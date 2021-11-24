-- MySQL dump 10.13  Distrib 8.0.26, for macos11 (x86_64)
--
-- Host: localhost    Database: meb
-- ------------------------------------------------------
-- Server version	5.7.34

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
-- Table structure for table `advogados`
--

DROP TABLE IF EXISTS `advogados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advogados` (
  `idAdvogado` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL DEFAULT '0',
  `sexoAdvogado` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `strEstadoCivilAdvogado` varchar(50) CHARACTER SET utf8 DEFAULT 'Não Informado',
  `strNaturalidadeAdvogado` varchar(200) CHARACTER SET utf8 DEFAULT 'Não Informado',
  `nnRg` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `nmMae` varchar(250) CHARACTER SET utf8 DEFAULT 'Não informado',
  `nmPai` varchar(250) CHARACTER SET utf8 DEFAULT 'Não informado',
  `nmResponsavel` varchar(200) CHARACTER SET utf8 DEFAULT 'Não informado',
  `idRespCadastroAdvogado` int(11) DEFAULT NULL,
  `pacientecol` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idAdvogado`),
  UNIQUE KEY `idPessoa_UNIQUE` (`idPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advogados`
--

LOCK TABLES `advogados` WRITE;
/*!40000 ALTER TABLE `advogados` DISABLE KEYS */;
/*!40000 ALTER TABLE `advogados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL DEFAULT '0',
  `sexoCliente` varchar(50) CHARACTER SET utf8 DEFAULT 'Não Infomado',
  `strEstadoCivilCliente` varchar(50) CHARACTER SET utf8 DEFAULT 'Não Informado',
  `strNaturalidadeCliente` varchar(200) CHARACTER SET utf8 DEFAULT 'Não Informado',
  `nnRg` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `nmMae` varchar(250) CHARACTER SET utf8 DEFAULT 'Não informado',
  `nmPai` varchar(250) CHARACTER SET utf8 DEFAULT 'Não informado',
  `nmResponsavel` varchar(200) CHARACTER SET utf8 DEFAULT 'Não informado',
  `idRespCadastroCliente` int(11) NOT NULL,
  `imgCliente` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `idPessoa_UNIQUE` (`idPessoa`),
  KEY `idPessoa` (`idPessoa`),
  CONSTRAINT `idPessoa` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,2,'Masculino','Casado','juazeiro do norte','2002034043643','JOSEFA DAMIANA SILVA','CICERO PAULO FRANCO DOS SANTOS','Não informado',1,'1634155901.peg'),(2,5,'Masculino','Casado','CRATO','','JOSEFA CALIXTO LAURA DA SILVA','','Não informado',3,'1634155628.jpg'),(3,7,'Feminino','Solteiro','santana do cariri','','ANTÃ´NIA SILVANIRA DA SILVA','','',3,''),(4,8,'Masculino','Solteiro','ASSARÃ‰','','MARIA EDITE DE QUEIROZ','','',3,''),(9,15,'Feminino','Não Informado','Não Informado','0','','',NULL,0,NULL),(10,16,'Feminino','Não Informado','Não Informado','0','','',NULL,0,NULL),(13,17,'Feminino','Solteiro','Juazeiro do Norte - CE','','ALZIRA MARTINS DA SILVA','','Não informado',3,'1633549531.fif');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenios`
--

DROP TABLE IF EXISTS `convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `convenios` (
  `idConvenio` int(11) NOT NULL AUTO_INCREMENT,
  `RazaoSocialConvenio` varchar(200) NOT NULL DEFAULT '0',
  `nmFantasiaConvenio` varchar(200) NOT NULL DEFAULT '0',
  `nnCepConvenio` varchar(20) NOT NULL DEFAULT '0',
  `strLogradouroConvenio` varchar(200) NOT NULL DEFAULT '0',
  `strComplementoConvenio` varchar(200) DEFAULT 'Não Informado',
  `srtBairroConvenio` varchar(200) NOT NULL DEFAULT '0',
  `srtCidadeConvenio` varchar(200) NOT NULL DEFAULT '0',
  `srtEstadoConvenio` varchar(200) NOT NULL DEFAULT '0',
  `srtTipoConvenio` varchar(200) NOT NULL DEFAULT '0',
  `nnCnpjConvenio` varchar(20) NOT NULL DEFAULT '0',
  `nnIncricaoConvenio` varchar(50) NOT NULL DEFAULT '0',
  `contatoConvenio` varchar(200) NOT NULL DEFAULT '0',
  `nnTelefoneConvenio` varchar(50) NOT NULL DEFAULT '0',
  `srtEmailConvenio` varchar(200) NOT NULL DEFAULT '0',
  `instAtendimentoConvenio` longtext,
  PRIMARY KEY (`idConvenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenios`
--

LOCK TABLES `convenios` WRITE;
/*!40000 ALTER TABLE `convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa`
--

DROP TABLE IF EXISTS `despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `despesa` (
  `idDespesa` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoDespesa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlDespesa` decimal(12,2) DEFAULT NULL,
  `tipoDespesa` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusDespesa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtVencimentoDespesa` date DEFAULT NULL,
  `dtPagamentoDespesa` varchar(20) DEFAULT NULL,
  `strComprovanteDespesa` varchar(200) NOT NULL,
  `idRespCadastroDispesa` int(11) NOT NULL,
  `cadastroDespesa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDespesa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa`
--

LOCK TABLES `despesa` WRITE;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
INSERT INTO `despesa` VALUES (1,'DESPESA TESTE 05',0.10,'RECORRENTE','PAGO','2021-09-13','2021-09-13','1631544455.png',1,'2021-09-13 14:47:35'),(2,'ASD',1.23,'EVENTUAL','PAGO','2021-09-07','2021-09-13','1631545648.png',1,'2021-09-13 15:07:28');
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exames`
--

DROP TABLE IF EXISTS `exames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exames` (
  `idExame` int(11) NOT NULL AUTO_INCREMENT,
  `codigoexame` varchar(50) NOT NULL DEFAULT '0',
  `exame` varchar(191) NOT NULL DEFAULT '0',
  `sinonimos` varchar(191) NOT NULL DEFAULT '0',
  `material` varchar(191) NOT NULL DEFAULT '0',
  `interpretacaoexame` longtext,
  `metodoexame` varchar(191) NOT NULL DEFAULT '0',
  `parametroexame` varchar(191) NOT NULL DEFAULT '0',
  `valorReferenciaExame` varchar(191) NOT NULL DEFAULT '0',
  `instrucoesPreparoExame` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`idExame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exames`
--

LOCK TABLES `exames` WRITE;
/*!40000 ALTER TABLE `exames` DISABLE KEYS */;
/*!40000 ALTER TABLE `exames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `idLogs` int(11) NOT NULL AUTO_INCREMENT,
  `tipyActionLog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userActionLog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionLog` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtActionLog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idLogs`)
) ENGINE=InnoDB AUTO_INCREMENT=838 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-14 04:08:43'),(2,'Listar','ROOT','Listou todos os clientes','2021-09-14 04:09:29'),(3,'Listar','ROOT','Listou todos os clientes','2021-09-14 04:09:36'),(4,'Sair','ROOT','O Usuario ROOT, Saiu do Sistema','2021-09-14 04:09:54'),(5,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-16 11:14:13'),(6,'Listar','ROOT','Listou todos os clientes','2021-09-16 11:14:32'),(7,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-21 15:34:45'),(8,'Listar','ROOT','Listou todos os clientes','2021-09-21 15:34:51'),(9,'Listar','ROOT','Listou todos os clientes','2021-09-21 15:34:53'),(10,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-23 13:19:32'),(11,'Listar','ROOT','Listou todos os clientes','2021-09-23 13:19:41'),(12,'Cadastrar','ROOT','Cadastro de novo Cliente:  PAULO GUTEMBERG SILVA DOS SANTOS -CPF: 008.599.183-00','2021-09-23 13:21:41'),(13,'Listar','ROOT','Listou todos os clientes','2021-09-23 13:21:44'),(14,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-23 13:42:51'),(15,'Listar','ROOT','Listou todos os clientes','2021-09-23 13:43:10'),(16,'Sair','ROOT','O Usuario ROOT, Saiu do Sistema','2021-09-23 13:52:03'),(17,'Entrar','AMANDA CANDIDO BEZERRA','o Usuario AMANDA CANDIDO BEZERRA, acessou o Sistema','2021-09-23 13:52:22'),(18,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 13:52:30'),(19,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 13:53:50'),(20,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 13:58:40'),(21,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 13:58:43'),(22,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-23 14:00:29'),(23,'Listar','ROOT','Listou todos os clientes','2021-09-23 14:00:36'),(24,'Listar','ROOT','Listou todos os clientes','2021-09-23 14:01:07'),(25,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-23 14:02:42'),(26,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-23 14:02:57'),(27,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-23 14:02:58'),(28,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-23 14:03:07'),(29,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 14:16:05'),(30,'Listar','ROOT','Listou todos os clientes','2021-09-23 14:33:18'),(31,'Listar','ROOT','Listou todos os clientes','2021-09-23 14:34:12'),(32,'Listar','ROOT','Listou todos os clientes','2021-09-23 19:59:05'),(33,'Listar','ROOT','Listou todos os clientes','2021-09-23 19:59:08'),(34,'Listar','','Listou todos os clientes','2021-09-23 23:02:48'),(35,'Listar','','Listou todos os clientes','2021-09-23 23:03:11'),(36,'Entrar','AMANDA CANDIDO BEZERRA','o Usuario AMANDA CANDIDO BEZERRA, acessou o Sistema','2021-09-23 23:03:30'),(37,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 23:03:39'),(38,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-23 23:06:20'),(39,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-24 17:55:25'),(40,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:55:29'),(41,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:55:34'),(42,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:56:15'),(43,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:57:03'),(44,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:57:36'),(45,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:58:19'),(46,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:58:45'),(47,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:58:50'),(48,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:59:05'),(49,'Listar','ROOT','Listou todos os clientes','2021-09-24 17:59:11'),(50,'Listar','ROOT','Listou todos os clientes','2021-09-24 18:00:53'),(51,'Listar','ROOT','Listou todos os clientes','2021-09-24 18:01:25'),(52,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-25 00:20:50'),(53,'Listar','ROOT','Listou todos os clientes','2021-09-25 00:20:54'),(54,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-27 17:51:34'),(55,'Listar','ROOT','Listou todos os clientes','2021-09-27 17:51:37'),(56,'Listar','ROOT','Listou todos os clientes','2021-09-27 17:54:23'),(57,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 18:01:24'),(58,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:01:36'),(59,'Cadastrar','ACREZIANE LOPES DA SILVA','Cadastro de novo Cliente:  CICERO CALIXTO SOBRINHO -CPF: 422.770.433-20','2021-09-30 18:05:18'),(60,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:05:22'),(61,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:11:41'),(62,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:11:48'),(63,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:11:54'),(64,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 18:13:25'),(65,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:13:38'),(66,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:16:05'),(67,'Cadastrar','ACREZIANE LOPES DA SILVA','Cadastro de novo Cliente:  MARIA DE FÃ¡TIMA DA SILVA DE SOUSA -CPF: 087.744.353-02','2021-09-30 18:21:00'),(68,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:21:04'),(69,'Cadastrar','ACREZIANE LOPES DA SILVA','Cadastro de novo Cliente:  RAIMUNDO NONATO DE SOUSA -CPF: 093.539.728-09','2021-09-30 18:25:07'),(70,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:25:11'),(71,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:29:45'),(72,'Entrar','AMANDA CANDIDO BEZERRA','o Usuario AMANDA CANDIDO BEZERRA, acessou o Sistema','2021-09-30 18:39:27'),(73,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-30 18:39:54'),(74,'Listar','AMANDA CANDIDO BEZERRA','Listou todos os clientes','2021-09-30 18:41:02'),(75,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-30 18:41:44'),(76,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:41:48'),(77,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-30 18:42:38'),(78,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:42:42'),(79,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:47:42'),(80,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:48:20'),(81,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 18:48:50'),(82,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:49:42'),(83,'Cadastrar','ROOT','Cadastro de novo Cliente:  ANTONIO ALISSON ALMEIDA QUEIROZ -CPF: 002.993.043-02','2021-09-30 18:50:55'),(84,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:50:57'),(85,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:52:32'),(86,'Cadastrar','ROOT','Cadastro de novo Cliente:  ANTONIO ALISSON ALMEIDA QUEIROZ -CPF: 002.993.043-02','2021-09-30 18:53:49'),(87,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:53:52'),(88,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:54:13'),(89,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:55:27'),(90,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:56:11'),(91,'Listar','ROOT','Listou todos os clientes','2021-09-30 18:58:45'),(92,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:00:54'),(93,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:06:16'),(94,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:06:21'),(95,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:06:47'),(96,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-09-30 19:06:55'),(97,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:06:59'),(98,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:07:03'),(99,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:07:24'),(100,'Cadastrar','ROOT','Cadastro de novo Cliente:  TESTE -CPF: 0-08','2021-09-30 19:08:15'),(101,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:08:19'),(102,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-09-30 19:08:50'),(103,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:08:54'),(104,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:08:57'),(105,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:09:33'),(106,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:10:53'),(107,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:11:05'),(108,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:15:36'),(109,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:16:45'),(110,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:17:04'),(111,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-09-30 19:17:36'),(112,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:17:42'),(113,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:17:57'),(114,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:17:59'),(115,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-09-30 19:18:36'),(116,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:19:16'),(117,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:19:25'),(118,'Cadastrar','ACREZIANE LOPES DA SILVA','Cadastro de novo Cliente:  TESTE 2 -CPF: 1','2021-09-30 19:20:36'),(119,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:20:40'),(120,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:22:06'),(121,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:23:49'),(122,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:28:09'),(123,'Listar','','Listou todos os clientes','2021-09-30 19:28:53'),(124,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 19:29:16'),(125,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:29:24'),(126,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:30:14'),(127,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:32:30'),(128,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:37:56'),(129,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:39:21'),(130,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:39:24'),(131,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:39:29'),(132,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:42:19'),(133,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:44:25'),(134,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:45:09'),(135,'Listar','ROOT','Listou todos os clientes','2021-09-30 19:47:54'),(136,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 19:58:18'),(137,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 20:00:56'),(138,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-09-30 20:01:02'),(139,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-09-30 20:01:06'),(140,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-09-30 20:01:34'),(141,'Listar','ROOT','Listou todos os clientes','2021-09-30 20:03:29'),(142,'Listar','ROOT','Listou todos os clientes','2021-09-30 20:14:28'),(143,'Listar','ROOT','Listou todos os clientes','2021-10-01 14:42:36'),(144,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-02 14:00:07'),(145,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:00:12'),(146,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:00:23'),(147,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:00:36'),(148,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-02 14:15:14'),(149,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:15:16'),(150,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:18:32'),(151,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:21:51'),(152,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:23:54'),(153,'Listar','ROOT','Listou todos os clientes','2021-10-02 14:25:24'),(154,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-04 14:43:28'),(155,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-04 14:43:32'),(156,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-04 14:44:29'),(157,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-04 14:48:15'),(158,'Listar','ROOT','Listou todos os clientes','2021-10-04 14:48:18'),(159,'Cadastrar','ACREZIANE LOPES DA SILVA','Cadastro de novo Cliente:  ERISMAR MARTINS LEITE -CPF: 399.726.743-04','2021-10-04 14:49:16'),(160,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-04 14:49:18'),(161,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-04 15:52:44'),(162,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:52:47'),(163,'Atualizar','ROOT','Atualizou os dados do Cliente:  RAIMUNDO NONATO DE SOUSA -CPF: 09353972809','2021-10-04 15:53:19'),(164,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:53:21'),(165,'Atualizar','ROOT','Atualizou os dados do Cliente:  MARIA DE FáTIMA DA SILVA DE SOUSA -CPF: 08774435302','2021-10-04 15:53:38'),(166,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:53:39'),(167,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:54:27'),(168,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:58:58'),(169,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:27'),(170,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:28'),(171,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:34'),(172,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:35'),(173,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:35'),(174,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:36'),(175,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:36'),(176,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:46'),(177,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:46'),(178,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(179,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(180,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(181,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(182,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(183,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:47'),(184,'Listar','ROOT','Listou todos os clientes','2021-10-04 15:59:48'),(185,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:12'),(186,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:23'),(187,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:25'),(188,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:26'),(189,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:27'),(190,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:32'),(191,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:00:33'),(192,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:01:02'),(193,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:01:04'),(194,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:01:05'),(195,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:01:07'),(196,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:25:39'),(197,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:28:13'),(198,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:28:17'),(199,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:28:43'),(200,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:28:45'),(201,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:11'),(202,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:12'),(203,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:13'),(204,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:14'),(205,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:33'),(206,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:42'),(207,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:29:53'),(208,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:31:21'),(209,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:31:22'),(210,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:31:25'),(211,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:39:00'),(212,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:41:36'),(213,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:41:39'),(214,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:41:40'),(215,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:41:41'),(216,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:10'),(217,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:10'),(218,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:10'),(219,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:10'),(220,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:10'),(221,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(222,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(223,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(224,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(225,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(226,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:11'),(227,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:12'),(228,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:43:12'),(229,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:44:38'),(230,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:24'),(231,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:26'),(232,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:27'),(233,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:28'),(234,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:29'),(235,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:44'),(236,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:47'),(237,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:46:50'),(238,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:47:33'),(239,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:48:12'),(240,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:48:16'),(241,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:50:27'),(242,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:50:30'),(243,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:51:44'),(244,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:51:45'),(245,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:51:54'),(246,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:03'),(247,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:04'),(248,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:06'),(249,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:15'),(250,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:42'),(251,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:43'),(252,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:52:44'),(253,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:12'),(254,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:14'),(255,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:24'),(256,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:25'),(257,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:29'),(258,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:31'),(259,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:32'),(260,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:32'),(261,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:53:54'),(262,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:54:10'),(263,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:54:11'),(264,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:54:39'),(265,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:54:40'),(266,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:54:58'),(267,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:33'),(268,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:34'),(269,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:43'),(270,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:44'),(271,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:53'),(272,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:55:54'),(273,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:01'),(274,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:02'),(275,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:03'),(276,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:03'),(277,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:04'),(278,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:56:04'),(279,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:57:31'),(280,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:57:37'),(281,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:57:40'),(282,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:58:08'),(283,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:58:53'),(284,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:59:51'),(285,'Listar','ROOT','Listou todos os clientes','2021-10-04 16:59:52'),(286,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:00'),(287,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:11'),(288,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:12'),(289,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:16'),(290,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:20'),(291,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:23'),(292,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:43'),(293,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:00:45'),(294,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:01:11'),(295,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:05'),(296,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:06'),(297,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:08'),(298,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:11'),(299,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:12'),(300,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:02:13'),(301,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:05'),(302,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:05'),(303,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:06'),(304,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:06'),(305,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:06'),(306,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:06'),(307,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:06'),(308,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:08'),(309,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:12'),(310,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:13'),(311,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:54'),(312,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:03:56'),(313,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:04:22'),(314,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:04:24'),(315,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:04:51'),(316,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:04:54'),(317,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:05:02'),(318,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:05:26'),(319,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:12:16'),(320,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:13:02'),(321,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:13:06'),(322,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:13:07'),(323,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:13:08'),(324,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:14:27'),(325,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:16:43'),(326,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:20:30'),(327,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:21:55'),(328,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:22:45'),(329,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:22:55'),(330,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:23:57'),(331,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:31:22'),(332,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:34:26'),(333,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:36:01'),(334,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:39:10'),(335,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:41:07'),(336,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:41:37'),(337,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:41:39'),(338,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:41:55'),(339,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:42:20'),(340,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:56:39'),(341,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:57:32'),(342,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:57:34'),(343,'Listar','ROOT','Listou todos os clientes','2021-10-04 17:59:17'),(344,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:02:16'),(345,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:02:18'),(346,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:02:19'),(347,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:02:21'),(348,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:02:21'),(349,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:03:30'),(350,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:03:30'),(351,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:04:28'),(352,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:04:46'),(353,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:04:49'),(354,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:05:12'),(355,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:06:13'),(356,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:09:34'),(357,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:11:19'),(358,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:14:08'),(359,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:20:51'),(360,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:21:49'),(361,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:21:54'),(362,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:21:55'),(363,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:22:56'),(364,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:23:02'),(365,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:23:37'),(366,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:24:44'),(367,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:25:09'),(368,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:25:43'),(369,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:26:04'),(370,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:27:41'),(371,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:27:43'),(372,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:27:48'),(373,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:27:57'),(374,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:30:27'),(375,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:30:27'),(376,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:32:12'),(377,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:32:15'),(378,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:32:27'),(379,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:32:29'),(380,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:32:43'),(381,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:32:45'),(382,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:34:03'),(383,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:34:04'),(384,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:34:05'),(385,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:35:31'),(386,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:35:40'),(387,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:35:42'),(388,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:36:52'),(389,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:37:01'),(390,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 18:37:33'),(391,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:37:35'),(392,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:39:26'),(393,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:40:32'),(394,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:41:05'),(395,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:42:01'),(396,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:43:19'),(397,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:45:51'),(398,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:06'),(399,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:19'),(400,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:19'),(401,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:19'),(402,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:20'),(403,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:20'),(404,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:46:21'),(405,'Listar','ROOT','Listou todos os clientes','2021-10-04 18:56:36'),(406,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:09:48'),(407,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:10:43'),(408,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:10:45'),(409,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:11:42'),(410,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:11:43'),(411,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:13:17'),(412,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:13:19'),(413,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:13:32'),(414,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:14:12'),(415,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:14:16'),(416,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:14:28'),(417,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:14:31'),(418,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:15:52'),(419,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:15:53'),(420,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:22:28'),(421,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:22:30'),(422,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:24:17'),(423,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:24:19'),(424,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:24:20'),(425,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:25:33'),(426,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:25:35'),(427,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:25:37'),(428,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:34:58'),(429,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:35:00'),(430,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:37:16'),(431,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:37:17'),(432,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:37:18'),(433,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:05'),(434,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:05'),(435,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:07'),(436,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:08'),(437,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:51'),(438,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:40:57'),(439,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:41:09'),(440,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:41:10'),(441,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:41:18'),(442,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:41:20'),(443,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:43:49'),(444,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:43:50'),(445,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:44:02'),(446,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:44:04'),(447,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:53:07'),(448,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:53:57'),(449,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:54:05'),(450,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:54:07'),(451,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:54:19'),(452,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:54:20'),(453,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:54:35'),(454,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:54:36'),(455,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:54:57'),(456,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:55:00'),(457,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:55:40'),(458,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:55:56'),(459,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:55:57'),(460,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 19:56:16'),(461,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:56:17'),(462,'Listar','ROOT','Listou todos os clientes','2021-10-04 19:56:36'),(463,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:00:19'),(464,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:00:30'),(465,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:00:32'),(466,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:00:53'),(467,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:00:54'),(468,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:02:51'),(469,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:03:14'),(470,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:04:36'),(471,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:05:17'),(472,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 20:05:34'),(473,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:05:36'),(474,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 20:05:50'),(475,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:05:52'),(476,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 20:17:23'),(477,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:17:26'),(478,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-04 20:17:48'),(479,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:18:02'),(480,'Listar','','Listou todos os clientes','2021-10-04 20:27:35'),(481,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-04 20:27:48'),(482,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:27:50'),(483,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:30:10'),(484,'Listar','ROOT','Listou todos os clientes','2021-10-04 20:38:05'),(485,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:02:05'),(486,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:05:12'),(487,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:06:11'),(488,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:22:49'),(489,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:25:40'),(490,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:46:25'),(491,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:46:30'),(492,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:46:41'),(493,'Listar','ROOT','Listou todos os clientes','2021-10-05 10:59:59'),(494,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-06 16:34:26'),(495,'Listar','ROOT','Listou todos os clientes','2021-10-06 16:34:28'),(496,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-06 18:43:26'),(497,'Listar','ROOT','Listou todos os clientes','2021-10-06 18:43:30'),(498,'Listar','ROOT','Listou todos os clientes','2021-10-06 19:45:18'),(499,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-06 19:45:31'),(500,'Listar','ROOT','Listou todos os clientes','2021-10-06 19:45:32'),(501,'Listar','ROOT','Listou todos os clientes','2021-10-06 19:51:19'),(502,'Listar','ROOT','Listou todos os clientes','2021-10-06 20:43:43'),(503,'Listar','ROOT','Listou todos os clientes','2021-10-06 20:43:53'),(504,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-13 13:34:44'),(505,'Listar','ROOT','Listou todos os clientes','2021-10-13 13:34:46'),(506,'Listar','ROOT','Listou todos os clientes','2021-10-13 13:35:49'),(507,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 13:58:07'),(508,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 13:58:10'),(509,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 13:58:23'),(510,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-10-13 13:58:48'),(511,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 13:58:50'),(512,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 13:58:53'),(513,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 13:59:23'),(514,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 13:59:53'),(515,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:00:24'),(516,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:00:36'),(517,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:01:06'),(518,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:01:37'),(519,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:02:07'),(520,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:02:37'),(521,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:03:08'),(522,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:03:38'),(523,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:04:08'),(524,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:04:39'),(525,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:05:09'),(526,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:05:39'),(527,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:06:10'),(528,'Listar','ROOT','Listou todos os clientes','2021-10-13 14:06:25'),(529,'Sair','ROOT','O Usuario ROOT, Saiu do Sistema','2021-10-13 14:06:32'),(530,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:06:40'),(531,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:07:11'),(532,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 14:07:16'),(533,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:07:17'),(534,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:07:41'),(535,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:08:12'),(536,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:08:42'),(537,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:09:12'),(538,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:09:43'),(539,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:10:13'),(540,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:10:44'),(541,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:11:14'),(542,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:11:44'),(543,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:12:15'),(544,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:12:45'),(545,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:13:15'),(546,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:13:46'),(547,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:14:16'),(548,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:14:47'),(549,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:15:17'),(550,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:15:47'),(551,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:16:18'),(552,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:16:48'),(553,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:17:18'),(554,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:17:49'),(555,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:18:19'),(556,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:18:49'),(557,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:19:19'),(558,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:19:50'),(559,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:20:20'),(560,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:20:50'),(561,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 14:30:31'),(562,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 15:55:04'),(563,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 15:55:06'),(564,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 18:36:00'),(565,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:36:03'),(566,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:43:10'),(567,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:53:58'),(568,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:54:06'),(569,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:58:03'),(570,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:58:07'),(571,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:58:13'),(572,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 18:59:34'),(573,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 19:00:59'),(574,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:01:00'),(575,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:13:32'),(576,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:22:54'),(577,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:23:39'),(578,'Atualizar','ACREZIANE LOPES DA SILVA','Atualizou a Foto do Cliente:   -CPF: ','2021-10-13 19:24:37'),(579,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:24:39'),(580,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:25:05'),(581,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:21'),(582,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:23'),(583,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:30'),(584,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:31'),(585,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:32'),(586,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:32'),(587,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:26:33'),(588,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:27:11'),(589,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:27:12'),(590,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:27:13'),(591,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:27:13'),(592,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:29:30'),(593,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:29:54'),(594,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:06'),(595,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:17'),(596,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:18'),(597,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:20'),(598,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:37'),(599,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:38'),(600,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:30:56'),(601,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:01'),(602,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:02'),(603,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:12'),(604,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:15'),(605,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:23'),(606,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:26'),(607,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:28'),(608,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:29'),(609,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:31:56'),(610,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:07'),(611,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:12'),(612,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:16'),(613,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:45'),(614,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:47'),(615,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:49'),(616,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:50'),(617,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:53'),(618,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:54'),(619,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:32:57'),(620,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:00'),(621,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:05'),(622,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:06'),(623,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:06'),(624,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:07'),(625,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:08'),(626,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:22'),(627,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:33:46'),(628,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:34:08'),(629,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:34:20'),(630,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:34:21'),(631,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:35:06'),(632,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:35:09'),(633,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:35:19'),(634,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:35:20'),(635,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:36:56'),(636,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:36:58'),(637,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:36:59'),(638,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:09'),(639,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:10'),(640,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:11'),(641,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:14'),(642,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:15'),(643,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:17'),(644,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:22'),(645,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:25'),(646,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:29'),(647,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:31'),(648,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:33'),(649,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:40'),(650,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:43'),(651,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:49'),(652,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:51'),(653,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:37:52'),(654,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:38:46'),(655,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:38:49'),(656,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:04'),(657,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:06'),(658,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:20'),(659,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:23'),(660,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:26'),(661,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:28'),(662,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:33'),(663,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:41:47'),(664,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:43:58'),(665,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:51:57'),(666,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:52:00'),(667,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:52:01'),(668,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:59:50'),(669,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:59:53'),(670,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 19:59:59'),(671,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:00:08'),(672,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:00:48'),(673,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:00:49'),(674,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:00:50'),(675,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:00:50'),(676,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:01:58'),(677,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:01:59'),(678,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:00'),(679,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:00'),(680,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:12'),(681,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:13'),(682,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:25'),(683,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:26'),(684,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:30'),(685,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:34'),(686,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:35'),(687,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:43'),(688,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:44'),(689,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:02:51'),(690,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:13'),(691,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:14'),(692,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:52'),(693,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:53'),(694,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:54'),(695,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:54'),(696,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:54'),(697,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:55'),(698,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:55'),(699,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:56'),(700,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:57'),(701,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:57'),(702,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:58'),(703,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:58'),(704,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:58'),(705,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:59'),(706,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:03:59'),(707,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:04:00'),(708,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:04:00'),(709,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:05:09'),(710,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:05:28'),(711,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:05:29'),(712,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:18'),(713,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:19'),(714,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:20'),(715,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:21'),(716,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:21'),(717,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:22'),(718,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:22'),(719,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:22'),(720,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:22'),(721,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(722,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(723,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(724,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(725,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(726,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:23'),(727,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:24'),(728,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:24'),(729,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:24'),(730,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:24'),(731,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(732,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(733,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(734,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(735,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(736,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:25'),(737,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:26'),(738,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:26'),(739,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:26'),(740,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:26'),(741,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:26'),(742,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:27'),(743,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:27'),(744,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:06:27'),(745,'Entrar','ACREZIANE LOPES DA SILVA','o Usuario ACREZIANE LOPES DA SILVA, acessou o Sistema','2021-10-13 20:06:44'),(746,'Sair','ACREZIANE LOPES DA SILVA','O Usuario ACREZIANE LOPES DA SILVA, Saiu do Sistema','2021-10-13 20:06:51'),(747,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-13 20:06:54'),(748,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:06:56'),(749,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-13 20:07:09'),(750,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:07:10'),(751,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:07:24'),(752,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:08:01'),(753,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:08:05'),(754,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:08:05'),(755,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:08:29'),(756,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:08:57'),(757,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:09:00'),(758,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:09:04'),(759,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:09:06'),(760,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:10:23'),(761,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:10:30'),(762,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:11:07'),(763,'Atualizar','ROOT','Atualizou a Foto do Cliente:   -CPF: ','2021-10-13 20:11:41'),(764,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:11:43'),(765,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:11:52'),(766,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:12:02'),(767,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:12:04'),(768,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:11'),(769,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:13'),(770,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:13'),(771,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:15'),(772,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:34'),(773,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:37'),(774,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:53'),(775,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:55'),(776,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:13:55'),(777,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:06'),(778,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:08'),(779,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:09'),(780,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:10'),(781,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:11'),(782,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:20'),(783,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:14:21'),(784,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:17:04'),(785,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:26'),(786,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:27'),(787,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:28'),(788,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:21:38'),(789,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:21:39'),(790,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:45'),(791,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:46'),(792,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:21:48'),(793,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:21:51'),(794,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:21:52'),(795,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:22:18'),(796,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:22:44'),(797,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:22:46'),(798,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:05'),(799,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:06'),(800,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:11'),(801,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:12'),(802,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:23:41'),(803,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:43'),(804,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:23:45'),(805,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:24:14'),(806,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:24:37'),(807,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:24:38'),(808,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:24:59'),(809,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:25:06'),(810,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:10'),(811,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:31'),(812,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:32'),(813,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:41'),(814,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:42'),(815,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:25:43'),(816,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:25:49'),(817,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:26:14'),(818,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:26:47'),(819,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:26:56'),(820,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-13 20:27:00'),(821,'Listar','ROOT','Listou todos os clientes','2021-10-13 20:28:30'),(822,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 09:42:00'),(823,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 09:42:02'),(824,'Entrar','ROOT','o Usuario ROOT, acessou o Sistema','2021-10-14 10:02:54'),(825,'Listar','ROOT','Listou todos os clientes','2021-10-14 10:02:56'),(826,'Listar','ROOT','Listou todos os clientes','2021-10-14 10:17:42'),(827,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 10:39:58'),(828,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 10:40:00'),(829,'Listar','ROOT','Listou todos os clientes','2021-10-14 11:51:25'),(830,'Listar','ROOT','Listou todos os clientes','2021-10-14 11:51:29'),(831,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:52:18'),(832,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:52:59'),(833,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:53:01'),(834,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:53:06'),(835,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:53:18'),(836,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:53:20'),(837,'Listar','ACREZIANE LOPES DA SILVA','Listou todos os clientes','2021-10-14 11:53:23');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa` (
  `idPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nmPessoa` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nmPessoaSocial` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `docPessoa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dtNascPessoa` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `stLogradouroPessoa` varchar(190) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nnCasaPessoa` int(11) DEFAULT NULL,
  `stCompleEndPessoa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `stBairroPessoa` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stCidadePessoa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `stEstadoPessoa` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `stCepPessoa` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nnTelefonePessoa` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nnWhatsappPessoa` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `stEmailPessoa` varchar(145) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txtObsContatosPessoas` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idPessoa`),
  UNIQUE KEY `nnCpfPessoa_UNIQUE` (`docPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'ROOT',NULL,'00000000000','03/04/1968','-',0,'','0','','CE','0','0','0','',''),(2,'PAULO GUTEMBERG SILVA DOS SANTOS','PAULINHO','00859918300','05/07/1986','RUA PEDRO BISPO DOS SANTOS',115,'CASA','SANTO ANTÃ´NIO','','CE','63050-140','(88) 99928-2400','(88) 98182-1531','pgutembergss@gmail.com',NULL),(3,'AMANDA CANDIDO BEZERRA',NULL,'96558903334','24/10/1985','RUA SÃ£O JOSÃ©',365,'','CENTRO','','CE','63010-032','(88) 99998-4348','','amanda@macedoebezerra.adv.br','RECADOS, FALAR COM'),(4,'ACREZIANE LOPES DA SILVA',NULL,'05795456365','05/03/1994','RUA TABELIÃ£O LUIZ TEÃ³FILO MACHADO',141,'AP. 101 BLOCO 01','AEROPORTO','','CE','63020-725','(88) 99743-9717','','macedoebezerra@macedoebezerra.adv.br','RECADOS, FALAR COM'),(5,'CICERO CALIXTO SOBRINHO','CICERO CALIXTO','42277043320','0/50/7197','RUA DO COMÃ©RCIO',202,'','DISTRITO DE DOM QUINTINO','CRATO','CE','','(88) 9889-8116','','',NULL),(7,'MARIA DE FÁTIMA DA SILVA DE SOUSA','','08774435302','26/01/2005','RUA FREI DAMIÃ£O',589,'','INHUMAS (ARAPORANGA)','SANTANA DO CARIRI','CE','','(88) 99640-4008','','',NULL),(8,'RAIMUNDO NONATO DE SOUSA','','09353972809','13/04/1967','SíTIO ESCONDIDO',190,'','ZONA RURAL','POTENGI','CE','','(88) 98105-4125','','',NULL),(15,'LETÃ­CIA VICTOR ROCHA','','06858497323','28/01/1999','RUA PRINCESA ISABEL',1267,'','CENTRO','JUAZEIRO DO NORTE','CE','','(88) 98879-8655','(88) 98879-8655','',NULL),(16,'JACQUELINE MOTA TEIXEIRA','JACQUELINE','0122670035','07/07/1984','RUA P 05',27,'','SANTA TEREZINHA','BARBALHA','CE','','(88) 99841-6298','(88) 99841-6298','',NULL),(17,'ERISMAR MARTINS LEITE','ERISMAR','39972674304','21/07/1969','RUA PEDRO HENRIQUE DE SOUSA',1467,'','PARQUE SÃ£O GERALDO','JUZEIRO DO NORTE','CE','','(88) 9886-33','(88) 98878-0277','',NULL);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processos`
--

DROP TABLE IF EXISTS `processos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processos` (
  `idprocesso` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idadvogado` int(11) DEFAULT '0',
  `objprocesso` varchar(255) NOT NULL,
  `descricaoprocesso` text,
  `numprocesso` bigint(50) DEFAULT NULL,
  `areaprocesso` varchar(100) NOT NULL,
  `statusprocesso` varchar(100) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idprocesso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processos`
--

LOCK TABLES `processos` WRITE;
/*!40000 ALTER TABLE `processos` DISABLE KEYS */;
INSERT INTO `processos` VALUES (1,2,0,'objeto teste',NULL,125824572014120707,'PREVIDÊNCIARIOS','Aguardando Documento','2021-10-14 10:16:49');
/*!40000 ALTER TABLE `processos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `idServicos` int(11) NOT NULL AUTO_INCREMENT,
  `nomeServico` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlServico` decimal(6,2) DEFAULT '1.00',
  `statusServico` int(1) DEFAULT '0',
  PRIMARY KEY (`idServicos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL,
  `passUser` varchar(200) NOT NULL,
  `nivelUser` int(11) NOT NULL,
  `flStatusUser` int(11) NOT NULL DEFAULT '1',
  `dtCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'21232f297a57a5a743894a0e4a801fc3',0,1,'2019-06-27 02:38:17'),(2,3,'c59129ab168153e7c35edcb481feab19',1,1,'2021-09-23 13:50:34'),(3,4,'705f1bb2f0f13926ad7fef32f47a15f3',2,1,'2021-09-23 13:58:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_pessoa_cliente`
--

DROP TABLE IF EXISTS `vw_pessoa_cliente`;
/*!50001 DROP VIEW IF EXISTS `vw_pessoa_cliente`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pessoa_cliente` AS SELECT 
 1 AS `idPassoaPessoa`,
 1 AS `nmPessoa`,
 1 AS `nmPessoaSocial`,
 1 AS `docPessoa`,
 1 AS `dtNascPessoa`,
 1 AS `stLogradouroPessoa`,
 1 AS `nnCasaPessoa`,
 1 AS `stCompleEndPessoa`,
 1 AS `stBairroPessoa`,
 1 AS `stCidadePessoa`,
 1 AS `stEstadoPessoa`,
 1 AS `stCepPessoa`,
 1 AS `nnTelefonePessoa`,
 1 AS `nnWhatsappPessoa`,
 1 AS `stEmailPessoa`,
 1 AS `txtObsContatosPessoas`,
 1 AS `idCliente`,
 1 AS `idPessoaCliente`,
 1 AS `sexoCliente`,
 1 AS `strEstadoCivilCliente`,
 1 AS `strNaturalidadeCliente`,
 1 AS `nnRg`,
 1 AS `nmMae`,
 1 AS `nmPai`,
 1 AS `nmResponsavel`,
 1 AS `imgCliente`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_pessoa_user`
--

DROP TABLE IF EXISTS `vw_pessoa_user`;
/*!50001 DROP VIEW IF EXISTS `vw_pessoa_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pessoa_user` AS SELECT 
 1 AS `idPessoaPessoa`,
 1 AS `nmPessoa`,
 1 AS `docPessoa`,
 1 AS `dtNascPessoa`,
 1 AS `stLogradouroPessoa`,
 1 AS `nnCasaPessoa`,
 1 AS `stCompleEndPessoa`,
 1 AS `stBairroPessoa`,
 1 AS `stEstadoPessoa`,
 1 AS `stCepPessoa`,
 1 AS `nnTelefonePessoa`,
 1 AS `nnWhatsappPessoa`,
 1 AS `stEmailPessoa`,
 1 AS `txtObsContatosPessoas`,
 1 AS `id`,
 1 AS `idPessoaUser`,
 1 AS `passUser`,
 1 AS `nivelUser`,
 1 AS `flStatusUser`,
 1 AS `dtCadastro`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_pessoa_cliente`
--

/*!50001 DROP VIEW IF EXISTS `vw_pessoa_cliente`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pessoa_cliente` AS select `pessoa`.`idPessoa` AS `idPassoaPessoa`,`pessoa`.`nmPessoa` AS `nmPessoa`,`pessoa`.`nmPessoaSocial` AS `nmPessoaSocial`,`pessoa`.`docPessoa` AS `docPessoa`,`pessoa`.`dtNascPessoa` AS `dtNascPessoa`,`pessoa`.`stLogradouroPessoa` AS `stLogradouroPessoa`,`pessoa`.`nnCasaPessoa` AS `nnCasaPessoa`,`pessoa`.`stCompleEndPessoa` AS `stCompleEndPessoa`,`pessoa`.`stBairroPessoa` AS `stBairroPessoa`,`pessoa`.`stCidadePessoa` AS `stCidadePessoa`,`pessoa`.`stEstadoPessoa` AS `stEstadoPessoa`,`pessoa`.`stCepPessoa` AS `stCepPessoa`,`pessoa`.`nnTelefonePessoa` AS `nnTelefonePessoa`,`pessoa`.`nnWhatsappPessoa` AS `nnWhatsappPessoa`,`pessoa`.`stEmailPessoa` AS `stEmailPessoa`,`pessoa`.`txtObsContatosPessoas` AS `txtObsContatosPessoas`,`clientes`.`idCliente` AS `idCliente`,`clientes`.`idPessoa` AS `idPessoaCliente`,`clientes`.`sexoCliente` AS `sexoCliente`,`clientes`.`strEstadoCivilCliente` AS `strEstadoCivilCliente`,`clientes`.`strNaturalidadeCliente` AS `strNaturalidadeCliente`,`clientes`.`nnRg` AS `nnRg`,`clientes`.`nmMae` AS `nmMae`,`clientes`.`nmPai` AS `nmPai`,`clientes`.`nmResponsavel` AS `nmResponsavel`,`clientes`.`imgCliente` AS `imgCliente` from (`pessoa` join `clientes` on((`clientes`.`idPessoa` = `pessoa`.`idPessoa`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_pessoa_user`
--

/*!50001 DROP VIEW IF EXISTS `vw_pessoa_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pessoa_user` AS select `pessoa`.`idPessoa` AS `idPessoaPessoa`,`pessoa`.`nmPessoa` AS `nmPessoa`,`pessoa`.`docPessoa` AS `docPessoa`,`pessoa`.`dtNascPessoa` AS `dtNascPessoa`,`pessoa`.`stLogradouroPessoa` AS `stLogradouroPessoa`,`pessoa`.`nnCasaPessoa` AS `nnCasaPessoa`,`pessoa`.`stCompleEndPessoa` AS `stCompleEndPessoa`,`pessoa`.`stBairroPessoa` AS `stBairroPessoa`,`pessoa`.`stEstadoPessoa` AS `stEstadoPessoa`,`pessoa`.`stCepPessoa` AS `stCepPessoa`,`pessoa`.`nnTelefonePessoa` AS `nnTelefonePessoa`,`pessoa`.`nnWhatsappPessoa` AS `nnWhatsappPessoa`,`pessoa`.`stEmailPessoa` AS `stEmailPessoa`,`pessoa`.`txtObsContatosPessoas` AS `txtObsContatosPessoas`,`users`.`id` AS `id`,`users`.`idPessoa` AS `idPessoaUser`,`users`.`passUser` AS `passUser`,`users`.`nivelUser` AS `nivelUser`,`users`.`flStatusUser` AS `flStatusUser`,`users`.`dtCadastro` AS `dtCadastro` from (`pessoa` join `users`) where (`pessoa`.`idPessoa` = `users`.`idPessoa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-15 13:18:26
