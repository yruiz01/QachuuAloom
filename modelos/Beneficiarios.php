<?php 
// Incluir la conexión a la base de datos
require "../config/Conexion.php";

class Beneficiarios {

    // Constructor
    public function __construct() {}

    // Método para insertar un nuevo beneficiario
    public function insertar($foto, $nombre_completo, $dpi, $id_comunidad, $ocupacion, $edad, $no_hijos, $telefono, $genero, $fecha_registro, $correo, $estado, $funcion) {
        $sql = "INSERT INTO beneficiarios (foto, Nombre_Completo, DPI, Id_Comunidad, Ocupacion, Edad, No_Hijos, Telefono, Genero, Fecha_Registro, Correo, Estado, Funcion)
                VALUES ('$foto', '$nombre_completo', '$dpi', '$id_comunidad', '$ocupacion', '$edad', '$no_hijos', '$telefono', '$genero', '$fecha_registro', '$correo', '$estado', '$funcion')";
        return ejecutarConsulta($sql);
    }

    // Método para editar un beneficiario existente
    public function editar($id, $foto, $nombre_completo, $dpi, $id_comunidad, $ocupacion, $edad, $no_hijos, $telefono, $genero, $fecha_registro, $correo, $estado, $funcion) {
        $sql = "UPDATE beneficiarios SET 
                    foto='$foto', 
                    Nombre_Completo='$nombre_completo', 
                    DPI='$dpi', 
                    Id_Comunidad='$id_comunidad', 
                    Ocupacion='$ocupacion', 
                    Edad='$edad', 
                    No_Hijos='$no_hijos', 
                    Telefono='$telefono', 
                    Genero='$genero', 
                    Fecha_Registro='$fecha_registro', 
                    Correo='$correo', 
                    Estado='$estado', 
                    Funcion='$funcion'
                WHERE Id_Beneficiario='$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar un beneficiario
    public function desactivar($id) {
        $sql = "UPDATE beneficiarios SET Estado='Inactivo' WHERE Id_Beneficiario='$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar un beneficiario
    public function activar($id) {
        $sql = "UPDATE beneficiarios SET Estado='Activo' WHERE Id_Beneficiario='$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar un beneficiario específico
    public function mostrar($id) {
        $sql = "SELECT * FROM beneficiarios WHERE Id_Beneficiario='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar todos los beneficiarios
    public function listar() {
        $sql = "SELECT * FROM beneficiarios ORDER BY Id_Beneficiario DESC";
        return ejecutarConsulta($sql);
    }

    // Método para verificar si un beneficiario existe en una comunidad específica
    public function verificar_beneficiario($id_comunidad) {
        $sql = "SELECT * FROM beneficiarios WHERE Id_Comunidad='$id_comunidad' AND Estado='Activo' ORDER BY Id_Beneficiario DESC";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar beneficiarios por comunidad y otros filtros
    public function listar_por_comunidad($id_comunidad) {
        $sql = "SELECT * FROM beneficiarios WHERE Id_Comunidad='$id_comunidad' AND Estado='Activo' ORDER BY Id_Beneficiario DESC";
        return ejecutarConsulta($sql);
    }
}
?>
