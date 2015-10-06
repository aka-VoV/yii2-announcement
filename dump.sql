-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               5.5.38-log - MySQL Community Server (GPL)
-- ОС сервера:                   Win32
-- HeidiSQL Версія:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for cms
CREATE DATABASE IF NOT EXISTS `cms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cms`;


-- Dumping structure for таблиця cms.an_cats
CREATE TABLE IF NOT EXISTS `an_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `local` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table cms.an_cats: ~9 rows (приблизно)
DELETE FROM `an_cats`;
/*!40000 ALTER TABLE `an_cats` DISABLE KEYS */;
INSERT INTO `an_cats` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`, `local`) VALUES
	(8, 8, 1, 6, 0, 'Купівля', ''),
	(9, 9, 1, 6, 0, 'Оренда', ''),
	(10, 10, 1, 6, 0, 'Продаж', ''),
	(11, 8, 2, 3, 1, 'Корми', ''),
	(12, 8, 4, 5, 1, 'Техніка', ''),
	(13, 9, 2, 3, 1, 'Здати в оренду', ''),
	(14, 9, 4, 5, 1, 'Орендувати', ''),
	(15, 10, 2, 3, 1, 'Корми', ''),
	(16, 10, 4, 5, 1, 'Техніка', '');
/*!40000 ALTER TABLE `an_cats` ENABLE KEYS */;


-- Dumping structure for таблиця cms.an_items
CREATE TABLE IF NOT EXISTS `an_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `local` varchar(55) NOT NULL,
  `title` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `person` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `an_items_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `an_cats` (`id`),
  CONSTRAINT `an_items_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `an_regions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table cms.an_items: ~0 rows (приблизно)
DELETE FROM `an_items`;
/*!40000 ALTER TABLE `an_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `an_items` ENABLE KEYS */;


-- Dumping structure for таблиця cms.an_regions
CREATE TABLE IF NOT EXISTS `an_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `local` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Dumping data for table cms.an_regions: ~26 rows (приблизно)
DELETE FROM `an_regions`;
/*!40000 ALTER TABLE `an_regions` DISABLE KEYS */;
INSERT INTO `an_regions` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`, `local`) VALUES
	(3, 3, 1, 52, 0, 'Україна', ''),
	(4, 3, 2, 3, 1, 'Київська обл.', ''),
	(5, 3, 4, 5, 1, 'Вінницька обл.', ''),
	(6, 3, 6, 7, 1, 'Волинська обл.', ''),
	(7, 3, 8, 9, 1, 'Дніпропетровська обл.', ''),
	(8, 3, 10, 11, 1, 'Донецька обл.', ''),
	(9, 3, 12, 13, 1, 'Житомирська обл.', ''),
	(10, 3, 14, 15, 1, 'Закарпатська обл.', ''),
	(11, 3, 16, 17, 1, 'Запорізька обл.', ''),
	(12, 3, 18, 19, 1, 'Івано-Франківська обл.', ''),
	(13, 3, 20, 21, 1, 'Кіровоградська обл.', ''),
	(14, 3, 22, 23, 1, 'Луганська обл.', ''),
	(15, 3, 24, 25, 1, 'Львівська обл.', ''),
	(16, 3, 26, 27, 1, 'Миколаївська обл.', ''),
	(17, 3, 28, 29, 1, 'Одеська обл.', ''),
	(18, 3, 30, 31, 1, 'Полтавська обл.', ''),
	(19, 3, 32, 33, 1, 'Рівненська обл.', ''),
	(20, 3, 34, 35, 1, 'Сумська обл.', ''),
	(21, 3, 36, 37, 1, 'Тернопільська обл.', ''),
	(22, 3, 38, 39, 1, 'Харківська обл.', ''),
	(23, 3, 40, 41, 1, 'Херсонська обл.', ''),
	(24, 3, 42, 43, 1, 'Хмельницька обл.', ''),
	(25, 3, 44, 45, 1, 'Черкаська обл.', ''),
	(26, 3, 46, 47, 1, 'Чернівецька обл.', ''),
	(27, 3, 48, 49, 1, 'Чернігівська обл.', ''),
	(28, 3, 50, 51, 1, 'АР Крим', '');
/*!40000 ALTER TABLE `an_regions` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
