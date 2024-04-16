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

-- Create the database
CREATE DATABASE IF NOT EXISTS portfolio;

-- Switch to the created database
USE portfolio;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `brief_summary` text,
  `percentage` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `job_profile` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `brief_summary` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `repo_url` varchar(255) DEFAULT NULL,
  `live_project_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

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
  `education` text,
  `socials` text,
  `projects` text,
  `custom1` text,
  `custom2` text,
  `custom3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'abc@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Third year student, pursing Bachelor of Computer Science at VCACS.\\nWorking as a Software Developer at SquareClues.\\nTech stack: MEAN, PHP, .NET Core\\/ Framework, flutter, MySQL, Firebase\\nConnect with me @col.mohammedtaher@gmail.com\"}','[{\"jobProfile\":\"Software Developer Intern\",\"company\":\"Elite Infosoft\",\"startDate\":\"2023-06-20\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"2024-01-01\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Developer\",\"company\":\"Elite Infosoft\",\"startDate\":\"2024-01-01\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"2024-03-01\",\"summ\":\"  Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Engineer\",\"company\":\"SquareClues\",\"startDate\":\"2024-03-01\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"present\",\"summ\":\"1. Negotiations with clients for feature enhancement\\n2. Active applications development using agile methodology.\\n3. Tech stack: Firebase, Angular 2+\"}]','[\"Angular\",\"React\",\"NodeJs\",\"dotnet core\",\"flutter\",\"firebase\",\"mongodb\",\"python\",\"mysql\",\"php\",\"Firebase\"]',NULL,'[{\"university\":\"Vishwakarma College,\",\"degree\":\"Bachelor of Science in Computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-04-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"1. In-depth course work in the field of computer science.\\n2. Practical and hands-on experience in working according to industry standards\\n3. hands-on labs\\n4. Project creation.\",\"perc\":\"9.5\"},{\"university\":\"S.M. Choksey College\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-05-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"1. In-depth course work in the field of computer science.\\n2. Practical and hands-on experience in working according to industry standards\\n3. hands-on labs\\n4. Project creation.\",\"perc\":\"95\"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"1. In-depth course work in the field of computer science.\\n2. Practical and hands-on experience in working according to industry standards\\n3. hands-on labs\\n4. Project creation.\",\"perc\":\"95\"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"city\":\"city 1\",\"country\":\"country 1\",\"summary\":\"1. In-depth course work in the field of computer science.\\n2. Practical and hands-on experience in working according to industry standards\\n3. hands-on labs\\n4. Project creation.\",\"perc\":\"95\"}]','{\"website\":\"https:\\/\\/mohammedtaherali.netlify.app\\/\",\"instagram\":\"https:\\/\\/instagram.com\\/mohammedtaherali\",\"facebook\":\"https:\\/\\/facebook.com\\/mohammedtaherali\",\"twitter\":\"https:\\/\\/x.com\\/mohammedtaherali\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/in\\/mohammedtaherali\",\"github\":\"https:\\/\\/github.com\\/Mohammed-taherali\\/\"}','[{\"title\":\"Netflix clone\",\"repoUrl\":\"https:\\/\\/github.com\\/Mohammed-taherali\\/netflixClone\",\"projUrl\":\"https:\\/\\/netflixClone.netlify.app\\/\"},{\"title\":\"Tenzies app\",\"repoUrl\":\"https:\\/\\/github.com\\/Mohammed-taherali\\/tenzies\",\"projUrl\":\"https:\\/\\/mtc-tenzies-app.netlify.app\"},{\"title\":\"Todo App\",\"repoUrl\":\"https:\\/\\/github.com\\/Mohammed-taherali\\/todo-app\",\"projUrl\":\"https:\\/\\/mtc-todo-app.netlify.app\"}]',NULL,NULL,NULL),(3,'asd@das.asd','YWJjZA==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'asd@das.asd','YWJjZA==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'newuser@gmail.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'test1@email.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'a@gmail.com','cGFzcw==',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'new1@gmail.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'m@g.com','cGFzcw==','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Third year student, pursing Bachelor of Computer Science at VCACS.\\nWorking as a Software Developer at Elite Infosoft.\\nTech stack: MERN, PHP, .NET Core, flutter, MySql\\nConnect with me @col.mohammedtaher@gmail.com\"}','[{\"jobProfile\":\"Software Developer Intern\",\"company\":\"Elite Infosoft\",\"startDate\":\"2023-06-20\",\"endDate\":\"2023-12-31\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Developer\",\"company\":\"Elite Infosoft\",\"startDate\":\"2024-01-01\",\"endDate\":\"present\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"}]','[\"Angular\",\"React\",\"NodeJs\",\"dotnet core\",\"flutter\",\"firebase\",\"mongodb\",\"python\",\"mysql\",\"php\"]',NULL,'[{\"university\":\"Vishwakarma College,\",\"degree\":\"Bachelor of Science in Computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-04-01\",\"perc\":\"9.5\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"S.M. Choksey College\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-05-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"}]','{\"website\":\"website link\",\"instagram\":\"insta link\",\"facebook\":\"fb link\",\"twitter\":\"twitter link\",\"linkedin\":\"linkedin link\",\"github\":\"github link\"}','[{\"title\":\"p1 \",\"repoUrl\":\"REPO 1\",\"projUrl\":\"url 1\"},{\"title\":\"p2\",\"repoUrl\":\"repo 2\",\"projUrl\":\"url 2\"},{\"title\":\"p3\",\"repoUrl\":\"repo 3\",\"projUrl\":\"url 3\"}]',NULL,NULL,NULL),(10,'p1@gmail.com','cGFzcw==','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Software engineer.\\nStudent at VCACS.\\nlearner.\\nexplorer.\"}','[{\"jobProfile\":\"Software Developer Intern\",\"company\":\"Elite Infosoft\",\"startDate\":\"2023-06-20\",\"endDate\":\"2023-12-31\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Developer\",\"company\":\"Elite Infosoft\",\"startDate\":\"2024-01-01\",\"endDate\":\"present\",\"summ\":\"Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"}]','[\"Angular\",\"React\",\"NodeJs\",\"dotnet core\",\"flutter\",\"firebase\",\"mongodb\",\"python\",\"mysql\",\"php\"]',NULL,'[{\"university\":\"Vishwakarma College,\",\"degree\":\"Bachelor of Science in Computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-04-01\",\"perc\":\"9.5\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"S.M. Choksey College\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-05-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"perc\":\"95\", \"city\": \"city 1\", \"country\": \"country 1\", \"summary\": \"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \"}]',NULL,NULL,NULL,NULL,NULL),(11,'mohammed@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Third year student, pursing Bachelor of Computer Science at VCACS.\\nWorking as a Software Developer at Elite Infosoft.\\nTech stack: MERN, PHP, .NET Core, flutter, MySql\\nConnect with me @col.mohammedtaher@gmail.com\"}','[{\"jobProfile\":\"Software Developer Intern\",\"company\":\"Elite Infosoft\",\"startDate\":\"2023-06-20\",\"city\":\"\",\"country\":\"\",\"endDate\":\"\",\"summ\":\"    Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"},{\"jobProfile\":\"Software Developer\",\"company\":\"Elite Infosoft\",\"startDate\":\"2024-01-01\",\"city\":\"\",\"country\":\"\",\"endDate\":\"present\",\"summ\":\"    Efficient and responsive implementation with proper documentation.\\nFine tuning and enhancing the product for minute details in the form of sprints. \\nCreated, updated and delivered three products within a span of five months. \\nNegotiations with stakeholders for feature enhancement.\"}]','[\"Angular\",\"React\",\"NodeJs\",\"dotnet core\",\"flutter\",\"firebase\",\"mongodb\",\"python\",\"mysql\",\"php\"]',NULL,'[{\"university\":\"Vishwakarma College\",\"degree\":\"Bachelor of Science in Computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-04-01\",\"city\":\"city 1\",\"country\":\"country 1\",\"summary\":\"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \\\"\\\"\\\"\\\"\",\"perc\":\"9.5\"},{\"university\":\"S.M. Choksey College\",\"degree\":\"HSC\",\"startDate\":\"2019-10-01\",\"endDate\":\"2021-05-01\",\"city\":\"city 1\",\"country\":\"country 1\",\"summary\":\"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \\\"\\\"\\\"\\\"\",\"perc\":\"95\"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"city\":\"city 1\",\"country\":\"country 1\",\"summary\":\"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \\\"\\\"\\\"\\\"\",\"perc\":\"95\"},{\"university\":\"MSB Educational Institute\",\"degree\":\"ICSE\",\"startDate\":\"2013-04-01\",\"endDate\":\"2019-04-01\",\"city\":\"city 1\",\"country\":\"country 1\",\"summary\":\"lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. lorem ipsum long text very much. \\\"\\\"\\\"\\\"\",\"perc\":\"95\"}]','{\"website\":\"website link\",\"instagram\":\"insta link\",\"facebook\":\"fb link\",\"twitter\":\"twitter link\",\"linkedin\":\"linkedin link\",\"github\":\"github link\"}','[{\"title\":\"p1 \",\"repoUrl\":\"REPO 1\",\"projUrl\":\"url 1\"},{\"title\":\"p2\",\"repoUrl\":\"repo 2\",\"projUrl\":\"url 2\"},{\"title\":\"p3\",\"repoUrl\":\"repo 3\",\"projUrl\":\"url 3\"},{\"title\":\"latest updated project yay!\",\"repoUrl\":\"repo url\",\"projUrl\":\"proj url\"}]',NULL,NULL,NULL),(12,'mohammedtaher@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Mohammed\",\"lname\":\"Taherali\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"+918855020434\",\"aboutMe\":\"Hi everyone, I am Mohammed Taherali.\\nCurrently a final year student pursing BSc(CS) from VCACS.\\nI like to code, read, cycle etc. \"}','[{\"jobProfile\":\"Profile 1\",\"company\":\"Company 1\",\"startDate\":\"2023-07-01\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"2023-12-31\",\"summ\":\"Brief summary of what i did.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\"},{\"jobProfile\":\"Profile 2\",\"company\":\"Company 2\",\"startDate\":\"2024-01-01\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"present\",\"summ\":\"I did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\"}]','[\"s1\",\"s2\",\"s3\",\"s4\",\"s5\",\"s6\",\"s7\",\"s8\",\"s9\",\"s10\"]',NULL,'[{\"university\":\"Uni 1\",\"degree\":\"Degree 1\",\"startDate\":\"2019-01-01\",\"endDate\":\"2021-01-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"I did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\",\"perc\":\"90\"},{\"university\":\"Uni 2\",\"degree\":\"Degree 2\",\"startDate\":\"2021-01-01\",\"endDate\":\"2024-01-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"I did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\\nI did many things etc etc.\",\"perc\":\"92\"}]','{\"website\":\"My Website link\",\"instagram\":\"Insta link\",\"facebook\":\"fb link\",\"twitter\":\"twitter link\",\"linkedin\":\"linkedin link\",\"github\":\"github link\"}','[{\"title\":\"p1\",\"repoUrl\":\"repo 1\",\"projUrl\":\"url 1\"},{\"title\":\"p2 \",\"repoUrl\":\"repo 2\",\"projUrl\":\"url 2\"}]',NULL,NULL,NULL),(13,'mohammedtaherali5253@gmail.com','cGFzc3dvcmQ=',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'uzair@gmail.com','cGFzc3dvcmQ=','{\"fname\":\"Uzair\",\"lname\":\"Mannur\",\"street\":\"kondhwa\",\"city\":\"Pune\",\"state\":\"Maharashtra\",\"pincode\":\"411048\",\"contact\":\"9519159494\",\"aboutMe\":\"Hello, My name is Uzair Mannur.\\nCurrently a final year student pursuing Bsc(CS) at VCACS, Pune.\"}','[{\"jobProfile\":\"Devops Intern\",\"company\":\"Rotona\",\"startDate\":\"2024-01-01\",\"city\":\"Pune\",\"country\":\"India\",\"endDate\":\"present\",\"summ\":\"Using Devops to make life of developers easier.\\nmaking CI\\/CD pipelines to increase development speed.\\nusing ELK for data processing.\"}]','[\"HTML\",\"CSS\",\"JS\",\"Bootstrap\",\"Django\",\"Python\",\"C\",\"C++\",\"Java\",\"MySQL\"]',NULL,'[{\"university\":\"VCACS\",\"degree\":\"Bachelor\'s of computer Science\",\"startDate\":\"2021-05-01\",\"endDate\":\"2024-05-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum\",\"perc\":\"9.10\"},{\"university\":\"Poona College\",\"degree\":\"HSC\",\"startDate\":\"2019-05-01\",\"endDate\":\"2021-05-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum\",\"perc\":\"89\"},{\"university\":\"Sungrace High School\",\"degree\":\"SSC\",\"startDate\":\"2009-05-01\",\"endDate\":\"2019-05-01\",\"city\":\"Pune\",\"country\":\"India\",\"summary\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum\",\"perc\":\"84\"}]','{\"website\":\"\",\"instagram\":\"insta link\",\"facebook\":\"fb link\",\"twitter\":\"twitter link\",\"linkedin\":\"linkedin link\",\"github\":\"github link\"}','[{\"title\":\"Amazon clone\",\"repoUrl\":\"amazon clone repo\",\"projUrl\":\"www.amazon.in\"}]',NULL,NULL,NULL);
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

-- Dump completed on 2024-04-16  7:29:08
