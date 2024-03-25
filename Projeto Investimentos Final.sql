-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema projetoinvestimentos
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ projetoinvestimentos;
USE projetoinvestimentos;

--
-- Table structure for table `projetoinvestimentos`.`adm`
--

DROP TABLE IF EXISTS `adm`;
CREATE TABLE `adm` (
  `idadm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `ocupacao` varchar(100) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT 10000.00,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idadm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`adm`
--

/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` (`idadm`,`nome`,`email`,`senha`,`cpf`,`ocupacao`,`saldo`,`alteracao`,`cadastro`,`ativo`) VALUES 
 (1,'David','davidestudosdev@gmail.com','12345678','187.967.366-58','ALUNO','100.00','2024-03-13 14:49:26','2024-03-13 14:43:12',1);
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;


--
-- Table structure for table `projetoinvestimentos`.`carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE `carro` (
  `idcarro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` decimal(10,2) DEFAULT NULL,
  `valor_investido` decimal(10,2) DEFAULT 0.00,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcarro`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`carro`
--

/*!40000 ALTER TABLE `carro` DISABLE KEYS */;
INSERT INTO `carro` (`idcarro`,`nome`,`descricao`,`imagem`,`data_criacao`,`valor`,`valor_investido`,`alteracao`,`ativo`) VALUES 
 (27,'Carro1','Carro1','EXEMPLO.jpg','2024-03-21 11:19:12','100.00','6600.00','2024-03-25 01:21:35',NULL),
 (28,'Carro2','Carro2','EXEMPLO.jpg','2024-03-21 11:19:26','200.00','3200.00','2024-03-25 01:05:21',NULL),
 (29,'Carro3','Carro3','EXEMPLO.jpg','2024-03-21 11:19:40','300.00','8100.00','2024-03-25 01:11:30',NULL);
/*!40000 ALTER TABLE `carro` ENABLE KEYS */;


--
-- Table structure for table `projetoinvestimentos`.`cartao_credito`
--

DROP TABLE IF EXISTS `cartao_credito`;
CREATE TABLE `cartao_credito` (
  `idcartao` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cartao` varchar(16) NOT NULL,
  `saldo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `idcliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcartao`),
  KEY `idcliente` (`idcliente`),
  CONSTRAINT `cartao_credito_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`cartao_credito`
--

/*!40000 ALTER TABLE `cartao_credito` DISABLE KEYS */;
INSERT INTO `cartao_credito` (`idcartao`,`codigo_cartao`,`saldo`,`cadastro`,`alteracao`,`ativo`,`idcliente`) VALUES 
 (1,'1','0.00','2024-03-24 22:48:44','2024-03-25 00:27:14',1,1),
 (3,'2','99998299.99','2024-03-25 00:42:49','2024-03-25 01:18:28',1,NULL);
/*!40000 ALTER TABLE `cartao_credito` ENABLE KEYS */;


--
-- Table structure for table `projetoinvestimentos`.`cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `ocupacao` varchar(100) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT 10000.00,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`idcliente`,`nome`,`email`,`senha`,`cpf`,`ocupacao`,`saldo`,`alteracao`,`cadastro`,`ativo`) VALUES 
 (1,'david','777dahnobeat@gmail.com','12345678','18796736658','Aluno','7076.00','2024-03-17 22:44:32','2024-03-16 22:22:24',NULL),
 (2,'Julio','julio@gmail.com','12345678','18796736652','Alunoo','9990500.00','2024-03-25 01:05:33','2024-03-17 22:50:32',NULL),
 (3,'Tulio','tulio@gmail.com','12345678','18796736658','Aluno','10000.00','2024-03-25 01:22:25','2024-03-25 01:22:25',NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Table structure for table `projetoinvestimentos`.`investimento`
--

DROP TABLE IF EXISTS `investimento`;
CREATE TABLE `investimento` (
  `idinvestimento` int(11) NOT NULL AUTO_INCREMENT,
  `idcarro` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `metodo_pagamento` enum('cartao_credito','dinheiro') NOT NULL,
  `data_investimento` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idinvestimento`),
  KEY `idcarro` (`idcarro`),
  CONSTRAINT `investimento_ibfk_1` FOREIGN KEY (`idcarro`) REFERENCES `carro` (`idcarro`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`investimento`
--

/*!40000 ALTER TABLE `investimento` DISABLE KEYS */;
INSERT INTO `investimento` (`idinvestimento`,`idcarro`,`quantidade`,`metodo_pagamento`,`data_investimento`) VALUES 
 (26,28,'2.00','cartao_credito','2024-03-25 00:14:03'),
 (27,28,'1.00','cartao_credito','2024-03-25 00:14:11'),
 (28,29,'1.00','cartao_credito','2024-03-25 00:15:58'),
 (29,29,'10.00','cartao_credito','2024-03-25 00:16:02'),
 (30,29,'10.00','cartao_credito','2024-03-25 00:16:18'),
 (31,27,'18.00','cartao_credito','2024-03-25 00:16:28'),
 (32,27,'1.00','cartao_credito','2024-03-25 00:27:14'),
 (33,27,'2.00','cartao_credito','2024-03-25 00:57:16'),
 (34,27,'2.00','cartao_credito','2024-03-25 01:03:25'),
 (35,28,'3.00','cartao_credito','2024-03-25 01:04:57'),
 (36,29,'2.00','dinheiro','2024-03-25 01:08:23'),
 (37,29,'2.00','cartao_credito','2024-03-25 01:11:30'),
 (38,27,'1.00','cartao_credito','2024-03-25 01:18:28'),
 (39,27,'2.00','dinheiro','2024-03-25 01:19:14'),
 (40,27,'2.00','dinheiro','2024-03-25 01:19:46'),
 (41,27,'1.00','dinheiro','2024-03-25 01:20:00'),
 (42,27,'10.00','dinheiro','2024-03-25 01:21:35');
/*!40000 ALTER TABLE `investimento` ENABLE KEYS */;


--
-- Table structure for table `projetoinvestimentos`.`proprietario`
--

DROP TABLE IF EXISTS `proprietario`;
CREATE TABLE `proprietario` (
  `idproprietario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `ocupacao` varchar(100) DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  `idcarro` int(11) DEFAULT NULL,
  PRIMARY KEY (`idproprietario`),
  KEY `fk_proprietario_carro` (`idcarro`),
  CONSTRAINT `fk_proprietario_carro` FOREIGN KEY (`idcarro`) REFERENCES `carro` (`idcarro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projetoinvestimentos`.`proprietario`
--

/*!40000 ALTER TABLE `proprietario` DISABLE KEYS */;
INSERT INTO `proprietario` (`idproprietario`,`nome`,`email`,`cpf`,`ocupacao`,`alteracao`,`cadastro`,`ativo`,`idcarro`) VALUES 
 (1,'João Silva','joao@example.com','123.456.789-10','Empresário','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (2,'Maria Santos','maria@example.com','987.654.321-01','Advogada','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (3,'Pedro Oliveira','pedro@example.com','456.789.123-10','Engenheiro','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (4,'Ana Souza','ana@example.com','321.654.987-10','Médica','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (5,'Carlos Almeida','carlos@example.com','654.321.987-10','Professor','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (6,'Fernanda Lima','fernanda@example.com','789.123.456-10','Estudante','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (7,'Roberto Santos','roberto@example.com','234.567.891-10','Empresário','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (8,'Juliana Ferreira','juliana@example.com','890.123.456-10','Designer','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (9,'Ricardo Nunes','ricardo@example.com','345.678.912-10','Programador','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL);
INSERT INTO `proprietario` (`idproprietario`,`nome`,`email`,`cpf`,`ocupacao`,`alteracao`,`cadastro`,`ativo`,`idcarro`) VALUES 
 (10,'Patrícia Costa','patricia@example.com','567.891.234-10','Contadora','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL);
/*!40000 ALTER TABLE `proprietario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
