-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: LR2
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `group_photo` varchar(255) DEFAULT NULL,
                          `name` varchar(255) DEFAULT NULL,
                          `FIO_group` varchar(255) DEFAULT NULL,
                          `major_id` bigint(20) unsigned DEFAULT NULL,
                          `year_of_entry` year(4) DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `groups_majors_id_fk` (`major_id`),
                          CONSTRAINT `groups_majors_id_fk` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (13,'2020_09_16_nsch_scho.JPG','Столярная мастерская',NULL,6,NULL),(14,'__4.jpg','Музыкальные развивающие занятия',NULL,1,NULL),(15,'2020_02_14_scifest_0.JPG','Физика, опыты, открытия',NULL,4,NULL),(16,'2019_09_14_nsch_062.JPG','Репа: музыкальный воркшоп',NULL,9,NULL),(17,'IMG_8750_1.jpg','Перед школой: как подготовить ребёнка и себя',NULL,9,NULL),(18,'HK8A1520.jpg','Праздничные открытки с линогравюрами',NULL,9,NULL),(19,'2023_10_06_SUP-day-8.jpg','Цирковая семейная школа',NULL,9,NULL),(20,'MAR_6244.JPG','Ударная установка',NULL,1,NULL),(21,'IMG_2582_.JPG','Игры нашего двора',NULL,9,NULL),(22,'_1.jpg','Эбру.Рисование на воде',NULL,9,NULL),(23,'A7_03968_.jpg','Стажировки в тьюторской службе Новой школы',NULL,8,NULL),(24,'_DSC7372.jpg','Гитара',NULL,1,NULL),(25,'_ANG7010-2.jpg','Фортепиано',NULL,1,NULL),(26,'_DSC8522.jpg','Волшебная керамика',NULL,9,NULL),(27,'20220415-A7_06871.jpg','Вокал',NULL,1,NULL),(28,'noroot.jpg','Инженерные выходные',NULL,9,NULL),(29,'noroot.png','Галактика эмоций',NULL,5,NULL),(30,'_2020_12_09_nsch_200.jpg','Математика вокруг нас',NULL,4,NULL),(31,'1__3__161.jpg','3D-физкультура (Школа диалога с препятствием)',NULL,2,NULL),(32,'-web-106.png','Ранняя подготовка к школе',NULL,4,NULL),(33,'2019_03_26_n_school_.JPG','Творческий экспериментариум',NULL,6,NULL),(34,'_2020_12_09_nsch_053.jpg','Баскетбол',NULL,2,NULL),(35,'group-boys-girl-figh.jpg','Клуб единоборств Новой школы',NULL,2,NULL),(36,'2019_03_26_n_school_.JPG','Шахматы',NULL,2,NULL),(37,'__JPEG_72.jpeg','Инженерный клуб',NULL,3,NULL),(38,'IMG_2581.JPG','В стране «Понарошку»',NULL,5,NULL),(39,'noroot.png','Волейбол',NULL,2,NULL),(40,'2023_10_06_SUP-day-1.jpg','Цирковая школа',NULL,2,NULL),(41,'2020_02_21__nschool_.jpg','Театральная студия Фишера',NULL,6,NULL),(42,'2019_06_21_nsh_inten.JPG','Гимнастика',NULL,2,NULL),(43,'2023_10_06_SUP-day-5.jpg','Худкружок',NULL,6,NULL),(44,'P1010644_.JPG','Как подготовить ребёнка к школе',NULL,8,NULL),(45,'221029_kvantik_274.JPG','Школа программирования',NULL,3,NULL),(46,'2019_09_14_nsch_073.JPG','Откуда берётся цвет',NULL,9,NULL),(47,'311_____.jpg','Роболаборатория',NULL,9,NULL),(48,'2019_03_26_n_school_.JPG','Мастерская печати',NULL,9,NULL),(49,'cGIZOgs7NUA.jpg','Научные выходные',NULL,9,NULL),(50,'_DSC0302_.jpg','Семейный портрет',NULL,9,NULL),(51,'dynamic-portrait-you.jpg','Dance mix 18+',NULL,8,NULL),(52,'2020_09_16_nsch_scho.JPG','Игра в глину',NULL,6,NULL),(53,'Kraeva-259.jpg','Керамическая мастерская',NULL,6,NULL),(54,'noroot.png','Чирлидинг',NULL,2,NULL),(55,'anastasia-hisel-tpiv.jpg','Стретчинг 18+',NULL,8,NULL),(56,'2020_09_16_nsch_scho.JPG','Alt gym',NULL,5,NULL),(57,'20240216_daily_82.JPG','Я так вижу',NULL,6,NULL),(58,'_ANG1413A.jpg','Мюзикл',NULL,1,NULL),(59,'DSC_4576.jpg','Удивительная киномеханика',NULL,6,NULL),(60,'photo.jpg','Робототехника',NULL,3,NULL),(61,'nsh_camp_216.JPG','Голос как искусство',NULL,1,NULL),(62,'HK8A4506.jpg','Футбол',NULL,2,NULL),(63,'iphone-photography-l.jpg','Фотография: как соблюдать и нарушать правила',NULL,6,NULL),(64,'ns_christmas_132.JPG','Про деньги',NULL,5,NULL),(65,'20230621_intensivy_1.jpg','Акробатический рок-н-ролл',NULL,1,NULL),(66,'IMG_1269.JPG','Hip-hop, electro, k-pop, popping',NULL,1,NULL),(67,'Group_2.png','Культурология',NULL,5,NULL),(68,'_4.svg','Английский с носителями языка по выходным',NULL,4,NULL),(69,'Sciencely_.png','Кружки по естественным наукам',NULL,4,NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `majors` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `majors`
--

LOCK TABLES `majors` WRITE;
/*!40000 ALTER TABLE `majors` DISABLE KEYS */;
INSERT INTO `majors` VALUES (1,'Музыка и танцы'),(2,'Спорт'),(3,'Технологии'),(4,'Школьные предметы'),(5,'Soft Skills'),(6,'Творчество'),(7,'Интенсивы'),(8,'Курсы для взрослых'),(9,'Семейные программы');
/*!40000 ALTER TABLE `majors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-11 15:56:46
