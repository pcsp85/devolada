-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-10-2013 a las 11:42:48
-- Versión del servidor: 5.5.32-cll
-- Versión de PHP: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `devolada_voy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `n_c` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `p_fiscal` varchar(1) NOT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `r_social` tinytext NOT NULL,
  `nom` varchar(80) NOT NULL,
  `ap_pat` varchar(50) NOT NULL,
  `ap_mat` varchar(50) NOT NULL,
  `dom_fiscal` tinytext NOT NULL,
  `cp` varchar(10) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `correo` tinytext NOT NULL,
  `fech_nac` date NOT NULL,
  `fech_reg` varchar(12) NOT NULL,
  `fua` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_c`),
  UNIQUE KEY `rfc` (`rfc`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`n_c`, `p_fiscal`, `rfc`, `r_social`, `nom`, `ap_pat`, `ap_mat`, `dom_fiscal`, `cp`, `tel`, `correo`, `fech_nac`, `fech_reg`, `fua`) VALUES
(1, '1', 'PEGC730305AP3', '', 'Carlos ALberto', 'Peimbert', 'Guerrero', 'avenida mirador de queretaro 21 casa 103 colonia el mirador, el marques queretaro', '76240', '2783508', 'carlos@w3d.com.mx', '1973-03-05', '1372691121', '2013-07-01 15:05:21'),
(2, '1', 'SSI1111111ZA', 'Josef Modlmayer', 'Joseph ', 'Modlmayey', '', 'San Felipe de jesus 502 local  24, frente a UVM', '76230', '7133800', 'josefm@sgtec.com.mx', '0000-00-00', '1374766615', '2013-07-25 18:26:22'),
(3, '2', 'AFO-831108-6M2', 'ACEROS FORTUNA, SA DE CV', 'Anan Patricia ', 'Plazola', 'Orozco', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '76010', '800-85-03', 'aplazola@cartech.com', '1983-11-08', '1375727167', '2013-08-05 18:26:07'),
(4, '1', 'SARNA730305', 'Farmacias Queretaro', 'Nadia', 'San Roman', 'nananana', 'Loma Pinal de amoles\r\n603 int 7', '76240', '442 322 8418', 'manager@distribuidoradesimilares.com', '1973-03-05', '1376949394', '2013-08-20 00:55:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE IF NOT EXISTS `contenido` (
  `id_cont` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `mnu` varchar(40) NOT NULL,
  `cont` text NOT NULL,
  `uua` int(6) NOT NULL,
  `fua` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cont`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id_cont`, `mnu`, `cont`, `uua`, `fua`) VALUES
(1, 'Inicio', '<p><img src="/images/banner_envio.png" /></p>\n\n<p>&nbsp;</p>\n\n<div id="promo"><br />\n<br />\nCompra tu paquete de gu&iacute;as prepagadas, es m&aacute;s econ&oacute;mico.<br />\n<br />\n<br />\nPrograma tus entregas con 24, 48 o 72 horas de anticipaci&oacute;n.</div>\n\n<p>En Devolada Voy, recolectamos y entregamos casi cualquier cosa.<br />\n<br />\nSomos una mensjer&iacute;a express,&nbsp;especializada en dar un servicio de<br />\nexcelencia en la Ciudad de Quer&eacute;taro.<br />\n<br />\nEs muy facil usar nuestro servicio: Llamanos, vamos y entregamos.</p>\n\n<p>Conoce nuestro servicios de mensajeria express.</p>\n\n<div id="inicio"><img src="/images/contactanos.png" /> <img src="/images/recolectamos.png" /> <img src="/images/clima.png" /></div>\n', 1, '2013-08-05 23:42:36'),
(2, 'Servicios', '<div id="izq"><br />\n<br />\n&nbsp;\n<h2>De volada express</h2>\n\n<ul>\n	<li>Recolectamos y entregamos en 50 minutos\n	<ul>\n		<li>( te urge enviar algo y se te hizo tarde, o no tienes tiempo para hacerlo)</li>\n	</ul>\n\n	<h2>De volada programado</h2>\n\n	<ul>\n		<li>Programa tu mensajer&iacute;a 24, 48 o 72 horas de anticipaci&oacute;n y nosotros lo recolectamos y lo entregamos el d&iacute;a pactado.</li>\n		<li>(no estar&aacute;s disponible el d&iacute;a que tienes que enviar o entregar tu paquete, solicita este servicio y nosotros nos encargamos del resto)</li>\n	</ul>\n\n	<h2>De volada mismo d&iacute;a</h2>\n	</li>\n	<li>Pide tu servicio antes de las 11 de la ma&ntilde;ana y lo entregamos el mismo d&iacute;a antes de las 6 de la tarde.</li>\n	<li>(necesitas enviar una factura, mandar un recibo, contratos, presentar escritos, mandar muestras)\n	<p>&nbsp;</p>\n	</li>\n</ul>\n</div>\n\n<div id="der">\n<h2>&iquest;Qu&eacute; puedo enviar?</h2>\n\n<ul>\n	<li>CD</li>\n	<li>DVD</li>\n	<li>Fotos</li>\n	<li>Libros</li>\n	<li>Revistas</li>\n	<li>Flores</li>\n	<li>Regalos</li>\n	<li>Tickets / Pasaportes</li>\n	<li>Cat&aacute;logos</li>\n	<li>Muestras de Producto</li>\n	<li>Boletos de avi&oacute;n</li>\n	<li>Poderes</li>\n	<li>Tarjetas</li>\n	<li>Aplicaciones / Solicitudes</li>\n	<li>Brochure</li>\n	<li>Planos</li>\n	<li>Presupuesto</li>\n	<li>Cotizaci&oacute;n / Contratos.</li>\n	<li>Manuales</li>\n	<li>Material Impreso publicitario.</li>\n	<li>Comunicaciones Impresas</li>\n	<li>Invitaciones</li>\n	<li>Tarjetas de Presentaci&oacute;n</li>\n	<li>La Tarea de tus hijos</li>\n	<li>Tarjetas de Felicitaciones, Navidad, etc.</li>\n</ul>\n\n<h2>&iquest;Qu&eacute; no puedo enviar?</h2>\n\n<ul>\n	<li>Cheques al portaador</li>\n	<li>T&iacute;tulos cobrables al portador</li>\n	<li>DInero en efectivo</li>\n	<li>Paquetes que contengan cosas frajiles que no esten empacados adecuadamente</li>\n</ul>\n</div>\n', 1, '2013-07-10 21:33:20'),
(3, 'Cobertura', '<h1><span style="font-family:monarkbold oblique,serif; font-size:19pt">En devolada voy<br />\n<br />\nCubrimos el &aacute;rea metropolitana de Quer&eacute;taro, y los parques industriales aleda&ntilde;os a la ciudad, tambi&eacute;n vamos al aeropuerto.</span></h1>\n\n<h1><span style="font-family:monarkbold oblique,serif; font-size:19pt">&iexcl;Ll&aacute;manos si requieres de mas &iexcl;informaci&oacute;n!&nbsp;</span></h1>\n', 1, '2013-07-22 17:33:51'),
(4, 'Tarifas', '<h1><strong>Este verano andamos con ganas de llevar todos sus env&iacute;os, as&iacute; que todos los env&iacute;os tienen un costo de $50 pesos, aun los que van a los parques industriales de Quer&eacute;taro. &iexcl;Ll&aacute;manos!</strong></h1>\n', 1, '2013-07-30 14:13:52'),
(5, 'Contacto', '<p>Por favor ingresa tus datos en el formulario y da clic en el boton Enviar</p>\r\n<form name="contacto" id="contacto" onSubmit="return false" class="f_usr">\r\n<input type="hidden" name="act" value="contacto">\r\n	<div><label><input type="text" name="nom" id="nom"><br>Nombre</label><label><input type="text" name="ap" id="ap"><br>Apellidos</label></div>\r\n    <div><label><input type="email" name="correo" id="correo"><br>Correo electr&oacute;nico</label></div>\r\n    <div><label><input type="text" name="tel" id="tel" onKeyPress="return numeros(event);"><br>Tel&eacute;fono</label></div>\r\n    <div><label>Mensaje <textarea name="mensaje" id="mensaje" cols="35"></textarea></label></div>\r\n    <div id="nota"></div>\r\n    <div><label style="display:block; text-align:center; clear:both;" title="Enviar formulario"><input type="image" src="images/consultar.png" onClick="contact();"><br>Enviar formulario</label></div>\r\n</form>', 1, '2013-07-10 21:30:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE IF NOT EXISTS `envios` (
  `id_e` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `guia` varchar(30) NOT NULL,
  `n_c` int(6) NOT NULL,
  `n_t` int(6) NOT NULL,
  `costo` varchar(9) NOT NULL,
  `t_pago` varchar(20) NOT NULL,
  `g_pp` int(6) NOT NULL,
  `usr_gen` int(6) NOT NULL,
  `usr_ent` int(6) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `nom_rec` varchar(200) NOT NULL,
  `dom_rec` tinytext NOT NULL,
  `fech_rec` datetime NOT NULL,
  `desc_paq` text NOT NULL,
  `nom_ent` varchar(200) NOT NULL,
  `dom_ent` tinytext NOT NULL,
  `fech_ent` datetime NOT NULL,
  `fech_reg` varchar(12) NOT NULL,
  `fua` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_e`),
  UNIQUE KEY `guia` (`guia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id_e`, `guia`, `n_c`, `n_t`, `costo`, `t_pago`, `g_pp`, `usr_gen`, `usr_ent`, `estado`, `nom_rec`, `dom_rec`, `fech_rec`, `desc_paq`, `nom_ent`, `dom_ent`, `fech_ent`, `fech_reg`, `fua`) VALUES
(1, '20130726-001-01-000002-0001', 2, 1, '50.00', '01', 0, 1, 2, '3', 'josef', 'San Felipe de jesus 502 local  24, frente a UVM', '2013-07-26 00:00:00', 'Recoger equipo en juriquilla y llevarlo al centro ', 'josef', 'colinia centro', '2013-07-26 00:00:00', '1374857816', '2013-08-05 22:21:13'),
(2, '20130726-001-01-000002-0002', 2, 1, '50.00', '01', 0, 1, 2, '3', 'josef', 'colonia centro ', '2013-07-26 00:00:00', 'equipo apple', 'josef', 'San Felipe de jesus 502 local  24, frente a UVM', '2013-07-26 00:00:00', '1374857885', '2013-08-05 22:21:15'),
(3, '20130805-001-03-000003-0001', 3, 1, '50.00', '03', 1, 1, 2, '5', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'Por procesar', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742315', '2013-08-07 21:12:07'),
(4, '20130805-001-03-000003-0002', 3, 1, '50.00', '03', 2, 1, 2, '5', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'Por Prcesar', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742372', '2013-08-14 17:30:58'),
(5, '20130805-001-03-000003-0003', 3, 1, '50.00', '03', 3, 1, 2, '5', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742423', '2013-08-21 16:04:58'),
(6, '20130805-001-03-000003-0004', 3, 1, '50.00', '03', 4, 1, 2, '5', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'Por Porcesar', 'Patricia Plazola', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742480', '2013-08-21 16:05:00'),
(7, '20130805-001-03-000003-0005', 3, 1, '50.00', '03', 5, 1, 2, '5', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742519', '2013-08-21 16:05:04'),
(8, '20130805-001-03-000003-0006', 3, 1, '50.00', '03', 6, 1, 2, '5', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742573', '2013-08-28 15:51:09'),
(9, '20130805-001-03-000003-0007', 3, 1, '50.00', '03', 7, 1, 2, '5', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por porcesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742611', '2013-08-28 15:51:24'),
(10, '20130805-001-03-000003-0008', 3, 1, '50.00', '03', 8, 1, 2, '2', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742651', '2013-08-28 15:53:16'),
(11, '20130805-001-03-000003-0009', 3, 1, '50.00', '03', 9, 1, 2, '2', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'pro procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742693', '2013-08-28 15:54:32'),
(12, '20130805-001-03-000003-0010', 3, 1, '50.00', '03', 10, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742731', '2013-08-05 22:45:31'),
(13, '20130805-001-03-000003-0011', 3, 1, '50.00', '03', 11, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742773', '2013-08-05 22:46:13'),
(14, '20130805-001-03-000003-0012', 3, 1, '50.00', '03', 12, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742816', '2013-08-05 22:46:56'),
(15, '20130805-001-03-000003-0013', 3, 1, '50.00', '03', 13, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742854', '2013-08-05 22:47:34'),
(16, '20130805-001-03-000003-0014', 3, 1, '50.00', '03', 14, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por porcesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742903', '2013-08-05 22:48:23'),
(17, '20130805-001-03-000003-0015', 3, 1, '50.00', '03', 15, 1, 2, '', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', 'por procesar', 'patricia', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-05 00:00:00', '1375742948', '2013-08-05 22:49:08'),
(18, '20130814-001-01-000002-0016', 2, 1, '50.00', '01', 0, 1, 2, '3', 'josef', 'San Felipe de jesus 502 local  24, frente a UVM', '2013-08-13 00:00:00', 'juriquilla al centro ', 'a nombre de josef', 'centro', '2013-08-13 00:00:00', '1376501268', '2013-08-14 17:30:39'),
(19, '20130814-001-01-000002-0017', 2, 1, '50.00', '01', 0, 1, 2, '3', 'josef', 'San Felipe de jesus 502 local  24, frente a UVM', '2013-08-13 00:00:00', 'iphone', 'a nombre de josef', 'santa rosa', '2013-08-13 00:00:00', '1376501368', '2013-08-14 17:30:40'),
(20, '20130814-001-01-000002-0018', 2, 1, '50.00', '01', 0, 1, 2, '3', 'Josef', 'San Felipe de jesus 502 local  24, frente a UVM', '2013-08-13 00:00:00', 'mercancia apple', 'a nombre de josef', 'centro allende', '2013-08-13 00:00:00', '1376501426', '2013-08-14 17:30:42'),
(21, '20130819-001-01-000004-0019', 4, 1, '50.00', '01', 0, 1, 2, '3', 'Nidia ', 'Loma Pinal de Amoles', '2013-08-19 00:00:00', 'Medicamentos', 'Nadia', 'Santa rosa Jauregui', '2013-08-19 00:00:00', '1376949607', '2013-08-20 00:58:00'),
(22, '20130819-001-01-000004-0020', 4, 1, '50.00', '01', 0, 1, 2, '3', 'Nadia ', 'Pino Suarez 304 pte  Col. NiÃ±os Heroes', '2013-08-19 00:00:00', 'Medicamentos', 'Nadia', 'Cerrito Coloroado', '2013-08-19 00:00:00', '1376960265', '2013-08-20 00:57:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(6) NOT NULL AUTO_INCREMENT,
  `id_usr` int(6) NOT NULL,
  `IP` varchar(18) NOT NULL,
  `agent` tinytext NOT NULL,
  `fech_log` varchar(12) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `id_usr`, `IP`, `agent`, `fech_log`) VALUES
(17, 1, '201.141.163.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', '1371444054'),
(18, 1, '201.141.163.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', '1371444925'),
(19, 1, '187.194.15.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', '1371520909'),
(20, 1, '201.141.163.207', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)', '1371524501'),
(21, 1, '68.171.231.83', 'Mozilla/5.0 (BlackBerry; U; BlackBerry 9380; en-US) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.1.0.569 Mobile Safari/534.11+', '1371525524'),
(22, 1, '201.141.175.143', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)', '1371618923'),
(23, 1, '187.194.15.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372103322'),
(24, 1, '187.194.15.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372119952'),
(25, 1, '201.141.181.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372204878'),
(26, 1, '201.141.181.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372205964'),
(27, 1, '201.141.181.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372209264'),
(28, 1, '201.141.184.143', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)', '1372570514'),
(29, 1, '187.194.15.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1372691007'),
(30, 1, '201.141.188.79', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)', '1372825148'),
(31, 1, '201.141.169.143', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1373341346'),
(32, 1, '201.141.162.143', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1373491913'),
(33, 1, '187.194.15.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1373495646'),
(34, 1, '201.141.162.143', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', '1373504980'),
(35, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374507862'),
(36, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374513817'),
(37, 1, '201.141.176.222', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374685973'),
(38, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374689067'),
(39, 1, '201.141.176.222', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374694689'),
(40, 1, '201.141.176.222', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374710977'),
(41, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374766440'),
(42, 1, '187.166.17.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36', '1374775291'),
(43, 1, '201.141.191.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374775889'),
(44, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374775982'),
(45, 1, '201.141.191.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374795734'),
(46, 1, '201.141.169.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374855374'),
(47, 1, '187.211.84.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36', '1374855851'),
(48, 1, '201.141.169.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374857638'),
(49, 1, '187.211.84.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36', '1374857674'),
(50, 1, '201.141.169.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374860939'),
(51, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374864692'),
(52, 1, '201.141.169.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1374865161'),
(53, 1, '201.141.182.30', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1375115949'),
(54, 3, '201.141.95.200', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0', '1375139098'),
(55, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', '1375193616'),
(56, 1, '187.211.32.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375310814'),
(57, 1, '187.211.32.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375316012'),
(58, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375368577'),
(59, 1, '187.211.32.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375386195'),
(60, 1, '187.166.17.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375466861'),
(61, 1, '187.211.32.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375477578'),
(62, 1, '187.166.17.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375726690'),
(63, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375741266'),
(64, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375889130'),
(65, 1, '189.203.217.54', 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25', '1375898919'),
(66, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375905041'),
(67, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375909916'),
(68, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375911941'),
(69, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1375987912'),
(70, 1, '187.211.7.101', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376085160'),
(71, 1, '187.211.20.185', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376426349'),
(72, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376501149'),
(73, 1, '187.166.17.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376502173'),
(74, 1, '201.122.178.211', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376502448'),
(75, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376602798'),
(76, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376675111'),
(77, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376949194'),
(78, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', '1376960114'),
(79, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1377101081'),
(80, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1377119071'),
(81, 1, '189.253.68.250', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1377616983'),
(82, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1377626025'),
(83, 1, '187.211.93.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1377705024'),
(84, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1378419123'),
(85, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', '1378476246'),
(86, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', '1378838060'),
(87, 1, '187.211.41.91', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.65 Safari/537.36', '1379428281'),
(88, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', '1379540690'),
(89, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '1380121840'),
(90, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '1380565189'),
(91, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '1380641272'),
(92, 1, '187.194.19.53', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36', '1380916485'),
(93, 1, '187.166.17.61', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36', '1381244037');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `n_t` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `grupo` tinytext NOT NULL,
  `tarifa` tinytext NOT NULL,
  `desc_tarifa` text NOT NULL,
  `costo` varchar(9) NOT NULL,
  `fua` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_t`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`n_t`, `grupo`, `tarifa`, `desc_tarifa`, `costo`, `fua`) VALUES
(1, 'Express', '1 a 20 Km', 'Servicio express, recolectamos y entregamos en 50 minutos, hasta 20 Km', '50', '2013-07-25 15:49:35'),
(2, 'Express', '20 a 40 Km', 'Servicio express, recolectamos y entregamos en 50 minutos, hasta 40 Km', '50.00', '2013-08-05 22:52:30'),
(3, 'Express', '40 a 60 Km', 'Servicio express, recolectamos y entregamos en 50 minutos, hasta 60 Km', '40', '2013-07-24 17:12:33'),
(4, 'Express', 'mas de 60 Km', 'Servicio express, recolectamos y entregamos en 50 minutos, m&aacute;s de 60 Km', '40', '2013-07-24 17:12:33'),
(5, 'Mismo dÃ­a', '1 a 20 Km', 'Recolectamos antes de las 11:00 y entregamos el mismo d&iacute;a antes de las 18:00 horas, hasta 20 Km', '40', '2013-07-24 17:22:24'),
(6, 'Mismo dÃ­a', '20 a 40 Km', 'Recolectamos antes de las 11:00 y entregamos el mismo d&iacute;a antes de las 18:00 horas, hasta 40 Km', '40', '2013-07-24 17:22:24'),
(7, 'Mismo dÃ­a', '40 a 60 Km', 'Recolectamos antes de las 11:00 y entregamos el mismo d&iacute;a antes de las 18:00 horas, hasta 60 Km', '40', '2013-07-24 17:22:24'),
(8, 'Mismo dÃ­a', 'm&aacute;s de 60 Km', 'Recolectamos antes de las 11:00 y entregamos el mismo d&iacute;a antes de las 18:00 horas, m&acute;s de 60 Km', '40', '2013-07-24 17:22:24'),
(9, 'Programado', '1 a 20 Km', 'Recolectamos en fecha programada y entregamos en fecha programada, hasta 20 Km', '40', '2013-07-24 21:22:24'),
(10, 'Programado', '20 a 40 Km', 'Recolectamos en fecha programada y entregamos en fecha programada, hasta 40 Km', '40', '2013-07-24 21:22:24'),
(11, 'Programado', '40 a 60 Km', 'Recolectamos en fecha programada y entregamos en fecha programada, hasta 60 Km', '40', '2013-07-24 21:22:24'),
(12, 'Programado', 'm&aacute;s de 60 Km', 'Recolectamos en fecha programada y entregamos en fecha programada, m&acute;s de 60 Km', '40', '2013-07-24 21:22:24'),
(13, 'Varios destinos', '1 a 20 Km', 'Recolectamos en fecha programada y entregamos en varios destinos, hasta 20 Km', '40', '2013-07-24 21:22:24'),
(14, 'Varios destinos', '20 a 40 Km', 'Recolectamos en fecha programada y entregamos en varios destinos, hasta 40 Km', '40', '2013-07-24 21:22:24'),
(15, 'Varios destinos', '40 a 60 Km', 'Recolectamos en fecha programada y entregamos en varios destinos, hasta 60 Km', '40', '2013-07-24 21:22:24'),
(16, 'Varios destinos', 'm&aacute;s de 60 Km', 'Recolectamos en fecha programada y entregamos en varios destinos, m&acute;s de 60 Km', '40', '2013-07-24 21:22:24'),
(17, 'Promociones', 'Verano', 'Este verano andamos con ganas de llevar todos sus envÃ­os, asÃ­ que todos los envÃ­os tienen un costo de $40 pesos, aun los que van a los parques industriales de QuerÃ©taro. Â¡LlÃ¡manos!', '40.00', '2013-07-26 18:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `perm` varchar(30) NOT NULL,
  `lock` varchar(16) NOT NULL,
  `nom` varchar(90) NOT NULL,
  `ap_pat` varchar(50) NOT NULL,
  `ap_mat` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `cel` varchar(25) NOT NULL,
  `dom` tinytext NOT NULL,
  `fech_reg` varchar(12) NOT NULL,
  `fua` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `user`, `pass`, `perm`, `lock`, `nom`, `ap_pat`, `ap_mat`, `sexo`, `cel`, `dom`, `fech_reg`, `fua`) VALUES
(1, 'Admin', '6aaf193232c1323fb7f7e671ff54eb54', '11111111', '', 'Administrador', '', '', '1', '045', '', '1371084334', '2013-07-11 01:49:47'),
(2, 'jorge', '06d4f07c943a4da1c8bfe591abbc3579', '00000001', '', 'Jorge ', 'Cruz', '', '1', '442 152 8994', '', '1374775773', '2013-07-25 18:09:33'),
(3, 'svicke', 'e1621809ed864d5fa9043f0d07085ec5', '11111110', '', 'Sebastian ', 'Gonzalez', 'Vicke', '1', '10892206', '', '1374776124', '2013-07-25 18:15:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
