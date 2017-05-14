-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: donde
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answer_option`
--

DROP TABLE IF EXISTS `answer_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_option_question_id_foreign` (`question_id`),
  CONSTRAINT `answer_option_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer_option`
--

LOCK TABLES `answer_option` WRITE;
/*!40000 ALTER TABLE `answer_option` DISABLE KEYS */;
INSERT INTO `answer_option` VALUES (1,'Información (explicalo en Comentarios)',1),(2,'Pastillas anticonceptivas',1),(3,'Anticoncepción de emergencia (pastilla del día después)',1),(4,'DIU',1),(5,'Sí, en ese momento',2),(6,'Sí, en parte (explicalo en Comentarios)',2),(7,'Sí',3),(8,'No',3),(9,'Mujer',5),(10,'Varón',5),(11,'Información sobre aborto seguro',6),(12,'Realización de una interrupción legal del embarazo',6),(13,'Anticoncepción de emergencia (pastilla del día después)',6),(14,'Otros (explicalo en Comentarios)',6),(15,'SI',7),(16,'NO',7),(17,'SI',8),(18,'NO',8),(19,'9 o menos',4),(20,'10 a 19',4),(21,'20 a 24',4),(22,'25 a 29',4),(23,'30 a 34',4),(24,'35 a 39',4),(25,'40 a 44',4),(26,'45 a 49',4),(27,'50 a 59',4),(28,'60 a 69',4),(29,'70 a 79',4),(30,'80 o más',4),(31,'SIU',1),(32,'Anticoncepción inyectable',1),(33,'Implante subdérmico (chip)',1),(34,'Condones (preservativos)',1),(35,'Ligadura de trompas',1),(36,'Vasectomía',1),(37,'Otros (explicalo en Comentarios)',1),(38,'No, estaba cerrado ',2),(39,'No, no tenían lo que buscaba',2),(40,'No, me derivaron a otro lugar',2),(41,'No, me dieron turno para otro día',2),(42,'Otra opción (explicalo en Comentarios)',2),(43,'Mujer trans',5),(44,'Varón trans',5),(45,'Otro',5),(46,'Prefiero no contestar',5),(47,'SI',10),(48,'NO',10),(49,'Información sobre VIH/sida',11),(50,'Información sobre otra infección de transmisión sexual',11),(51,'Atención médica para VIH/sida',11),(52,'Atención médica para otra infección de transmisión sexual',11),(53,'Medicación para VIH/sida',11),(54,'Medicación para otra infección de transmisión sexual',11),(55,'Otros (explicalo en Comentarios)',11),(56,'Información sobre vacunas para mi',12),(57,'Información sobre vacunas para un niño',12),(58,'Vacuna para hepatitis B',12),(59,'Vacuna para VPH',12),(60,'Otra vacuna para mi',12),(61,'Otra vacuna para un niño',12),(62,'Otros (explicalo en Comentarios)',12),(63,'Información sobre la prueba de VIH',13),(64,'Realización de la prueba de VIH tradicional',13),(65,'Realización de la prueba de VIH rápida',13),(66,'Confirmación de un resultado positivo de VIH',13),(67,'Otros (explicalo en Comentarios)',13),(68,'Información sobre condones (preservativos)',14),(69,'Condones (preservativos)',14),(70,'Otros (explicalo en Comentarios)',14),(71,'SI',9),(72,'NO',9);
/*!40000 ALTER TABLE `answer_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `que_busca` varchar(500) DEFAULT NULL,
  `le_dieron` varchar(500) DEFAULT NULL,
  `info_ok` tinyint(1) DEFAULT NULL,
  `privacidad_ok` tinyint(1) DEFAULT NULL,
  `edad` varchar(100) DEFAULT NULL,
  `genero` varchar(500) DEFAULT NULL,
  `comentario` varchar(400) DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  `aprobado` tinyint(1) DEFAULT NULL,
  `idPlace` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `es_gratuito` tinyint(1) NOT NULL,
  `comodo` tinyint(1) NOT NULL,
  `informacion_vacunas` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPlace` (`idPlace`),
  CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`idPlace`) REFERENCES `places` (`placeId`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation`
--

LOCK TABLES `evaluation` WRITE;
/*!40000 ALTER TABLE `evaluation` DISABLE KEYS */;
INSERT INTO `evaluation` VALUES (1,'Información, Test de Embarazao','Si, aunque no me dieron todo lo que buscaba',1,1,'22','Mujer','Comentario super mega largo que es tan largo que se hace re largo leeerlo entero xq es super largo, y como es tan largo no da leerlo entero, asi que resumo diciendo que es un cometario super largo 00',4,1,205278,'2017-03-02 16:53:07','2017-03-02 16:53:07','',0,0,0),(2,'Anticoncepcíon de emergencia, Ligadura de trompas','Si, aunque no me dieron todo lo que buscaba',0,1,'22','Varón','asd',3,1,205278,'2017-03-02 18:04:51','2017-03-02 18:04:51','',0,0,0),(3,'Información, Test de Embarazao','Otra opción',0,1,'22','Mujer trans','asdasd',3,1,205303,'2017-03-02 18:28:28','2017-03-02 18:28:28','',0,0,0),(4,'Información, Test de Embarazao','No',0,0,'22','Varón','asdasdasdasd',3,1,205303,'2017-03-03 16:14:26','2017-03-03 16:14:26','',0,0,0),(5,'Información, Test de Embarazao','Si, aunque no me dieron todo lo que buscaba',0,0,'222','Mujer','22',3,1,205303,'2017-03-03 16:21:24','2017-03-03 16:21:24','',0,0,0),(6,'Información, Pastillas anticonceptivas, Otros','Si, aunque no me dieron todo lo que buscaba',0,1,'16','Varón','asdasdasdasd',3,1,205303,'2017-03-04 16:31:05','2017-03-04 16:31:05','',0,0,0),(7,'Test de Embarazao, Pastillas anticonceptivas','Si, aunque no me dieron todo lo que buscaba',0,1,'22','Mujer','asdasd',3,1,205304,'2017-03-04 16:43:18','2017-03-04 16:43:18','',0,0,0),(8,'Test de Embarazao, Anticoncepcíon de emergencia','Si, aunque no me dieron todo lo que buscaba',0,0,'222','Mujer','2asdasd',3,1,205303,'2017-03-04 16:45:13','2017-03-04 16:45:13','',0,0,0),(9,'Anticoncepcíon inyectable','Si, aunque no me dieron todo lo que buscaba',0,0,'222','Varón trans','asdasd',3,1,205303,'2017-03-04 16:47:22','2017-03-04 16:47:22','',0,0,0),(10,'Pastillas anticonceptivas, Anticoncepcíon de emergencia','Si, aunque no me dieron todo lo que buscaba',0,1,'222','Varón trans','asdasdasd',3,1,205303,'2017-03-04 16:48:27','2017-03-04 16:48:27','',0,0,0),(11,'Test de Embarazao, Anticoncepcíon de emergencia','Si, aunque no me dieron todo lo que buscaba',0,0,'22','Mujer','asdasdasd',3,1,205303,'2017-03-04 16:49:36','2017-03-04 16:49:36','',0,0,0),(12,'Test de Embarazao, Pastillas anticonceptivas','No',0,1,'22','Mujer trans','asdasasd',3,1,205303,'2017-03-04 16:50:13','2017-03-04 16:50:13','',0,0,0),(13,'Test de Embarazao','No',0,0,'22','Mujer trans','aasdasdas',3,1,205303,'2017-03-04 16:54:21','2017-03-04 16:54:21','',0,0,0),(14,'Otros','No, estaba cerrado',0,0,'22','Mujer trans','asdasdasd',3,1,205303,'2017-03-04 16:55:57','2017-03-04 16:55:57','',0,0,0),(15,'Otros','Si, aunque no me dieron todo lo que buscaba',0,1,'22','Mujer','asdasd',3,1,205303,'2017-03-04 17:00:22','2017-03-04 17:00:22','',0,0,0),(16,'Otros','No',0,0,'22','Mujer trans','asdasd',3,1,205303,'2017-03-04 17:01:19','2017-03-04 17:01:19','',0,0,0),(17,'Otros','Si, aunque no me dieron todo lo que buscaba',0,1,'222','Mujer','asdasdasd',3,1,205303,'2017-03-04 17:03:16','2017-03-04 17:03:16','',0,0,0),(18,'Vasectomia','Si, aunque no me dieron todo lo que buscaba',0,1,'222','Varón trans','asdasdasd',3,1,205303,'2017-03-04 17:04:32','2017-03-04 17:04:32','',0,0,0),(19,'Información','No',0,0,'222','Varón','asdasdasd',3,1,205303,'2017-03-04 17:04:58','2017-03-04 17:04:58','',0,0,0),(20,'Otros','No, estaba cerrado',1,1,'22','Varón','adasdas',3,1,205304,'2017-03-04 17:06:16','2017-03-04 17:06:16','',0,0,0),(21,'Información, Test de Embarazao, DIU','Si, aunque no me dieron todo lo que buscaba',0,0,'22','Varón','asdasdasd',5,1,205303,'2017-05-03 19:04:37','2017-05-03 19:04:37','',0,0,0),(22,'Información, Test de Embarazao, Pastillas anticonceptivas, DIU','No',0,0,'22','Varón trans','asdasdad',4,1,205279,'2017-05-03 19:06:15','2017-05-03 19:06:15','prueba',0,0,0),(23,'Información, Pastillas anticonceptivas','Si',0,1,'23','Mujer trans','YOLO',3,1,205279,'2017-05-04 13:22:29','2017-05-04 13:22:29','prueba',0,0,0),(24,'Información, Test de Embarazao, Pastillas anticonceptivas','Si',1,0,'16','Mujer','A veces gano',5,1,205279,'2017-05-04 16:56:47','2017-05-04 16:56:47','',0,0,0),(25,'Información (explicalo en Comentarios), Anticoncepción de emergencia (pastilla del día después)','Algo',0,1,'88','femenino','toodo mal',1,1,205304,'2017-05-11 15:37:07','2017-05-11 15:37:07','sssr',0,0,0),(26,'Información (explicalo en Comentarios), Anticoncepción de emergencia (pastilla del día después)','Algo',0,1,'22','femenino','enojado',1,1,205301,'2017-05-11 15:38:57','2017-05-11 15:38:57','sssr',0,0,0),(27,'Información (explicalo en Comentarios), Pastillas anticonceptivas, DIU','Nada',1,0,'3','masculino','asasdasdasd',3,1,205304,'2017-05-11 15:49:08','2017-05-11 15:49:08','sssr',0,0,0),(28,'Información (explicalo en Comentarios), Anticoncepción de emergencia (pastilla del día después)','Nada',0,0,'22','femenino','sdasda',3,1,205304,'2017-05-11 16:22:54','2017-05-11 16:22:54','sssr',0,0,0),(29,'Pastillas anticonceptivas','Algo',0,1,'22','masculino','asdasdasdasdasd',3,1,205304,'2017-05-11 20:43:25','2017-05-11 20:43:25','sssr',0,0,0),(30,'Otros (explicalo en Comentarios)','Nada',0,0,'26','masculino','asdasdasdasd',3,1,205304,'2017-05-11 20:51:32','2017-05-11 20:51:32','ile',0,0,0),(31,'Información (explicalo en Comentarios)','Nada',1,0,'22','masculino','asdasdasd',3,1,205304,'2017-05-11 20:53:13','2017-05-11 20:53:13','sssr',0,0,0),(32,'Información (explicalo en Comentarios)','Nada',0,0,'22','masculino','asdasdasd',3,1,205304,'2017-05-11 20:56:05','2017-05-11 20:56:05','sssr',0,0,0),(33,'Información sobre aborto seguro, Realización de una interrupción legal del embarazo, Otros (explicalo en Comentarios)','No, no tenían lo que buscaba',0,0,'40 a 44','Otro','asdasd',3,1,205304,'2017-05-12 17:37:38','2017-05-12 17:37:38','ile',0,0,0),(34,'Condones (preservativos), Otros (explicalo en Comentarios)','No, no tenían lo que buscaba',1,0,'30 a 34','Varón trans','asdasdasd',3,1,205301,'2017-05-12 17:44:28','2017-05-12 17:44:28','condones',0,0,0),(35,'Información sobre condones (preservativos), Otros (explicalo en Comentarios)','No, me derivaron a otro lugar',0,0,'25 a 29','Otro','000000000',2,1,205304,'2017-05-12 17:47:38','2017-05-12 17:47:38','condones',0,0,0),(36,'Información sobre condones (preservativos)','No, no tenían lo que buscaba',0,0,'30 a 34','Otro','22112312313',2,1,205279,'2017-05-12 17:49:16','2017-05-12 17:49:16','condones',0,0,0),(37,'DIU, Anticoncepción inyectable','Sí, en ese momento',0,0,'10 a 19','Varón','3234234',2,1,205304,'2017-05-12 18:22:28','2017-05-12 18:22:28','sssr',0,0,0),(38,'Condones (preservativos)','No, estaba cerrado ',1,0,'30 a 34','Otro','',3,1,205304,'2017-05-13 14:00:18','2017-05-13 14:00:18','condones',1,1,0);
/*!40000 ALTER TABLE `evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2017_04_30_201345_add_service_column_to_evaluation',1),('2017_05_03_145251_add_columnstoevaluation',2),('2017_05_04_192520_questionModel',3),('2017_05_04_192540_question_optionModel',3),('2017_05_05_143302_create_service_table',3),('2017_05_05_143544_create_question_service_table',3),('2017_05_10_151814_add_evaluationColumn_to_questionTable',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(45) DEFAULT NULL,
  `habilitado` tinyint(4) DEFAULT NULL,
  `zoom` int(2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (5,'Argentina',1,4,'2016-11-21 17:19:46','2016-11-21 17:19:46'),(6,'ArgentinaASO',NULL,NULL,'2017-03-03 03:48:59','2017-03-03 03:48:59'),(7,NULL,NULL,NULL,'2017-03-03 10:58:36','2017-03-03 10:58:36');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partido`
--

DROP TABLE IF EXISTS `partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_partido` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `zoom` int(2) DEFAULT NULL,
  `idProvincia` int(11) DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_partido_pais_idx` (`idPais`),
  KEY `fk_partido_provincia_idx` (`idProvincia`),
  CONSTRAINT `fk_partido_pais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_provincia` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partido`
--

LOCK TABLES `partido` WRITE;
/*!40000 ALTER TABLE `partido` DISABLE KEYS */;
INSERT INTO `partido` VALUES (114,'Paraná','2016-11-21 19:29:39','2016-11-21 19:29:39',1,NULL,39,5),(115,'La Paz',NULL,NULL,1,NULL,39,5),(116,'Capital',NULL,NULL,1,NULL,42,5),(117,'Algo del 40',NULL,NULL,1,NULL,40,5),(118,'Algo del 41',NULL,NULL,1,NULL,41,5),(119,'La Banda','2017-01-14 20:55:06','2017-01-14 20:55:06',1,NULL,43,5),(120,'Invernada Sud','2017-02-02 14:38:34','2017-02-02 14:38:34',1,NULL,43,5),(121,'Santiago Del Estero','2017-02-02 14:38:34','2017-02-02 14:38:34',1,NULL,43,5),(122,'Forres','2017-02-02 14:38:34','2017-02-02 14:38:34',1,NULL,43,5),(123,'Quimili','2017-02-02 19:57:39','2017-02-02 19:57:39',1,NULL,43,5),(124,'Colonia El Simbolar','2017-02-02 19:57:39','2017-02-02 19:57:39',1,NULL,43,5),(125,'Ojo De Agua','2017-02-02 19:57:40','2017-02-02 19:57:40',1,NULL,43,5),(126,'Termas De Rio Hondo','2017-02-02 19:57:40','2017-02-02 19:57:40',1,NULL,43,5),(127,'Piedra Blanca','2017-02-02 19:57:40','2017-02-02 19:57:40',1,NULL,43,5),(128,'Los Juries','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(129,'Colonia Pinto','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(130,'Gramilla','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(131,'La Florida','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(132,'La Darsena','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(133,'Lote 47','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(134,'Los Ovejeros','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(135,'Pirpintos','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(136,'San Jose','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(137,'Santa Teresa','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(138,'Beltran','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(139,'Antilo','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(140,'El Colorado','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(141,'Villa Zanjon','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(142,'Puestito San Antonio','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(143,'Kilometro 477','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(144,'La Higuera','2017-02-02 19:57:41','2017-02-02 19:57:41',1,NULL,43,5),(145,'Los Mojones','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(146,'Las Tinajas','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(147,'Maquito','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(148,'Santa Lucia','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(149,'Tiun Punco','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(150,'El Hoyo','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(151,'Villa Brana','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(152,'Vaca Huañuna','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(153,'Argentina','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(154,'Caspi Corral','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(155,'Estacion Robles','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(156,'Clodomira','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(157,'El Charco','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(158,'Mistol Pozo','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(159,'Santa Catalina','2017-02-02 19:57:42','2017-02-02 19:57:42',1,NULL,43,5),(160,'Selva','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(161,'Sumampa','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(162,'Suncho Corral','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(163,'Tres Mojones','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(164,'Salavina','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(165,'Ambargasta','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(166,'Fernandez','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(167,'Pozo Betbeder','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(168,'Quebrachito','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(169,'Simbolar','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(170,'Buey Muerto','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(171,'Banda','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(172,'Brea Pozo','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(173,'Colonia Dora','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(174,'El Churqui','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(175,'Pozo Del Castaño','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(176,'Laprida','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(177,'Medellin','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(178,'San Antonio','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(179,'Sol De Mayo','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(180,'Sol De Julio','2017-02-02 19:57:43','2017-02-02 19:57:43',1,NULL,43,5),(181,'Yuchan','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(182,'Coronel Rico','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(183,'Loreto','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(184,'Monte Quemado','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(185,'Bº La Catolica','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(186,'Añatuya','2017-02-02 19:57:44','2017-02-02 19:57:44',1,NULL,43,5),(187,'Tacañitas','2017-02-02 19:57:45','2017-02-02 19:57:45',1,NULL,43,5),(188,'Paraje Miel De Palo','2017-02-02 19:57:45','2017-02-02 19:57:45',1,NULL,43,5),(189,'Ardiles','2017-02-02 19:57:45','2017-02-02 19:57:45',1,NULL,43,5),(190,'Alhuampa','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(191,'Algarrobal Viejo','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(192,'Campo Alegre','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(193,'Campo Grande','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(194,'Amama','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(195,'Campo Del Cielo','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(196,'Choya','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(197,'El Cachi','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(198,'Estacion Atamisqui','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(199,'La Abritas','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(200,'Barrancas','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(201,'Barranca Colorada','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(202,'Campo De Cejas','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(203,'Pampa De Los Guanacos','2017-02-02 19:57:46','2017-02-02 19:57:46',1,NULL,43,5),(204,'San Gregorio','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(205,'Campo Gallo','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(206,'Punta Del Monte','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(207,'Cerrillos','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(208,'Chaupi Pozo','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(209,'Chañar Pozo De Arriba','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(210,'Pozuelo','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(211,'San Antonio Norte','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(212,'Sotelo','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(213,'San Benito','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(214,'Invernada','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(215,'Chauchillas','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(216,'Colonia Tinco','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(217,'Colonia Siegel','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(218,'Frias','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(219,'Donadeu','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(220,'Palo Negro','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(221,'Garza','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(222,'Las Cejas De Juarez','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(223,'Guanaco Sombriana','2017-02-02 19:57:47','2017-02-02 19:57:47',1,NULL,43,5),(224,'El Porvenir','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(225,'El Gran Porvenir','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(226,'Villa Union','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(227,'El Bobadal','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(228,'Fortin Inca','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(229,'El Arenal','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(230,'El Cajon','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(231,'El Cerro','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(232,'El Diablo','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(233,'Kilometro 49','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(234,'Fisco De Fatima','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(235,'Los Tigres','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(236,'El Mojon','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(237,'La Cañada','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(238,'Huayamampa','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(239,'El Patay','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(240,'La Fragua','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(241,'Fisco Chico','2017-02-02 19:57:48','2017-02-02 19:57:48',1,NULL,43,5),(242,'Hoyon','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(243,'Copo Viejo','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(244,'Huachana','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(245,'Guardia Escolta','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(246,'Granadero Gatica','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(247,'Herrera','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(248,'Isca Yacu','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(249,'Lavalle','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(250,'Isla Verde','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(251,'Los Telares','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(252,'Icaño','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(253,'Juanillo','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(254,'La Aurora','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(255,'Kilometro 0','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(256,'Jumi Pozo','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(257,'Km 90','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(258,'La Noria','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(259,'El Cabure','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(260,'El Dean','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(261,'Pozo Hondo','2017-02-02 19:57:49','2017-02-02 19:57:49',1,NULL,43,5),(262,'Los Acostas','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(263,'La Rivera','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(264,'Nueva Esperanza','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(265,'Manogasta','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(266,'Los Gallegos','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(267,'La Resbalosa','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(268,'Los Pereyra','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(269,'Los Nuñez','2017-02-02 19:57:50','2017-02-02 19:57:50',1,NULL,43,5),(270,'Capital','2017-02-03 11:36:46','2017-02-03 11:36:46',1,NULL,43,5),(271,'Robles','2017-02-03 15:48:01','2017-02-03 15:48:01',1,NULL,43,5),(272,'Malvinas Argentinas','2017-02-03 18:29:51','2017-02-03 18:29:51',1,NULL,40,5),(273,'Pergamino','2017-02-03 18:29:52','2017-02-03 18:29:52',1,NULL,40,5),(274,'San Miguel','2017-02-03 18:29:52','2017-02-03 18:29:52',1,NULL,40,5),(275,'Morón','2017-02-03 18:29:52','2017-02-03 18:29:52',1,NULL,40,5),(276,'Moreno','2017-02-03 18:29:52','2017-02-03 18:29:52',1,NULL,40,5),(277,'Bahía Blanca','2017-02-03 18:29:52','2017-02-03 18:29:52',1,NULL,40,5),(278,'Carmen De Areco','2017-02-03 18:53:08','2017-02-03 18:53:08',1,NULL,40,5),(279,'Avellaneda','2017-02-03 18:53:08','2017-02-03 18:53:08',1,NULL,40,5),(280,'Carlos Casares','2017-02-03 18:53:08','2017-02-03 18:53:08',1,NULL,40,5),(281,'General Pueyrredón','2017-02-03 18:53:08','2017-02-03 18:53:08',1,NULL,40,5),(282,'Adolfo Sourdeaux','2017-02-03 18:53:08','2017-02-03 18:53:08',1,NULL,40,5),(283,'Coronel Dorrego','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(284,'Coronel Rosales','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(285,'Guaminí','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(286,'Junín','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(287,'Tres De Febrero','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(288,'Hurlingham','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(289,'Villarino','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(290,'San Nicolás','2017-02-03 18:53:09','2017-02-03 18:53:09',1,NULL,40,5),(291,'San Isidro','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(292,'General Alvarado','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(293,'Navarro','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(294,'Tres Arroyos','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(295,'Gral. Belgrano','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(296,'Tigre','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(297,'Saladillo','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(298,'Necochea','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(299,'Capitán Sarmiento','2017-02-03 18:53:10','2017-02-03 18:53:10',1,NULL,40,5),(300,'Pilar','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(301,'Campana','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(302,'Cañuelas','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(303,'General San Martín','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(304,'General Rodríguez','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(305,'San Vicente','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(306,'Almirante Brown','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(307,'Laprida','2017-02-03 18:53:11','2017-02-03 18:53:11',1,NULL,40,5),(308,'San Andrés De Giles','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(309,'Chivilcoy','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(310,'Marcos Paz','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(311,'Zárate','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(312,'Florencio Varela','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(313,'Quilmes','2017-02-03 18:53:12','2017-02-03 18:53:12',1,NULL,40,5),(314,NULL,'2017-02-03 19:14:37','2017-02-03 19:14:37',1,NULL,40,5),(315,'Balvanera','2017-02-03 19:35:37','2017-02-03 19:35:37',1,NULL,41,5),(316,'Flores','2017-02-06 21:46:16','2017-02-06 21:46:16',1,NULL,41,5),(317,'Escalante','2017-02-06 21:46:16','2017-02-06 21:46:16',1,NULL,44,5),(318,'Retiro','2017-02-06 21:46:16','2017-02-06 21:46:16',1,NULL,41,5),(319,'Moreno','2017-02-10 18:57:08','2017-02-10 18:57:08',1,NULL,43,5),(320,'Monserrat','2017-02-10 18:57:09','2017-02-10 18:57:09',1,NULL,41,5),(321,'Belgrano','2017-02-10 18:57:09','2017-02-10 18:57:09',1,NULL,43,5),(322,'General Taboada','2017-02-10 18:57:09','2017-02-10 18:57:09',1,NULL,43,5),(323,'Copo','2017-02-10 18:57:09','2017-02-10 18:57:09',1,NULL,43,5),(324,'Alberdi','2017-02-10 18:57:09','2017-02-10 18:57:09',1,NULL,43,5),(325,'Lomas de Zamora','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,40,5),(326,'Juan F. Ibarra','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,43,5),(327,'La Costa','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,40,5),(328,'Figueroa','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,43,5),(329,'Atamisqui','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,43,5),(330,'Jimenez','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,43,5),(331,'San Lorenzo','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,45,5),(332,'Aguará Grande','2017-02-10 18:57:10','2017-02-10 18:57:10',1,NULL,45,5),(333,'Villa Atamisqui','2017-02-10 20:19:14','2017-02-10 20:19:14',1,NULL,43,5),(334,'La Capital','2017-02-10 20:19:17','2017-02-10 20:19:17',1,NULL,45,5),(335,'Rosario','2017-02-10 20:19:17','2017-02-10 20:19:17',1,NULL,45,5),(336,'San Martín','2017-02-10 20:19:18','2017-02-10 20:19:18',1,NULL,45,5),(337,'Caseros','2017-02-10 20:19:18','2017-02-10 20:19:18',1,NULL,45,5),(338,'General Pinto','2017-02-10 21:13:14','2017-02-10 21:13:14',1,NULL,45,5),(339,'General Obligado','2017-02-10 21:13:14','2017-02-10 21:13:14',1,NULL,45,5),(340,'General Lopez','2017-02-10 21:13:14','2017-02-10 21:13:14',1,NULL,45,5),(341,'Garay','2017-02-10 21:13:14','2017-02-10 21:13:14',1,NULL,45,5),(342,'Constitución','2017-02-10 21:13:14','2017-02-10 21:13:14',1,NULL,45,5),(343,'San Javier','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(344,'San Cristobal','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(345,'Castellanos','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(346,'Vera','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(347,'San Jerónimo','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(348,'Las Colonias','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(349,'Iriondo','2017-02-10 21:13:15','2017-02-10 21:13:15',1,NULL,45,5),(350,'9 de Julio','2017-02-10 21:13:16','2017-02-10 21:13:16',1,NULL,45,5),(351,'San Justo','2017-02-10 21:13:16','2017-02-10 21:13:16',1,NULL,45,5),(352,'Belgrano','2017-02-10 23:28:42','2017-02-10 23:28:42',1,NULL,45,5),(353,'Orán','2017-02-10 23:28:43','2017-02-10 23:28:43',1,NULL,46,5),(354,'Capital','2017-02-10 23:28:43','2017-02-10 23:28:43',1,NULL,46,5),(355,'General Jose de San Martín','2017-02-10 23:28:43','2017-02-10 23:28:43',1,NULL,46,5),(356,'General Martin Miguel de Güemes','2017-02-10 23:28:43','2017-02-10 23:28:43',1,NULL,46,5),(357,'Metán','2017-02-10 23:28:43','2017-02-10 23:28:43',1,NULL,46,5),(358,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',1,NULL,47,5),(359,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',1,NULL,48,5),(360,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',1,NULL,44,5),(361,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',1,NULL,49,5),(362,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',1,NULL,50,5),(363,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',1,NULL,51,5),(364,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',1,NULL,52,5),(365,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',1,NULL,53,5),(366,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,54,5),(367,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,55,5),(368,'Comuna 13','2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,41,5),(369,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,45,5),(370,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,43,5),(371,'Córdoba','2017-02-11 00:04:03','2017-02-11 00:04:03',1,NULL,56,5),(372,NULL,'2017-02-11 00:04:05','2017-02-11 00:04:05',1,NULL,39,5),(373,NULL,'2017-02-11 00:04:05','2017-02-11 00:04:05',1,NULL,57,5),(374,'Río Cuarto','2017-02-11 00:04:07','2017-02-11 00:04:07',1,NULL,56,5),(375,NULL,'2017-02-11 00:04:43','2017-02-11 00:04:43',1,NULL,56,5),(376,NULL,'2017-02-11 00:04:47','2017-02-11 00:04:47',1,NULL,58,5),(377,NULL,'2017-02-11 00:05:02','2017-02-11 00:05:02',1,NULL,59,5),(378,NULL,'2017-02-11 00:05:02','2017-02-11 00:05:02',1,NULL,60,5),(379,'Ushuaia','2017-02-26 13:00:20','2017-02-26 13:00:20',1,NULL,47,5),(380,'Río Gallegos','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,48,5),(381,'Comodoro Rivadavia','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,44,5),(382,'Rawson','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,44,5),(383,'Trelew','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,44,5),(384,'Esquel','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,44,5),(385,'Puerto Madryn  ','2017-02-26 13:02:13','2017-02-26 13:02:13',1,NULL,44,5),(386,'ParanáASO','2017-03-03 03:48:59','2017-03-03 03:48:59',1,NULL,61,6),(387,NULL,'2017-03-03 10:58:36','2017-03-03 10:58:36',1,NULL,62,7),(388,'Mendicrim','2017-03-06 22:18:56','2017-03-06 22:18:56',1,NULL,63,5);
/*!40000 ALTER TABLE `partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `places` (
  `placeId` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento` varchar(600) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `altura` varchar(50) DEFAULT NULL,
  `piso_dpto` varchar(50) DEFAULT NULL,
  `cruce` varchar(300) DEFAULT NULL,
  `barrio_localidad` varchar(300) DEFAULT NULL,
  `idPartido` int(11) DEFAULT NULL,
  `idProvincia` int(11) DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `aprobado` tinyint(4) DEFAULT NULL,
  `observacion` varchar(1000) DEFAULT NULL,
  `formattedAddress` varchar(200) DEFAULT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `confidence` float DEFAULT NULL,
  `fail` varchar(200) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `habilitado` tinyint(4) DEFAULT NULL,
  `vacunatorio` tinyint(4) DEFAULT NULL,
  `infectologia` tinyint(4) DEFAULT NULL,
  `condones` tinyint(4) DEFAULT NULL,
  `prueba` tinyint(4) DEFAULT NULL,
  `es_rapido` tinyint(4) DEFAULT NULL,
  `tel_testeo` varchar(50) DEFAULT NULL,
  `mail_testeo` varchar(50) DEFAULT NULL,
  `horario_testeo` varchar(100) DEFAULT NULL,
  `responsable_testeo` varchar(100) DEFAULT NULL,
  `web_testeo` varchar(100) DEFAULT NULL,
  `ubicacion_testeo` varchar(100) DEFAULT NULL,
  `observaciones_testeo` varchar(500) DEFAULT NULL,
  `tel_distrib` varchar(50) DEFAULT NULL,
  `mail_distrib` varchar(50) DEFAULT NULL,
  `horario_distrib` varchar(100) DEFAULT NULL,
  `responsable_distrib` varchar(100) DEFAULT NULL,
  `web_distrib` varchar(100) DEFAULT NULL,
  `ubicacion_distrib` varchar(100) DEFAULT NULL,
  `comentarios_distrib` varchar(500) DEFAULT NULL,
  `tel_infectologia` varchar(50) DEFAULT NULL,
  `mail_infectologia` varchar(50) DEFAULT NULL,
  `horario_infectologia` varchar(100) DEFAULT NULL,
  `responsable_infectologia` varchar(100) DEFAULT NULL,
  `web_infectologia` varchar(100) DEFAULT NULL,
  `ubicacion_infectologia` varchar(100) DEFAULT NULL,
  `comentarios_infectologia` varchar(500) DEFAULT NULL,
  `tel_vac` varchar(50) DEFAULT NULL,
  `mail_vac` varchar(50) DEFAULT NULL,
  `horario_vac` varchar(100) DEFAULT NULL,
  `responsable_vac` varchar(100) DEFAULT NULL,
  `web_vac` varchar(100) DEFAULT NULL,
  `ubicacion_vac` varchar(100) DEFAULT NULL,
  `comentarios_vac` varchar(500) DEFAULT NULL,
  `mac` tinyint(4) DEFAULT NULL,
  `tel_mac` varchar(50) DEFAULT NULL,
  `mail_mac` varchar(50) DEFAULT NULL,
  `horario_mac` varchar(100) DEFAULT NULL,
  `responsable_mac` varchar(100) DEFAULT NULL,
  `web_mac` varchar(100) DEFAULT NULL,
  `ubicacion_mac` varchar(100) DEFAULT NULL,
  `comentarios_mac` varchar(500) DEFAULT NULL,
  `ile` tinyint(4) DEFAULT NULL,
  `tel_ile` varchar(50) DEFAULT NULL,
  `mail_ile` varchar(50) DEFAULT NULL,
  `horario_ile` varchar(100) DEFAULT NULL,
  `responsable_ile` varchar(100) DEFAULT NULL,
  `web_ile` varchar(100) DEFAULT NULL,
  `ubicacion_ile` varchar(100) DEFAULT NULL,
  `comentarios_ile` varchar(500) DEFAULT NULL,
  `cantidad_votos` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT '0',
  `rateReal` float DEFAULT '0',
  PRIMARY KEY (`placeId`),
  KEY `fk_provincia_idx` (`idProvincia`),
  KEY `fk_partido_idx` (`idPartido`),
  KEY `fk_pais_idx` (`idPais`),
  CONSTRAINT `fk_pais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido` FOREIGN KEY (`idPartido`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_provincia` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=205309 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (205278,'Casa JonaASO','PublicASO','Av. Almafuerte','4777',NULL,NULL,'ParanáASO',386,61,6,1,NULL,NULL,'-53.78168799251','-67.699728012085',1,NULL,'2017-03-06 22:48:55','2017-02-23 19:20:16',1,0,0,0,0,0,NULL,NULL,'7a13','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',0,'tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',0,'tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',2,4,3.5),(205279,'Casa Jona2','Publico2','Av. Almafuerte','47778',NULL,NULL,'Paraná',114,39,5,1,NULL,NULL,'-53.78168799251','-67.699728012085',7,NULL,'2017-05-12 18:45:38','2017-02-23 19:20:16',1,0,0,1,0,0,NULL,NULL,'7a13','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile','tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',0,'tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',0,'tel desde ile','mail desde ile','horario desde ile','resp desde ile','web desde ile','ubi desde ile','obs desde ile',4,4,3.5),(205298,'Línea Salud Sexual Programa Nacional',NULL,NULL,NULL,NULL,NULL,NULL,387,62,7,1,NULL,NULL,'-53.78168799251','-67.699728012085',1,NULL,'2017-03-06 22:48:56','2017-02-28 15:27:24',1,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205299,'Hospital Regional Rio Grande ','Centro de Salud','Belgrano ','350',NULL,NULL,NULL,358,47,5,1,NULL,NULL,'-53.78168799251','-67.699728012085',1,NULL,'2017-03-06 22:48:55','2017-02-28 15:27:24',1,0,0,1,0,0,NULL,NULL,'Lunes a viernes de 8 a 15hs',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205300,'Línea Salud Sexual Programa Nacional',NULL,NULL,NULL,NULL,NULL,NULL,380,48,5,1,NULL,NULL,'-51.611746','-69.290804',1,NULL,'2017-03-06 22:48:55','2017-02-28 15:27:24',1,0,0,1,0,0,'0800-222-3444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205301,'Centro Especializado En Salud Integral De Adolescentes- Comodoro Rivadavia','Centro de Salud','San Martin','1400',NULL,NULL,NULL,381,44,5,1,NULL,NULL,'-45.8621183','-67.499313',1,NULL,'2017-05-12 17:44:28','2017-02-28 15:27:24',1,0,0,1,0,0,'0297 -445329',NULL,'lunes a viernes de 8 a 14hs .',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,2,2),(205302,'Centro Especializado En Salud Integral De Adolescentes- Rawson','Centro de Salud','Pte. Gral. Julio A. Roca ','534',NULL,NULL,NULL,382,44,5,1,NULL,NULL,'-43.389081939117','-65.21484375',1,NULL,'2017-03-06 22:48:55','2017-02-28 15:27:25',1,0,0,1,0,0,'0280- 4483549',NULL,'lunes a viernes - 8 a 14hs.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205303,'Línea Salud Sexual Programa Nacional',NULL,NULL,NULL,NULL,NULL,NULL,382,44,5,1,NULL,NULL,'-43.299316','-65.102533',1,NULL,'2017-05-03 19:04:37','2017-02-28 15:27:25',1,0,0,1,0,0,'0800-222-3444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,3,3.1176),(205304,'Centro Especializado En Salud Integral De Adolescentes- Trelew','Centro de Salud','Moreno','440',NULL,NULL,NULL,383,44,5,1,NULL,NULL,'-43.004647127794','-65.390625',1,NULL,'2017-05-13 14:00:18','2017-02-28 15:27:25',1,0,0,1,0,0,'0280-4426773',NULL,'lunes a viernes - 9 a 15hs.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,3,2.6923),(205305,'Centro Especializado En Salud Integral De Adolescentes- Esquel','Centro de Salud','Fontana',NULL,NULL,'Don Bosco',NULL,384,44,5,1,NULL,NULL,'-42.9174358',' -7.1.3211466',1,NULL,'2017-03-06 22:48:55','2017-02-28 15:27:25',1,0,0,1,0,0,'02945- 451230',NULL,'lunes a viernes - 8 a 16hs.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205306,'Casa de Tincho','Publico','Otra calle.','123','1231231','123','Villa Pueyrredón',316,41,5,1,'Todo bien',NULL,'-34.5893295','-58.5084837',NULL,NULL,'2017-05-11 18:48:11','2017-05-04 17:02:54',NULL,1,0,0,1,0,'1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','','1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','','1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','','1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','',1,'1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','',0,'1122223344','tinchoforever@gmail.com','Todos','Nadie','google.com','','',NULL,0,0),(205307,'Martin','Publico','Carlos A Lopes','3336','','','Villa Pueyrredon',316,41,5,1,'Villa Pueyrredon',NULL,'-34.5893329','-58.508483',NULL,NULL,'2017-05-11 18:53:43','2017-05-11 18:51:54',NULL,0,0,0,0,0,'','','','','','','','Villa Pueyrredon','villa@pueyrredon.com','Villa Pueyrredon','Villa Pueyrredon','villapuey.com','','','','','','','','','','','','','','','','',0,'','','','','','','',0,'','','','','','','',NULL,0,0),(205308,'Casa Jona New About','Casa','Almafuerrtes','477777777','el piso','El cruce','El barrio',114,39,5,0,'no gracias',NULL,'-31.7623488','-60.4554117',NULL,NULL,'2017-05-11 22:45:18','2017-05-11 22:32:36',NULL,1,0,1,0,0,'','','','','','','','','','','el responsable','','','','','','','','','','','','','','el responsable','','','',0,'','','','','','','',0,'','','','','','','',NULL,0,0);
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `habilitado` tinyint(4) DEFAULT NULL,
  `zoom` int(2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `peso` int(11) DEFAULT '0',
  `idPais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provincia_pais_idx` (`idPais`),
  CONSTRAINT `fk_provincia_pais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (39,'Entre Ríos',1,NULL,'2016-11-21 19:29:39','2016-11-21 19:29:39',0,5),(40,'Buenos Aires',1,NULL,NULL,NULL,0,5),(41,'Ciudad Autónoma de Buenos Aires',1,NULL,NULL,NULL,0,5),(42,'Cordoba',1,NULL,NULL,NULL,0,5),(43,'Santiago del Estero',NULL,NULL,'2017-01-14 20:55:06','2017-01-14 20:55:06',0,5),(44,'Chubut',NULL,NULL,'2017-02-06 21:46:16','2017-02-06 21:46:16',0,5),(45,'Santa Fe',NULL,NULL,'2017-02-10 18:57:10','2017-02-10 18:57:10',0,5),(46,'Salta',NULL,NULL,'2017-02-10 23:28:43','2017-02-10 23:28:43',0,5),(47,'Tierra del Fuego',NULL,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',0,5),(48,'Santa Cruz',NULL,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',0,5),(49,'Rio Negro',NULL,NULL,'2017-02-11 00:04:01','2017-02-11 00:04:01',0,5),(50,'Río Negro',NULL,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',0,5),(51,'Neuquen ',NULL,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',0,5),(52,'Neuquén',NULL,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',0,5),(53,'La Pampa',NULL,NULL,'2017-02-11 00:04:02','2017-02-11 00:04:02',0,5),(54,'Mendoza',NULL,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',0,5),(55,'Misiones',NULL,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',0,5),(56,'Córdoba',NULL,NULL,'2017-02-11 00:04:03','2017-02-11 00:04:03',0,5),(57,'San Luis',NULL,NULL,'2017-02-11 00:04:05','2017-02-11 00:04:05',0,5),(58,'San Juan',NULL,NULL,'2017-02-11 00:04:47','2017-02-11 00:04:47',0,5),(59,'Corrientes ',NULL,NULL,'2017-02-11 00:05:02','2017-02-11 00:05:02',0,5),(60,'La Rioja',NULL,NULL,'2017-02-11 00:05:02','2017-02-11 00:05:02',0,5),(61,'Entre RíosASO',NULL,NULL,'2017-03-03 03:48:59','2017-03-03 03:48:59',0,6),(62,NULL,NULL,NULL,'2017-03-03 10:58:36','2017-03-03 10:58:36',0,7),(63,'Mateico',NULL,NULL,'2017-03-06 22:18:56','2017-03-06 22:18:56',0,5);
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `evaluation_column` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'¿Qué fuiste a buscar?* (Podés marcar varias opciones)','checkbox','que_busca'),(2,'¿Te dieron lo que buscabas?*','selectbox','le_dieron'),(3,'¿Durante la consulta se respetó tu privacidad, evitando que otras personas te vieran o escucharan?*','radiobox','privacidad_ok'),(4,'¿Cual es tu edad?','selectbox','edad'),(5,'Género*','selectbox','genero'),(6,'¿Qué fuiste a buscar?* (Podés marcar varias opciones)','checkbox','que_busca'),(7,'¿Recibiste información clara, sencilla y completa?*','radiobox','info_ok'),(8,'¿Te sentiste cómodo/a durante la consulta?*','radiobox','comodo'),(9,'¿La atención fue gratuita?*','radiobox','es_gratuito'),(10,'¿Te informaron sobre las vacunas indicadas para tu edad?*','radiobox','informacion_vacunas'),(11,'¿Qué fuiste a buscar?*','checkbox','que_busca'),(12,'¿Qué fuiste a buscar?* (Podés marcar varias opciones)','checkbox','que_busca'),(13,'¿Qué fuiste a buscar?* (Podés marcar varias opciones)','checkbox','que_busca'),(14,'¿Qué fuiste a buscar?* (Podés marcar varias opciones)','checkbox','que_busca');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_service`
--

DROP TABLE IF EXISTS `question_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_service_question_id_foreign` (`question_id`),
  KEY `question_service_service_id_foreign` (`service_id`),
  CONSTRAINT `question_service_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  CONSTRAINT `question_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_service`
--

LOCK TABLES `question_service` WRITE;
/*!40000 ALTER TABLE `question_service` DISABLE KEYS */;
INSERT INTO `question_service` VALUES (10,1,1),(11,2,1),(12,3,1),(13,4,1),(14,5,1),(15,7,1),(16,8,1),(17,6,2),(18,2,2),(19,4,2),(20,5,2),(21,8,2),(22,2,3),(23,2,4),(24,2,5),(25,2,6),(26,7,2),(27,7,3),(28,7,4),(29,7,5),(30,7,6),(36,8,3),(37,8,4),(38,8,5),(39,8,6),(40,3,2),(41,3,3),(42,3,5),(43,9,1),(44,9,2),(45,9,5),(46,9,6),(47,4,3),(48,4,4),(49,4,5),(50,4,6),(51,5,3),(52,5,4),(53,5,5),(54,5,6),(55,10,4),(56,11,3),(57,12,4),(58,13,5),(59,14,6);
/*!40000 ALTER TABLE `question_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Servicio de Salud Sexual y Reproductiva','sssr','Servicio de Salud Sexual y Reproductiva',''),(2,'Interrupción Legal de Embarazo','ILE','Interrupción Legal de Embarazo',''),(3,'Centro de Infectología','cdi','Centro de Infectología',''),(4,'Vacunatorios','vacunatorios','Vacunatorios',''),(5,'Prueba VIH','prueba','Prueba VIH',''),(6,'Condones','condones','Condones','');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testing`
--

DROP TABLE IF EXISTS `testing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testing` (
  `null` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testing`
--

LOCK TABLES `testing` WRITE;
/*!40000 ALTER TABLE `testing` DISABLE KEYS */;
INSERT INTO `testing` VALUES (0);
/*!40000 ALTER TABLE `testing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'francoohd','francoo.hd@gmail.com','$2y$10$yuzsh1wBM0UPQsgnC/.p5u2HR2hwhtnC81A.g1qIFHMsG9s8DFQyy','2016-09-30 23:09:50','2015-09-29 14:40:41','31qojC6qg3nrQYLO4slSEVKdaTe3fPMqkGrYcFnKdePzvKByRo65m3oktsQb'),(22,'Martin','martin.rabaglia@gmail.com','$2y$10$Y7B4Jqg0Ki9xHO8YXv28j.UNE4antkuM5NjbPUlebwc9lDL2V85aK','2015-12-09 18:25:24','2015-12-09 18:25:24',NULL),(25,'Guadalupe López','guadalupelopezt@gmail.com','$2y$10$Zy5Eya4rImJSgYVxIQPT8uN/T9a5qTZ5Mmh8bH0G5ARQD6qXKFZTq','2016-06-24 13:19:52','2016-06-24 13:19:52',NULL),(27,'Anita Massacane','anita.massacane@huesped.org.ar','$2y$10$dRbtZlukDVHyMpVfgJ9hb.Oec3f0Q7ewLaSa0xm73JuSm6Khob7/6','2016-06-24 13:22:38','2016-06-24 13:22:38',NULL),(28,'Leandro Kahn','leandro.cahn@huesped.org.ar','$2y$10$3UY5jgKakgqpicm5z.AbVumdg15dFtGXPspQFkhkw5XOSuv8QCaUa','2016-06-24 13:23:32','2016-06-24 13:23:32',NULL),(29,'Meli','melina.masnatta@huesped.org.ar','$2y$10$j8wbVlF22.0EInJPCzaBFuDAOv7txrOgwQ6Wq3EYv4cHltHmqvFWi','2016-09-06 17:13:51','2016-09-06 17:13:27','S4BTrdQTEyz30jp6fIG02LPU9VAPBMZKLHvm0x4OEUIoRNL2KQH72WE1ifPb'),(39,'DONDE','donde@huesped.org.ar','$2y$10$clT4ZiuhOBqvp9Mo7a6iVOALqBHjEwAmJWOEaxYslvmg2FfHkrSWW','2017-02-24 12:50:13','2016-11-15 20:48:46','sLurX1garTqrSGpFH7MsjyaiQ4rx4fNahkOM7fCSB9INyZuxLEUMmdwxTKrg'),(40,'Jonaaaaa','a@s','$2y$10$DcauBoR1/7zbXzCMAYRToOP9MhJHNcHUV/btfnt.df.cjV0r247Kq','2017-02-08 00:02:31','2017-02-08 00:02:31',NULL),(41,'Jona','jonatan.santana2@gmail.com','$2y$10$BcJ2MRm2tKWmABH3ZUhaRORJiyD1SNlncXcWbqFoJ/olTP700T8uq','2017-03-09 15:51:08','2017-03-09 15:51:08',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-14 14:36:09
