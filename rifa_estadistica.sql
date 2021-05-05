DROP TABLE IF EXISTS `Boletos`;
CREATE TABLE `Boletos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` int(12) DEFAULT NULL,
  `vendedor` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto` decimal(7,2) DEFAULT NULL,
  `instante_modificacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

