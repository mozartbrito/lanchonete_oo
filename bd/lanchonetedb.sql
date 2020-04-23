-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: lanchonete_api
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Lanches'),(2,'Bebidas'),(13,'Alimentos'),(14,'Eletroportáteis'),(16,'Laticinio');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `sexo` enum('Masculino','Feminino','Não informado') DEFAULT 'Não informado',
  `email` varchar(150) NOT NULL,
  `senha` char(32) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `cep` varchar(14) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Daniel Lagos','833.333.890-96','1996-10-02','Masculino','danielcliente@email.com',NULL,'(61) 99999-9999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens`
--

DROP TABLE IF EXISTS `imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `caminho` varchar(255) DEFAULT NULL,
  `produto_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produto_imagem_idx` (`produto_id`),
  CONSTRAINT `fk_produto_imagem` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens`
--

LOCK TABLES `imagens` WRITE;
/*!40000 ALTER TABLE `imagens` DISABLE KEYS */;
INSERT INTO `imagens` VALUES (1,'refrigerante','assets/img/produtos/3/refrigerante-20200421010412.jpg',3),(2,'refrigerante2','assets/img/produtos/3/refrigerante2-20200421010412.jpg',3),(3,'refrigerante3','assets/img/produtos/3/refrigerante3-20200421010413.jpg',3),(4,'refrigerante2','assets/img/produtos/4/refrigerante2-20200421010413.jpg',4),(5,'refrigerante','assets/img/produtos/4/refrigerante-20200421010421.jpg',4),(6,'refrigerante3','assets/img/produtos/4/refrigerante3-20200421010421.jpg',4),(7,'792387278a97ce893ded01005bc40e06','assets/img/produtos/3/792387278a97ce893ded01005bc40e06-20200421010421.jpg',3),(8,'b2','assets/img/produtos/5/b2-20200422220440.jpg',5),(9,'b2-2','assets/img/produtos/5/b2-2-20200422220440.jpg',5),(10,'b2-3','assets/img/produtos/5/b2-3-20200422220440.jpg',5);
/*!40000 ALTER TABLE `imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `categoria` int NOT NULL,
  `qtd` int DEFAULT '0',
  `descricao` text,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_idx` (`categoria`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (3,'Refrigerante',5.00,2,15,'sadfasdf'),(4,'Coca Lata',4.50,2,4,'Cola lata de 350ml'),(5,'Burguer Duplo',19.90,1,0,'2 hamburgueres de carne com 180g cada uma;\r\nAlface;\r\nTomate;\r\nMussarela;\r\nCebola;');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Juan Pablo','juan@email.com','81dc9bdb52d04dc20036dbd8313ed055','Juan Pablo-20200420230428.jpg'),(4,'Guilherme','guilherme@email.com','81dc9bdb52d04dc20036dbd8313ed055','WhatsApp-icone-20200420230427.png'),(5,'Lucas','lucas@email.com','81dc9bdb52d04dc20036dbd8313ed055','images-20200423000443.jpg');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lanchonete_api'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-22 22:17:17
