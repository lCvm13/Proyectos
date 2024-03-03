
CREATE DATABASE IF NOT EXISTS `peticionsgithub`;
USE `peticionsgithub`;

CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL,
    `apellido` VARCHAR(50) NOT NULL,
    `ciudad` VARCHAR(50) NOT NULL
);
