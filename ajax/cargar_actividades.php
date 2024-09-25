<?php
session_start();
require_once '../config/Conexion.php'; // Incluir el archivo de conexión

// Obtener la conexión usando el método estático
$conexion = Conexion::conectar();

// Verificar la acción (crear, actualizar o eliminar)
$action = $_POST['action'] ?? '';

if ($action == 'create') {
    // Insertar nueva actividad
    $nombre_actividad = $_POST['nombre_actividad'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $id_comunidad = $_POST['id_comunidad'] ?? '';
    $recursos_utilizados = $_POST['recursos_utilizados'] ?? '';
    $id_beneficiario = $_POST['id_beneficiario'] ?? '';

    // Preparar la consulta para insertar la actividad
    $stmt = $conexion->prepare("INSERT INTO actividad (Nombre_Actividad, Descripcion, Fecha_Inicio, Fecha_Fin, Id_Comunidad, Recursos_Utilizados, Id_Beneficiario) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisi", $nombre_actividad, $descripcion, $fecha_inicio, $fecha_fin, $id_comunidad, $recursos_utilizados, $id_beneficiario);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

} elseif ($action == 'update') {
    // Actualizar actividad existente
    $id = $_POST['id'] ?? null;
    if ($id) {
        $nombre_actividad = $_POST['nombre_actividad'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $fecha_inicio = $_POST['fecha_inicio'] ?? '';
        $fecha_fin = $_POST['fecha_fin'] ?? '';
        $id_comunidad = $_POST['id_comunidad'] ?? '';
        $recursos_utilizados = $_POST['recursos_utilizados'] ?? '';
        $id_beneficiario = $_POST['id_beneficiario'] ?? '';

        // Preparar la consulta para actualizar la actividad
        $stmt = $conexion->prepare("UPDATE actividad SET Nombre_Actividad=?, Descripcion=?, Fecha_Inicio=?, Fecha_Fin=?, Id_Comunidad=?, Recursos_Utilizados=?, Id_Beneficiario=? WHERE Id_Actividad=?");
        $stmt->bind_param("ssssisi", $nombre_actividad, $descripcion, $fecha_inicio, $fecha_fin, $id_comunidad, $recursos_utilizados, $id_beneficiario, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
    }

} elseif ($action == 'delete') {
    // Eliminar actividad
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $conexion->prepare("DELETE FROM actividad WHERE Id_Actividad=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
}
?>
