-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-03-2012 a las 12:47:16
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `esdfperceptron`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocatoria`
--

CREATE TABLE `convocatoria` (
  `idconvocatoria` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) collate utf8_spanish_ci NOT NULL,
  `idperfil` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`idconvocatoria`),
  KEY `idperfil` (`idperfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `convocatoria`
--

INSERT INTO `convocatoria` (`idconvocatoria`, `nombre`, `idperfil`, `fechainicio`, `fechafin`, `estado`) VALUES
(1, 'DOCENTE MATEMATICA MARZO-I', 1, '2012-03-24', '2012-03-24', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL auto_increment,
  `descripcion` varchar(500) collate utf8_spanish_ci NOT NULL,
  `comentario` text collate utf8_spanish_ci NOT NULL,
  `respuesta_positivo` varchar(100) collate utf8_spanish_ci NOT NULL default 'SI' COMMENT 'Valor de la respuesta 1',
  `respuesta_negativo` varchar(100) collate utf8_spanish_ci NOT NULL default 'NO' COMMENT 'Valor de la respuesta -1',
  `puntaje` decimal(10,2) NOT NULL,
  `idrubro` int(11) NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`identrada`),
  KEY `idrubro` (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`identrada`, `descripcion`, `comentario`, `respuesta_positivo`, `respuesta_negativo`, `puntaje`, `idrubro`, `estado`) VALUES
(1, 'Grado de Doctor', 'Grado de Doctor', 'Si', 'No', 10.00, 1, 'N'),
(2, 'Grado de Maestro', 'Grado de Maestro', 'Si', 'No', 8.00, 1, 'N'),
(3, 'Título Profesional', 'Título Profesional', 'Si', 'No', 6.00, 1, 'N'),
(4, 'Bachiller', 'Bachiller', 'Si', 'No', 3.00, 1, 'N'),
(5, 'Título Segunda Profesión', 'Título Segunda Profesión', 'Si', 'No', 5.00, 1, 'N'),
(6, 'Doctorado', 'Doctorado', 'Si', 'No', 5.00, 2, 'N'),
(7, 'Maestría', 'Maestría', 'Si', 'No', 3.00, 2, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `idparametro` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) collate utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) collate utf8_spanish_ci NOT NULL,
  `valor` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`idparametro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `parametro`
--

INSERT INTO `parametro` (`idparametro`, `nombre`, `descripcion`, `valor`) VALUES
(1, 'MEMBRESIA DE SALIDA FINAL', 'MEMBRESIA DE SALIDA FINAL', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) collate utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) collate utf8_spanish_ci NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`idperfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'DOCENTE', 'DOCENTE UNIVERSITARIO', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfilbuscado`
--

CREATE TABLE `perfilbuscado` (
  `idperfilbuscado` int(11) NOT NULL auto_increment,
  `idconvocatoria` int(11) NOT NULL,
  `identrada` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`idperfilbuscado`),
  KEY `idconvocatoria` (`idconvocatoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=36 ;

--
-- Volcar la base de datos para la tabla `perfilbuscado`
--

INSERT INTO `perfilbuscado` (`idperfilbuscado`, `idconvocatoria`, `identrada`, `valor`) VALUES
(29, 1, 1, -1.00),
(30, 1, 2, 1.00),
(31, 1, 3, -1.00),
(32, 1, 4, -1.00),
(33, 1, 5, -1.00),
(34, 1, 6, 1.00),
(35, 1, 7, -1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL auto_increment,
  `codigo` varchar(10) collate utf8_spanish_ci NOT NULL,
  `apellidopaterno` varchar(25) collate utf8_spanish_ci NOT NULL,
  `apellidomaterno` varchar(25) collate utf8_spanish_ci NOT NULL,
  `nombres` varchar(25) collate utf8_spanish_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `lugarnacimiento` varchar(25) collate utf8_spanish_ci NOT NULL,
  `sexo` char(1) collate utf8_spanish_ci NOT NULL,
  `nrodoc` varchar(8) collate utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) collate utf8_spanish_ci NOT NULL,
  `estadocivil` char(1) collate utf8_spanish_ci NOT NULL COMMENT 'S->Soltero,C->Casado,D->Divorsiado,V-Viudo',
  `telefonofijo` varchar(10) collate utf8_spanish_ci NOT NULL,
  `celular` varchar(10) collate utf8_spanish_ci NOT NULL,
  `email` varchar(50) collate utf8_spanish_ci NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  `foto` varchar(255) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`idpersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcar la base de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `codigo`, `apellidopaterno`, `apellidomaterno`, `nombres`, `fechanacimiento`, `lugarnacimiento`, `sexo`, `nrodoc`, `direccion`, `estadocivil`, `telefonofijo`, `celular`, `email`, `estado`, `foto`) VALUES
(1, '001', 'MONTENEGRO', 'COCHAS', 'GEYNEN', '1987-10-07', 'Lonya Grande', 'M', '44611543', 'Jr.Colombia 217 Chiclayo', 'S', '', '979368623', 'geynen_0710@hotmail.com', 'N', ''),
(2, '002', 'QUINTANA', 'PEREZ', 'RONNIE', '2011-11-24', '', 'M', '11111111', 'XX', 'S', 'x', 'x', 'x', 'N', ''),
(6, '003', 'MONTENEGRO', 'COCHAS', 'JEFFER', '2011-12-12', '', 'M', '43434343', '', 'S', '', '', '', 'N', ''),
(7, '004', '', '', 'MANE', '2012-03-15', '', 'M', '11111111', '', 'S', '', '', '', 'N', ''),
(8, '005', '', '', 'VILMAR', '2012-03-15', '', 'M', '11111111', '', 'S', '', '', '', 'N', ''),
(9, '006', '', '', 'FLAVIO', '2012-03-15', '', 'M', '11111111', '', 'S', '', '', '', 'N', ''),
(10, '007', '', '', 'PAULO', '2012-03-15', '', 'M', '11111111', '', 'S', '', '', '', 'N', ''),
(11, '008', '', '', 'MARIA', '2012-03-15', '', 'F', '11111111', '', 'S', '', '', '', 'N', ''),
(12, '009', '', '', 'KARINA', '2012-03-15', '', 'F', '11111111', '', 'S', '', '', '', 'N', ''),
(13, '010', '', '', 'KATIA', '2012-03-15', '', 'F', '11111111', '', 'S', '', '', '', 'N', ''),
(14, '011', '', '', 'FLAVIA', '2012-03-15', '', 'F', '11111111', '', 'S', '', '', '', 'N', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idrespuesta` int(11) NOT NULL auto_increment,
  `idconvocatoria` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `identrada` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`idrespuesta`),
  KEY `idconvocatoria` (`idconvocatoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=29 ;

--
-- Volcar la base de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idrespuesta`, `idconvocatoria`, `idpersona`, `identrada`, `valor`) VALUES
(1, 1, 1, 1, -1.00),
(2, 1, 1, 2, 1.00),
(3, 1, 1, 3, 1.00),
(4, 1, 1, 4, -1.00),
(5, 1, 1, 5, -1.00),
(6, 1, 1, 6, 1.00),
(7, 1, 1, 7, -1.00),
(15, 1, 2, 1, -1.00),
(16, 1, 2, 2, 1.00),
(17, 1, 2, 3, 1.00),
(18, 1, 2, 4, -1.00),
(19, 1, 2, 5, -1.00),
(20, 1, 2, 6, 1.00),
(21, 1, 2, 7, -1.00),
(22, 1, 6, 1, -1.00),
(23, 1, 6, 2, -1.00),
(24, 1, 6, 3, 1.00),
(25, 1, 6, 4, 1.00),
(26, 1, 6, 5, -1.00),
(27, 1, 6, 6, -1.00),
(28, 1, 6, 7, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

CREATE TABLE `rubro` (
  `idrubro` int(11) NOT NULL auto_increment,
  `descripcion` text collate utf8_spanish_ci NOT NULL,
  `puntaje` decimal(10,2) NOT NULL,
  `tipo` char(1) collate utf8_spanish_ci NOT NULL COMMENT 'Indica tipo de selección M->Multiple, U->Unica',
  `idperfil` int(11) NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL default 'N',
  PRIMARY KEY  (`idrubro`),
  KEY `idperfil` (`idperfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `rubro`
--

INSERT INTO `rubro` (`idrubro`, `descripcion`, `puntaje`, `tipo`, `idperfil`, `estado`) VALUES
(1, 'GRADOS Y TITULOS', 20.00, 'M', 1, 'N'),
(2, 'ESTUDIOS CONCLUIDOS', 5.00, 'U', 1, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipousuario` int(11) NOT NULL auto_increment,
  `descripcion` varchar(30) collate utf8_spanish_ci NOT NULL,
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`idtipousuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipousuario`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'N'),
(2, 'Postulante', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL auto_increment,
  `idpersona` int(11) NOT NULL,
  `login` varchar(40) collate utf8_spanish_ci NOT NULL,
  `clave` varchar(32) collate utf8_spanish_ci NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  PRIMARY KEY  (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idpersona`, `login`, `clave`, `idtipousuario`) VALUES
(1, 1, 'admin', '202cb962ac59075b964b07152d234b70', 1),
(2, 6, 'jeffer', '202cb962ac59075b964b07152d234b70', 2);
