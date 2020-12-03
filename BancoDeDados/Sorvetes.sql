-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.13-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sorvete
--

CREATE DATABASE IF NOT EXISTS sorvete;
USE sorvete;

--
-- Definition of table `tbfabricante`
--

DROP TABLE IF EXISTS `tbfabricante`;
CREATE TABLE `tbfabricante` (
  `idfabricante` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomefabricante` varchar(60) NOT NULL,
  PRIMARY KEY (`idfabricante`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbfabricante`
--

/*!40000 ALTER TABLE `tbfabricante` DISABLE KEYS */;
INSERT INTO `tbfabricante` (`idfabricante`,`nomefabricante`) VALUES 
 (1,'Kibon'),
 (2,'Nestle'),
 (3,'Jundiá');
/*!40000 ALTER TABLE `tbfabricante` ENABLE KEYS */;


--
-- Definition of table `tbsorvetes`
--

DROP TABLE IF EXISTS `tbsorvetes`;
CREATE TABLE `tbsorvetes` (
  `idsorvete` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sabor` varchar(60) NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `idfabricante` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idsorvete`),
  KEY `FK_sorvetes_1` (`idfabricante`),
  CONSTRAINT `FK_sorvetes_1` FOREIGN KEY (`idfabricante`) REFERENCES `tbfabricante` (`idfabricante`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbsorvetes`
--

/*!40000 ALTER TABLE `tbsorvetes` DISABLE KEYS */;
INSERT INTO `tbsorvetes` (`idsorvete`,`sabor`,`quantidade`,`idfabricante`) VALUES 
 (1,'Fruttare Limão',10,1),
 (2,'Fruttare Uva',8,1),
 (4,'Sem parar',8,2),
 (5,'Sem parar',10,2);
/*!40000 ALTER TABLE `tbsorvetes` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
