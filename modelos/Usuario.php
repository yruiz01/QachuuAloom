<?php 
//incluir la conexión de base de datos
require "../config/Conexion.php";

class Usuario {

    //implementamos nuestro constructor
    public function __construct(){

    }

    //método para insertar usuarios
    public function insertar($nombre_usuario, $correo, $telefono, $rol, $password, $imagen, $estado){
        $sql="INSERT INTO usuarios (Nombre_Usuario, Correo, Telefono, Rol, Password, Imagen, Estado)
        VALUES ('$nombre_usuario', '$correo', '$telefono', '$rol', '$password', '$imagen', '$estado')";
        return ejecutarConsulta($sql);
    }

    //método para editar usuarios
    public function editar($idusuario, $nombre_usuario, $correo, $telefono, $rol, $imagen, $estado){
        $sql="UPDATE usuarios SET Nombre_Usuario='$nombre_usuario', Correo='$correo', Telefono='$telefono',
              Rol='$rol', Imagen='$imagen', Estado='$estado' WHERE Id_Usuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //método para desactivar usuarios
    public function desactivar($idusuario){
        $sql="UPDATE usuarios SET Estado='Inactivo' WHERE Id_Usuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //método para activar usuarios
    public function activar($idusuario){
        $sql="UPDATE usuarios SET Estado='Activo' WHERE Id_Usuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //método para mostrar datos de un solo usuario
    public function mostrar($idusuario){
        $sql="SELECT * FROM usuarios WHERE Id_Usuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //método para listar todos los usuarios
    public function listar(){
        $sql="SELECT * FROM usuarios";
        return ejecutarConsulta($sql);
    }

    //método para verificar el acceso de un usuario
    public function verificar($nombre_usuario, $password){
        $sql="SELECT * FROM usuarios WHERE Nombre_Usuario='$nombre_usuario' AND Password='$password' AND Estado='Activo'";
        return ejecutarConsulta($sql);
    }

    //método para listar los permisos asignados a un usuario
    public function listarmarcados($idusuario){
        $sql="SELECT * FROM permiso_usuario WHERE Id_Usuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
}
?>
