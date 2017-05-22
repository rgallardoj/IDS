
CREATE SCHEMA IF NOT EXISTS `cgg` DEFAULT CHARACTER SET latin1 ;
USE `cgg` ;

-- -----------------------------------------------------
-- Table `cgg`.`regiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`regiones` (
  `region_id` INT(11) NOT NULL AUTO_INCREMENT,
  `region_nombre` VARCHAR(64) NOT NULL,
  `region_ordinal` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`region_id`))
ENGINE = MyISAM
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `cgg`.`provincias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`provincias` (
  `provincia_id` INT(11) NOT NULL AUTO_INCREMENT,
  `provincia_nombre` VARCHAR(64) NOT NULL,
  `region_id` INT(11) NOT NULL,
  PRIMARY KEY (`provincia_id`),
  INDEX `fk_provincias_regiones1_idx` (`region_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 54
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `cgg`.`comunas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`comunas` (
  `comuna_id` INT(11) NOT NULL AUTO_INCREMENT,
  `comuna_nombre` VARCHAR(64) NOT NULL,
  `provincia_id` INT(11) NOT NULL,
  PRIMARY KEY (`comuna_id`),
  INDEX `fk_comunas_provincias1_idx` (`provincia_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 346
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `cgg`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`perfil` (
  `idperfil` INT(5) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idperfil`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cgg`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`usuario` (
  `rut` INT(9) NOT NULL,
  `pass` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido_paterno` VARCHAR(45) NOT NULL,
  `apellido_materno` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `numCasa` INT(10) NOT NULL,
  `idperfil` INT(5) NOT NULL,
  `comuna_id` INT(11) NOT NULL,
  `activo` BIT NOT NULL,
  PRIMARY KEY (`rut`),
  INDEX `fk_usuario_perfil1_idx` (`idperfil` ASC),
  INDEX `fk_usuario_comunas1_idx` (`comuna_id` ASC)
  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cgg`.`tipodeuda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`tipodeuda` (
  `idtipodeuda` INT NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipodeuda`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cgg`.`tipoCuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`tipoCuenta` (
  `idtipoCuenta` INT NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipoCuenta`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cgg`.`tipoIngreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`tipoIngreso` (
  `idtipoIngreso` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipoIngreso`))
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `cgg`.`deuda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`deuda` (
  `iddeuda` INT NOT NULL AUTO_INCREMENT,
  `usuario_rut` INT(9) NOT NULL,
  `tipodeuda_idtipodeuda` INT NOT NULL,
  `fechaIngreso` DATETIME NOT NULL,
  `estadoDeuda` BIT NOT NULL,
  `comentario` VARCHAR(45) NULL,
  `tipoCuenta_idtipoCuenta` INT NOT NULL,
  PRIMARY KEY (`iddeuda`),
  INDEX `fk_deuda_usuario1_idx` (`usuario_rut` ASC),
  INDEX `fk_deuda_tipodeuda1_idx` (`tipodeuda_idtipodeuda` ASC),
  INDEX `fk_deuda_tipoCuenta1_idx` (`tipoCuenta_idtipoCuenta` ASC),
  CONSTRAINT `fk_deuda_usuario1`
    FOREIGN KEY (`usuario_rut`)
    REFERENCES `cgg`.`usuario` (`rut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_deuda_tipodeuda1`
    FOREIGN KEY (`tipodeuda_idtipodeuda`)
    REFERENCES `cgg`.`tipodeuda` (`idtipodeuda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_deuda_tipoCuenta1`
    FOREIGN KEY (`tipoCuenta_idtipoCuenta`)
    REFERENCES `cgg`.`tipoCuenta` (`idtipoCuenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `cgg`.`detalledeuda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`detalledeuda` (
  `iddetalledeuda` INT NOT NULL AUTO_INCREMENT,
  `deuda_iddeuda` INT NOT NULL,
  `fechaIngreso` DATETIME NOT NULL,
  `fechaPago` DATETIME NULL,
  `valorCuota` INT NOT NULL,
  `valorPagado` INT NULL,
  `estadoPago` BIT NULL,
  `numCuota` INT NULL,
  PRIMARY KEY (`iddetalledeuda`),
  INDEX `fk_detalledeuda_deuda1_idx` (`deuda_iddeuda` ASC),
  CONSTRAINT `fk_detalledeuda_deuda1`
    FOREIGN KEY (`deuda_iddeuda`)
    REFERENCES `cgg`.`deuda` (`iddeuda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cgg`.`ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cgg`.`ingreso` (
  `idingreso` INT NOT NULL AUTO_INCREMENT,
  `montoIngreso` INT NOT NULL,
  `comentario` VARCHAR(45) NULL,
  `usuario_rut` INT(9) NOT NULL,
  `tipoIngreso_idtipoIngreso` INT NOT NULL,
  PRIMARY KEY (`idingreso`),
  INDEX `fk_ingreso_usuario1_idx` (`usuario_rut` ASC),
  INDEX `fk_ingreso_tipoIngreso1_idx` (`tipoIngreso_idtipoIngreso` ASC),
  CONSTRAINT `fk_ingreso_usuario1`
    FOREIGN KEY (`usuario_rut`)
    REFERENCES `cgg`.`usuario` (`rut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingreso_tipoIngreso1`
    FOREIGN KEY (`tipoIngreso_idtipoIngreso`)
    REFERENCES `cgg`.`tipoIngreso` (`idtipoIngreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `comunas` (`comuna_id`,`comuna_nombre`,`provincia_id`)
VALUES
	(1,'Arica',1),
	(2,'Camarones',1),
	(3,'General Lagos',2),
	(4,'Putre',2),
	(5,'Alto Hospicio',3),
	(6,'Iquique',3),
	(7,'Cami�a',4),
	(8,'Colchane',4),
	(9,'Huara',4),
	(10,'Pica',4),
	(11,'Pozo Almonte',4),
	(12,'Antofagasta',5),
	(13,'Mejillones',5),
	(14,'Sierra Gorda',5),
	(15,'Taltal',5),
	(16,'Calama',6),
	(17,'Ollague',6),
	(18,'San Pedro de Atacama',6),
	(19,'Mar�a Elena',7),
	(20,'Tocopilla',7),
	(21,'Cha�aral',8),
	(22,'Diego de Almagro',8),
	(23,'Caldera',9),
	(24,'Copiap�',9),
	(25,'Tierra Amarilla',9),
	(26,'Alto del Carmen',10),
	(27,'Freirina',10),
	(28,'Huasco',10),
	(29,'Vallenar',10),
	(30,'Canela',11),
	(31,'Illapel',11),
	(32,'Los Vilos',11),
	(33,'Salamanca',11),
	(34,'Andacollo',12),
	(35,'Coquimbo',12),
	(36,'La Higuera',12),
	(37,'La Serena',12),
	(38,'Paihuaco',12),
	(39,'Vicu�a',12),
	(40,'Combarbal�',13),
	(41,'Monte Patria',13),
	(42,'Ovalle',13),
	(43,'Punitaqui',13),
	(44,'R�o Hurtado',13),
	(45,'Isla de Pascua',14),
	(46,'Calle Larga',15),
	(47,'Los Andes',15),
	(48,'Rinconada',15),
	(49,'San Esteban',15),
	(50,'La Ligua',16),
	(51,'Papudo',16),
	(52,'Petorca',16),
	(53,'Zapallar',16),
	(54,'Hijuelas',17),
	(55,'La Calera',17),
	(56,'La Cruz',17),
	(57,'Limache',17),
	(58,'Nogales',17),
	(59,'Olmu�',17),
	(60,'Quillota',17),
	(61,'Algarrobo',18),
	(62,'Cartagena',18),
	(63,'El Quisco',18),
	(64,'El Tabo',18),
	(65,'San Antonio',18),
	(66,'Santo Domingo',18),
	(67,'Catemu',19),
	(68,'Llaillay',19),
	(69,'Panquehue',19),
	(70,'Putaendo',19),
	(71,'San Felipe',19),
	(72,'Santa Mar�a',19),
	(73,'Casablanca',20),
	(74,'Conc�n',20),
	(75,'Juan Fern�ndez',20),
	(76,'Puchuncav�',20),
	(77,'Quilpu�',20),
	(78,'Quintero',20),
	(79,'Valpara�so',20),
	(80,'Villa Alemana',20),
	(81,'Vi�a del Mar',20),
	(82,'Colina',21),
	(83,'Lampa',21),
	(84,'Tiltil',21),
	(85,'Pirque',22),
	(86,'Puente Alto',22),
	(87,'San Jos� de Maipo',22),
	(88,'Buin',23),
	(89,'Calera de Tango',23),
	(90,'Paine',23),
	(91,'San Bernardo',23),
	(92,'Alhu�',24),
	(93,'Curacav�',24),
	(94,'Mar�a Pinto',24),
	(95,'Melipilla',24),
	(96,'San Pedro',24),
	(97,'Cerrillos',25),
	(98,'Cerro Navia',25),
	(99,'Conchal�',25),
	(100,'El Bosque',25),
	(101,'Estaci�n Central',25),
	(102,'Huechuraba',25),
	(103,'Independencia',25),
	(104,'La Cisterna',25),
	(105,'La Granja',25),
	(106,'La Florida',25),
	(107,'La Pintana',25),
	(108,'La Reina',25),
	(109,'Las Condes',25),
	(110,'Lo Barnechea',25),
	(111,'Lo Espejo',25),
	(112,'Lo Prado',25),
	(113,'Macul',25),
	(114,'Maip�',25),
	(115,'�u�oa',25),
	(116,'Pedro Aguirre Cerda',25),
	(117,'Pe�alol�n',25),
	(118,'Providencia',25),
	(119,'Pudahuel',25),
	(120,'Quilicura',25),
	(121,'Quinta Normal',25),
	(122,'Recoleta',25),
	(123,'Renca',25),
	(124,'San Miguel',25),
	(125,'San Joaqu�n',25),
	(126,'San Ram�n',25),
	(127,'Santiago',25),
	(128,'Vitacura',25),
	(129,'El Monte',26),
	(130,'Isla de Maipo',26),
	(131,'Padre Hurtado',26),
	(132,'Pe�aflor',26),
	(133,'Talagante',26),
	(134,'Codegua',27),
	(135,'Co�nco',27),
	(136,'Coltauco',27),
	(137,'Do�ihue',27),
	(138,'Graneros',27),
	(139,'Las Cabras',27),
	(140,'Machal�',27),
	(141,'Malloa',27),
	(142,'Mostazal',27),
	(143,'Olivar',27),
	(144,'Peumo',27),
	(145,'Pichidegua',27),
	(146,'Quinta de Tilcoco',27),
	(147,'Rancagua',27),
	(148,'Rengo',27),
	(149,'Requ�noa',27),
	(150,'San Vicente de Tagua Tagua',27),
	(151,'La Estrella',28),
	(152,'Litueche',28),
	(153,'Marchihue',28),
	(154,'Navidad',28),
	(155,'Peredones',28),
	(156,'Pichilemu',28),
	(157,'Ch�pica',29),
	(158,'Chimbarongo',29),
	(159,'Lolol',29),
	(160,'Nancagua',29),
	(161,'Palmilla',29),
	(162,'Peralillo',29),
	(163,'Placilla',29),
	(164,'Pumanque',29),
	(165,'San Fernando',29),
	(166,'Santa Cruz',29),
	(167,'Cauquenes',30),
	(168,'Chanco',30),
	(169,'Pelluhue',30),
	(170,'Curic�',31),
	(171,'Huala��',31),
	(172,'Licant�n',31),
	(173,'Molina',31),
	(174,'Rauco',31),
	(175,'Romeral',31),
	(176,'Sagrada Familia',31),
	(177,'Teno',31),
	(178,'Vichuqu�n',31),
	(179,'Colb�n',32),
	(180,'Linares',32),
	(181,'Longav�',32),
	(182,'Parral',32),
	(183,'Retiro',32),
	(184,'San Javier',32),
	(185,'Villa Alegre',32),
	(186,'Yerbas Buenas',32),
	(187,'Constituci�n',33),
	(188,'Curepto',33),
	(189,'Empedrado',33),
	(190,'Maule',33),
	(191,'Pelarco',33),
	(192,'Pencahue',33),
	(193,'R�o Claro',33),
	(194,'San Clemente',33),
	(195,'San Rafael',33),
	(196,'Talca',33),
	(197,'Arauco',34),
	(198,'Ca�ete',34),
	(199,'Contulmo',34),
	(200,'Curanilahue',34),
	(201,'Lebu',34),
	(202,'Los �lamos',34),
	(203,'Tir�a',34),
	(204,'Alto Biob�o',35),
	(205,'Antuco',35),
	(206,'Cabrero',35),
	(207,'Laja',35),
	(208,'Los �ngeles',35),
	(209,'Mulch�n',35),
	(210,'Nacimiento',35),
	(211,'Negrete',35),
	(212,'Quilaco',35),
	(213,'Quilleco',35),
	(214,'San Rosendo',35),
	(215,'Santa B�rbara',35),
	(216,'Tucapel',35),
	(217,'Yumbel',35),
	(218,'Chiguayante',36),
	(219,'Concepci�n',36),
	(220,'Coronel',36),
	(221,'Florida',36),
	(222,'Hualp�n',36),
	(223,'Hualqui',36),
	(224,'Lota',36),
	(225,'Penco',36),
	(226,'San Pedro de La Paz',36),
	(227,'Santa Juana',36),
	(228,'Talcahuano',36),
	(229,'Tom�',36),
	(230,'Bulnes',37),
	(231,'Chill�n',37),
	(232,'Chill�n Viejo',37),
	(233,'Cobquecura',37),
	(234,'Coelemu',37),
	(235,'Coihueco',37),
	(236,'El Carmen',37),
	(237,'Ninhue',37),
	(238,'�iquen',37),
	(239,'Pemuco',37),
	(240,'Pinto',37),
	(241,'Portezuelo',37),
	(242,'Quill�n',37),
	(243,'Quirihue',37),
	(244,'R�nquil',37),
	(245,'San Carlos',37),
	(246,'San Fabi�n',37),
	(247,'San Ignacio',37),
	(248,'San Nicol�s',37),
	(249,'Treguaco',37),
	(250,'Yungay',37),
	(251,'Carahue',38),
	(252,'Cholchol',38),
	(253,'Cunco',38),
	(254,'Curarrehue',38),
	(255,'Freire',38),
	(256,'Galvarino',38),
	(257,'Gorbea',38),
	(258,'Lautaro',38),
	(259,'Loncoche',38),
	(260,'Melipeuco',38),
	(261,'Nueva Imperial',38),
	(262,'Padre Las Casas',38),
	(263,'Perquenco',38),
	(264,'Pitrufqu�n',38),
	(265,'Puc�n',38),
	(266,'Saavedra',38),
	(267,'Temuco',38),
	(268,'Teodoro Schmidt',38),
	(269,'Tolt�n',38),
	(270,'Vilc�n',38),
	(271,'Villarrica',38),
	(272,'Angol',39),
	(273,'Collipulli',39),
	(274,'Curacaut�n',39),
	(275,'Ercilla',39),
	(276,'Lonquimay',39),
	(277,'Los Sauces',39),
	(278,'Lumaco',39),
	(279,'Pur�n',39),
	(280,'Renaico',39),
	(281,'Traigu�n',39),
	(282,'Victoria',39),
	(283,'Corral',40),
	(284,'Lanco',40),
	(285,'Los Lagos',40),
	(286,'M�fil',40),
	(287,'Mariquina',40),
	(288,'Paillaco',40),
	(289,'Panguipulli',40),
	(290,'Valdivia',40),
	(291,'Futrono',41),
	(292,'La Uni�n',41),
	(293,'Lago Ranco',41),
	(294,'R�o Bueno',41),
	(295,'Ancud',42),
	(296,'Castro',42),
	(297,'Chonchi',42),
	(298,'Curaco de V�lez',42),
	(299,'Dalcahue',42),
	(300,'Puqueld�n',42),
	(301,'Queil�n',42),
	(302,'Quemchi',42),
	(303,'Quell�n',42),
	(304,'Quinchao',42),
	(305,'Calbuco',43),
	(306,'Cocham�',43),
	(307,'Fresia',43),
	(308,'Frutillar',43),
	(309,'Llanquihue',43),
	(310,'Los Muermos',43),
	(311,'Maull�n',43),
	(312,'Puerto Montt',43),
	(313,'Puerto Varas',43),
	(314,'Osorno',44),
	(315,'Puero Octay',44),
	(316,'Purranque',44),
	(317,'Puyehue',44),
	(318,'R�o Negro',44),
	(319,'San Juan de la Costa',44),
	(320,'San Pablo',44),
	(321,'Chait�n',45),
	(322,'Futaleuf�',45),
	(323,'Hualaihu�',45),
	(324,'Palena',45),
	(325,'Ais�n',46),
	(326,'Cisnes',46),
	(327,'Guaitecas',46),
	(328,'Cochrane',47),
	(329,'O\'higgins',47),
	(330,'Tortel',47),
	(331,'Coihaique',48),
	(332,'Lago Verde',48),
	(333,'Chile Chico',49),
	(334,'R�o Ib��ez',49),
	(335,'Ant�rtica',50),
	(336,'Cabo de Hornos',50),
	(337,'Laguna Blanca',51),
	(338,'Punta Arenas',51),
	(339,'R�o Verde',51),
	(340,'San Gregorio',51),
	(341,'Porvenir',52),
	(342,'Primavera',52),
	(343,'Timaukel',52),
	(344,'Natales',53),
	(345,'Torres del Paine',53);

-- 
-- Provincias
--
INSERT INTO `provincias` (`provincia_id`,`provincia_nombre`,`region_id`)
VALUES
	(1,'Arica',1),
	(2,'Parinacota',1),
	(3,'Iquique',2),
	(4,'El Tamarugal',2),
	(5,'Antofagasta',3),
	(6,'El Loa',3),
	(7,'Tocopilla',3),
	(8,'Cha�aral',4),
	(9,'Copiap�',4),
	(10,'Huasco',4),
	(11,'Choapa',5),
	(12,'Elqui',5),
	(13,'Limar�',5),
	(14,'Isla de Pascua',6),
	(15,'Los Andes',6),
	(16,'Petorca',6),
	(17,'Quillota',6),
	(18,'San Antonio',6),
	(19,'San Felipe de Aconcagua',6),
	(20,'Valparaiso',6),
	(21,'Chacabuco',7),
	(22,'Cordillera',7),
	(23,'Maipo',7),
	(24,'Melipilla',7),
	(25,'Santiago',7),
	(26,'Talagante',7),
	(27,'Cachapoal',8),
	(28,'Cardenal Caro',8),
	(29,'Colchagua',8),
	(30,'Cauquenes',9),
	(31,'Curic�',9),
	(32,'Linares',9),
	(33,'Talca',9),
	(34,'Arauco',10),
	(35,'Bio B�o',10),
	(36,'Concepci�n',10),
	(37,'�uble',10),
	(38,'Caut�n',11),
	(39,'Malleco',11),
	(40,'Valdivia',12),
	(41,'Ranco',12),
	(42,'Chilo�',13),
	(43,'Llanquihue',13),
	(44,'Osorno',13),
	(45,'Palena',13),
	(46,'Ais�n',14),
	(47,'Capit�n Prat',14),
	(48,'Coihaique',14),
	(49,'General Carrera',14),
	(50,'Ant�rtica Chilena',15),
	(51,'Magallanes',15),
	(52,'Tierra del Fuego',15),
	(53,'�ltima Esperanza',15);

-- 
-- Regiones
--
INSERT INTO `regiones` (`region_id`,`region_nombre`,`region_ordinal`)
VALUES
	(1,'Arica y Parinacota','XV'),
	(2,'Tarapac�','I'),
	(3,'Antofagasta','II'),
	(4,'Atacama','III'),
	(5,'Coquimbo','IV'),
	(6,'Valparaiso','V'),
	(7,'Metropolitana de Santiago','RM'),
	(8,'Libertador General Bernardo O\'Higgins','VI'),
	(9,'Maule','VII'),
	(10,'Biob�o','VIII'),
	(11,'La Araucan�a','IX'),
	(12,'Los R�os','XIV'),
	(13,'Los Lagos','X'),
	(14,'Ais�n del General Carlos Ib��ez del Campo','XI'),
	(15,'Magallanes y de la Ant�rtica Chilena','XII');


-- -----------------------------------------------------
-- Table `cgg`.`tipodeuda`
-- -----------------------------------------------------
INSERT INTO `cgg`.`tipodeuda` (`idtipodeuda`, `descripcion`) VALUES (1, "Credito");
INSERT INTO `cgg`.`tipodeuda` (`idtipodeuda`, `descripcion`) VALUES (2, "Mensual");


-- -----------------------------------------------------
-- Table `cgg`.`perfil`
-- -----------------------------------------------------
INSERT INTO `cgg`.`perfil` (`idperfil`, `descripcion`) VALUES (1, "Administrador");
INSERT INTO `cgg`.`perfil` (`idperfil`, `descripcion`) VALUES (2, "Usuario");

-- -----------------------------------------------------
-- Table `cgg`.`tipoCuenta`
-- -----------------------------------------------------
INSERT INTO `cgg`.`tipoCuenta` (`idtipoCuenta`, `descripcion`) VALUES (1, "Luz");
INSERT INTO `cgg`.`tipoCuenta` (`idtipoCuenta`, `descripcion`) VALUES (2, "Agua");
INSERT INTO `cgg`.`tipoCuenta` (`idtipoCuenta`, `descripcion`) VALUES (3, "Gas");
INSERT INTO `cgg`.`tipoCuenta` (`idtipoCuenta`, `descripcion`) VALUES (4, "Otro");

-- -----------------------------------------------------
-- Table `cgg`.`tipoCuenta`
-- -----------------------------------------------------
INSERT INTO `cgg`.`tipoIngreso` (`idtipoIngreso`, `descripcion`) VALUES (1, "Fijo");
INSERT INTO `cgg`.`tipoIngreso` (`idtipoIngreso`, `descripcion`) VALUES (2, "Variable");

-- -----------------------------------------------------
-- Table `cgg`.`tipoCuenta`
-- -----------------------------------------------------
INSERT INTO `cgg`.`usuario` (`rut`, `pass`, `nombre`, `apellido_paterno`, `apellido_materno`, `direccion`, `numCasa`, `idperfil`, `comuna_id`, `activo`) VALUES (17953813, "1795", "Rodrigo", "Gallardo", "Juarez", "Dgo tocornal 01313", 13, 1, 86, 1);