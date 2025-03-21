-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2025 a las 17:15:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Apellidop` varchar(30) DEFAULT NULL,
  `Aellidom` varchar(30) DEFAULT NULL,
  `Matricula` varchar(20) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `correo`, `Nombre`, `Apellidop`, `Aellidom`, `Matricula`, `Password`) VALUES
(1, 'admins@gmail.com', 'Admin', '', NULL, ' A2025', '123'),
(2, '', 'Admin2', NULL, NULL, 'A2031', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Id_alumno` int(11) NOT NULL,
  `Matricula` varchar(20) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidop` varchar(100) DEFAULT NULL,
  `Apellidom` varchar(100) DEFAULT NULL,
  `grupo` varchar(11) NOT NULL,
  `grado` int(11) NOT NULL,
  `nivel` enum('PREESCOLAR','PRIMARIA','SECUNDARIA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Id_alumno`, `Matricula`, `Nombre`, `Apellidop`, `Apellidom`, `grupo`, `grado`, `nivel`) VALUES
(1, '20250001', 'LUAN ALFONSO', 'CAMPOS', 'TREJO', 'M', 1, 'PREESCOLAR'),
(2, '20250002', 'DEREK', 'MARTINEZ', 'PAREDES', 'M', 1, 'PREESCOLAR'),
(3, '20250003', 'AMY CAMILA', 'BELTRAN', 'HINOJOSA', 'A', 1, 'PREESCOLAR'),
(4, '20250004', 'JUAN EMILIO', 'DURAN', 'CRUZ', 'A', 1, 'PREESCOLAR'),
(5, '20250005', 'IVAN', 'RANGEL', 'ALDO', 'A', 1, 'PREESCOLAR'),
(6, '20250006', 'VALENTIN', 'RECENDIZ', 'GODINEZ', 'A', 1, 'PREESCOLAR'),
(7, '20250007', 'NICOLAS', 'ROMERO', 'RAMIREZ', 'A', 1, 'PREESCOLAR'),
(8, '20250008', 'CAIN EMILIO', 'CRUZ', 'QUITERIO', 'A', 2, 'PREESCOLAR'),
(9, '20250009', 'MATTEO EMISAEL', 'DAJUI', 'QUITERIO', 'A', 2, 'PREESCOLAR'),
(10, '20250010', 'ALONSO EMMANUEL', 'DE LA CRUZ', 'PEREZ', 'A', 2, 'PREESCOLAR'),
(11, '20250011', 'IVANNA SCARLETT', 'ESCOBAR', 'ANGELES', 'A', 2, 'PREESCOLAR'),
(12, '20250012', 'RENATA', 'ESTRADA', 'RIVERA', 'A', 2, 'PREESCOLAR'),
(13, '20250013', 'CHRISTIAN DAMIAN', 'GARCIA', 'JUAREZ', 'A', 2, 'PREESCOLAR'),
(14, '20250014', 'LIAN MATEO', 'LOPEZ', 'PALMA', 'A', 2, 'PREESCOLAR'),
(15, '20250015', 'ALEJANDRA DANIA', 'LUGO', 'RAMIREZ', 'A', 2, 'PREESCOLAR'),
(16, '20250016', 'SALVADOR DALI', 'MARTINEZ', 'AGUIRRE', 'A', 2, 'PREESCOLAR'),
(17, '20250017', 'MARIANA VALENTINA', 'MARTINEZ', 'SORIA', 'A', 2, 'PREESCOLAR'),
(18, '20250018', 'CLOE', 'MAYORGA', 'MARTINEZ', 'A', 2, 'PREESCOLAR'),
(19, '20250019', 'AMBER ABIGAIL', 'PALOGRANDE', 'HERNANDEZ', 'A', 2, 'PREESCOLAR'),
(20, '20250020', 'EITHAN JOSEPH', 'RAFAEL', 'CALLEJAS', 'A', 2, 'PREESCOLAR'),
(21, '20250021', 'CARLOS DANIEL', 'SALCEDO', 'SANCHEZ', 'A', 2, 'PREESCOLAR'),
(22, '20250022', 'AMELIE', 'SALVADOR', 'JACINTO', 'A', 2, 'PREESCOLAR'),
(23, '20250023', 'YERIK KHALIL', 'BAÑOS', 'AGUILAR', 'A', 3, 'PREESCOLAR'),
(24, '20250024', 'RODRIGO', 'BARQUERA', 'HINOJOSA', 'A', 3, 'PREESCOLAR'),
(25, '20250025', 'LIA', 'CAMPANILLA', 'BAXCAJAY', 'A', 3, 'PREESCOLAR'),
(26, '20250026', 'ANA MARUB', 'CHAVEZ', 'TERAN', 'A', 3, 'PREESCOLAR'),
(27, '20250027', 'JASIBE VALENTINA', 'CORONA', 'GARCIA', 'A', 3, 'PREESCOLAR'),
(28, '20250028', 'EIDAN', 'DEL REYO', 'MARTINEZ', 'A', 3, 'PREESCOLAR'),
(29, '20250029', 'KERIM', 'HERNANDEZ', 'SALVADOR', 'A', 3, 'PREESCOLAR'),
(30, '20250030', 'SANTI', 'HUERTA', 'CERVANTES', 'A', 3, 'PREESCOLAR'),
(31, '20250031', 'AYTANA', 'LINARES', 'QUITERIO', 'A', 3, 'PREESCOLAR'),
(32, '20250032', 'JOSE MARIA', 'LUGO', 'LOPEZ', 'A', 3, 'PREESCOLAR'),
(33, '20250033', 'LUNA AMELIE', 'MACIAS', 'RAMIREZ', 'A', 3, 'PREESCOLAR'),
(35, '20250034', 'KEVIN ALEXIS', 'MARTINEZ', 'DE LA CRUZ', 'A', 3, 'PREESCOLAR'),
(36, '20250035', 'ZAID FARID', 'MENDOZA', 'MARTINEZ', 'A', 3, 'PREESCOLAR'),
(37, '20250036', 'SARAH LUCIA', 'MORALES', 'RAMIREZ', 'A', 3, 'PREESCOLAR'),
(38, '20250037', 'ROBERTO', 'PEREZ', 'SANCHEZ', 'A', 3, 'PREESCOLAR'),
(39, '20250038', 'ROMINA', 'ROMERO', 'GONZALEZ', 'A', 3, 'PREESCOLAR'),
(40, '20250039', 'ISABELLA ALEJANDRA', 'ROMERO', 'JURADO', 'A', 3, 'PREESCOLAR'),
(41, '20250040', 'ESTRELLA', 'ZUÑIGA', 'MARQUEZ', 'A', 3, 'PREESCOLAR'),
(42, '20250041', 'DIEGO FERNANDO', 'CARRASCO', 'CRUZ', 'A', 1, 'PRIMARIA'),
(43, '20250042', 'EMILY PAULETTE', 'CASTILLA', 'MARTINEZ', 'A', 1, 'PRIMARIA'),
(44, '20250043', 'DANIELA', 'DE LA CRUZ', 'OTERO', 'A', 1, 'PRIMARIA'),
(45, '20250044', 'DARIO', 'DE LA CRUZ', 'ROMERO', 'A', 1, 'PRIMARIA'),
(46, '20250045', 'LIA VICTORIA', 'DE LA CRUZ', 'VIXTHA', 'A', 1, 'PRIMARIA'),
(47, '20250046', 'MARIA FERNANDA', 'HERNANDEZ', 'REYES', 'A', 1, 'PRIMARIA'),
(48, '20250047', 'ANGEL', 'LLACA', 'URIBE', 'A', 1, 'PRIMARIA'),
(49, '20250048', 'MICHELLE', 'MARTINEZ', 'AGUIRRE', 'A', 1, 'PRIMARIA'),
(50, '20250049', 'ATENEA', 'MARTINEZ', 'BOLTEADA', 'A', 1, 'PRIMARIA'),
(51, '20250050', 'EFREN ANTONIO', 'MARTINEZ', 'DIAZ', 'A', 1, 'PRIMARIA'),
(52, '20250051', 'MARIA JOSE', 'MARTINEZ', 'GUILLEN', 'A', 1, 'PRIMARIA'),
(53, '20250052', 'LEANDRO ASAD', 'MARTINEZ', 'PALMA', 'A', 1, 'PRIMARIA'),
(54, '20250053', 'AMAYA GABRIELLE', 'NUÑEZ', 'GONZALEZ', 'A', 1, 'PRIMARIA'),
(55, '20250054', 'JULIA SAMARA', 'PEREZ', 'REYES', 'A', 1, 'PRIMARIA'),
(56, '20250055', 'JOSE JOAQUIN', 'URIBE', 'MENESES', 'A', 1, 'PRIMARIA'),
(57, '20250056', 'ULISSES ALONSO', 'VILCHIZ', 'GARCIA', 'A', 1, 'PRIMARIA'),
(58, '20250057', 'DIEGO ANTONIO', 'ALVAREZ', 'HERNANDEZ', 'B', 1, 'PRIMARIA'),
(59, '20250058', 'MIA CHARLOTTE', 'BARRON', 'MENDOZA', 'B', 1, 'PRIMARIA'),
(60, '20250059', 'AYLIN ANDREA', 'BENITEZ', 'MEJIA', 'B', 1, 'PRIMARIA'),
(61, '20250060', 'ELIZABETH AMAYA', 'CHAVEZ', 'MONTUFAR', 'B', 1, 'PRIMARIA'),
(62, '20250061', 'CAMILA', 'CRUZ', 'RAMIREZ', 'B', 1, 'PRIMARIA'),
(63, '20250062', 'MAXIMILIANO', 'FERNANDEZ', 'CUELLAR', 'B', 1, 'PRIMARIA'),
(64, '20250063', 'EMMA ISABELLA', 'GONZALEZ', 'HERNANDEZ', 'B', 1, 'PRIMARIA'),
(65, '20250064', 'FERNANDA', 'GRIJALVA', 'GOMEZ', 'B', 1, 'PRIMARIA'),
(66, '20250065', 'MIRANDA', 'GUZMAN', 'TREJO', 'B', 1, 'PRIMARIA'),
(67, '20250066', 'EMILIANO', 'HERNANDEZ', 'RESENDIZ', 'B', 1, 'PRIMARIA'),
(68, '20250067', 'LIAM JOHED', 'JIMENEZ', 'ALDANA', 'B', 1, 'PRIMARIA'),
(69, '20250068', 'ISAAC TADEO', 'LOPEZ', 'CALZADA', 'B', 1, 'PRIMARIA'),
(70, '20250069', 'LEONARDO', 'MARTINEZ', 'BARRERA', 'B', 1, 'PRIMARIA'),
(71, '20250070', 'JULIA', 'NOVOA', 'GUTIERREZ', 'B', 1, 'PRIMARIA'),
(72, '20250071', 'SAMIRA', 'SALVADOR', 'JACINTO', 'B', 1, 'PRIMARIA'),
(73, '20250072', 'DULCE ABRIL', 'VAQUERO', 'XAXNI', 'B', 1, 'PRIMARIA'),
(74, '20250073', 'JOSE EDUARDO', 'AZPEITIA', 'SANCHEZ', 'A', 2, 'PRIMARIA'),
(75, '20250074', 'DULCE NAOMI', 'CERRITO', 'PEREZ', 'A', 2, 'PRIMARIA'),
(76, '20250075', 'IAN ALEXANDRO', 'CHAVEZ', 'BARERA', 'A', 2, 'PRIMARIA'),
(77, '20250076', 'JOSE FRANCISCO', 'CORONA', 'GARCIA', 'A', 2, 'PRIMARIA'),
(78, '20250077', 'DULCE ARIADNA', 'GUTIERREZ', 'GARCIA', 'A', 2, 'PRIMARIA'),
(79, '20250078', 'JOSE DE JESUS', 'JACOBO', 'BELTRAN', 'A', 2, 'PRIMARIA'),
(80, '20250079', 'ABRAHAM', 'LOPEZ', 'MEJIA', 'A', 2, 'PRIMARIA'),
(81, '20250080', 'PAULA LILITH', 'MAQUEDA', 'HERNANDEZ', 'A', 2, 'PRIMARIA'),
(82, '20250081', 'IAN EMMANUEL', 'MORALES', 'OLGUIN', 'A', 2, 'PRIMARIA'),
(83, '20250082', 'JOSHUA IVAN', 'PEREZ', 'MENDOZA', 'A', 2, 'PRIMARIA'),
(84, '20250083', 'EITHAN BLADIMIR', 'RAMIREZ', 'TRIGUEROS', 'A', 2, 'PRIMARIA'),
(85, '20250084', 'LUCA', 'ZAMORANO', 'TREJO', 'A', 2, 'PRIMARIA'),
(86, '20250085', 'AIMEE QUETZALY', 'AGUAZUL', 'YERBAFRIA', 'A', 3, 'PRIMARIA'),
(87, '20250086', 'DANIELA', 'ALVAREZ', 'HERNANDEZ', 'A', 3, 'PRIMARIA'),
(88, '20250087', 'IAN SCOTT', 'BARRON', 'MENDOZA', 'A', 3, 'PRIMARIA'),
(89, '20250088', 'ANGEL LUCCIANO', 'BELTRAN', 'QUITERIO', 'A', 3, 'PRIMARIA'),
(90, '20250089', 'SANTIAGO', 'BENITEZ', 'MEJIA', 'A', 3, 'PRIMARIA'),
(91, '20250090', 'MIGUEL', 'DE LA CRUZ', 'OTERO', 'A', 3, 'PRIMARIA'),
(92, '20250091', 'MAITE JIMENA', 'DIAZ', 'PEDRAZA', 'A', 3, 'PRIMARIA'),
(93, '20250092', 'VALERIA SINAI', 'FELIPE', 'MARQUEZ', 'A', 3, 'PRIMARIA'),
(94, '20250093', 'SANTIAGO', 'GUERRERO', 'MARTIN', 'A', 3, 'PRIMARIA'),
(95, '20250094', 'ADOLFO JOSUE', 'GUZMAN', 'ROMULO', 'A', 3, 'PRIMARIA'),
(96, '20250095', 'AZUL MAHETZI', 'HERNANDEZ', 'RUIZ', 'A', 3, 'PRIMARIA'),
(97, '20250096', 'XIMENA', 'HILARIO', 'QUITERIO', 'A', 3, 'PRIMARIA'),
(98, '20250097', 'PAULA NAOMI', 'LOPEZ', 'CALZADA', 'A', 3, 'PRIMARIA'),
(99, '20250098', 'JOSE FERNANDO', 'LOPEZ', 'GOMEZ', 'A', 3, 'PRIMARIA'),
(100, '20250099', 'OMAR', 'MARTINEZ', 'BARRERA', 'A', 3, 'PRIMARIA'),
(101, '20250100', 'ELIAN', 'OLGUIN', 'PEREZ', 'A', 3, 'PRIMARIA'),
(102, '20250101', 'IAN', 'ORTIZ', 'SANCHEZ', 'A', 3, 'PRIMARIA'),
(103, '20250102', 'MATIAS ISRAEL', 'PINTADO', 'LIRA', 'A', 3, 'PRIMARIA'),
(104, '20250103', 'IAN SANTIAGO', 'TEJAMANIL', 'ROMULO', 'A', 3, 'PRIMARIA'),
(105, '20250104', 'DAVID MATEO', 'VILCHIZ', 'GARCIA', 'A', 3, 'PRIMARIA'),
(106, '20250105', 'JESUS ALEJANDRO', 'ZUÑIGA', 'MARQUEZ', 'A', 3, 'PRIMARIA'),
(107, '20250106', 'GABRIEL', 'BARRERA', 'GUTIERREZ', 'A', 4, 'PRIMARIA'),
(108, '20250107', 'ZOE CAMILA', 'BARRON', 'MENDOZA', 'A', 4, 'PRIMARIA'),
(109, '20250108', 'MATEO KARIM', 'DORANTES', 'HERNANDEZ', 'A', 4, 'PRIMARIA'),
(110, '20250109', 'PABLO ARTURO', 'FLORES', 'PEREZ', 'A', 4, 'PRIMARIA'),
(111, '20250110', 'DANIELA MARELY', 'HERNANDEZ', 'PEREZ', 'A', 4, 'PRIMARIA'),
(112, '20250111', 'AYARI YAZID', 'MARTINEZ', 'GARCIA', 'A', 4, 'PRIMARIA'),
(113, '20250112', 'IKER GAEL', 'MARTINEZ', 'PALMA', 'A', 4, 'PRIMARIA'),
(114, '20250113', 'IKER', 'MAYORGA', 'MARTINEZ', 'A', 4, 'PRIMARIA'),
(115, '20250114', 'VALENTINA', 'MONTELONGO', 'ROMERO', 'A', 4, 'PRIMARIA'),
(116, '20250115', 'EMMAUS', 'PEREZ', 'BELTRAN', 'A', 4, 'PRIMARIA'),
(117, '20250116', 'AISHA JANINE', 'QUIÑONEZ', 'PINEDA', 'A', 4, 'PRIMARIA'),
(118, '20250117', 'MARTIN EMILIANO', 'RODRIGUEZ', 'IBARRA', 'A', 4, 'PRIMARIA'),
(119, '20250118', 'CONSTANTINE TADEO', 'TEJAMANIL', 'JIMENEZ', 'A', 4, 'PRIMARIA'),
(120, '20250119', 'ANUAR ALBERTO', 'ALVAREZ', 'HERNANDEZ', 'A', 5, 'PRIMARIA'),
(121, '20250120', 'XIMENA GUADALUPE', 'BARRERA', 'NIETO', 'A', 5, 'PRIMARIA'),
(122, '20250121', 'FATIMA MARIA', 'BARRERA', 'NIETO', 'A', 5, 'PRIMARIA'),
(123, '20250122', 'FRIDA SOFIA', 'CAMARGO', 'TREJO', 'A', 5, 'PRIMARIA'),
(124, '20250123', 'MATEO MANUEL', 'CARRASCO', 'CRUZ', 'A', 5, 'PRIMARIA'),
(125, '20250124', 'ALICE THAILY', 'CERON', 'HERNANDEZ', 'A', 5, 'PRIMARIA'),
(126, '20250125', 'LYA NICOLE', 'CHAVEZ', 'BENITEZ', 'A', 5, 'PRIMARIA'),
(127, '20250126', 'METZTLI XIMENA', 'FIGUEROA', 'TECPA', 'A', 5, 'PRIMARIA'),
(128, '20250127', 'JOSE EDUARDO', 'FLORES', 'MACIAS', 'A', 5, 'PRIMARIA'),
(129, '20250128', 'IKER LEONARDO', 'GONZALEZ', 'CASTILLO', 'A', 5, 'PRIMARIA'),
(130, '20250129', 'NICOLE', 'GUZMAN', 'ROMULO', 'A', 5, 'PRIMARIA'),
(131, '20250130', 'CARLOS SANTIAGO', 'JACOBO', 'PEREZ', 'A', 5, 'PRIMARIA'),
(132, '20250131', 'SASHA IRURI', 'MARTINEZ', 'CRUZ', 'A', 5, 'PRIMARIA'),
(133, '20250132', 'MARCO ANTONIO', 'MARTINEZ', 'DE LA PEÑA', 'A', 5, 'PRIMARIA'),
(134, '20250133', 'MAXINE DANIELA', 'MARTINEZ', 'SILVA', 'A', 5, 'PRIMARIA'),
(135, '20250134', 'ARIADNE ELVIRA', 'MENDOZA', 'ALCANTARA', 'A', 5, 'PRIMARIA'),
(136, '20250135', 'CRISTOPHER MANUEL', 'MORALES', 'OLGUIN', 'A', 5, 'PRIMARIA'),
(137, '20250136', 'YOOHAN', 'OLGUIN', 'MENDOZA', 'A', 5, 'PRIMARIA'),
(138, '20250137', 'ARLETH ALEJANDRA', 'TORRES', 'VILLEGAS', 'A', 5, 'PRIMARIA'),
(139, '20250138', 'KEVIN', 'TREJO', 'BRISEÑO', 'A', 5, 'PRIMARIA'),
(140, '20250139', 'LUCIO EUGENIO', 'URIBE', 'MENESES', 'A', 5, 'PRIMARIA'),
(141, '20250140', 'HECTOR ADRIAN', 'ZEQUERA', 'RAMIREZ', 'A', 5, 'PRIMARIA'),
(142, '20250141', 'SAID ALEJANDRO', 'ZUÑIGA', 'ESPINOZA', 'A', 5, 'PRIMARIA'),
(143, '20250142', 'ANGEL DAVID', 'ACOSTA', 'MEDINA', 'A', 6, 'PRIMARIA'),
(144, '20250143', 'MARIA JOSE', 'CABAÑAS', 'AVALOS', 'A', 6, 'PRIMARIA'),
(145, '20250144', 'LIA ALITZEL', 'GALAN', 'PEREZ', 'A', 6, 'PRIMARIA'),
(146, '20250145', 'VALENTINA', 'GUTIERREZ', 'ESCOBAR', 'A', 6, 'PRIMARIA'),
(147, '20250146', 'EVOLET MIRANDA', 'HILARIO', 'QUITERIO', 'A', 6, 'PRIMARIA'),
(148, '20250147', 'SAUL ALEJANDRO', 'LOPEZ', 'CALZADA', 'A', 6, 'PRIMARIA'),
(149, '20250148', 'JOSSELINE DANAE', 'LOPEZ', 'MARTIN', 'A', 6, 'PRIMARIA'),
(150, '20250149', 'LUIZ KARIM', 'MENDOZA', 'TREJO', 'A', 6, 'PRIMARIA'),
(151, '20250150', 'TADEO SEBASTIAN', 'MORALES', 'LUGO', 'A', 6, 'PRIMARIA'),
(152, '20250151', 'SOFIA', 'PANTOJA', 'MAQUEDA', 'A', 6, 'PRIMARIA'),
(153, '20250152', 'EUMIR BENJAMIN', 'PEREZ', 'FELIX', 'A', 6, 'PRIMARIA'),
(154, '20250153', 'AITANA JIMENA', 'PEREZ', 'PARRA', 'A', 6, 'PRIMARIA'),
(155, '20250154', 'NATALY', 'RAMIREZ', 'MARTINEZ', 'A', 6, 'PRIMARIA'),
(156, '20250155', 'MARIA FERNANDA', 'RAMIREZ', 'PEREZ', 'A', 6, 'PRIMARIA'),
(157, '20250156', 'HANNIA ITZAE', 'RODRIGUEZ', 'PALACIOS', 'A', 6, 'PRIMARIA'),
(158, '20250157', 'ANA CLAUDIA', 'TORRES', 'GARCIA', 'A', 6, 'PRIMARIA'),
(159, '20250158', 'MATEO', 'ZAMORANO', 'TREJO', 'A', 6, 'PRIMARIA'),
(160, '20250159', 'SOPHIA', 'AZPEITIA', 'SANCHEZ', 'B', 6, 'PRIMARIA'),
(161, '20250160', 'ANTONIO DE JESUS', 'BELTRAN', 'VIZUET', 'B', 6, 'PRIMARIA'),
(162, '20250161', 'GABRIEL', 'CHAPARRO', 'SANCHEZ', 'B', 6, 'PRIMARIA'),
(163, '20250162', 'ZOE MICHELLE', 'CRUZ', 'RAMIREZ', 'B', 6, 'PRIMARIA'),
(164, '20250163', 'MARLIES SAMANTHA', 'DOTHI', 'CHARREZ', 'B', 6, 'PRIMARIA'),
(165, '20250164', 'FROYLAN', 'ESCOBAR', 'ARUMIR', 'B', 6, 'PRIMARIA'),
(166, '20250165', 'ANGEL ABDIEL', 'GUERRERO', 'MARTIN', 'B', 6, 'PRIMARIA'),
(167, '20250166', 'JUANJESUS BENI', 'IXTLAHUACA', 'DEL VILLAR', 'B', 6, 'PRIMARIA'),
(168, '20250167', 'JARED EFRAIN', 'JACOBO', 'BELTRAN', 'B', 6, 'PRIMARIA'),
(169, '20250168', 'ANIA MIRANDA', 'LEMUS', 'MARTINEZ', 'B', 6, 'PRIMARIA'),
(170, '20250169', 'JADE MARGARITA', 'LOPEZ', 'MEJIA', 'B', 6, 'PRIMARIA'),
(171, '20250170', 'CAMILA DANAE', 'MARTINEZ', 'AVILA', 'B', 6, 'PRIMARIA'),
(172, '20250171', 'FERNANDA', 'OJEDA', 'LUGO', 'B', 6, 'PRIMARIA'),
(173, '20250172', 'JOSE MARIA', 'PEREZ', 'BELTRAN', 'B', 6, 'PRIMARIA'),
(174, '20250173', 'NATALIA YARETZI', 'ROSAS', 'PEREZ', 'B', 6, 'PRIMARIA'),
(175, '20250174', 'ADLYN JOARY', 'VILLEDA', 'REYNOSO', 'B', 6, 'PRIMARIA'),
(176, '20250175', 'MIRANDA', 'ALTAMIRA', 'MORALES', 'A', 1, 'SECUNDARIA'),
(177, '20250176', 'ALISSON XAMIT', 'CHAVEZ', 'SOTO', 'A', 1, 'SECUNDARIA'),
(178, '20250177', 'KAIRI HIKARI', 'ELVIRA', 'VAQUERO', 'A', 1, 'SECUNDARIA'),
(179, '20250178', 'OZIEL', 'GARCIA', 'GARCIA', 'A', 1, 'SECUNDARIA'),
(180, '20250179', 'LUIS ANGEL', 'GARCIA', 'JUAREZ', 'A', 1, 'SECUNDARIA'),
(181, '20250180', 'SAMIRA', 'GIL', 'ISIDRO', 'A', 1, 'SECUNDARIA'),
(182, '20250181', 'EDUARDO', 'GUTIERREZ', 'MOYA', 'A', 1, 'SECUNDARIA'),
(183, '20250182', 'SANTIAGO', 'HINOJOSA', 'MELCHOR', 'A', 1, 'SECUNDARIA'),
(184, '20250183', 'JOSE FRANCISCO', 'LOPEZ', 'GOMEZ', 'A', 1, 'SECUNDARIA'),
(185, '20250184', 'AARON', 'LUGO', 'LOPEZ', 'A', 1, 'SECUNDARIA'),
(186, '20250185', 'XIMENA ILENE', 'MENDOZA', 'CONTRERAS', 'A', 1, 'SECUNDARIA'),
(187, '20250186', 'JESUS FABIAN', 'MORALES', 'GALVAN', 'A', 1, 'SECUNDARIA'),
(188, '20250187', 'YAMIL', 'OLGUIN', 'MENDOZA', 'A', 1, 'SECUNDARIA'),
(189, '20250188', 'ANGEL GABRIEL', 'RAMOS', 'MAYIDA', 'A', 1, 'SECUNDARIA'),
(190, '20250189', 'MAIDELYN PAMELA', 'SOLIS', 'PEREZ', 'A', 1, 'SECUNDARIA'),
(191, '20250190', 'VANESA KASSANDRA', 'TINOCO', 'GARCIA', 'A', 1, 'SECUNDARIA'),
(192, '20250191', 'MARIANA YANIN', 'VARGAS', 'RAMIREZ', 'A', 1, 'SECUNDARIA'),
(193, '20250192', 'LUIS ANTONIO', 'VENTURA', 'HERRERA', 'A', 1, 'SECUNDARIA'),
(194, '20250193', 'YUMMA KARELY', 'ARTEAGA', 'MARTINEZ', 'A', 2, 'SECUNDARIA'),
(195, '20250194', 'WENDY ATZIRI', 'BAUTISTA', 'CASTILLO', 'A', 2, 'SECUNDARIA'),
(196, '20250195', 'LYLA', 'BUSTOS', 'CRUZ', 'A', 2, 'SECUNDARIA'),
(197, '20250196', 'CAMILA', 'CAMACHO', 'MENDOZA', 'A', 2, 'SECUNDARIA'),
(198, '20250197', 'GERARDO YAHIR', 'CHARREZ', 'RIVERA', 'A', 2, 'SECUNDARIA'),
(199, '20250198', 'DULCE FERNANDA', 'CORNEJO', 'MARTINEZ', 'A', 2, 'SECUNDARIA'),
(200, '20250199', 'JONATHAN EMANUEL', 'DOMINGUEZ', 'CHAVEZ', 'A', 2, 'SECUNDARIA'),
(201, '20250200', 'JAZRAEL ALDAIR', 'ECHEGARAY', 'OLGUÍN', 'A', 2, 'SECUNDARIA'),
(202, '20250201', 'LORENA NATALY', 'GARCIA', 'CASADOS', 'A', 2, 'SECUNDARIA'),
(203, '20250202', 'CONSTANZA', 'GONZALEZ', 'VILLEDA', 'A', 2, 'SECUNDARIA'),
(204, '20250203', 'FERNANDA', 'GUERRERO', 'PADILLA', 'A', 2, 'SECUNDARIA'),
(205, '20250204', 'JOSE ANTONIO', 'JIMENEZ', 'MARTIN', 'A', 2, 'SECUNDARIA'),
(206, '20250205', 'DANYA', 'LUNA', 'LUNA', 'A', 2, 'SECUNDARIA'),
(207, '20250206', 'EMILIANO DE JESUS', 'MARTINEZ', 'BARRERA', 'A', 2, 'SECUNDARIA'),
(208, '20250207', 'AYLEN SOFIA', 'MARTINEZ', 'DE LA PEÑA', 'A', 2, 'SECUNDARIA'),
(209, '20250208', 'MELANI AYLEN', 'MENDOZA', 'ALCANTARA', 'A', 2, 'SECUNDARIA'),
(210, '20250209', 'IVANNA ZARETH', 'NUÑEZ', 'GONZALEZ', 'A', 2, 'SECUNDARIA'),
(211, '20250210', 'YULIAN', 'OLGUIN', 'MENDOZA', 'A', 2, 'SECUNDARIA'),
(212, '20250211', 'ITZAYANA', 'PEREZ', 'BELTRAN', 'A', 2, 'SECUNDARIA'),
(213, '20250212', 'AISLIN CASSANDRA', 'PEREZ', 'PARRA', 'A', 2, 'SECUNDARIA'),
(214, '20250213', 'DAFNE YAMILET', 'AGUILAR', 'MUNDO', 'A', 3, 'SECUNDARIA'),
(215, '20250214', 'DAYRA MAERELIN', 'AVALOS', 'HERNANDEZ', 'A', 3, 'SECUNDARIA'),
(216, '20250215', 'TIFFANY MICHELLE', 'CERVANTES', 'ROMERO', 'A', 3, 'SECUNDARIA'),
(217, '20250216', 'DENHI GEORGINA', 'CHAVEZ', 'HERNANDEZ', 'A', 3, 'SECUNDARIA'),
(218, '20250217', 'JESUS ALEJANDRO', 'DE LA CRUZ', 'BAUTISTA', 'A', 3, 'SECUNDARIA'),
(219, '20250218', 'DONI HYADI', 'DOMINGUEZ', 'HERNANDEZ', 'A', 3, 'SECUNDARIA'),
(220, '20250219', 'MELANY XANTHAL', 'GARCIA', 'DE LA ROSA', 'A', 3, 'SECUNDARIA'),
(221, '20250220', 'YOSMAR ALAIN', 'GUTIERREZ', 'ESCOBAR', 'A', 3, 'SECUNDARIA'),
(222, '20250221', 'SANTIAGO', 'GUTIERREZ', 'HERNANDEZ', 'A', 3, 'SECUNDARIA'),
(223, '20250222', 'FERNANDA ELUNEY', 'GUTIERREZ', 'RAMIREZ', 'A', 3, 'SECUNDARIA'),
(224, '20250223', 'YURITZI CAMILA', 'IXTLAHUACA', 'DEL VILLAR', 'A', 3, 'SECUNDARIA'),
(225, '20250224', 'JORGE ARIM', 'MANILLA', 'ESTRELLA', 'A', 3, 'SECUNDARIA'),
(226, '20250225', 'RUBEN', 'MARTINEZ', 'BARRERA', 'A', 3, 'SECUNDARIA'),
(227, '20250226', 'ALISON MICHELLE', 'MARTINEZ', 'MORGADO', 'A', 3, 'SECUNDARIA'),
(228, '20250227', 'FABIAN', 'MEZA', 'BELTRAN', 'A', 3, 'SECUNDARIA'),
(229, '20250228', 'ERICK AMADO', 'PEDRAZA', 'ORTEGA', 'A', 3, 'SECUNDARIA'),
(230, '20250229', 'MELANY ODETT', 'PEÑA', 'ESCAMILLA', 'A', 3, 'SECUNDARIA'),
(231, '20250230', 'YESGUA YADIEL', 'PEREZ', 'REYES', 'A', 3, 'SECUNDARIA'),
(232, '20250231', 'JOSE RAUL', 'RETANA', 'VAZQUEZ', 'A', 3, 'SECUNDARIA'),
(233, '20250232', 'ISABELLA', 'REYES', 'CARRILLO', 'A', 3, 'SECUNDARIA'),
(234, '20250233', 'SAID', 'RODRIGUEZ', 'PALACIOS', 'A', 3, 'SECUNDARIA'),
(235, '20250234', 'KEYLA CAMILA', 'SEVERO', 'TORRES', 'A', 3, 'SECUNDARIA'),
(236, '20250235', 'AXEL ALDAIR', 'SIERRA', 'MORENO', 'A', 3, 'SECUNDARIA'),
(237, '20250236', 'BRISA CAMILA', 'TEJAMANIL', 'JIMENEZ', 'A', 3, 'SECUNDARIA'),
(238, '20250237', 'DULCE ABISAI', 'URIBE', 'BARQUERA', 'A', 3, 'SECUNDARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificacion` int(11) NOT NULL,
  `Id_alumno` int(20) NOT NULL,
  `id_asignatura` int(20) NOT NULL,
  `id_periodo` int(20) NOT NULL,
  `calificacion` double NOT NULL,
  `fecha_captura` date NOT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `Observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos`
--

CREATE TABLE `campos` (
  `id_asignatura` int(11) NOT NULL,
  `campo_formativo` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `campo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campos`
--

INSERT INTO `campos` (`id_asignatura`, `campo_formativo`, `descripcion`, `campo`) VALUES
(1, 'Español 1', 'Secundaria', 'Lenguajes '),
(2, 'Ingles', 'Secundaria ', 'Lenguajes'),
(3, 'Artes', 'Secundaria', 'Lenguajes'),
(4, 'Matemáticas', 'Secundaria ', 'Saberes y Pensamientos Científico '),
(5, 'Ciencias ', 'Secundaria', 'Saberes y Pensamientos Científico '),
(6, 'Geografía', 'Secundaria', 'Ética Naturaleza y Sociedad'),
(7, 'Historia 1', 'Secundaria', 'Ética Naturaleza y Sociedad'),
(8, 'Formación C. y E.', 'Secundaria ', 'Ética Naturaleza y Sociedad'),
(9, 'Biologia ', 'Secundaria', 'Saberes y Pensamientos Científicos '),
(10, 'Tecnología', 'Secundaria', 'De lo Humano y lo Comunitario '),
(11, 'Edu. Física', 'Secundaria', 'De lo Humano y lo Comunitario'),
(12, 'Español', 'Primaria ', 'Lenguajes '),
(13, 'Ingles', 'Primaria', 'Lenguajes '),
(14, 'Edu. Artística', 'Primaria ', 'Lenguajes '),
(15, 'Matemáticas', 'Primaria', 'Saberes y Pensamientos Científicos '),
(16, 'Tecnología ', 'Primaria ', 'Saberes y Pensamientos Científicos '),
(17, 'F.C y E', 'Primaria ', 'Ética Naturaleza y Sociedad'),
(18, 'Conoc. del medio', 'Primaria ', 'Ética Naturaleza y Sociedad'),
(19, 'Edu. Física ', 'Primaria ', 'De lo Humano y lo Comunitario'),
(20, 'Edu. en la Fe', 'Primaria ', 'De lo Humano y lo Comunitario'),
(21, 'Edu. Socioemocional', 'Primaria ', 'De lo Humano y lo Comunitario'),
(22, 'Vida Saludable', 'Primaria ', 'De lo Humano y lo Comunitario'),
(23, 'Lenguajes ', 'Preescolar ', ''),
(24, 'Saberes y Pensamiento Científico ', 'Preescolar ', ''),
(25, 'Ética, Naturaleza y Sociedades ', 'Preescolar ', ''),
(26, 'De lo Humano y lo Comunitario ', 'Preescolar ', ''),
(27, 'Ingles ', 'Preescolar ', ''),
(28, 'Habilidades Digitales ', 'Preescolar ', ''),
(29, 'Edu. Física ', 'Preescolar ', ''),
(30, 'Edu. en la Fe', 'Preescolar ', ''),
(31, 'Estimulación Musical Temprana', 'Preescolar ', ''),
(32, 'Macarsi', 'Preescolar', ''),
(33, 'Guitarra/Violín ', 'Preescolar', ''),
(34, 'Inovamat', 'Preescolar', ''),
(35, 'Estimulación Sensorial', 'Preescolar', ''),
(36, 'Ingles Interactivo', 'Preescolar', ''),
(37, 'Motricidad Fina y Gruesa ', 'Preescolar', ''),
(38, 'Ciencias Naturales', 'Primaria ', 'Saberes y Pensamientos Científicos '),
(39, 'La Entidad Donde Vivo', 'Primaria ', 'Ética Naturaleza y Sociedad'),
(40, 'Historia', 'Primaria ', 'Ética Naturaleza y Sociedad'),
(41, 'Geografía', 'Primaria ', 'Ética Naturaleza y Sociedad'),
(42, 'Física', 'Secundaria ', 'Saberes y Pensamiento Científico '),
(43, 'Quimica', 'Secundaria', 'Saberes y Pensamiento Científico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_escolar`
--

CREATE TABLE `ciclo_escolar` (
  `id_ciclo` int(100) NOT NULL,
  `nombre_ciclo` varchar(50) NOT NULL,
  `fecha_inicio_ciclo` date NOT NULL,
  `fecha_fin_ciclo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciclo_escolar`
--

INSERT INTO `ciclo_escolar` (`id_ciclo`, `nombre_ciclo`, `fecha_inicio_ciclo`, `fecha_fin_ciclo`) VALUES
(1, '2025-2025', '2025-01-09', '2025-07-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `Matricula_D` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Nombre_D` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Apellidop_D` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Apellidom_D` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo_D` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password_D` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `grado1` varchar(10) NOT NULL,
  `grado2` varchar(20) NOT NULL,
  `grado3` varchar(20) NOT NULL,
  `grado4` varchar(20) NOT NULL,
  `grado5` varchar(20) NOT NULL,
  `grado6` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificar`
--

CREATE TABLE `modificar` (
  `id` int(11) NOT NULL,
  `Calificacion` double DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `id_asignatura` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `Id_alumno` int(11) NOT NULL,
  `Id_calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificarpres`
--

CREATE TABLE `modificarpres` (
  `id` int(11) NOT NULL,
  `calificacion` text DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `id_asignatura` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificarsecu`
--

CREATE TABLE `modificarsecu` (
  `id` int(11) NOT NULL,
  `calificacion` double DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `id_asignatura` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nombre`) VALUES
(1, 'PREESCOLAR'),
(2, 'PRIMARIA'),
(3, 'SECUNDARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `nivel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `nombre`, `fecha_inicio`, `fecha_fin`, `nivel_id`) VALUES
(1, 'captura_de_calificacion1', '2025-03-07', '2025-03-07', NULL),
(2, 'captura_de_calificacion2', '2025-03-06', '2025-03-06', NULL),
(3, 'captura_de_calificacion3', '2025-03-14', '2025-03-16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prescolar`
--

CREATE TABLE `prescolar` (
  `id_calificaciones` int(11) NOT NULL,
  `id_alumno` int(50) NOT NULL,
  `id_asignatura` int(20) NOT NULL,
  `id_periodo` int(20) NOT NULL,
  `calificacion` text NOT NULL,
  `fecha_captura` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secu`
--

CREATE TABLE `secu` (
  `id_notas` int(11) NOT NULL,
  `id_alumnos` int(50) NOT NULL,
  `id_asignaturas` int(20) NOT NULL,
  `id_periodos` int(20) NOT NULL,
  `calificaciones` double NOT NULL,
  `fecha_captura` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`Id_alumno`),
  ADD UNIQUE KEY `Matricula` (`Matricula`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `nivel_id` (`nivel_id`);

--
-- Indices de la tabla `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `ciclo_escolar`
--
ALTER TABLE `ciclo_escolar`
  ADD PRIMARY KEY (`id_ciclo`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modificar`
--
ALTER TABLE `modificar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modificarpres`
--
ALTER TABLE `modificarpres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modificarsecu`
--
ALTER TABLE `modificarsecu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_notas` (`id_calificacion`),
  ADD KEY `id_calificacion` (`id_calificacion`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `nivel_id` (`nivel_id`);

--
-- Indices de la tabla `prescolar`
--
ALTER TABLE `prescolar`
  ADD PRIMARY KEY (`id_calificaciones`);

--
-- Indices de la tabla `secu`
--
ALTER TABLE `secu`
  ADD PRIMARY KEY (`id_notas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `Id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=699;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `modificar`
--
ALTER TABLE `modificar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `modificarpres`
--
ALTER TABLE `modificarpres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `modificarsecu`
--
ALTER TABLE `modificarsecu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prescolar`
--
ALTER TABLE `prescolar`
  MODIFY `id_calificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT de la tabla `secu`
--
ALTER TABLE `secu`
  MODIFY `id_notas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`);

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `periodo_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
