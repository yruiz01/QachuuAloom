<?php 
// Incluir la conexión a la base de datos
require "../config/Conexion.php";

class Comunidades {

    // Implementamos nuestro constructor
    public function __construct() {
    }

    // Método para insertar registro
    public function insertar($nombre_comunidad) {
        $sql = "INSERT INTO comunidades (Nombre_Comunidad) VALUES ('$nombre_comunidad')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registro
    public function editar($id_comunidad, $nombre_comunidad) {
        $sql = "UPDATE comunidades SET Nombre_Comunidad='$nombre_comunidad' WHERE Id_Comunidad='$id_comunidad'";
        return ejecutarConsulta($sql);
    }

    // Método para anular (desactivar) un registro
    public function anular($id_comunidad) {
        $sql = "UPDATE comunidades SET Estado='Anulado' WHERE Id_Comunidad='$id_comunidad'"; 
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id_comunidad) {
        $sql = "SELECT * FROM comunidades WHERE Id_Comunidad='$id_comunidad'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar todos los registros
    public function listar() {
        $sql = "SELECT * FROM comunidades ORDER BY Id_Comunidad DESC";
        return ejecutarConsulta($sql);
    }
}
?> 
