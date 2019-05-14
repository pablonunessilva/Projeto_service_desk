-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: helpdesk2
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chamados`
--

DROP TABLE IF EXISTS `chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `chamados` (
  `idchamado` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `setorcall` varchar(25) NOT NULL,
  `solicitacao` varchar(30) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `id_problema` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `data_resolvido` datetime DEFAULT NULL,
  `id_prioridade` int(11) NOT NULL,
  PRIMARY KEY (`idchamado`),
  KEY `fk_usuario` (`idusuario`),
  KEY `fk_prioridade` (`id_prioridade`),
  KEY `fk_problema` (`id_problema`),
  CONSTRAINT `fk_prioridade` FOREIGN KEY (`id_prioridade`) REFERENCES `prioridade` (`id`),
  CONSTRAINT `fk_problema` FOREIGN KEY (`id_problema`) REFERENCES `tbl_problema` (`id_problema`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chamados`
--

LOCK TABLES `chamados` WRITE;
/*!40000 ALTER TABLE `chamados` DISABLE KEYS */;
INSERT INTO `chamados` VALUES (1,3,'2019-05-14 10:18:24','cliente','Adm','teste',2,'Pendente',NULL,2);
/*!40000 ALTER TABLE `chamados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confirma`
--

DROP TABLE IF EXISTS `confirma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `confirma` (
  `idchamado2` int(11) NOT NULL,
  `idconfirma` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idconfirma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confirma`
--

LOCK TABLES `confirma` WRITE;
/*!40000 ALTER TABLE `confirma` DISABLE KEYS */;
/*!40000 ALTER TABLE `confirma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prioridade`
--

DROP TABLE IF EXISTS `prioridade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `prioridade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridade_desc` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sla` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prioridade`
--

LOCK TABLES `prioridade` WRITE;
/*!40000 ALTER TABLE `prioridade` DISABLE KEYS */;
INSERT INTO `prioridade` VALUES (1,'Critico',12),(2,'Urgente',24),(3,'Intermediário',72),(4,'Básico',96);
/*!40000 ALTER TABLE `prioridade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostas`
--

DROP TABLE IF EXISTS `respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` varchar(1000) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idchamado` int(11) NOT NULL,
  `data` varchar(10) DEFAULT NULL,
  `hora` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `respostas_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas`
--

LOCK TABLES `respostas` WRITE;
/*!40000 ALTER TABLE `respostas` DISABLE KEYS */;
INSERT INTO `respostas` VALUES (1,'teste',19,66,'14/05/2019','10:19:49'),(2,'teste12',19,66,'14/05/2019','10:19:56');
/*!40000 ALTER TABLE `respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_problema`
--

DROP TABLE IF EXISTS `tbl_problema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_problema` (
  `id_problema` int(11) NOT NULL AUTO_INCREMENT,
  `desc_problema` varchar(40) NOT NULL,
  PRIMARY KEY (`id_problema`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_problema`
--

LOCK TABLES `tbl_problema` WRITE;
/*!40000 ALTER TABLE `tbl_problema` DISABLE KEYS */;
INSERT INTO `tbl_problema` VALUES (1,'Internet lenta'),(2,'Abrir site especifico'),(3,'Não abre site nenhum'),(4,'Mudança de enreço'),(5,'Mudança do local do roteado'),(6,'Outros');
/*!40000 ALTER TABLE `tbl_problema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `setor` varchar(40) NOT NULL,
  `datacadastro` datetime NOT NULL,
  `dados_status` varchar(10) NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `primeira_vez` tinyint(1) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'master','','master','202cb962ac59075b964b07152d234b70','administrativo','2017-07-17 01:46:06','ativo','0000-00-00 00:00:00',0),(2,'Severino','severino@hotmail.com','severino','202cb962ac59075b964b07152d234b70','RH','2019-03-30 17:27:06','ativo','0000-00-00 00:00:00',0),(3,'Adm','leandro.marim@hotmail.com','marim48','e7d80ffeefa212b7c5c55700e4f7193e','cliente','2019-05-14 10:15:56','ativo','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-14 10:22:56
