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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Daniel Lagos Souza','833.333.890-96','1996-10-02','Masculino','danielcliente@email.com',NULL,'(61) 99999-9999','71750-000','Núcleo Rural Vargem Bonita','4','Setor de chacaras','Núcleo Rural Vargem Bonita (Park Way)','Brasília','DF','noite-20200424230417.jpg'),(2,'Maria Madalena','006.437.970-17','1988-05-28','Feminino','mariamadalena@email.com',NULL,'(61) 98686-7878',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Mozart Teixeira de Brito','949.494.646-45','2010-10-10','Masculino','mozart.contato@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','(64) 65465-4646','72583-300','Rua 500 Lote 502','','5454','Setor Meireles (Santa Maria)','Brasília','DF','mozart-brito-20200424010419.jpg');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controles`
--

DROP TABLE IF EXISTS `controles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `tipo` enum('Administrativo','Front') DEFAULT 'Administrativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controles`
--

LOCK TABLES `controles` WRITE;
/*!40000 ALTER TABLE `controles` DISABLE KEYS */;
INSERT INTO `controles` VALUES (1,'cliente','1','Administrativo'),(2,'usuario','1','Administrativo'),(3,'perfil','1','Administrativo'),(4,'categoria','1','Administrativo'),(5,'produto','1','Administrativo'),(6,'venda','1','Administrativo'),(7,'estoque','1','Administrativo');
/*!40000 ALTER TABLE `controles` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens`
--

LOCK TABLES `imagens` WRITE;
/*!40000 ALTER TABLE `imagens` DISABLE KEYS */;
INSERT INTO `imagens` VALUES (1,'refrigerante','assets/img/produtos/3/refrigerante-20200421010412.jpg',3),(2,'refrigerante2','assets/img/produtos/3/refrigerante2-20200421010412.jpg',3),(3,'refrigerante3','assets/img/produtos/3/refrigerante3-20200421010413.jpg',3),(4,'refrigerante2','assets/img/produtos/4/refrigerante2-20200421010413.jpg',4),(5,'refrigerante','assets/img/produtos/4/refrigerante-20200421010421.jpg',4),(6,'refrigerante3','assets/img/produtos/4/refrigerante3-20200421010421.jpg',4),(7,'792387278a97ce893ded01005bc40e06','assets/img/produtos/3/792387278a97ce893ded01005bc40e06-20200421010421.jpg',3),(8,'b2','assets/img/produtos/5/b2-20200422220440.jpg',5),(9,'b2-2','assets/img/produtos/5/b2-2-20200422220440.jpg',5),(10,'b2-3','assets/img/produtos/5/b2-3-20200422220440.jpg',5),(11,'hotdog2','assets/img/produtos/7/hotdog2-20200428220424.jpg',7),(12,'hotdog1','assets/img/produtos/7/hotdog1-20200428220424.jpg',7);
/*!40000 ALTER TABLE `imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfis`
--

DROP TABLE IF EXISTS `perfis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL COMMENT 'Esta tabela armazenará todos os perfis que o sistema possa necessitar.',
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfis`
--

LOCK TABLES `perfis` WRITE;
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;
INSERT INTO `perfis` VALUES (1,'Administrador','1'),(3,'Vendedor','1'),(4,'Financeiro','1');
/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `controle_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `select` char(1) NOT NULL DEFAULT '0',
  `delete` char(1) NOT NULL DEFAULT '0',
  `update` char(1) NOT NULL DEFAULT '0',
  `insert` char(1) NOT NULL DEFAULT '0',
  `show` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_permissoes_controles1_idx` (`controle_id`),
  KEY `fk_permissoes_perfis1_idx` (`perfil_id`),
  CONSTRAINT `fk_permissoes_controles1` FOREIGN KEY (`controle_id`) REFERENCES `controles` (`id`),
  CONSTRAINT `fk_permissoes_perfis1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,1,1,'1','1','1','1','1'),(2,3,1,'1','1','1','1','1'),(5,5,3,'1','0','1','1','1'),(6,4,1,'1','1','1','1','1'),(9,5,1,'1','1','1','1','1'),(10,2,1,'1','1','1','1','1'),(12,2,3,'0','0','1','0','1'),(13,1,3,'1','0','1','1','1'),(14,4,3,'1','0','1','1','1'),(18,1,4,'1','0','0','0','1'),(19,5,4,'1','0','0','0','1'),(20,6,1,'1','1','1','1','1'),(21,7,1,'1','1','1','1','1'),(22,7,3,'1','0','1','1','1'),(23,6,3,'1','0','1','0','1'),(24,6,4,'1','0','0','0','1'),(25,7,4,'1','0','0','0','1'),(37,4,4,'1','0','0','0','1');
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (3,'Refrigerante',5.00,2,15,'sadfasdf'),(4,'Coca Lata',4.50,2,4,'Cola lata de 350ml'),(5,'Burguer Duplo',19.90,1,0,'2 hamburgueres de carne com 180g cada uma;\r\nAlface;\r\nTomate;\r\nMussarela;\r\nCebola;'),(6,'Contra filé',25.90,13,20,'Contra filé com arroz branco, feijão tropeiro e vinagrete'),(7,'Hot Dog',12.00,1,15,'Completo na chapa, com milho, ervilha, queijo mussarela, bacon.');
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
  `perfil_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfil_idx` (`perfil_id`),
  CONSTRAINT `fk_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Juan Pablo','juan@email.com','81dc9bdb52d04dc20036dbd8313ed055','Juan Pablo-20200420230428.jpg',4),(4,'Guilherme','guilherme@email.com','81dc9bdb52d04dc20036dbd8313ed055','WhatsApp-icone-20200420230427.png',3),(5,'Lucas','lucas@email.com','81dc9bdb52d04dc20036dbd8313ed055','images-20200423000443.jpg',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `cliente_id` int NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Iniciada','Pendente','Finalizada','Cancelada') NOT NULL DEFAULT 'Iniciada',
  `data_finalizacao` datetime DEFAULT NULL,
  `forma_pagamento` varchar(45) DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_idx` (`cliente_id`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (1,'2020265644',2,'2020-04-21 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(2,'2020265648',2,'2020-04-22 20:30:00','Pendente',NULL,'',NULL),(3,'2020265647',3,'2020-04-23 17:20:00','Pendente',NULL,'',NULL),(4,'2020265644',2,'2020-04-21 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(5,'2020265644',2,'2020-04-24 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(6,'2020265644',2,'2020-04-10 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(7,'2020265644',2,'2020-04-02 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(8,'2020265644',2,'2020-04-29 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(9,'2020265644',2,'2020-04-30 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(10,'2020265644',2,'2020-04-30 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(11,'2020265644',2,'2020-04-18 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(12,'2020265644',2,'2020-04-18 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(13,'2020265644',2,'2020-04-01 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(14,'2020265644',2,'2020-04-01 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(15,'2020265644',2,'2020-04-30 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(16,'2020265644',2,'2020-04-17 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00'),(17,'2020265644',2,'2020-04-12 15:30:00','Finalizada','2020-04-23 12:38:00','Cartão','2020-04-23 12:38:00');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas_produtos`
--

DROP TABLE IF EXISTS `vendas_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas_produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `venda_id` int NOT NULL,
  `produto_id` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd` int NOT NULL DEFAULT '1',
  `desconto` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_produto_idx` (`produto_id`),
  KEY `fk_venda_idx` (`venda_id`),
  CONSTRAINT `fk_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `fk_venda` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas_produtos`
--

LOCK TABLES `vendas_produtos` WRITE;
/*!40000 ALTER TABLE `vendas_produtos` DISABLE KEYS */;
INSERT INTO `vendas_produtos` VALUES (1,1,3,5.00,2,0.00),(2,1,5,19.90,3,0.00),(3,2,4,4.50,1,0.00),(4,3,3,5.00,1,0.00),(5,3,5,19.90,2,0.00),(6,2,6,7.90,2,0.00),(7,3,6,7.90,5,0.00),(8,2,6,7.90,2,0.00),(9,3,6,7.90,5,0.00),(10,2,6,7.90,2,0.00),(11,3,6,5.00,2,0.00),(12,5,6,5.00,2,0.00),(13,2,6,5.00,2,0.00),(14,2,6,5.00,2,0.00),(15,2,6,5.00,2,0.00),(16,5,6,5.00,2,0.00),(17,2,6,5.00,2,0.00),(18,6,6,5.00,2,0.00),(19,7,6,5.00,2,0.00),(20,8,6,5.00,2,0.00),(21,9,6,5.00,2,0.00),(22,9,6,12.00,2,0.00),(23,13,6,5.00,2,0.00),(24,12,6,19.90,3,0.00),(25,11,6,19.90,3,0.00),(26,10,6,19.90,2,0.00),(27,14,6,5.00,2,0.00),(28,14,6,5.00,2,0.00),(29,15,6,7.00,1,0.00),(30,16,6,7.00,2,0.00),(31,2,6,5.00,1,0.00),(32,17,6,5.00,2,0.00),(33,17,6,5.00,2,0.00);
/*!40000 ALTER TABLE `vendas_produtos` ENABLE KEYS */;
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

-- Dump completed on 2020-04-29 22:28:30
