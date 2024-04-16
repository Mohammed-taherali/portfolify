-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: portfolio
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` text,
  `experience` text,
  `skills` text,
  `contact` text,
  `custom1` text,
  `custom2` text,
  `custom3` text,
  `education` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'abc@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Third year student, pursing Bachelor of Computer Science at VCACS.\\nWorking as a Software Developer at Elite Infosoft.\\nTech stack: MERN, PHP, .NET Core, flutter, MySql\\nConnect with me @col.mohammedtaher@gmail.com\"}','[{\"jobProfile\":\"Software Developer Intern\",\"company\":\"Elite Infosoft\",\"startDate\":\"2023-06-20\",\"endDate\":\"2023-12-31\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Developer\",\"company\":\"Elite Infosoft\",\"startDate\":\"2024-01-01\",\"endDate\":\"present\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"}]','[\"Angular\",\"React\",\"NodeJs\",\"dotnet core\",\"flutter\",\"firebase\",\"mongodb\",\"python\",\"mysql\",\"php\"]',NULL,NULL,NULL,NULL,'[{\"university\":\"Vishwakarma College,\",\"degree\":\"Bachelor of Science in Computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-04-01\",\"perc\":\"9.5\"},{\"university\":\"S.M. Choksey College\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-05-01\",\"perc\":\"95\"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"95\"}]'),(3,'asd@das.asd','YWJjZA==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'asd@das.asd','YWJjZA==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'newuser@gmail.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'test1@email.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'a@gmail.com','cGFzcw==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'new1@gmail.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'m@g.com','cGFzcw==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'p1@gmail.com','cGFzcw==','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Software engineer.\\nStudent at VCACS.\\nlearner.\\nexplorer.\"}','[{\"jobProfile\":\"jb\",\"company\":\"c\",\"startDate\":\"2024-01-01\",\"endDate\":\"2024-01-01\",\"summ\":\"brief summary.\\nbrief summary.\\nbrief summary.\\nbrief summary.\"}]','[\"skill 1\",\"skill 2\",\"skill 3\",\"skill 4\",\"skill 5\"]',NULL,NULL,NULL,NULL,'[{\"university\":\"uni\",\"degree\":\"deg\",\"startDate\":\"2024-01-01\",\"endDate\":\"2024-01-01\",\"perc\":\"92\"}]'),(11,'mohammed@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"Kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"As an experienced MERN stack developer I bring ideas to life with cutting-edge technology. \\nI thrive to create efficient and responsive solutions. \\nWith scalability, maintainability and user-centric designs as the main focus, I always strive to deliver the highest quality code to customers. \\nAs an effective listener and speaker, I can easily comprehend user\\u2019s requirements and cater to their needs.\"}','[{\"jobProfile\":\"SOFTWARE DEVELOPER INTERN\",\"company\":\"ELITE INFOSOFT\",\"startDate\":\"2023-06-01\",\"endDate\":\"2023-12-01\",\"summ\":\"Efficient and responsive implementation with proper documentation. Fine tuning and enhancing the product for minute details in the form of sprints. Created, updated and delivered three products within a span of five months. Negotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"SOFTWARE DEVELOPER INTERN\",\"company\":\"ELITE INFOSOFT\",\"startDate\":\"2024-01-01\",\"endDate\":\"2024-03-01\",\"summ\":\"Efficient and responsive implementation with proper documentation. Fine tuning and enhancing the product for minute details in the form of sprints. Created, updated and delivered three products within a span of five months. Negotiations with stakeholders for feature enhancement.\"}]','[\"HTML\",\"CSS \\/ Javascript\",\"JQuery\",\"Bootstrap\",\"Angular\",\"Angular JS\",\"React JS\",\"Firebase\",\"MySql\",\"PHP\",\"dotnet core\"]',NULL,NULL,NULL,NULL,'[{\"university\":\"VISHWAKARMA COLLEGE\",\"degree\":\"BACHELOR OF SCIENCE IN COMPUTER SCIENCE\",\"startDate\":\"2021-04-01\",\"endDate\":\"2024-04-01\",\"perc\":\"9.5\"},{\"university\":\"S.M. CHOKSEY COLLEGE\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-04-01\",\"perc\":\"95\"},{\"university\":\"MSB EDUCATIONAL INSTITUTE\",\"degree\":\"icse\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"\"}]');
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

-- Dump completed on 2024-03-01  9:02:21
