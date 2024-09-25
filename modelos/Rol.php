<?php
// Incluir la conexión a la base de datos
require "../config/Conexion.php";

class Rol {
    // Constructor vacío
    public function __construct() {
    }

    // Método para insertar un nuevo rol
    public function insertar($nombre_rol) {
        $sql = "INSERT INTO rol (Nombre_Rol) VALUES ('$nombre_rol')";
        return ejecutarConsulta($sql);
    }

    // Método para editar un rol existente
    public function editar($id_rol, $nombre_rol) {
        $sql = "UPDATE rol SET Nombre_Rol='$nombre_rol' WHERE Id_Rol='$id_rol'";
        return ejecutarConsulta($sql);
    }

    // Método para eliminar un rol
    public function eliminar($id_rol) {
        $sql = "DELETE FROM rol WHERE Id_Rol='$id_rol'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un rol específico
    public function mostrar($id_rol) {
        $sql = "SELECT * FROM rol WHERE Id_Rol='$id_rol'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar todos los roles
    public function listar() {
        $sql = "SELECT * FROM rol";
        return ejecutarConsulta($sql);
    }
}
?>
