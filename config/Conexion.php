<?php
if (!class_exists('Conexion')) {
    class Conexion {
        public static function conectar() {
            static $conexion = null; // Esto evita crear múltiples conexiones
            if ($conexion === null) {
                $conexion = new mysqli("localhost", "root", "", "qachuu_aloom");
                $conexion->set_charset("utf8");

                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }
            }
            return $conexion;
        }
    }
}

// Verificar si la función ejecutarConsulta no ha sido declarada previamente
if (!function_exists('ejecutarConsulta')) {
    function ejecutarConsulta($sql) {
        $conexion = Conexion::conectar();
        $resultado = $conexion->query($sql);

        if ($resultado === false) {
            die("Error en la consulta: " . $conexion->error);
        }

        return $resultado;
    }
}

// Verificar si la función ejecutarConsultaSimpleFila no ha sido declarada previamente
if (!function_exists('ejecutarConsultaSimpleFila')) {
    function ejecutarConsultaSimpleFila($sql) {
        $conexion = Conexion::conectar();
        $resultado = $conexion->query($sql);

        if ($resultado === false) {
            die("Error en la consulta: " . $conexion->error);
        }

        return $resultado->fetch_assoc();
    }
}

// Verificar si la función ejecutarConsulta_retornarID no ha sido declarada previamente
if (!function_exists('ejecutarConsulta_retornarID')) {
    function ejecutarConsulta_retornarID($sql) {
        $conexion = Conexion::conectar();
        $resultado = $conexion->query($sql);

        if ($resultado === false) {
            die("Error en la consulta: " . $conexion->error);
        }

        return $conexion->insert_id;
    }
}
?>
