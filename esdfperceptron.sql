-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2012 a las 20:45:14
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `esdfperceptron`
--

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
  `estado` char(1) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`identrada`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`identrada`, `descripcion`, `comentario`, `respuesta_positivo`, `respuesta_negativo`, `estado`) VALUES
(1, 'CUAL ES TU GENERO?', 'INDICA TU SEXO', 'Masculino', 'Femenino', 'N'),
(2, 'TE GUSTA SALIR?', 'INDICA SI TE GUSTA SALIR', 'Si', 'No', 'N'),
(3, 'SE HA CASADO?', 'INDICA SI TE HAS CASADO', 'Si', 'No', 'N'),
(4, 'TIENE HIJOS?', 'INDICA SI TIENES HIJOS', 'Si', 'No', 'N'),
(5, 'TE GUSTARIA FORMAR UNA FAMILIA?', 'INDICA SI TE GUSTARIA FORMAR UNA FAMILIA', 'Si', 'No', 'N');

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
  `idpersona` int(11) NOT NULL,
  `identrada` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`idrespuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=56 ;

--
-- Volcar la base de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idrespuesta`, `idpersona`, `identrada`, `valor`) VALUES
(1, 1, 1, 1.00),
(2, 1, 2, 1.00),
(3, 1, 3, 1.00),
(4, 1, 4, -1.00),
(5, 1, 5, 1.00),
(6, 2, 1, 1.00),
(7, 2, 2, 1.00),
(8, 2, 3, 1.00),
(9, 2, 4, -1.00),
(10, 2, 5, -1.00),
(11, 6, 1, 1.00),
(12, 6, 2, 1.00),
(13, 6, 3, -1.00),
(14, 6, 4, 1.00),
(15, 6, 5, 1.00),
(16, 7, 1, 1.00),
(17, 7, 2, 1.00),
(18, 7, 3, -1.00),
(19, 7, 4, -1.00),
(20, 7, 5, 1.00),
(21, 8, 1, 1.00),
(22, 8, 2, 1.00),
(23, 8, 3, -1.00),
(24, 8, 4, 1.00),
(25, 8, 5, 1.00),
(26, 9, 1, 1.00),
(27, 9, 2, -1.00),
(28, 9, 3, -1.00),
(29, 9, 4, 1.00),
(30, 9, 5, 1.00),
(31, 10, 1, 1.00),
(32, 10, 2, 1.00),
(33, 10, 3, -1.00),
(34, 10, 4, -1.00),
(35, 10, 5, -1.00),
(36, 11, 1, -1.00),
(37, 11, 2, -1.00),
(38, 11, 3, -1.00),
(39, 11, 4, 1.00),
(40, 11, 5, -1.00),
(41, 12, 1, -1.00),
(42, 12, 2, -1.00),
(43, 12, 3, -1.00),
(44, 12, 4, -1.00),
(45, 12, 5, -1.00),
(46, 13, 1, -1.00),
(47, 13, 2, -1.00),
(48, 13, 3, -1.00),
(49, 13, 4, 1.00),
(50, 13, 5, 1.00),
(51, 14, 1, -1.00),
(52, 14, 2, -1.00),
(53, 14, 3, 1.00),
(54, 14, 4, 1.00),
(55, 14, 5, 1.00);

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
