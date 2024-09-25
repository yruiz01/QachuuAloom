<?php 
require_once "../modelos/Permiso.php";

$permiso = new Permiso();

switch ($_GET["op"]) {
    
    case 'listar':
        $rspta = $permiso->listar();
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->Nombre_Permiso,
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

    case 'guardaryeditar':
        $id_permiso = isset($_POST["id_permiso"]) ? limpiarCadena($_POST["id_permiso"]) : "";
        $nombre_permiso = isset($_POST["nombre_permiso"]) ? limpiarCadena($_POST["nombre_permiso"]) : "";
        $id_rol = isset($_POST["id_rol"]) ? limpiarCadena($_POST["id_rol"]) : "";

        if (empty($id_permiso)) {
            // Insertar nuevo permiso
            $rspta = $permiso->insertar($nombre_permiso, $id_rol);
            echo $rspta ? "Permiso registrado correctamente" : "No se pudo registrar el permiso";
        } else {
            // Editar permiso existente
            $rspta = $permiso->editar($id_permiso, $nombre_permiso, $id_rol);
            echo $rspta ? "Permiso actualizado correctamente" : "No se pudo actualizar el permiso";
        }
        break;

    case 'eliminar':
        $id_permiso = isset($_POST["id_permiso"]) ? limpiarCadena($_POST["id_permiso"]) : "";
        $rspta = $permiso->eliminar($id_permiso);
        echo $rspta ? "Permiso eliminado correctamente" : "No se pudo eliminar el permiso";
        break;

    case 'mostrar':
        $id_permiso = isset($_POST["id_permiso"]) ? limpiarCadena($_POST["id_permiso"]) : "";
        $rspta = $permiso->mostrar($id_permiso);
        echo json_encode($rspta);
        break;
}
?>
