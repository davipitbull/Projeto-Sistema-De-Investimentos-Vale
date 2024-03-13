-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB


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

CREATE DATABASE IF NOT EXISTS projetoinvestimentos;
USE projetoinvestimentos;

--
-- Definition of table `adm`
--

DROP TABLE IF EXISTS `adm`;
CREATE TABLE `adm` (
  `idadm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `ocupacao` varchar(100) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT 100.00,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idadm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adm`
--

/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` (`idadm`,`nome`,`email`,`senha`,`cpf`,`ocupacao`,`saldo`,`alteracao`,`cadastro`,`ativo`) VALUES 
 (1,'David','davidestudosdev@gmail.com','12345678','187.967.366-58','ALUNO','100.00','2024-03-13 14:49:26','2024-03-13 14:43:12',1);
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;


--
-- Definition of table `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE `carro` (
  `idcarro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcarro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carro`
--

/*!40000 ALTER TABLE `carro` DISABLE KEYS */;
INSERT INTO `carro` (`idcarro`,`nome`,`descricao`,`imagem`,`data_criacao`,`alteracao`,`ativo`) VALUES 
 (1,'Fiat Uno','Carro econômico e prático.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (2,'Volkswagen Gol','Um dos carros mais vendidos no Brasil.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (3,'Ford Ka','Compacto e ágil.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (4,'Chevrolet Onix','Confortável e com boa tecnologia.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (5,'Renault Kwid','Carro urbano e econômico.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (6,'Toyota Corolla','Um dos sedãs mais populares.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (7,'Honda Civic','Elegância e desempenho.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (8,'Hyundai HB20','Design moderno e bom custo-benefício.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (9,'Nissan Versa','Espaçoso e confortável.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1),
 (10,'Jeep Renegade','SUV compacto e versátil.','foto1.jpg','2024-03-13 15:19:28','2024-03-13 15:23:54',1);
/*!40000 ALTER TABLE `carro` ENABLE KEYS */;


--
-- Definition of table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `ocupacao` varchar(100) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT 100.00,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `proprietario`
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
-- Dumping data for table `proprietario`
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
 (9,'Ricardo Nunes','ricardo@example.com','345.678.912-10','Programador','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL),
 (10,'Patrícia Costa','patricia@example.com','567.891.234-10','Contadora','2024-03-13 15:19:28','2024-03-13 15:19:28',1,NULL);
/*!40000 ALTER TABLE `proprietario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
