CREATE TABLE if not exists `pda_version` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  `id_sistema` int(11) NOT NULL,
  `sistema` varchar(255) NOT NULL,
  `versao` varchar(50) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
