<?php
require_once "../modelos/Rol.php";

$rol = new Rol();

$id_rol = isset($_POST["id_rol"]) ? limpiarCadena($_POST["id_rol"]) : "";
$nombre_rol = isset($_POST["nombre_rol"]) ? limpiarCadena($_POST["nombre_rol"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id_rol)) {
            $rspta = $rol->insertar($nombre_rol);
            echo $rspta ? "Rol registrado correctamente" : "No se pudo registrar el rol";
        } else {
            $rspta = $rol->editar($id_rol, $nombre_rol);
            echo $rspta ? "Rol actualizado correctamente" : "No se pudo actualizar el rol";
        }
        break;

    case 'eliminar':
        $rspta = $rol->eliminar($id_rol);
        echo $rspta ? "Rol eliminado correctamente" : "No se pudo eliminar el rol";
        break;

    case 'mostrar':
        $rspta = $rol->mostrar($id_rol);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $rol->listar();
        $data = Array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->Id_Rol . ')"><i class="fa fa-pencil"></i></button>' .
                       ' <button class="btn btn-danger" onclick="eliminar(' . $reg->Id_Rol . ')"><i class="fa fa-trash"></i></button>',
                "1" => $reg->Nombre_Rol
            );
        }
        $results = array(
            "sEcho" => 1, // Información para datatables
            "iTotalRecords" => count($data), // Total de registros
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
?>
