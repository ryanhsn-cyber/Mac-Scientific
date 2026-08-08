-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: demo_ecommerce_e_commerce_23
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@macscientific.com','01775457008','17097300021260370.png',0,'$2y$10$Bi2ppNkvdx/7aGe55I6fyuQ4e8hFlA0Q6wBUD7MSSDpqiwC3JAUNS',NULL,'2018-02-28 23:27:08','2024-03-06 21:00:02'),(3,'Admin','siteadmin@shohojsolution.com','01735544074','17097300021260370.png',0,'$2y$10$40vkfh20RukQnS7YyC2uBuPb92urwUkdefzil9XTlbUZXlFl5BTki',NULL,'2018-02-28 23:27:08','2024-03-06 21:00:02');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attribute_options`
--

DROP TABLE IF EXISTS `attribute_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribute_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'unlimited',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribute_options`
--

LOCK TABLES `attribute_options` WRITE;
/*!40000 ALTER TABLE `attribute_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `attribute_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributes`
--

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Shein Womens Clothing 2021 Summer Fashion Design Clothing Manufacturer Lantern Long Sleeve','45% OFF','#','163172091306.jpg',' Banner 1',1,NULL,NULL),(2,'Casual Minimalist Tie Waist women clothing Denim Halter Midi Pencil Sling Dresses','70% OFF','#','163172090805.jpg','Banner 2',1,NULL,NULL),(3,'Top Sale High Quality Newest Designs Custom Women Clothing Wholesale from China Dresses','60% OFF','#','163172090304.jpg','Banner 3',1,NULL,NULL),(5,'2021 Summer Women Clothing Ropa Sexy Lady Cut Out Halter Mini Dresses','50% OFF','#','163172089704.jpg','Banner 4',1,NULL,NULL);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bcategories`
--

DROP TABLE IF EXISTS `bcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bcategories`
--

LOCK TABLES `bcategories` WRITE;
/*!40000 ALTER TABLE `bcategories` DISABLE KEYS */;
INSERT INTO `bcategories` VALUES (1,'Beauty','Beauty',1,NULL,NULL),(2,'Fashion','fashion',1,NULL,NULL);
/*!40000 ALTER TABLE `bcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_popular` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_items`
--

DROP TABLE IF EXISTS `campaign_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_feature` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_items`
--

LOCK TABLES `campaign_items` WRITE;
/*!40000 ALTER TABLE `campaign_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `is_feature` tinyint(4) DEFAULT '1',
  `serial` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (18,'PRP','prp','17097173381320765.png','[{\"value\":\"women\"}]','Women Clothing',1,1,1,NULL,NULL),(19,'PRF','prf','17097296381612817.png','[{\"value\":\"men\"}]','men',1,1,2,NULL,NULL),(21,'INJECTION','injection','17097297312642651.png',NULL,NULL,1,1,3,NULL,NULL),(22,'Labware','labware','17097298082621689.png',NULL,NULL,1,1,4,NULL,NULL),(23,'Dermalfiller','dermalfiller','17097298922080183.png',NULL,NULL,1,1,5,NULL,NULL),(24,'MICRONEEDLING','microneedling','17097299581260370.png',NULL,NULL,1,1,6,NULL,NULL),(25,'Care','care','17097299722642651.png',NULL,NULL,1,1,7,NULL,NULL),(26,'Threadlifting','threadlifting','17097065881546661.png',NULL,NULL,1,1,8,NULL,NULL),(27,'Med courses','med-courses','17097299812642651.png',NULL,NULL,1,1,9,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chield_categories`
--

DROP TABLE IF EXISTS `chield_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chield_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chield_categories`
--

LOCK TABLES `chield_categories` WRITE;
/*!40000 ALTER TABLE `chield_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `chield_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan',NULL,NULL),(2,'Albania',NULL,NULL),(3,'Algeria',NULL,NULL),(4,'American Samoa',NULL,NULL),(5,'Andorra',NULL,NULL),(6,'Angola',NULL,NULL),(7,'Anguilla',NULL,NULL),(8,'Antarctica',NULL,NULL),(9,'Antigua and Barbuda',NULL,NULL),(10,'Argentina',NULL,NULL),(11,'Armenia',NULL,NULL),(12,'Aruba',NULL,NULL),(13,'Australia',NULL,NULL),(14,'Austria',NULL,NULL),(15,'Azerbaijan',NULL,NULL),(16,'Bahamas',NULL,NULL),(17,'Bahrain',NULL,NULL),(18,'Bangladesh',NULL,NULL),(19,'Barbados',NULL,NULL),(20,'Belarus',NULL,NULL),(21,'Belgium',NULL,NULL),(22,'Belize',NULL,NULL),(23,'Benin',NULL,NULL),(24,'Bermuda',NULL,NULL),(25,'Bhutan',NULL,NULL),(26,'Bolivia',NULL,NULL),(27,'Bosnia and Herzegovina',NULL,NULL),(28,'Botswana',NULL,NULL),(29,'Bouvet Island',NULL,NULL),(30,'Brazil',NULL,NULL),(31,'British Indian Ocean Territory',NULL,NULL),(32,'Brunei Darussalam',NULL,NULL),(33,'Bulgaria',NULL,NULL),(34,'Burkina Faso',NULL,NULL),(35,'Burundi',NULL,NULL),(36,'Cambodia',NULL,NULL),(37,'Cameroon',NULL,NULL),(38,'Canada',NULL,NULL),(39,'Cape Verde',NULL,NULL),(40,'Cayman Islands',NULL,NULL),(41,'Central African Republic',NULL,NULL),(42,'Chad',NULL,NULL),(43,'Chile',NULL,NULL),(44,'China',NULL,NULL),(45,'Christmas Island',NULL,NULL),(46,'Cocos (Keeling) Islands',NULL,NULL),(47,'Colombia',NULL,NULL),(48,'Comoros',NULL,NULL),(49,'Democratic Republic of the Congo',NULL,NULL),(50,'Republic of Congo',NULL,NULL),(51,'Cook Islands',NULL,NULL),(52,'Costa Rica',NULL,NULL),(53,'Croatia (Hrvatska)',NULL,NULL),(54,'Cuba',NULL,NULL),(55,'Cyprus',NULL,NULL),(56,'Czech Republic',NULL,NULL),(57,'Denmark',NULL,NULL),(58,'Djibouti',NULL,NULL),(59,'Dominica',NULL,NULL),(60,'Dominican Republic',NULL,NULL),(61,'East Timor',NULL,NULL),(62,'Ecuador',NULL,NULL),(63,'Egypt',NULL,NULL),(64,'El Salvador',NULL,NULL),(65,'Equatorial Guinea',NULL,NULL),(66,'Eritrea',NULL,NULL),(67,'Estonia',NULL,NULL),(68,'Ethiopia',NULL,NULL),(69,'Falkland Islands (Malvinas)',NULL,NULL),(70,'Faroe Islands',NULL,NULL),(71,'Fiji',NULL,NULL),(72,'Finland',NULL,NULL),(73,'France',NULL,NULL),(74,'France, Metropolitan',NULL,NULL),(75,'French Guiana',NULL,NULL),(76,'French Polynesia',NULL,NULL),(77,'French Southern Territories',NULL,NULL),(78,'Gabon',NULL,NULL),(79,'Gambia',NULL,NULL),(80,'Georgia',NULL,NULL),(81,'Germany',NULL,NULL),(82,'Ghana',NULL,NULL),(83,'Gibraltar',NULL,NULL),(84,'Guernsey',NULL,NULL),(85,'Greece',NULL,NULL),(86,'Greenland',NULL,NULL),(87,'Grenada',NULL,NULL),(88,'Guadeloupe',NULL,NULL),(89,'Guam',NULL,NULL),(90,'Guatemala',NULL,NULL),(91,'Guinea',NULL,NULL),(92,'Guinea-Bissau',NULL,NULL),(93,'Guyana',NULL,NULL),(94,'Haiti',NULL,NULL),(95,'Heard and Mc Donald Islands',NULL,NULL),(96,'Honduras',NULL,NULL),(97,'Hong Kong',NULL,NULL),(98,'Hungary',NULL,NULL),(99,'Iceland',NULL,NULL),(100,'India',NULL,NULL),(101,'Isle of Man',NULL,NULL),(102,'Indonesia',NULL,NULL),(103,'Iran (Islamic Republic of)',NULL,NULL),(104,'Iraq',NULL,NULL),(105,'Ireland',NULL,NULL),(106,'Israel',NULL,NULL),(107,'Italy',NULL,NULL),(108,'Ivory Coast',NULL,NULL),(109,'Jersey',NULL,NULL),(110,'Jamaica',NULL,NULL),(111,'Japan',NULL,NULL),(112,'Jordan',NULL,NULL),(113,'Kazakhstan',NULL,NULL),(114,'Kenya',NULL,NULL),(115,'Kiribati',NULL,NULL),(116,'Korea, Democratic People\'s Republic of',NULL,NULL),(118,'Kosovo',NULL,NULL),(119,'Kuwait',NULL,NULL),(120,'Kyrgyzstan',NULL,NULL),(121,'Lao People\'s Democratic Republic',NULL,NULL),(122,'Latvia',NULL,NULL),(123,'Lebanon',NULL,NULL),(124,'Lesotho',NULL,NULL),(125,'Liberia',NULL,NULL),(126,'Libyan Arab Jamahiriya',NULL,NULL),(127,'Liechtenstein',NULL,NULL),(128,'Lithuania',NULL,NULL),(129,'Luxembourg',NULL,NULL),(130,'Macau',NULL,NULL),(131,'North Macedonia',NULL,NULL),(132,'Madagascar',NULL,NULL),(133,'Malawi',NULL,NULL),(134,'Malaysia',NULL,NULL),(135,'Maldives',NULL,NULL),(136,'Mali',NULL,NULL),(137,'Malta',NULL,NULL),(138,'Marshall Islands',NULL,NULL),(139,'Martinique',NULL,NULL),(140,'Mauritania',NULL,NULL),(141,'Mauritius',NULL,NULL),(142,'Mayotte',NULL,NULL),(143,'Mexico',NULL,NULL),(144,'Micronesia, Federated States of',NULL,NULL),(145,'Moldova, Republic of',NULL,NULL),(146,'Monaco',NULL,NULL),(147,'Mongolia',NULL,NULL),(148,'Montenegro',NULL,NULL),(149,'Montserrat',NULL,NULL),(150,'Morocco',NULL,NULL),(151,'Mozambique',NULL,NULL),(152,'Myanmar',NULL,NULL),(153,'Namibia',NULL,NULL),(154,'Nauru',NULL,NULL),(155,'Nepal',NULL,NULL),(156,'Netherlands',NULL,NULL),(157,'Netherlands Antilles',NULL,NULL),(158,'New Caledonia',NULL,NULL),(159,'New Zealand',NULL,NULL),(160,'Nicaragua',NULL,NULL),(161,'Niger',NULL,NULL),(162,'Nigeria',NULL,NULL),(163,'Niue',NULL,NULL),(164,'Norfolk Island',NULL,NULL),(165,'Northern Mariana Islands',NULL,NULL),(166,'Norway',NULL,NULL),(167,'Oman',NULL,NULL),(168,'Pakistan',NULL,NULL),(169,'Palau',NULL,NULL),(170,'Palestine',NULL,NULL),(171,'Panama',NULL,NULL),(172,'Papua New Guinea',NULL,NULL),(173,'Paraguay',NULL,NULL),(174,'Peru',NULL,NULL),(175,'Philippines',NULL,NULL),(176,'Pitcairn',NULL,NULL),(177,'Poland',NULL,NULL),(178,'Portugal',NULL,NULL),(179,'Puerto Rico',NULL,NULL),(180,'Qatar',NULL,NULL),(181,'Reunion',NULL,NULL),(182,'Romania',NULL,NULL),(183,'Russian Federation',NULL,NULL),(184,'Rwanda',NULL,NULL),(185,'Saint Kitts and Nevis',NULL,NULL),(186,'Saint Lucia',NULL,NULL),(187,'Saint Vincent and the Grenadines',NULL,NULL),(188,'Samoa',NULL,NULL),(189,'San Marino',NULL,NULL),(190,'Sao Tome and Principe',NULL,NULL),(191,'Saudi Arabia',NULL,NULL),(192,'Senegal',NULL,NULL),(193,'Serbia',NULL,NULL),(194,'Seychelles',NULL,NULL),(195,'Sierra Leone',NULL,NULL),(196,'Singapore',NULL,NULL),(197,'Slovakia',NULL,NULL),(198,'Slovenia',NULL,NULL),(199,'Solomon Islands',NULL,NULL),(200,'Somalia',NULL,NULL),(201,'South Africa',NULL,NULL),(202,'South Georgia South Sandwich Islands',NULL,NULL),(203,'South Sudan',NULL,NULL),(204,'Spain',NULL,NULL),(205,'Sri Lanka',NULL,NULL),(206,'St. Helena',NULL,NULL),(207,'St. Pierre and Miquelon',NULL,NULL),(208,'Sudan',NULL,NULL),(209,'Suriname',NULL,NULL),(210,'Svalbard and Jan Mayen Islands',NULL,NULL),(211,'Swaziland',NULL,NULL),(212,'Sweden',NULL,NULL),(213,'Switzerland',NULL,NULL),(214,'Syrian Arab Republic',NULL,NULL),(215,'Taiwan',NULL,NULL),(216,'Tajikistan',NULL,NULL),(217,'Tanzania, United Republic of',NULL,NULL),(218,'Thailand',NULL,NULL),(219,'Togo',NULL,NULL),(220,'Tokelau',NULL,NULL),(221,'Tonga',NULL,NULL),(222,'Trinidad and Tobago',NULL,NULL),(223,'Tunisia',NULL,NULL),(224,'Turkey',NULL,NULL),(225,'Turkmenistan',NULL,NULL),(226,'Turks and Caicos Islands',NULL,NULL),(227,'Tuvalu',NULL,NULL),(228,'Uganda',NULL,NULL),(229,'Ukraine',NULL,NULL),(230,'United Arab Emirates',NULL,NULL),(231,'United Kingdom',NULL,NULL),(232,'United States',NULL,NULL),(233,'United States minor outlying islands',NULL,NULL),(234,'Uruguay',NULL,NULL),(235,'Uzbekistan',NULL,NULL),(236,'Vanuatu',NULL,NULL),(237,'Vatican City State',NULL,NULL),(238,'Venezuela',NULL,NULL),(239,'Vietnam',NULL,NULL),(240,'Virgin Islands (British)',NULL,NULL),(241,'Virgin Islands (U.S.)',NULL,NULL),(242,'Wallis and Futuna Islands',NULL,NULL),(243,'Western Sahara',NULL,NULL),(244,'Yemen',NULL,NULL),(245,'Zambia',NULL,NULL),(246,'Zimbabwe',NULL,NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD','$',1,0,NULL,NULL),(8,'BDT','৳',84,1,NULL,NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `body` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Order','Your Have Successfully Placed The Order','<p>Hello {user_name},</p><p>Your Order Has Been Placed Successfilly.<br>Your Order Number is {transaction_number}.<br></p>',NULL,NULL),(2,'Registration','Welcome To Online Baby Shop','<p>Hello ; {user_name},</p><p>You have successfully registered to {site_title}, We wish you will have a wonderful experience using our service.</p><p>Thank You .<br></p>',NULL,NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_settings`
--

DROP TABLE IF EXISTS `extra_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extra_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `is_t4_slider` tinyint(4) DEFAULT '1',
  `is_t4_featured_banner` tinyint(4) DEFAULT '1',
  `is_t4_specialpick` tinyint(4) DEFAULT '1',
  `is_t4_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t4_flashdeal` tinyint(4) DEFAULT '1',
  `is_t4_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t4_popular_category` tinyint(4) DEFAULT '1',
  `is_t4_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t4_blog_section` tinyint(4) DEFAULT '1',
  `is_t4_brand_section` tinyint(4) DEFAULT '1',
  `is_t4_service_section` tinyint(4) DEFAULT '1',
  `is_t3_slider` tinyint(4) DEFAULT '1',
  `is_t3_service_section` tinyint(4) DEFAULT '1',
  `is_t3_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t3_popular_category` tinyint(4) DEFAULT '1',
  `is_t3_flashdeal` tinyint(4) DEFAULT '1',
  `is_t3_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t3_pecialpick` tinyint(4) DEFAULT '1',
  `is_t3_brand_section` tinyint(4) DEFAULT '1',
  `is_t3_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t3_blog_section` tinyint(4) DEFAULT '1',
  `is_t2_slider` tinyint(4) DEFAULT '1',
  `is_t2_service_section` tinyint(4) DEFAULT '1',
  `is_t2_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t2_flashdeal` tinyint(4) DEFAULT '1',
  `is_t2_new_product` tinyint(4) DEFAULT '1',
  `is_t2_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t2_featured_product` tinyint(4) DEFAULT '1',
  `is_t2_bestseller_product` tinyint(4) DEFAULT '1',
  `is_t2_toprated_product` tinyint(4) DEFAULT '1',
  `is_t2_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t2_blog_section` tinyint(4) DEFAULT '1',
  `is_t2_brand_section` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_t1_falsh` tinyint(4) DEFAULT '1',
  `is_t2_falsh` tinyint(4) DEFAULT '1',
  `is_t3_falsh` tinyint(4) DEFAULT '1',
  `is_t4_falsh` tinyint(4) DEFAULT '1',
  `is_t2_three_column_category` tinyint(4) DEFAULT '1',
  `is_t3_three_column_category` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_settings`
--

LOCK TABLES `extra_settings` WRITE;
/*!40000 ALTER TABLE `extra_settings` DISABLE KEYS */;
INSERT INTO `extra_settings` VALUES (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,0,0,1,0,1,1,0,0,1,0,NULL,NULL,0,1,1,1,0,1);
/*!40000 ALTER TABLE `extra_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (15,1,'How can I purchase it ?','Voluptatibus enim, aut natus sint porro veniam atque obcaecati ullam, consequatur laboriosam laborum corrupti autem fugit',NULL,NULL,NULL,NULL),(25,1,'Anim pariatur cliche reprehenderit ?','Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus.',NULL,NULL,NULL,NULL),(27,1,'Smartphones in Every Day Life ?','afdads','[{\"value\":\"ad\"},{\"value\":\"fd\"}]','dfa',NULL,NULL),(28,3,'Lorem ipsum dolor sit amet, consectetur adipiscing  ?','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',NULL,NULL,NULL,NULL),(29,3,'But I must explain to you how all this mistaken idea ?','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, cons',NULL,NULL,NULL,NULL),(30,3,'Where does it come from ?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',NULL,NULL,NULL,NULL),(31,4,'Where can I get some ?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.',NULL,NULL,NULL,NULL),(32,4,'Why do we use it?','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',NULL,NULL,NULL,NULL),(33,4,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',NULL,NULL,NULL,NULL),(34,4,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',NULL,NULL,NULL,NULL),(35,5,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',NULL,NULL,NULL,NULL),(36,5,'Why do we use it?','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',NULL,NULL,NULL,NULL),(37,5,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',NULL,NULL,NULL,NULL),(38,6,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',NULL,NULL,NULL,NULL),(39,6,'Why do we use it?','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',NULL,NULL,NULL,NULL),(40,6,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',NULL,NULL,NULL,NULL),(41,7,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',NULL,NULL,NULL,NULL),(42,7,'Why do we use it?','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',NULL,NULL,NULL,NULL),(43,7,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fcategories`
--

DROP TABLE IF EXISTS `fcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fcategories`
--

LOCK TABLES `fcategories` WRITE;
/*!40000 ALTER TABLE `fcategories` DISABLE KEYS */;
INSERT INTO `fcategories` VALUES (1,'Electronics !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Electronics-',NULL,NULL,1,NULL,NULL),(3,'Poroduct Delevery !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Poroduct-Delevery-','[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]','It is a long established fact that a r',1,NULL,NULL),(4,'Discount Policy !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Discount-Policy-',NULL,NULL,1,NULL,NULL),(5,'Vat Information !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Vat-Information-',NULL,NULL,1,NULL,NULL),(6,'Coupon  Information !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Coupon--Information-',NULL,NULL,1,NULL,NULL),(7,'Offer Information !','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born','Offer-Information-',NULL,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `fcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,1,'hZn4ACD+GEL-10ml.png',NULL,NULL),(2,2,'bnBXPRP TUBE =ACD+GEL  (3).jpg',NULL,NULL),(3,3,'CnxD4.jpeg',NULL,NULL),(4,4,'i2egKXGyUv.png',NULL,NULL),(5,4,'ZY2cfVdB51.webp',NULL,NULL),(6,4,'ozeaIOD5tJ.jpeg',NULL,NULL),(7,4,'oK3w3IQGBV.jpeg',NULL,NULL),(8,4,'1sk4dUtJl8.jpeg',NULL,NULL),(9,5,'ch38vkDDS6.mp4',NULL,NULL),(10,5,'KQVDzjLNgr.jpeg',NULL,NULL),(11,5,'Pdpbvrz3X3.jpeg',NULL,NULL),(12,5,'zLgUPkyETW.jpeg',NULL,NULL),(13,5,'p3CWHfEDDV.jpeg',NULL,NULL),(14,5,'EcLj01SgeO.jpeg',NULL,NULL),(15,5,'tCc43uxZt2.jpeg',NULL,NULL),(16,5,'qkPo4uTQxD.jpeg',NULL,NULL),(17,5,'7wOLOepg1d.jpeg',NULL,NULL),(18,5,'EtwRSif3v9.jpeg',NULL,NULL),(19,5,'fhWJmMiXLC.jpeg',NULL,NULL),(20,5,'LVA9xKo516.jpeg',NULL,NULL),(21,5,'6SSninrMFL.jpeg',NULL,NULL),(22,5,'68SBtyzq4b.docx',NULL,NULL),(23,5,'otAkUCysK7.docx',NULL,NULL),(24,6,'EZKEcFJnGP.png',NULL,NULL),(25,7,'5K3IYLA4SZ.jpeg',NULL,NULL),(26,7,'DYjMymhAR9.jpeg',NULL,NULL),(27,7,'JfC6IE2Qcv.jpeg',NULL,NULL),(28,7,'kP3MgHlGMv.jpeg',NULL,NULL),(29,7,'AbJFpDaGRk.jpeg',NULL,NULL),(30,7,'IRVSgMBu3P.jpeg',NULL,NULL),(31,7,'MxILTwg59j.docx',NULL,NULL),(32,8,'PyIbyux6rI.docx',NULL,NULL),(33,8,'lGw1uTNq1e.png',NULL,NULL),(34,8,'KNkIObRKGJ.png',NULL,NULL),(35,8,'6exVqvLpZf.png',NULL,NULL),(36,8,'gF8srj4zNu.png',NULL,NULL),(37,8,'ggADSEIuUT.png',NULL,NULL),(38,8,'kGlBFrSPwo.png',NULL,NULL),(39,8,'W8CNQWGnW0.webp',NULL,NULL),(40,8,'CqajhaDwiB.png',NULL,NULL),(41,9,'Rh9PU8F9tU.png',NULL,NULL),(42,9,'c8TNmfESq1.png',NULL,NULL),(43,9,'MhKfSw0DA5.png',NULL,NULL),(44,9,'UdgGcCEeqq.png',NULL,NULL),(45,9,'p3gOVtUQnH.docx',NULL,NULL),(46,10,'BJni8PqWkm.jpeg',NULL,NULL),(47,10,'F3QEkUnYZe.jpeg',NULL,NULL),(48,10,'SeTElTfRPB.jpeg',NULL,NULL),(49,10,'eRrnVpDywz.jpeg',NULL,NULL),(50,10,'VOApsg5Po6.pdf',NULL,NULL),(51,10,'9lPeDNSAyr.docx',NULL,NULL),(52,10,'v89yeLDYI0.png',NULL,NULL),(53,10,'BgYtbwRnTJ.webp',NULL,NULL),(54,11,'xRW2lJkmAA.docx',NULL,NULL),(55,11,'IbfZNyBI95.zip',NULL,NULL),(56,11,'27NkQQypCj.pdf',NULL,NULL),(57,12,'xzIf3YPx0o.jpg',NULL,NULL),(58,12,'AeVGNAQZnm.mp4',NULL,NULL),(59,12,'yOjaPeLMAl.jpeg',NULL,NULL),(60,12,'vFAT4BAULF.jpeg',NULL,NULL),(61,12,'5lRKnRMAfU.jpeg',NULL,NULL),(62,12,'0kxilSiV4j.jpeg',NULL,NULL),(63,12,'OyO580Sp7d.jpg',NULL,NULL),(64,12,'4yQxKa5B7a.jpeg',NULL,NULL),(65,12,'7BwPQ3zz0A.jpg',NULL,NULL),(66,12,'uMx0d0lXIk.avif',NULL,NULL),(67,12,'HARp44jPiK.jpeg',NULL,NULL),(68,12,'aIwFr7ZERJ.jpeg',NULL,NULL),(69,12,'BSuKEuURae.jpeg',NULL,NULL),(70,12,'0qw4wEEgff.jpeg',NULL,NULL),(71,12,'PRcKKFjWMu.jpeg',NULL,NULL),(72,12,'Mol7vRLJsL.avif',NULL,NULL),(73,12,'v0dFXp8BXS.docx',NULL,NULL),(74,13,'CffhPnYXVK.docx',NULL,NULL),(75,13,'ze8G44nNXC.jpg',NULL,NULL),(76,13,'29RSvHpSEw.jpg',NULL,NULL),(77,13,'2dqYfetpWv.jpg',NULL,NULL),(78,13,'VWSwLZxGoL.jpg',NULL,NULL),(79,13,'8x9gcMRgJj.jpg',NULL,NULL),(80,13,'ce41lHEoCM.jpg',NULL,NULL),(81,13,'4wppAIwlN7.docx',NULL,NULL),(100,16,'rJTJJUdfhT.jpeg',NULL,NULL),(101,16,'CdNsSw0L0f.jpeg',NULL,NULL),(102,16,'pzWzEmMdyQ.jpeg',NULL,NULL),(103,16,'ToHkBwYJMZ.jpeg',NULL,NULL),(104,17,'IHnU7dRw0Y.jpg',NULL,NULL),(105,17,'JfvHkLQr8z.jpg',NULL,NULL),(106,17,'YOHmD3HAik.jpg',NULL,NULL),(107,17,'hXsfe0gk4E.jpg',NULL,NULL),(108,17,'wrl4O713wM.jpg',NULL,NULL),(109,18,'0oxx7LAiz2.png',NULL,NULL),(110,18,'mMgConnv64.jpg',NULL,NULL),(111,18,'KDTNfhfl2w.jpg',NULL,NULL),(112,18,'LwyZDIL39Z.jpg',NULL,NULL),(113,18,'BJS6njDgVu.jpg',NULL,NULL),(114,18,'v969eUYLoA.jpg',NULL,NULL),(115,18,'lXmiJQnrnI.jpg',NULL,NULL),(116,18,'x0M4rd32eQ.jpg',NULL,NULL),(117,18,'LZQZiYwLPN.jpg',NULL,NULL),(118,18,'eRb6fxOMHR.docx',NULL,NULL),(119,18,'x0IE20mWU3.jpg',NULL,NULL),(120,18,'xjziU5VVgB.png',NULL,NULL),(121,18,'8iVoVNAbNE.png',NULL,NULL),(122,19,'JQ2gLjSMcs.jpeg',NULL,NULL),(123,19,'ywWDasXXwu.jpg',NULL,NULL),(124,19,'vrNLJhN2Sm.webp',NULL,NULL),(125,19,'gXNKxSpH33.webp',NULL,NULL),(126,19,'TVvQWLDRo5.webp',NULL,NULL),(127,19,'Eqi9p0kyPp.webp',NULL,NULL),(128,19,'mQ4bl3hWyw.webp',NULL,NULL),(129,19,'AXUkaOIKZ0.webp',NULL,NULL),(130,19,'kcQwmFjNa6.jpeg',NULL,NULL),(131,19,'IVOV58MpCn.jpg',NULL,NULL),(132,19,'LDOW5PFswJ.jpeg',NULL,NULL),(133,19,'MwkqwyKFLY.jpg',NULL,NULL),(134,19,'wSD7HSfqaF.jpeg',NULL,NULL),(135,19,'QeM5gCq80P.jpg',NULL,NULL),(136,19,'9AT1OfpVf0.jpeg',NULL,NULL),(137,19,'4TGUMYw6GP.docx',NULL,NULL),(138,19,'igOOjEbpUo.jpg',NULL,NULL),(139,20,'0yR5cLhzZO.jpeg',NULL,NULL),(140,20,'a1d2OTMMTZ.jpeg',NULL,NULL),(141,20,'Szy4RstNTA.jpeg',NULL,NULL),(142,20,'gQHlCEyqF3.jpeg',NULL,NULL),(143,20,'b8xnQk43lm.jpeg',NULL,NULL),(144,20,'Go1STj2Z9b.jpg',NULL,NULL),(145,20,'lKzpjguN5D.jpg',NULL,NULL),(146,20,'4c9rx6aGer.jpg',NULL,NULL),(147,20,'2mhkBAiVvR.png',NULL,NULL),(148,20,'Sy4wXHdWrq.jpg',NULL,NULL),(149,20,'WwUheK22aO.docx',NULL,NULL),(150,20,'2sn6dkYGM1.docx',NULL,NULL),(151,20,'3liaXEehB3.docx',NULL,NULL),(152,20,'6m0nzZhLdL.docx',NULL,NULL),(153,21,'8DEXRZsAxl.jpeg',NULL,NULL),(154,21,'TMWrkxBt8j.jpg',NULL,NULL);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_cutomizes`
--

DROP TABLE IF EXISTS `home_cutomizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_cutomizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banner_first` text COLLATE utf8mb4_unicode_ci,
  `banner_secend` text COLLATE utf8mb4_unicode_ci,
  `banner_third` text COLLATE utf8mb4_unicode_ci,
  `popular_category` text COLLATE utf8mb4_unicode_ci,
  `two_column_category` text COLLATE utf8mb4_unicode_ci,
  `feature_category` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page4` text COLLATE utf8mb4_unicode_ci,
  `home_4_popular_category` text COLLATE utf8mb4_unicode_ci,
  `hero_banner` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_cutomizes`
--

LOCK TABLES `home_cutomizes` WRITE;
/*!40000 ALTER TABLE `home_cutomizes` DISABLE KEYS */;
INSERT INTO `home_cutomizes` VALUES (1,'{\"title1\":\"Babys Items\",\"subtitle1\":\"50% OFF\",\"firsturl1\":\"#\",\"title2\":\"Fathers\",\"subtitle2\":\"40% OFF\",\"firsturl2\":\"#\",\"title3\":\"Home\",\"subtitle3\":\"30% OFF\",\"firsturl3\":\"#\",\"img1\":\"IyAnc_ban7.png\",\"img2\":\"lXcoc_ban7.png\",\"img3\":\"V4rwc_ban7.png\"}','{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Man\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"title3\":\"Headphone\",\"subtitle3\":\"60% OFF\",\"url3\":\"#\",\"img1\":\"ST2oc_ban7.png\",\"img2\":\"9Ci4c_ban7.png\",\"img3\":\"PNmdc_ban7.png\"}','{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Headphones\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img1\":\"LcoLc_ban7.png\",\"img2\":\"5YhAc_ban7.png\"}','{\"popular_title\":\"Popular Categories\",\"category_id1\":\"18\",\"subcategory_id1\":\"6\",\"childcategory_id1\":null,\"category_id2\":\"19\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}','{\"category_id1\":\"27\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"22\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null}','{\"feature_title\":\"Featured Categories\",\"category_id1\":\"18\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"27\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}',NULL,NULL,'{\"label1\":\"FORMAL\",\"url1\":\"#\",\"label2\":\"LIMITEN EDITION\",\"url2\":\"#\",\"label3\":\"WOMEN\'S COLLECTION\",\"url3\":\"#\",\"label4\":\"SMART CASUALS\",\"url4\":\"#\",\"label5\":\"POLO\",\"url5\":\"#\",\"img1\":\"16368975771.jpg\",\"img2\":\"16368975772.jpg\",\"img3\":\"16368975773.jpg\",\"img4\":\"16368975774.jpg\",\"img5\":\"16368975775.jpg\"}','[\"18\",\"19\",\"21\",\"27\"]','{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Man\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img1\":\"bkWtScreenshot_18.png\",\"img2\":\"bACFScreenshot_17.png\"}');
/*!40000 ALTER TABLE `home_cutomizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT '0',
  `subcategory_id` int(11) DEFAULT '0',
  `childcategory_id` int(11) DEFAULT '0',
  `tax_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT '0',
  `name` text COLLATE utf8mb4_unicode_ci,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `video` text COLLATE utf8mb4_unicode_ci,
  `sort_details` text COLLATE utf8mb4_unicode_ci,
  `specification_name` text COLLATE utf8mb4_unicode_ci,
  `specification_description` text COLLATE utf8mb4_unicode_ci,
  `is_specification` tinyint(4) DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` double DEFAULT '0',
  `previous_price` double DEFAULT '0',
  `stock` int(11) DEFAULT '0',
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `is_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `file_type` enum('file','link') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `license_name` text COLLATE utf8mb4_unicode_ci,
  `license_key` text COLLATE utf8mb4_unicode_ci,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_link` text COLLATE utf8mb4_unicode_ci,
  `tier_prices` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,18,NULL,NULL,3,NULL,'PRP Tube – ACD + Gel, 10ml','PRP-Tube-–-ACD---Gel--10ml-','v0r4TyS2z5','',NULL,'PRP Tube – ACD + Gel, 10ml','<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 10ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuges</b></p>',NULL,1,'<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 10ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuge</b></p>','17833316887.png',0,0,90,'',NULL,1,'feature',NULL,NULL,NULL,NULL,'2026-07-06 09:54:48','2026-07-06 12:23:02',NULL,NULL,'normal','MJrlwv60.png',NULL,NULL),(2,18,1,NULL,3,NULL,'PRP Tube – ACD + Gel','15ml','nljgZ7P145','',NULL,'Sterile 15 ml  PRP Tube with ACD + Gel. ISO 13485 & CE certified. Ideal for PRP hair, skin & joint treatments. Crystal clear and trusted by professionals.','<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 15 ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuges</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><font style=\"font-size: 14pt;\"><b>Applications / Uses:</b></font></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Hair PRP Therapy (Hair Regrowth, Follicle Repair)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Facial Aesthetics (Anti-aging, Wrinkles, Acne Scars)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Orthopedic PRP Therapy (Joint Pain, Ligament Healing)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Skin Rejuvenation (Glow, Texture, Pigmentation)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Wound Healing &amp; Cell Regeneration</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><font style=\"font-size: 14pt;\"><b>Using System / Instructions:</b></font></p><ol style=\"font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Draw 12 ml of blood into the tube (ACD prevents clotting).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Place the tube in a centrifuge machine (follow PRP-specific RPM/time).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>The gel separates the plasma from red and white blood cells.</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Use a syringe to extract the PRP from the upper layer.</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Apply PRP to the treatment area (scalp, skin, joints, etc.).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Dispose of the tube after single use.</b></p></li></ol><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><i><b>Always use by trained professionals under sterile conditions.</b></i></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><b>Certifications:</b></p><ul style=\"font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>ISO 13485 Certified (Medical Devices Quality)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>CE Certified (European Compliance)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Sterile &amp; Single-Use Only</b></p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p>',NULL,1,'<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">The <b>PRP Tube – ACD + Gel (15 ml )</b> is a high-quality, <b>sterile single-use medical device</b> used for safe and efficient <b>Platelet-Rich Plasma (PRP) preparation</b>. Pre-filled with <b>ACD (Anticoagulant Citrate Dextrose)</b> to prevent blood clotting and <b>separation gel</b> to isolate plasma effectively, this tube ensures <b>high-purity PRP collection</b> for clinical and aesthetic applications.</p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">This product is <b>ISO 13485 and CE certified</b>, guaranteeing safety, sterility, and consistent performance. It is compatible with most <b>standard centrifuge machines</b> and trusted by <b>clinics, dermatologists, and PRP specialists</b>.</p>','1783336459PRP TUBE =ACD+GEL  (2).jpg',0,0,19,'',NULL,1,'feature',NULL,NULL,NULL,NULL,'2026-07-06 11:14:19','2026-07-06 12:23:02',NULL,NULL,'normal','hrfT5pbJ.jpg',NULL,NULL),(3,18,NULL,NULL,3,NULL,'Product Name: PRP & PRF Clinical Centrifuge Machine (DM0506) | 300–5000 RPM | LCD Display | Brushless Motor | CE & ISO Certified','Product-Name--PRP---PRF-Clinical-Centrifuge-Machine--DM0506----300–5000-RPM---LCD-Display---Brushless-Motor---CE---ISO-Certified','KlNnXlNVFG','',NULL,'Professional low-speed laboratory centrifuge designed for PRP, PRF, blood, urine, and laboratory sample separation. Features a maintenance-free brushless DC motor, LCD display, programmable settings, and a fixed-angle 6-place rotor compatible with 1.5–15 ml tubes. Suitable for hospitals, aesthetic clinics, diagnostic laboratories, and research facilities.','<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\">Model: DM0506 / CF0506<br>Brand: WEIAI<br>Max Speed: 5000 RPM<br>Speed Range: 300–5000 RPM<br>Max RCF: 2350 × g<br>Display: LCD<br>Motor: Brushless DC Motor<br>Power Supply: AC 110V/220V, 50/60Hz<br>Dimensions: 300 × 240 × 180 mm<br>Weight: 5.2 kg<br>Package Size: 400 × 350 × 270 mm<br>Warranty: 1 Year<br>Certificates: CE, ISO, FCC, FDA, LVD (as applicable from supplier documentation)</p><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; line-height: 19.9333px; color: rgb(79, 129, 189); break-inside: avoid; background: transparent; break-after: avoid; font-weight: bold; font-size: 13pt; font-family: Calibri, serif;\">How to Use</h2><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\">1. Collect samples using appropriate sterile tubes.<br>2. Balance the rotor with equal-weight tubes opposite each other.<br>3. Insert tubes securely and close the lid.<br>4. Set RPM/RCF and timer as required.<br>5. Press Start to begin centrifugation.<br>6. Wait until the cycle completes and the lid unlocks automatically.<br>7. Remove samples carefully and continue processing according to your validated protocol.<br><br>Example Settings:<br>• PRP: 4000 RPM for 5 minutes<br>• PRF: 2700 RPM for 7 minutes<br><br>Note: These are example settings only. Always follow the validated protocol recommended by your laboratory, clinician, or tube manufacturer.</p>',NULL,1,'<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\">The PRP &amp; PRF Clinical Centrifuge Machine (DM0506) is a professional laboratory centrifuge engineered for medical, aesthetic, and laboratory applications. It is suitable for PRP preparation, PRF protocols, blood component separation, urine analysis, and routine laboratory procedures. Powered by a brushless DC motor, it offers quiet operation, stable speed, and long service life. The LCD display allows easy monitoring of RPM, RCF, and timer settings, while two programmable memory modes simplify repetitive workflows.</p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><img src=\"http://localhost:8080/assets/images/av4d6.jpeg\" style=\"width: 576px;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"></p>','17833368431.jpg',0,0,12,'',NULL,1,'feature',NULL,NULL,NULL,NULL,'2026-07-06 11:20:43','2026-07-06 12:23:02',NULL,NULL,'normal','AEnFHtnT.jpg',NULL,NULL),(4,18,0,0,NULL,0,'Atlantica EXOSOME','atlantica-exosome-nDDnV','faWhxiDt2s',NULL,NULL,'Atlantica EXOSOME',NULL,NULL,0,'Atlantica EXOSOME','5WoAJBguiV.jpeg',1000,1200,100,'Atlantica EXOSOME','Atlantica EXOSOME',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 13:49:40',NULL,NULL,'normal','5WoAJBguiV.jpeg',NULL,NULL),(5,18,0,0,NULL,0,'Auto Drama Rollar','auto-drama-rollar-MSjLz','jjNEBRUVjv',NULL,NULL,'Auto Drama Rollar',NULL,NULL,0,'Auto Drama Rollar','RgN3aSVJGL.jpeg',1000,1200,100,'Auto Drama Rollar','Auto Drama Rollar',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 13:49:40',NULL,NULL,'normal','RgN3aSVJGL.jpeg',NULL,NULL),(6,18,NULL,NULL,3,NULL,'Blood Collection Neddel Holder','blood-collection-neddel-holder-2FovP','kRyrmLTAi3','',NULL,'Blood Collection Neddel Holder',NULL,NULL,0,'Blood Collection Neddel Holder','1783346689Blood collection needle-holder.png',1000,1200,100,'Blood Collection Neddel Holder','Blood Collection Neddel Holder',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 14:04:49',NULL,NULL,'normal','kKmfZkmG.png',NULL,NULL),(7,18,0,0,NULL,0,'Darma Roller ZTC','darma-roller-ztc-V0eTo','FlycTHpiWa',NULL,NULL,'Darma Roller ZTC',NULL,NULL,0,'Darma Roller ZTC','HNlUSDQ7IW.jpeg',1000,1200,100,'Darma Roller ZTC','Darma Roller ZTC',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 13:49:40',NULL,NULL,'normal','HNlUSDQ7IW.jpeg',NULL,NULL),(8,18,NULL,NULL,3,NULL,'GFC Tube 10 ML','gfc-tube-10-ml-AzhHo','NNvrT9PijC','',NULL,'GFC Tube 10 ML',NULL,NULL,0,'GFC Tube 10 ML','1783346940GF 15ml Tube .png',1000,1200,100,'GFC Tube 10 ML','GFC Tube 10 ML',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 14:09:00',NULL,NULL,'normal','VclqAkIU.png',NULL,NULL),(9,18,NULL,NULL,3,NULL,'GFC Tube 15 ML','gfc-tube-15-ml-QHJC5','nQOj0Yb4ns','',NULL,'GFC Tube 15 ML',NULL,NULL,0,'GFC Tube 15 ML','1783347016GF 15ml Tube  (1).png',1000,1200,100,'GFC Tube 15 ML','GFC Tube 15 ML',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 14:10:16',NULL,NULL,'normal','VVmHQJf1.png',NULL,NULL),(10,18,0,0,NULL,0,'LXC','lxc-O1cyp','qXesMvojci',NULL,NULL,'LXC',NULL,NULL,0,'LXC','5vMi8XeB93.jpeg',1000,1200,100,'LXC','LXC',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 13:49:40',NULL,NULL,'normal','5vMi8XeB93.jpeg',NULL,NULL),(11,18,0,0,NULL,0,'Long Needel For PRP','long-needel-for-prp-1491L','Yr4MEXEejH',NULL,NULL,'Long Needel For PRP',NULL,NULL,0,'Long Needel For PRP','nyEBiRHhVR.jpeg',1000,1200,100,'Long Needel For PRP','Long Needel For PRP',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 13:49:40',NULL,NULL,'normal','nyEBiRHhVR.jpeg',NULL,NULL),(12,18,NULL,NULL,3,NULL,'PRP Centrifuge300-5000','prp-centrifuge300-5000-uZHPc','5orwAK0lkt','',NULL,'PRP Centrifuge300-5000',NULL,NULL,0,'PRP Centrifuge300-5000','17833467632.jpg',1000,1200,100,'PRP Centrifuge300-5000','PRP Centrifuge300-5000',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 14:06:03',NULL,NULL,'normal','HU4NdsMT.jpg',NULL,NULL),(13,18,NULL,NULL,3,NULL,'PRP= ACD+GEL+BIOTIN 10ML','prp-acdgelbiotin-10ml-K4G06','2iecd0XvTl','',NULL,'PRP= ACD+GEL+BIOTIN 10ML',NULL,NULL,0,'PRP= ACD+GEL+BIOTIN 10ML','1783346587PRP=ACD+GEL (1).jpg',1000,1200,100,'PRP= ACD+GEL+BIOTIN 10ML','PRP= ACD+GEL+BIOTIN 10ML',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:40','2026-07-06 14:03:07',NULL,NULL,'normal','2W34TQ75.jpg',NULL,NULL),(16,18,NULL,NULL,3,NULL,'PRP=ACD+GEL+Biotin -12ml','prpacdgelbiotin-12ml-rkYml','PpcJYLrS4C','',NULL,'PRP=ACD+GEL+Biotin -12ml',NULL,NULL,0,'PRP=ACD+GEL+Biotin -12ml','1783346563common.jpeg',1000,1200,100,'PRP=ACD+GEL+Biotin -12ml','PRP=ACD+GEL+Biotin -12ml',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 14:02:43',NULL,NULL,'normal','dTdA6yqG.jpeg',NULL,NULL),(17,18,NULL,NULL,3,NULL,'PRP=ACD+GEL-15 ML','prpacdgel-15-ml-elEcG','CIJP58VJVI','',NULL,'PRP=ACD+GEL-15 ML',NULL,NULL,0,'PRP=ACD+GEL-15 ML','1783346531ACD+GEL+BIOTIN -15ml.png',1000,1200,100,'PRP=ACD+GEL-15 ML','PRP=ACD+GEL-15 ML',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 14:02:11',NULL,NULL,'normal','jkaR8AQJ.png',NULL,NULL),(18,18,NULL,NULL,3,NULL,'Sodium Ciretet Tube','sodium-ciretet-tube-FQmlH','HzxENSasN6','',NULL,'Sodium Ciretet Tube',NULL,NULL,0,'Sodium Ciretet Tube','17833468743.jpg',1000,1200,100,'Sodium Ciretet Tube','Sodium Ciretet Tube',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 14:07:54',NULL,NULL,'normal','1uRqbPpT.jpg',NULL,NULL),(19,18,0,0,NULL,0,'T Shape','t-shape-EBJ4V','2jAol2dSr7',NULL,NULL,'T Shape',NULL,NULL,0,'T Shape','GrMeHhscZc.jpeg',1000,1200,100,'T Shape','T Shape',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 13:49:41',NULL,NULL,'normal','GrMeHhscZc.jpeg',NULL,NULL),(20,18,0,0,NULL,0,'TC4 Centrifuge','tc4-centrifuge-LPejA','X0UGBTMztU',NULL,NULL,'TC4 Centrifuge',NULL,NULL,0,'TC4 Centrifuge','JYllm0jtun.jpeg',1000,1200,100,'TC4 Centrifuge','TC4 Centrifuge',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 13:49:41',NULL,NULL,'normal','JYllm0jtun.jpeg',NULL,NULL),(21,25,23,NULL,3,NULL,'Tourniquet','tourniquet-kDB7y','NC2zl6ii9g','',NULL,'Tourniquet',NULL,NULL,0,'Tourniquet','1783346133Ttourniquet.jpg',1000,1200,100,'Tourniquet','Tourniquet',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 13:55:34',NULL,NULL,'normal','nGxrTO64.jpg',NULL,NULL),(22,21,NULL,NULL,3,NULL,'Unimaster','unimaster-GPuWh','sSdDdM6TKt','',NULL,'Unimaster',NULL,NULL,0,'Unimaster','1783346025Needle.jpg',1000,1200,100,'Unimaster','Unimaster',1,NULL,NULL,NULL,NULL,NULL,'2026-07-06 13:49:41','2026-07-06 18:23:40',NULL,NULL,'normal','CiIpT0bP.jpg',NULL,'[{\"min_qty\":\"100\",\"price\":1.1904761904761905},{\"min_qty\":\"200\",\"price\":0.9523809523809523}]');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','1647794127lN7PfPAc.json','1647794127lN7PfPAc',1,0,NULL,NULL,'Website'),(2,'Bangla','1647792286wzAqXQOx.json','1647792286wzAqXQOx',0,0,NULL,NULL,'Website'),(3,'English','1647794074eEeCbfDD.json','1647794074eEeCbfDD',1,0,NULL,NULL,'Dashboard'),(4,'Bangla','1638870927JMqjbCXv.json','1638870927JMqjbCXv',0,1,NULL,NULL,'Dashboard');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,1,'test','2021-12-03 06:33:29','2021-12-03 06:33:29');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021_08_21_073142_create_admins_table',1),(2,'2021_08_21_073507_create_users_table',1),(3,'2021_09_20_144419_create_items_table',1),(4,'2021_09_20_151605_create_settings_table',1),(5,'2021_09_21_073848_create_attributes_table',1),(6,'2021_09_21_073951_create_attribute_options_table',1),(7,'2021_09_21_074028_create_banners_table',1),(8,'2021_09_21_074231_create_bcategories_table',1),(9,'2021_09_21_074309_create_brands_table',1),(10,'2021_09_21_074412_create_campaign_items_table',1),(11,'2021_09_21_074536_create_categories_table',1),(12,'2021_09_21_074744_create_chield_categories_table',1),(13,'2021_09_21_074952_create_countries_table',1),(14,'2021_09_21_075024_create_currencies_table',1),(15,'2021_09_21_075231_create_email_templates_table',1),(16,'2021_09_21_075346_create_faqs_table',1),(17,'2021_09_21_075642_create_fcategories_table',1),(18,'2021_09_21_080223_create_galleries_table',1),(19,'2021_09_21_080320_create_home_cutomizes_table',1),(20,'2021_09_21_080454_create_languages_table',1),(21,'2021_09_21_080652_create_messages_table',1),(22,'2021_09_21_080805_create_notifications_table',1),(23,'2021_09_21_090957_create_orders_table',1),(25,'2021_09_21_092255_create_payment_settings_table',1),(26,'2021_09_21_092722_create_posts_table',1),(27,'2021_09_21_092801_create_promo_codes_table',1),(28,'2021_09_21_093709_create_reviews_table',1),(29,'2021_09_21_093833_create_roles_table',1),(30,'2021_09_21_094020_create_services_table',1),(31,'2021_09_21_094413_create_shipping_services_table',1),(32,'2021_09_21_094517_create_sliders_table',1),(33,'2021_09_21_094630_create_socials_table',1),(34,'2021_09_21_094739_create_subcategories_table',1),(35,'2021_09_21_094831_create_subscribers_table',1),(36,'2021_09_21_094903_create_taxes_table',1),(37,'2021_09_21_095021_create_tickets_table',1),(38,'2021_09_21_095605_create_track_orders_table',1),(39,'2021_09_21_095650_create_transactions_table',1),(40,'2021_09_21_095836_create_wishlists_table',1),(41,'2021_09_21_091316_create_pages_table',2),(42,'2021_09_22_095954_add_extra_visibility_to_settings_table',3),(43,'2021_09_29_075836_add_theme_to_settings_table',4),(44,'2021_09_30_103035_google_chapcha_to_settings__table',5),(45,'2021_10_04_141643_add_currency_deraction_to_settings_table',6),(46,'2021_10_08_135417_add_theme_field_to_sliders_table',7),(51,'2021_10_09_153059_license_to_items_table',8),(56,'2021_10_09_173004_remove_item_type_to_items_table',9),(57,'2021_10_09_173038_set_item_type_to_items_table',9),(58,'2021_10_10_051502_add_scrript_to_settings_table',10),(59,'2021_10_10_142339_thumbnail_to_items_table',11),(61,'2021_10_10_163455_home_page4_to_home_cutomizes_table',12),(62,'2021_10_11_090243_create_extra_settings_table',13),(63,'2021_10_12_145150_add_home4populer_category_to_home_cutomizes_table',14),(64,'2021_10_13_100048_create_sitemaps_table',15),(65,'2021_10_15_140708_add_type_to_promo_codes_table',16),(66,'2021_10_15_163958_add_announcement_link_to_settings_table',17),(68,'2021_11_21_143624_add_shop_extra_field_to_settings_table',19),(69,'2021_11_20_105052_add_stock_to_attribute_options_table',20),(71,'2021_11_21_151422_add_home_page_title_to_settings_table',21),(72,'2021_11_23_141528_add_type_to_languages_table',22),(73,'2021_11_23_144810_add_privacy_terms_to_settings_table',23),(74,'2021_11_23_182026_add_guest_checkout_to_settings_table',24),(76,'2021_11_24_144859_add_guest_hero_banner_to_home_cutomizes_table',25),(77,'2021_11_26_163222_add_affiliate_link_to_items_table',26),(78,'2021_11_27_113624_add_css_field_to_settings_table',27),(79,'2021_12_05_161222_add_flash_section_to_extra_settings_table',28),(82,'2021_12_05_165840_add_popup_field_to_settings_table',29),(83,'2021_12_06_141255_add_3column_section_to_extra_settings_table',30),(84,'2022_01_03_141239_add_currency_seperator_to_settings_table',31),(85,'2022_01_04_142738_create_states_table',32),(86,'2022_01_04_145532_add_state_id_to_users_table',33),(88,'2022_01_04_161647_add_state_id_to_orders_table',34),(89,'2022_01_06_155345_add_disqus_to_settings_table',35),(90,'2022_01_16_143429_add_type_to_states_table',36),(91,'2022_01_16_153254_add_state_to_orders_table',37),(92,'2022_03_01_162121_add_is_decemial_to_settings_table',38),(93,'2022_03_20_154807_update_column_to_home_cutomizes_table',39),(94,'2026_07_06_181207_add_tier_prices_to_items_table',40);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,133,NULL,0,'2024-03-06 15:19:31','2024-03-06 15:19:31'),(2,134,NULL,0,'2024-03-06 15:24:49','2024-03-06 15:24:49'),(3,135,NULL,0,'2024-08-03 18:59:32','2024-08-03 18:59:32'),(4,136,NULL,0,'2024-08-18 21:38:50','2024-08-18 21:38:50'),(5,NULL,11,0,'2024-08-26 11:51:15','2024-08-26 11:51:15'),(6,137,NULL,0,'2024-08-26 11:52:59','2024-08-26 11:52:59'),(7,NULL,12,0,'2024-09-18 05:25:32','2024-09-18 05:25:32'),(8,NULL,13,0,'2024-11-06 16:42:29','2024-11-06 16:42:29');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` text COLLATE utf8mb4_unicode_ci,
  `shipping` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` double NOT NULL DEFAULT '0',
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_info` text COLLATE utf8mb4_unicode_ci,
  `billing_info` text COLLATE utf8mb4_unicode_ci,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_price` double DEFAULT '0',
  `state` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `pos` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (7,'About Us','about-us','<div class=\"about-us-content\">\n    <p class=\"lead font-weight-normal text-muted mb-4\">Mac Scientific is a trusted supplier of regenerative medicine, aesthetic, and laboratory products, dedicated to supporting healthcare professionals with high-quality, reliable, and innovative medical solutions.</p>\n    \n    <p>We specialize in supplying premium PRP Tubes, PRF Tubes, GFC Tubes, Sodium Citrate Tubes, Microneedling products, and other regenerative medicine and aesthetic consumables. In addition, we offer a comprehensive range of laboratory equipment, consumables, and diagnostic supplies to meet the everyday needs of clinics, hospitals, diagnostic centers, and research laboratories.</p>\n    \n    <p>At Mac Scientific, we believe that quality products are the foundation of better patient care and clinical success. Every product we provide is carefully selected to ensure safety, consistency, and performance, enabling medical professionals to deliver the highest standards of treatment and diagnosis.</p>\n    \n    <p>Our commitment extends beyond supplying products. We focus on building long-term relationships with our customers through exceptional service, competitive pricing, timely delivery, and professional support. Whether serving a regenerative medicine clinic, an aesthetic practice, or a diagnostic laboratory, we strive to be a dependable partner in advancing healthcare.</p>\n    \n    <p>As the medical industry continues to evolve, Mac Scientific remains committed to innovation, integrity, and excellenceâ€”helping healthcare professionals achieve better outcomes and shaping the future of regenerative medicine, aesthetics, and laboratory diagnostics.</p>\n\n    <div class=\"row mt-5 mb-4\">\n        <div class=\"col-md-6 mb-4\">\n            <div class=\"card h-100 border-0 shadow-sm p-4 bg-light\">\n                <h3 class=\"h4 text-primary mb-3\"><i class=\"icon-target mr-2\"></i>Mission</h3>\n                <p class=\"mb-0\">At Mac Scientific, our mission is to empower healthcare professionals, regenerative medicine practitioners, aesthetic clinics, and diagnostic laboratories by providing high-quality, reliable, and innovative medical products. We are committed to delivering premium PRP, PRF, GFC, and aesthetic consumables, along with essential laboratory supplies, while ensuring exceptional customer service, competitive pricing, and long-term professional partnerships. Our goal is to support better clinical outcomes through trusted products and continuous innovation.</p>\n            </div>\n        </div>\n        <div class=\"col-md-6 mb-4\">\n            <div class=\"card h-100 border-0 shadow-sm p-4 bg-light\">\n                <h3 class=\"h4 text-primary mb-3\"><i class=\"icon-eye mr-2\"></i>Vision</h3>\n                <p class=\"mb-0\">Our vision is to become one of the most trusted and leading suppliers of regenerative medicine, aesthetic, and laboratory products in Bangladesh and beyond. We aspire to advance healthcare by making innovative medical technologies more accessible, supporting the growth of healthcare professionals, and contributing to safer, more effective patient care. Through integrity, quality, and continuous improvement, â€œmac scientificâ€ aims to be the preferred partner for clinics, hospitals, and laboratories across the region.</p>\n            </div>\n        </div>\n    </div>\n</div>',NULL,NULL,2,NULL,NULL),(10,'Privacy Policy','privacy-policy','<div class=\"privacy-policy-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p>Mac Scientific respects your privacy and is committed to protecting your personal information.</p>\n    \n    <p>We may collect information such as your name, phone number, email address, business name, shipping address, and order details when you contact us or place an order.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">How We Use Your Information</h3>\n    <p>Your information is used only to:</p>\n    <ul class=\"mb-4\">\n        <li>Process and deliver orders.</li>\n        <li>Provide customer support.</li>\n        <li>Respond to inquiries.</li>\n        <li>Improve our services.</li>\n        <li>Send order updates and promotional communications (where permitted).</li>\n    </ul>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Information Sharing &amp; Protection</h3>\n    <p>We do not sell or rent your personal information to third parties.</p>\n    <p>We implement reasonable administrative and technical measures to protect your information. However, no internet transmission or electronic storage method is completely secure.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Third-Party Links</h3>\n    <p>Our website may contain links to third-party websites. Mac Scientific is not responsible for their privacy practices or content.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Updates &amp; Contact</h3>\n    <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with the revised effective date.</p>\n    <p>If you have any questions regarding this Privacy Policy, please contact Mac Scientific using the contact information provided on our website.</p>\n</div>',NULL,NULL,2,NULL,NULL),(11,'Terms & Service','terms-and-service','<div class=\"terms-service-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">By placing an order through Mac Scientific, you agree to the following terms and conditions:</p>\n    \n    <ol class=\"pl-3 mb-4\">\n        <li class=\"mb-2\">Product availability is subject to stock.</li>\n        <li class=\"mb-2\">Prices may change without prior notice.</li>\n        <li class=\"mb-2\">Orders are confirmed only after acceptance by Mac Scientific.</li>\n        <li class=\"mb-2\">Customers are responsible for providing accurate shipping and billing information.</li>\n        <li class=\"mb-2\">Products should be inspected upon delivery. Any damage or incorrect shipment should be reported within 48 hours.</li>\n        <li class=\"mb-2\">Returns or replacements are accepted only for damaged, defective, or incorrectly supplied products, subject to our return policy.</li>\n        <li class=\"mb-2\">Products intended for professional medical use should be used only by qualified healthcare professionals and according to the manufacturerâ€™s instructions.</li>\n        <li class=\"mb-2\">Mac Scientific shall not be liable for improper use, misuse, or unauthorized modification of any product.</li>\n        <li class=\"mb-2\">We reserve the right to refuse or cancel any order when necessary.</li>\n        <li class=\"mb-2\">These Terms &amp; Conditions are governed by the laws of Bangladesh.</li>\n    </ol>\n</div>',NULL,NULL,2,NULL,NULL),(12,'Return Policy','return-policy','<div class=\"return-policy-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">At Mac Scientific, customer satisfaction is important to us. We are committed to supplying high-quality regenerative medicine, aesthetic, and laboratory products. Please review our Return &amp; Refund Policy before placing an order.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">1. Eligibility for Returns</h3>\n    <p>Returns may be accepted only under the following circumstances:</p>\n    <ul class=\"mb-3\">\n        <li>The product received is damaged during delivery.</li>\n        <li>The product delivered is incorrect or does not match the confirmed order.</li>\n        <li>The product has a manufacturing defect.</li>\n        <li>The product is received with broken or tampered packaging.</li>\n    </ul>\n    <p class=\"font-weight-bold text-dark mb-4\">To be eligible for a return, you must notify us within 48 hours of receiving the product.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">2. Non-Returnable Items</h3>\n    <p>For safety, hygiene, and quality assurance reasons, the following items cannot be returned or exchanged unless they are defective or supplied incorrectly:</p>\n    <ul class=\"mb-4\">\n        <li>Opened or used medical products.</li>\n        <li>Sterile products with broken seals or opened packaging.</li>\n        <li>Products damaged due to misuse, improper storage, or mishandling.</li>\n        <li>Clearance, promotional, or special-order items (unless defective).</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">3. Return Conditions</h3>\n    <p>To process a return, the product must:</p>\n    <ul class=\"mb-4\">\n        <li>Be unused and in its original condition.</li>\n        <li>Be returned with its original packaging and accessories (if applicable).</li>\n        <li>Include proof of purchase, such as an invoice or order confirmation.</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">4. Refund Policy</h3>\n    <p>Once the returned product has been received and inspected, Mac Scientific will notify you of the outcome.</p>\n    <p>If your return is approved, we may:</p>\n    <ul class=\"mb-3\">\n        <li>Issue a full refund.</li>\n        <li>Replace the product with the same item.</li>\n        <li>Provide store credit, where applicable.</li>\n    </ul>\n    <p class=\"mb-4\">Refunds will be processed using the original payment method whenever possible. Processing times may vary depending on the payment provider.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">5. Shipping Charges</h3>\n    <ul class=\"mb-4\">\n        <li>If the return is due to our error (wrong item, damaged product, or manufacturing defect), Mac Scientific will bear the applicable return shipping costs.</li>\n        <li>If the return is requested for reasons other than our error and is accepted at our discretion, the customer may be responsible for shipping charges.</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">6. Order Cancellation</h3>\n    <p class=\"mb-4\">Orders may be cancelled before shipment. Once an order has been dispatched, it cannot be cancelled and will be subject to this Return &amp; Refund Policy.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">7. Contact Us</h3>\n    <p class=\"mb-4\">For return or refund requests, please contact our customer support team with your order details and photographs (if applicable) before sending any product back.</p>\n\n    <div class=\"alert alert-info mt-4\">\n        <p class=\"mb-0\">Thank you for choosing Mac Scientific. We appreciate your trust and remain committed to providing reliable products and professional customer service.</p>\n    </div>\n</div>',NULL,NULL,2,NULL,NULL),(14,'Legal Notice','legal-notice','<div class=\"legal-notice-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">Welcome to Mac Scientific. By accessing and using this website, you agree to comply with the terms outlined in this Legal Notice.</p>\n\n    <p>Mac Scientific is a supplier of regenerative medicine, aesthetic, and laboratory products. All information provided on this website is intended for general informational and commercial purposes only.</p>\n\n    <p>The products displayed on this website are intended for use by qualified healthcare professionals, licensed medical practitioners, clinics, hospitals, diagnostic laboratories, or authorized distributors, where applicable.</p>\n\n    <p class=\"font-weight-bold text-dark\">Mac Scientific does not provide medical advice, diagnosis, or treatment. Any clinical decisions regarding the use of our products remain the sole responsibility of the healthcare professional.</p>\n\n    <p>While we strive to ensure the accuracy of all product information, specifications, and pricing, Mac Scientific reserves the right to modify product details, availability, and prices without prior notice.</p>\n\n    <p>All trademarks, logos, product images, text, and website content are the property of Mac Scientific or their respective owners and may not be reproduced without written permission.</p>\n\n    <p class=\"mb-0\">Any disputes arising from the use of this website shall be governed by the applicable laws of the People\'s Republic of Bangladesh.</p>\n</div>','[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]',NULL,2,NULL,NULL),(15,'Medical Disclaimer','medical-disclaimer','<div class=\"medical-disclaimer-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">The information provided on the Mac Scientific website is intended for general informational and commercial purposes only. It is not intended to replace professional medical advice, diagnosis, or treatment.</p>\n\n    <p>Mac Scientific is a supplier of regenerative medicine, aesthetic, and laboratory products. We do not practice medicine, provide medical consultations, or recommend specific treatments.</p>\n\n    <p>Many of our productsâ€”including PRP Tubes, PRF Tubes, GFC Tubes, Sodium Citrate Tubes, microneedling products, and other medical consumablesâ€”are intended for use by qualified healthcare professionals, licensed medical practitioners, hospitals, clinics, diagnostic laboratories, and trained personnel only.</p>\n\n    <p>Customers are solely responsible for ensuring that products are used in accordance with applicable laws, local regulations, manufacturer instructions, and accepted clinical protocols.</p>\n\n    <p>Mac Scientific does not guarantee specific clinical outcomes or treatment results. Individual patient outcomes may vary depending on medical conditions, practitioner expertise, treatment protocols, and other factors beyond our control.</p>\n\n    <p>Product images, descriptions, specifications, and pricing are provided for reference purposes only and may be updated or changed without prior notice.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Professional Acknowledgement &amp; Agreement</h3>\n    <p>By purchasing or using products supplied by Mac Scientific, you acknowledge and agree that:</p>\n    <ul class=\"mb-4\">\n        <li class=\"mb-2\">You are responsible for determining whether a product is appropriate for your intended professional use.</li>\n        <li class=\"mb-2\">Products must be used only by qualified healthcare professionals where applicable.</li>\n        <li class=\"mb-2\">Mac Scientific shall not be liable for any injury, loss, damage, or adverse outcome resulting from improper use, misuse, unauthorized modification, or failure to follow manufacturer instructions.</li>\n        <li class=\"mb-2\">The information on this website should never be interpreted as medical advice or a substitute for consultation with a licensed healthcare professional.</li>\n    </ul>\n\n    <p>If you have questions regarding product specifications, compatibility, or intended use, please contact Mac Scientific before placing your order.</p>\n\n    <div class=\"alert alert-info mt-4\">\n        <p class=\"mb-0\">Thank you for choosing Mac Scientific as your trusted partner in regenerative medicine, aesthetic solutions, and laboratory supplies.</p>\n    </div>\n</div>',NULL,NULL,2,'2026-07-06 07:24:28','2026-07-06 07:24:28');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `unique_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_settings`
--

LOCK TABLES `payment_settings` WRITE;
/*!40000 ALTER TABLE `payment_settings` DISABLE KEYS */;
INSERT INTO `payment_settings` VALUES (1,'Cash On Delivery',NULL,'cod','1631032407index.png','Cash on Delivery basically means you will pay the amount of product while you get the item delivered to you.',1,NULL,NULL),(14,'Stripe','{\"key\":\"pk_test_51HZI80H3jdWvr8gEn3oRtFlnJTqRpecXGQueOyngEArTyF6gjjfOVqbFeFMpAMRoQmKwPPrh81OiWzhDlqtS5nGs00gKycg4Oa\",\"secret\":\"sk_test_51HZI80H3jdWvr8gErqdNWpqUkAgHMQdw7uug1mfUY38vIUfodsAWj4hoBK43rBvHebYETVX4ZCne03o3Ifco1qkR00dhrdpPsh\"}','stripe','1601930611stripe-logo-blue.png','Stripe is the faster & safer way to send money. Make an online payment via Stripe.',1,NULL,NULL),(15,'Paypal','{\"client_id\":\"AUtv8KISHG9l9rmlXB0cSLjt6A91IsGfPACeRreuRpEV3GR-ZRnxIxXnUVKNYIfqVXrxs2uPlGDot0Cc\",\"client_secret\":\"EEdtOBI_NjI2bJzLSIzumsN_xSI7htn8qyAcRz0mvO8Emv-7CdfQeqxNZlDhiDAd0ZhV49e4sOhjtwho\",\"check_sandbox\":1}','paypal','16218678201601930675paypal-784404_960_720.png','PayPal is the faster & safer way to send money. Make an online payment via PayPal.',1,NULL,NULL),(17,'Mollie','{\"key\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\"}','mollie','1621785282Mollie.jpeg','Mollie is a Payment Provider for Belgium and the Netherlands, offering payment methods such as credit card, iDEAL, Bancontact/Mister cash, PayPal, SCT, SDD and others.',1,NULL,NULL),(18,'Paytm','{\"mercent\":\"tkogux49985047638244\",\"client_secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"is_paytm\":\"1\",\"paytm_mode\":\"sandbox\"}','paytm','1631978815images.png','Paytm is the faster & safer way to send money. Make an online payment via Paytm.',1,NULL,NULL),(19,'SSLCommerz','{\"store_id\":\"geniu5e1b00621f81e\",\"store_password\":\"geniu5e1b00621f81e@ssl\",\"check_sandbox\":1}','sslcommerz','1631978716ssl-thumb.jpeg','SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.',1,NULL,NULL),(24,'Mercadopago','{\"public_key\":\"TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8\",\"token\":\"TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482\",\"check_sandbox\":1}','mercadopago','1633085560unnamed.jpeg','Mercadopago is the faster & safer way to send money. Make an online payment via Mercadopago.',1,NULL,NULL),(25,'Authorize.Net','{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"check_sandbox\":1}','authorize','1633100640seal2.png','Authorize.Net is the faster & safer way to send money. Make an online payment via Authorize.Net',1,NULL,NULL),(26,'Paystack','{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"geniusdevs@gmail.com\"}','paystack','1634237632paystack-opengraph.png','Paystack is the faster & safer way to send money. Make an online payment via Paystack.',1,NULL,NULL),(27,'Bank Transfer',NULL,'bank','1638530860pngwing.com (1).png','<p>Account Number : 434 3434 3334</p><p>Pay With Bank Transfer.</p><p>Account Name : Jhon Due</p><p>Account Email : demo@gmail.com</p>',1,NULL,NULL),(28,'Razorpay','{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\"}','razorpay','1637992878download.jpeg','Rezorpay is the faster & safer way to send money. Make an online payment via Rezorpay.',1,NULL,NULL),(29,'Flutter Wave','{\"public_key\":\"FLWPUBK_TEST-d54c4c69ef195e721af2139e7dfe1a23-X\",\"secret_key\":\"FLWSECK_TEST-86c6484143e62c4c9bc2e8aa08a07c92-X\",\"text\":\"Pay via your Flutter Wave account.\"}','flutterwave','1637998096download.png','Flutterwave is the faster & safer way to send money. Make an online payment via Flutterwave.',1,NULL,NULL);
/*!40000 ALTER TABLE `payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (59,'Fashion and Beauty Series 1','fashion-and-beauty-series-1','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349673media_5-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"lapop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:27:53'),(61,'Fashion and Beauty Series 2','fashion-and-beauty-series-2','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349684media_7-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:04'),(62,'Fashion and Beauty Series 3','fashion-and-beauty-series-3','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349695media_10-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:15'),(63,'Fashion and Beauty Series 4','fashion-and-beauty-series-4','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349704media_21-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:24'),(64,'Fashion and Beauty Series 5','fashion-and-beauty-series-5','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349716media_23-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:36'),(65,'Fashion and Beauty Series 6','fashion-and-beauty-series-6','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349728media_24-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:48'),(66,'Fashion and Beauty Series 7','fashion-and-beauty-series-7','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349736media_26-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:28:56'),(67,'Fashion and Beauty Series 8','fashion-and-beauty-series-8','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!','[\"1632349747media_28-768x512.jpg\"]',1,'mobile,phone,camera,lapop','[{\"value\":\"mobile\"},{\"value\":\"phone\"},{\"value\":\"camera\"},{\"value\":\"laptop\"}]','It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2021-05-31 07:48:23','2021-09-22 16:29:07');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times` int(11) NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
INSERT INTO `promo_codes` VALUES (1,'Flash Discount','ironman',95,2,1,NULL,NULL,NULL),(2,'Halloween Carnival','superman',96,5,1,NULL,NULL,NULL),(3,'Fest Carnival','loki',94,10,1,NULL,NULL,'amount');
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `review` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'test','[\"Manage Categories\",\"Manage Products\",\"Manage Orders\",\"Transactions\",\"Ecommerce\",\"Customer List\",\"Manages Tickets\",\"Manage Site\",\"Manage Faqs Contents\",\"Manage Blogs\",\"Manages Pages\",\"Subscribers List\",\"Manage System User\"]','2021-12-05 10:24:27','2021-12-05 10:24:27');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (31,'Secure Online Payment','We posess SSL / Secure Certificate','162196474904.png',NULL,NULL),(32,'24/7 Customer Support','Friendly 24/7 customer support','162196471103.png',NULL,NULL),(33,'Money Back Guarantee','We return money within 30 days','162196467602.png',NULL,NULL),(34,'Nationwide Delivery','Reliable shipping for all orders nationwide','162196463701.png',NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_loader` tinyint(4) DEFAULT '1',
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_check` tinyint(4) DEFAULT '0',
  `email_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overlay` text COLLATE utf8mb4_unicode_ci,
  `google_analytics_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_shop` tinyint(4) DEFAULT '1',
  `is_blog` tinyint(4) DEFAULT '1',
  `is_faq` tinyint(4) DEFAULT '1',
  `is_contact` tinyint(4) DEFAULT '1',
  `facebook_check` tinyint(4) DEFAULT '1',
  `facebook_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_check` tinyint(4) DEFAULT '1',
  `google_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` double DEFAULT '0',
  `max_price` double DEFAULT '100000',
  `footer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_address` text COLLATE utf8mb4_unicode_ci,
  `footer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_gateway_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` text COLLATE utf8mb4_unicode_ci,
  `friday_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satureday_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satureday_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_slider` tinyint(4) DEFAULT '1',
  `is_category` tinyint(4) DEFAULT '1',
  `is_product` tinyint(4) DEFAULT '1',
  `is_top_banner` tinyint(4) DEFAULT '1',
  `is_recent` tinyint(4) DEFAULT '1',
  `is_top` tinyint(4) DEFAULT '1',
  `is_best` tinyint(4) DEFAULT '1',
  `is_flash` tinyint(4) DEFAULT '1',
  `is_brand` tinyint(4) DEFAULT '1',
  `is_blogs` tinyint(4) DEFAULT '1',
  `is_campaign` tinyint(4) DEFAULT '1',
  `is_brands` tinyint(4) DEFAULT '1',
  `is_bottom_banner` tinyint(4) DEFAULT '1',
  `is_service` tinyint(4) DEFAULT '1',
  `campaign_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_status` tinyint(4) DEFAULT '1',
  `twilio_sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_form_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_announcement` tinyint(4) DEFAULT '1',
  `announcement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_delay` decimal(11,2) NOT NULL DEFAULT '0.00',
  `is_maintainance` tinyint(4) DEFAULT '1',
  `maintainance_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintainance_text` text COLLATE utf8mb4_unicode_ci,
  `is_twilio` tinyint(4) DEFAULT '0',
  `twilio_section` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_three_c_b_first` tinyint(4) NOT NULL DEFAULT '1',
  `is_popular_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_three_c_b_second` tinyint(4) NOT NULL DEFAULT '1',
  `is_highlighted` tinyint(4) NOT NULL DEFAULT '1',
  `is_two_column_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_popular_brand` tinyint(4) NOT NULL DEFAULT '1',
  `is_featured_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_two_c_b` tinyint(4) NOT NULL DEFAULT '1',
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_site_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha` tinyint(4) DEFAULT '0',
  `currency_direction` tinyint(4) DEFAULT '1',
  `google_analytics` text COLLATE utf8mb4_unicode_ci,
  `google_adsense` text COLLATE utf8mb4_unicode_ci,
  `facebook_pixel` text COLLATE utf8mb4_unicode_ci,
  `facebook_messenger` text COLLATE utf8mb4_unicode_ci,
  `is_google_analytics` tinyint(4) DEFAULT '0',
  `is_google_adsense` tinyint(4) DEFAULT '0',
  `is_facebook_pixel` tinyint(4) DEFAULT '0',
  `is_facebook_messenger` tinyint(4) DEFAULT '0',
  `announcement_link` text COLLATE utf8mb4_unicode_ci,
  `is_attribute_search` tinyint(4) DEFAULT '1',
  `is_range_search` tinyint(4) DEFAULT '1',
  `view_product` int(11) DEFAULT '12',
  `home_page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Home',
  `is_privacy_trams` tinyint(4) DEFAULT '1',
  `policy_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '''#''',
  `terms_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '''#''',
  `is_guest_checkout` tinyint(4) DEFAULT '1',
  `custom_css` text COLLATE utf8mb4_unicode_ci,
  `announcement_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'banner',
  `is_cookie` tinyint(4) DEFAULT '1',
  `cookie_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_details` text COLLATE utf8mb4_unicode_ci,
  `decimal_separator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '.',
  `thousand_separator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT ',',
  `disqus` text COLLATE utf8mb4_unicode_ci,
  `is_disqus` tinyint(4) NOT NULL DEFAULT '0',
  `is_decimal` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Mac Scientific','prp_logo.png','1709734426Screenshot_10.png','1709711634download.png',0,'1600622296topic.jpg','#112BB1',1,'smtp.mailtrap.io','2525','tls','ab7d3fde364e5f','aac3f52ada3308','info.elitede signsbd@gmail.com','Elitedesign','info@elitedesign.com.bd','4.0',NULL,'UA-106757798-1','elitedesign,elitedesignsbd,hello,bd','Online Baby, your trusted source fornatural consumer foods, specializes increating delectable and nutritious options for the modern palate.Our commitment to using only the finest ingredients ensures a delightful culinary experience, promoting a healthylifestyle with every bite.Discover the essence of pure goodness with Atika Foods.',1,1,0,1,1,'643929170080071','038b2100dff9a2a684c85959c0accf66','https://localhost/my/omnimart/auth/facebook/callback',1,'915191002660-6hjno4cgnbcm5p1kb3t692trh7pc6ngh.apps.googleusercontent.com','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','http://localhost/my/omnimart/auth/google/callback',0,10000,'+8801312699221','Shop No. 59. 2nd Floor, Rajanigandha Super Market, Kachukhet, Dhaka-1206, Bangladesh.','macscientificbd@gmail.com','1709711755y7mS4QRuHu6dNY9y6FAmv29me1Rg4v4CCAbpJdq4.png','{\"icons\":[\"fab fa-facebook-f\",\"fab fa-facebook\",\"fab fa-instagram\",\"fab fa-youtube\",\"fab fa-whatsapp\"],\"links\":[\"https:\\/\\/facebook.com\\/macscientific\",\"https:\\/\\/www.facebook.com\\/profile.php?id=61574534235204\",\"https:\\/\\/instagram.com\\/macscientific\",\"https:\\/\\/www.youtube.com\\/@MACScientific\",\"https:\\/\\/wa.me\\/8801312699221\"]}','9:27 PM','9:27 PM','9:27 PM','9:27 PM','Â© All rights reserved By Mac Scientific',1,0,0,0,0,0,0,0,0,1,1,1,0,1,'Deals Of The Week','10/10/2022',1,'AC73e54518487ad4e26da8b465a7614f1f0','300d787df0c398ae46b84b74ea86f59c','+8801775457708','+880',1,'1709712076head1.png',1.00,0,'16323327831619241714761747856.jpg','We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank you.',1,'{\"\'purchase\'\":\"Your Order Purchase Successfully. your order number is {order_number}\",\"\'order_status\'\":\"Your Order status update. Order number is {order_number}\"}',NULL,NULL,1,1,1,1,1,1,1,1,'theme2','#','#',0,1,NULL,NULL,NULL,'#',0,0,0,0,'#',1,1,16,'Mac Scientific',1,'#','#',1,NULL,'Get 50% Discount.','newletter',1,'Your experience on this site will be improved by allowing cookies.','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, facere nesciunt doloremque nobis debitis sint?','.',',','#',1,1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_services`
--

DROP TABLE IF EXISTS `shipping_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `minimum_price` double NOT NULL DEFAULT '0',
  `is_condition` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_services`
--

LOCK TABLES `shipping_services` WRITE;
/*!40000 ALTER TABLE `shipping_services` DISABLE KEYS */;
INSERT INTO `shipping_services` VALUES (1,'Free Delevery',0,1000,1,1,NULL,NULL),(2,'Delivery',20,0,0,1,NULL,NULL);
/*!40000 ALTER TABLE `shipping_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitemaps`
--

DROP TABLE IF EXISTS `sitemaps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitemaps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sitemap_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitemaps`
--

LOCK TABLES `sitemaps` WRITE;
/*!40000 ALTER TABLE `sitemaps` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitemaps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'theme1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (18,'1783345060banner 1.png','#','#','1783340454logo.png','It is a long established fact that a reader will be distracted by the readable content',NULL,NULL,'theme2'),(20,'YlvLPRP-vs-PRF3.jpg','#','#','IlfIPRP-vs-PRF3.jpg','no',NULL,NULL,'theme1'),(22,'JB5nshutterstock_1068445823.jpg','#','#','o8dmshutterstock_1068445823.jpg','#',NULL,NULL,'theme2');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socials`
--

DROP TABLE IF EXISTS `socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socials`
--

LOCK TABLES `socials` WRITE;
/*!40000 ALTER TABLE `socials` DISABLE KEYS */;
INSERT INTO `socials` VALUES (1,'https://www.facebook.com/','fab fa-facebook-square',NULL,NULL),(2,'https://twitter.com/','fab fa-twitter-square',NULL,NULL),(3,'https://www.instagram.com/','fab fa-instagram',NULL,NULL),(10,'https://www.pinterest.com/','fab fa-pinterest-square',NULL,NULL);
/*!40000 ALTER TABLE `socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (6,'Alaska',3,0,'percentage'),(7,'California',4,0,'percentage'),(8,'New Mexico',5,0,'percentage'),(9,'Utah',6,0,'percentage'),(10,'Virginia',6,0,'percentage');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,'PRP-Tubes','PRP-Tubes',18,0,NULL,NULL),(2,'PRP Sets','PRP-Sets',18,0,NULL,NULL),(3,'Needles','Needles',21,0,NULL,NULL),(4,'Syringes','Syringes',21,0,NULL,NULL),(5,'Spare Needles','Spare-Needles',21,0,NULL,NULL),(6,'Blood Collection Set','Blood-Collection-Set',21,0,NULL,NULL),(7,'Valves, Connectors, Closures','Valves--Connectors--Closures',21,0,NULL,NULL),(8,'Tourniquets','Tourniquets',21,0,NULL,NULL),(9,'Centrifuge','Centrifuge',22,0,NULL,NULL),(10,'Essentials','Essentials',22,0,NULL,NULL),(11,'Centrifuge cart','Centrifuge-cart',22,0,NULL,NULL),(12,'Needling Pen','Needling-Pen',24,0,NULL,NULL),(13,'Spare Needle','Spare-Needle',24,0,NULL,NULL),(14,'Serum & Ampoules','Serum---Ampoules',24,0,NULL,NULL),(15,'BB Glow','BB-Glow',24,0,NULL,NULL),(16,'Mesorollers','Mesorollers',24,0,NULL,NULL),(17,'Beauty Cleanser','Beauty-Cleanser',25,0,NULL,NULL),(18,'FRUIT ACID PEELING','FRUIT-ACID-PEELING',25,0,NULL,NULL),(19,'Creams','Creams',25,0,NULL,NULL),(20,'Peeling','Peeling',25,0,NULL,NULL),(21,'Face Masks','Face-Masks',25,0,NULL,NULL),(22,'Wound healing ointments','Wound-healing-ointments',25,0,NULL,NULL),(23,'Disinfectant','Disinfectant',25,0,NULL,NULL),(24,'ANTI AGING','ANTI-AGING',25,0,NULL,NULL),(25,'Medical Training','Medical-Training',27,0,NULL,NULL),(26,'Online Courses','Online-Courses',27,0,NULL,NULL);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (1,'user@gmail.com',NULL,NULL),(2,'mehedihasaen588@gmail.com',NULL,NULL),(3,'thereisalottoknow@gmail.com',NULL,NULL);
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxes`
--

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
INSERT INTO `taxes` VALUES (1,'High Tax',4,1,NULL,NULL),(2,'Low Tax',1,1,NULL,NULL),(3,'No Tax',0,1,NULL,NULL);
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'I need help','I need help',NULL,1,NULL,'2021-12-03 06:32:39','2021-12-03 06:32:39');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `track_orders`
--

DROP TABLE IF EXISTS `track_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `track_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `track_orders`
--

LOCK TABLES `track_orders` WRITE;
/*!40000 ALTER TABLE `track_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `track_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-07  4:22:59
