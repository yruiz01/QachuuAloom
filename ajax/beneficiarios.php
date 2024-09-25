<?php 
require_once "../modelos/Beneficiarios.php";
if (strlen(session_id()) < 1) 
	session_start();

$beneficiarios = new Beneficiarios();

$id = isset($_POST["idbeneficiario"]) ? limpiarCadena($_POST["idbeneficiario"]) : "";
$foto = isset($_POST["foto"]) ? limpiarCadena($_POST["foto"]) : "";
$nombre_completo = isset($_POST["nombre_completo"]) ? limpiarCadena($_POST["nombre_completo"]) : "";
$dpi = isset($_POST["dpi"]) ? limpiarCadena($_POST["dpi"]) : "";
$id_comunidad = isset($_POST["id_comunidad"]) ? limpiarCadena($_POST["id_comunidad"]) : "";
$ocupacion = isset($_POST["ocupacion"]) ? limpiarCadena($_POST["ocupacion"]) : "";
$edad = isset($_POST["edad"]) ? limpiarCadena($_POST["edad"]) : "";
$no_hijos = isset($_POST["no_hijos"]) ? limpiarCadena($_POST["no_hijos"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$genero = isset($_POST["genero"]) ? limpiarCadena($_POST["genero"]) : "";
$fecha_registro = isset($_POST["fecha_registro"]) ? limpiarCadena($_POST["fecha_registro"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena($_POST["correo"]) : "";
$estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]) : "";
$funcion = isset($_POST["funcion"]) ? limpiarCadena($_POST["funcion"]) : "";

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])) {
		$foto = $_POST["fotoactual"];
	} else {
		$ext = explode(".", $_FILES["foto"]["name"]);
		if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png") {
			$foto = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["foto"]["tmp_name"], "../files/beneficiarios/" . $foto);
		}
	}

	if (empty($id)) {
		$rspta = $beneficiarios->insertar($foto, $nombre_completo, $dpi, $id_comunidad, $ocupacion, $edad, $no_hijos, $telefono, $genero, $fecha_registro, $correo, $estado, $funcion); 
		echo $rspta ? "Beneficiario registrado correctamente" : "No se pudo registrar el beneficiario";
	} else {
		$rspta = $beneficiarios->editar($id, $foto, $nombre_completo, $dpi, $id_comunidad, $ocupacion, $edad, $no_hijos, $telefono, $genero, $fecha_registro, $correo, $estado, $funcion);
		echo $rspta ? "Beneficiario actualizado correctamente" : "No se pudo actualizar el beneficiario"; 
	}
	break;

	case 'desactivar':
		$rspta = $beneficiarios->desactivar($id);
		echo $rspta ? "Beneficiario desactivado correctamente" : "No se pudo desactivar el beneficiario";
		break;

	case 'activar':
		$rspta = $beneficiarios->activar($id);
		echo $rspta ? "Beneficiario activado correctamente" : "No se pudo activar el beneficiario";
		break;
	
	case 'mostrar':
		$rspta = $beneficiarios->mostrar($id);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta = $beneficiarios->listar();   
		$data = Array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => ($reg->Estado == 'Activo') 
					? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->Id_Beneficiario . ')"><i class="fa fa-pencil"></i></button>' . ' ' . 
					  '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->Id_Beneficiario . ')"><i class="fa fa-close"></i></button>'
					: '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->Id_Beneficiario . ')"><i class="fa fa-pencil"></i></button>' . ' ' . 
					  '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->Id_Beneficiario . ')"><i class="fa fa-check"></i></button>',
				"1" => "<img src='../files/beneficiarios/" . $reg->foto . "' height='50px' width='50px'>",
				"2" => $reg->Nombre_Completo,
				"3" => $reg->Telefono,
				"4" => $reg->Correo,
				"5" => $reg->DPI,
				"6" => $reg->Ocupacion,
				"7" => $reg->Edad,
				"8" => $reg->No_Hijos,
				"9" => $reg->Estado
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
