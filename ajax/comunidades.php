<?php 
require_once "../modelos/Comunidades.php"; // Cambiar por el nuevo modelo de comunidades
if (strlen(session_id())<1) 
    session_start();

$comunidades = new Comunidades();

$id_comunidad = isset($_POST["id_comunidad"]) ? limpiarCadena($_POST["id_comunidad"]) : "";
$nombre_comunidad = isset($_POST["nombre_comunidad"]) ? limpiarCadena($_POST["nombre_comunidad"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id_comunidad)) {
            $rspta = $comunidades->insertar($nombre_comunidad);
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
        } else {
            $rspta = $comunidades->editar($id_comunidad, $nombre_comunidad);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }
        break;

    case 'anular':
        $rspta = $comunidades->anular($id_comunidad);
        echo $rspta ? "Comunidad anulada correctamente" : "No se pudo anular la comunidad";
        break;

    case 'mostrar':
        $rspta = $comunidades->mostrar($id_comunidad);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $comunidades->listar();
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->Id_Comunidad.')"><i class="fa fa-pencil"></i></button>' .
                       ' <button class="btn btn-danger btn-xs" onclick="anular('.$reg->Id_Comunidad.')"><i class="fa fa-close"></i></button>',
                "1" => $reg->Nombre_Comunidad
            );
        }

        $results = array(
            "sEcho" => 1, // Info para datatables
            "iTotalRecords" => count($data), // Total de registros
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
?> 
