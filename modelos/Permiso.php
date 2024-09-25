<?php 
// Incluir la conexión a la base de datos
require "../config/Conexion.php";

class Permiso {

    // Implementamos nuestro constructor
    public function __construct() {}

    // Método para insertar un nuevo permiso
    public function insertar($nombre_permiso, $id_rol) {
        $sql = "INSERT INTO permiso (Nombre_Permiso, Id_Rol) VALUES ('$nombre_permiso', '$id_rol')";
        return ejecutarConsulta($sql);
    }

    // Método para editar un permiso existente
    public function editar($id_permiso, $nombre_permiso, $id_rol) {
        $sql = "UPDATE permiso SET Nombre_Permiso='$nombre_permiso', Id_Rol='$id_rol' WHERE Id_Permiso='$id_permiso'";
        return ejecutarConsulta($sql);
    }

    // Método para eliminar un permiso
    public function eliminar($id_permiso) {
        $sql = "DELETE FROM permiso WHERE Id_Permiso='$id_permiso'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un permiso específico
    public function mostrar($id_permiso) {
        $sql = "SELECT * FROM permiso WHERE Id_Permiso='$id_permiso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Listar todos los permisos con su respectivo rol asociado
    public function listar() {
        $sql = "SELECT p.Id_Permiso, p.Nombre_Permiso, r.Nombre_Rol 
                FROM permiso p 
                INNER JOIN rol r ON p.Id_Rol = r.Id_Rol";
        return ejecutarConsulta($sql);
    }
}
?>
