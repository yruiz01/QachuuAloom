<?php
session_start();
require_once "../modelos/Usuario.php";

// Puntos de depuración
header('Content-Type: text/plain'); // Para asegurarte de que veas la salida en texto

echo "Usuario.php está siendo ejecutado\n";

// Revisa si $_POST tiene los valores correctos
if (empty($_POST['logina']) || empty($_POST['clavea'])) {
    echo "Error: Falta logina o clavea\n";
    print_r($_POST); // Muestra los datos recibidos
    exit;
}
$usuario = new Usuario();

$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre_usuario = isset($_POST["nombre_usuario"]) ? limpiarCadena($_POST["nombre_usuario"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena($_POST["correo"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$rol = isset($_POST["rol"]) ? limpiarCadena($_POST["rol"]) : "";
$password = isset($_POST["password"]) ? limpiarCadena($_POST["password"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";
$estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Manejamos la imagen si se subió una nueva
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            }
        }

        // Hash SHA256 para la contraseña
        $clavehash = hash("SHA256", $password);

        if (empty($idusuario)) {
            $rspta = $usuario->insertar($nombre_usuario, $correo, $telefono, $rol, $clavehash, $imagen, $estado);
            echo $rspta ? "Usuario registrado correctamente" : "No se pudo registrar el usuario";
        } else {
            $rspta = $usuario->editar($idusuario, $nombre_usuario, $correo, $telefono, $rol, $imagen, $estado);
            echo $rspta ? "Usuario actualizado correctamente" : "No se pudo actualizar el usuario";
        }
    break;

    case 'desactivar':
        $rspta = $usuario->desactivar($idusuario);
        echo $rspta ? "Usuario desactivado correctamente" : "No se pudo desactivar el usuario";
    break;

    case 'activar':
        $rspta = $usuario->activar($idusuario);
        echo $rspta ? "Usuario activado correctamente" : "No se pudo activar el usuario";
    break;

    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario);
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $usuario->listar();
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->Estado == 'Activo') ? 
                    '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->Id_Usuario . ')"><i class="fa fa-pencil"></i></button>' . ' ' . 
                    '<button class="btn btn-info btn-xs" onclick="mostrar_clave(' . $reg->Id_Usuario . ')"><i class="fa fa-key"></i></button>' . ' ' . 
                    '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->Id_Usuario . ')"><i class="fa fa-close"></i></button>' : 
                    '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->Id_Usuario . ')"><i class="fa fa-pencil"></i></button>' . ' ' . 
                    '<button class="btn btn-info btn-xs" onclick="mostrar_clave(' . $reg->Id_Usuario . ')"><i class="fa fa-key"></i></button>' . ' ' . 
                    '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->Id_Usuario . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->Nombre_Usuario,
                "2" => $reg->Correo,
                "3" => $reg->Telefono,
                "4" => $reg->Rol,
                "5" => "<img src='../files/usuarios/" . $reg->Imagen . "' height='50px' width='50px'>",
                "6" => ($reg->Estado == 'Activo') ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
            );
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
    break;

    case 'verificar':
        // Validar si el usuario tiene acceso al sistema
        $nombre_usuario = $_POST['logina'];
        $password = $_POST['clavea'];

        // Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $password);
    
        $rspta = $usuario->verificar($nombre_usuario, $clavehash);
        $fetch = $rspta->fetch_object();

        if ($fetch) {
            // Declaramos las variables de sesión
            $_SESSION['id_usuario'] = $fetch->Id_Usuario;
            $_SESSION['nombre_usuario'] = $fetch->Nombre_Usuario;
            $_SESSION['imagen'] = $fetch->Imagen;
            $_SESSION['correo'] = $fetch->Correo;
            $_SESSION['rol'] = $fetch->Rol;

            // Asignar permisos basados en el rol
            switch ($fetch->Rol) {
                case 'Administrador':
                    $_SESSION['escritorio'] = 1;
                    $_SESSION['actividades'] = 1;
                    break;
                case 'Supervisor':
                    $_SESSION['escritorio'] = 1;
                    $_SESSION['actividades'] = 1;
                    break;
                case 'Colaborador':
                    $_SESSION['escritorio'] = 0;
                    $_SESSION['actividades'] = 1;
                    break;
            }
            // Enviar respuesta JSON
            header('Content-Type: application/json');
            echo json_encode($fetch);
        } else {
            // Enviar respuesta nula si no se encuentra el usuario
            header('Content-Type: application/json');
            echo json_encode(null);
        }
    break;

    case 'salir':
        // Limpiamos las variables de sesión
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    break;
}
?>
