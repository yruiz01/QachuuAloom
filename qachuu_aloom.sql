-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci�n: 12-01-2020 a las 17:46:14
-- Versi�n del servidor: 10.4.6-MariaDB
-- Versi�n de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--Base de datos: qachuu_aloom
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla actividad
--

CREATE TABLE actividad (
  Id_Actividad int(11) NOT NULL,
  Nombre_Actividad varchar(255) DEFAULT NULL,
  Descripcion text DEFAULT NULL,
  Fecha_Inicio date DEFAULT NULL,
  Fecha_Fin date DEFAULT NULL,
  Id_Comunidad int(11) DEFAULT NULL,
  Recursos_Utilizados text DEFAULT NULL,
  Id_Beneficiario int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla beneficiarios
--

CREATE TABLE beneficiarios (
  Id_Beneficiario int(11) NOT NULL,
  foto varchar(100) DEFAULT NULL,
  Nombre_Completo varchar(255) DEFAULT NULL,
  DPI varchar(20) DEFAULT NULL,
  Id_Comunidad int(11) DEFAULT NULL,
  Ocupacion varchar(255) DEFAULT NULL,
  Edad int(11) DEFAULT NULL,
  No_Hijos int(11) DEFAULT NULL,
  Telefono varchar(20) DEFAULT NULL,
  Genero varchar(20) DEFAULT NULL,
  Fecha_Registro date DEFAULT NULL,
  Correo varchar(255) DEFAULT NULL,
  Estado varchar(20) DEFAULT NULL,
  Funcion enum('Socio','Participante','Guía') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla comunidad
--

CREATE TABLE comunidad (
  Id_Comunidad int(11) NOT NULL,
  Nombre_Comunidad varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla participacion_proyectos
--

CREATE TABLE participacion_proyectos (
  Id_Participacion int(11) NOT NULL,
  Id_Beneficiario int(11) DEFAULT NULL,
  Id_Proyecto int(11) DEFAULT NULL,
  Fecha_Participacion date DEFAULT NULL,
  Comentarios text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla permisos
--

CREATE TABLE permisos (
  Id_Permiso int(11) NOT NULL,
  Nombre_Permiso varchar(50) DEFAULT NULL,
  Id_Rol int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla proyecto
--

CREATE TABLE proyecto (
  Id_Proyecto int(11) NOT NULL,
  Nombre_Proyecto varchar(255) DEFAULT NULL,
  Descripcion text DEFAULT NULL,
  Fecha_Inicio date DEFAULT NULL,
  Fecha_Fin date DEFAULT NULL,
  Estado varchar(50) DEFAULT NULL,
  Estado_Alerta date DEFAULT NULL,
  Id_Comunidad int(11) DEFAULT NULL,
  Responsable varchar(255) DEFAULT NULL,
  Archivo_PDF longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla reporte
--

CREATE TABLE reporte (
  Id_Reporte int(11) NOT NULL,
  Nombre_Reporte varchar(255) DEFAULT NULL,
  Tipo_Reporte varchar(255) DEFAULT NULL,
  Fecha_Creacion date DEFAULT NULL,
  Contenido text DEFAULT NULL,
  Criterios text DEFAULT NULL,
  Id_Usuario int(11) DEFAULT NULL,
  Id_Actividad int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla roles
--

CREATE TABLE roles (
  Id_Rol int(11) NOT NULL,
  Nombre_Rol varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tabla_notificaciones
--

CREATE TABLE tabla_notificaciones (
  Id_Notificacion int(11) NOT NULL,
  Id_Usuario int(11) DEFAULT NULL,
  Tipo_Notificacion varchar(255) DEFAULT NULL,
  Contenido text DEFAULT NULL,
  Fecha_Envio date DEFAULT NULL,
  Estado varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE usuarios (
  Id_Usuario int(11) NOT NULL,
  Imagen varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  Nombre_Usuario varchar(255) DEFAULT NULL,
  Correo varchar(255) DEFAULT NULL,
  Password varchar(255) DEFAULT NULL,
  Telefono int(8) NOT NULL,
  Rol int(11) DEFAULT NULL,
  Fecha_Creacion date DEFAULT NULL,
  Ultimo_Ingreso date DEFAULT NULL,
  Estado varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla usuarios
--

INSERT INTO usuarios (Id_Usuario, Imagen, Nombre_Usuario, Correo, Password, Telefono, Rol, Fecha_Creacion, Ultimo_Ingreso, Estado) VALUES
(3, '', 'admin', 'admin@example.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0, NULL, '2024-09-25', NULL, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla actividad
--
ALTER TABLE actividad
  ADD PRIMARY KEY (Id_Actividad),
  ADD KEY Id_Comunidad (Id_Comunidad),
  ADD KEY Id_Beneficiario (Id_Beneficiario);

--
-- Indices de la tabla beneficiarios
--
ALTER TABLE beneficiarios
  ADD PRIMARY KEY (Id_Beneficiario),
  ADD KEY Id_Comunidad (Id_Comunidad);

--
-- Indices de la tabla comunidad
--
ALTER TABLE comunidad
  ADD PRIMARY KEY (Id_Comunidad);

--
-- Indices de la tabla participacion_proyectos
--
ALTER TABLE participacion_proyectos
  ADD PRIMARY KEY (Id_Participacion),
  ADD KEY Id_Beneficiario (Id_Beneficiario),
  ADD KEY Id_Proyecto (Id_Proyecto);

--
-- Indices de la tabla permisos
--
ALTER TABLE permisos
  ADD PRIMARY KEY (Id_Permiso),
  ADD KEY Id_Rol (Id_Rol);

--
-- Indices de la tabla proyecto
--
ALTER TABLE proyecto
  ADD PRIMARY KEY (Id_Proyecto),
  ADD KEY Id_Comunidad (Id_Comunidad);

--
-- Indices de la tabla reporte
--
ALTER TABLE reporte
  ADD PRIMARY KEY (Id_Reporte),
  ADD KEY Id_Usuario (Id_Usuario),
  ADD KEY Id_Actividad (Id_Actividad);

--
-- Indices de la tabla roles
--
ALTER TABLE roles
  ADD PRIMARY KEY (Id_Rol);

--
-- Indices de la tabla tabla_notificaciones
--
ALTER TABLE tabla_notificaciones
  ADD PRIMARY KEY (Id_Notificacion),
  ADD KEY Id_Usuario (Id_Usuario);

--
-- Indices de la tabla usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (Id_Usuario),
  ADD KEY Rol (Rol);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla actividad
--
ALTER TABLE actividad
  MODIFY Id_Actividad int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla beneficiarios
--
ALTER TABLE beneficiarios
  MODIFY Id_Beneficiario int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla comunidad
--
ALTER TABLE comunidad
  MODIFY Id_Comunidad int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla participacion_proyectos
--
ALTER TABLE participacion_proyectos
  MODIFY Id_Participacion int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla permisos
--
ALTER TABLE permisos
  MODIFY Id_Permiso int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla proyecto
--
ALTER TABLE proyecto
  MODIFY Id_Proyecto int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla reporte
--
ALTER TABLE reporte
  MODIFY Id_Reporte int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla roles
--
ALTER TABLE roles
  MODIFY Id_Rol int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla tabla_notificaciones
--
ALTER TABLE tabla_notificaciones
  MODIFY Id_Notificacion int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla usuarios
--
ALTER TABLE usuarios
  MODIFY Id_Usuario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla actividad
--
ALTER TABLE actividad
  ADD CONSTRAINT actividad_ibfk_1 FOREIGN KEY (Id_Comunidad) REFERENCES comunidad (Id_Comunidad),
  ADD CONSTRAINT actividad_ibfk_2 FOREIGN KEY (Id_Beneficiario) REFERENCES beneficiarios (Id_Beneficiario);

--
-- Filtros para la tabla beneficiarios
--
ALTER TABLE beneficiarios
  ADD CONSTRAINT beneficiarios_ibfk_1 FOREIGN KEY (Id_Comunidad) REFERENCES comunidad (Id_Comunidad);

--
-- Filtros para la tabla participacion_proyectos
--
ALTER TABLE participacion_proyectos
  ADD CONSTRAINT participacion_proyectos_ibfk_1 FOREIGN KEY (Id_Beneficiario) REFERENCES beneficiarios (Id_Beneficiario),
  ADD CONSTRAINT participacion_proyectos_ibfk_2 FOREIGN KEY (Id_Proyecto) REFERENCES proyecto (Id_Proyecto);

--
-- Filtros para la tabla permisos
--
ALTER TABLE permisos
  ADD CONSTRAINT permisos_ibfk_1 FOREIGN KEY (Id_Rol) REFERENCES roles (Id_Rol);

--
-- Filtros para la tabla proyecto
--
ALTER TABLE proyecto
  ADD CONSTRAINT proyecto_ibfk_1 FOREIGN KEY (Id_Comunidad) REFERENCES comunidad (Id_Comunidad);

--
-- Filtros para la tabla reporte
--
ALTER TABLE reporte
  ADD CONSTRAINT reporte_ibfk_1 FOREIGN KEY (Id_Usuario) REFERENCES usuarios (Id_Usuario),
  ADD CONSTRAINT reporte_ibfk_2 FOREIGN KEY (Id_Actividad) REFERENCES actividad (Id_Actividad);

--
-- Filtros para la tabla tabla_notificaciones
--
ALTER TABLE tabla_notificaciones
  ADD CONSTRAINT tabla_notificaciones_ibfk_1 FOREIGN KEY (Id_Usuario) REFERENCES usuarios (Id_Usuario);

--
-- Filtros para la tabla usuarios
--
ALTER TABLE usuarios
  ADD CONSTRAINT usuarios_ibfk_1 FOREIGN KEY (Rol) REFERENCES roles (Id_Rol);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;