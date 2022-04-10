/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : ukk_hotel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-04-11 04:50:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bayar
-- ----------------------------
DROP TABLE IF EXISTS `bayar`;
CREATE TABLE `bayar` (
  `bayarId` int(11) NOT NULL AUTO_INCREMENT,
  `bayarTransId` int(11) DEFAULT NULL,
  `bayarStatus` enum('belum bayar','lunas') DEFAULT NULL,
  `bayarNominal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bayarId`),
  KEY `bayarTransId` (`bayarTransId`),
  CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`bayarTransId`) REFERENCES `transaksi` (`transaksiId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bayar
-- ----------------------------

-- ----------------------------
-- Table structure for kamar
-- ----------------------------
DROP TABLE IF EXISTS `kamar`;
CREATE TABLE `kamar` (
  `kamarId` int(11) NOT NULL AUTO_INCREMENT,
  `kamarKode` varchar(255) DEFAULT NULL,
  `kamarTipeId` int(11) DEFAULT 1,
  `kamarStatusId` int(11) DEFAULT 1,
  PRIMARY KEY (`kamarId`),
  KEY `kamarTipeId` (`kamarTipeId`),
  KEY `kamarStatusId` (`kamarStatusId`),
  CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`kamarTipeId`) REFERENCES `ref_kamar_tipe` (`refKamarTipeId`),
  CONSTRAINT `kamar_ibfk_2` FOREIGN KEY (`kamarStatusId`) REFERENCES `ref_kamar_status` (`refKamarStatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of kamar
-- ----------------------------
INSERT INTO `kamar` VALUES ('1', 'A1', '1', '2');
INSERT INTO `kamar` VALUES ('2', 'A2', '1', '1');
INSERT INTO `kamar` VALUES ('5', 'A3', '1', '1');
INSERT INTO `kamar` VALUES ('6', 'A4', '1', '1');
INSERT INTO `kamar` VALUES ('7', 'A5', '1', '1');
INSERT INTO `kamar` VALUES ('8', 'A6', '1', '1');
INSERT INTO `kamar` VALUES ('9', 'A7', '1', '1');
INSERT INTO `kamar` VALUES ('11', 'B1', '2', '1');
INSERT INTO `kamar` VALUES ('12', 'B2', '2', '1');
INSERT INTO `kamar` VALUES ('13', 'B3', '2', '1');
INSERT INTO `kamar` VALUES ('14', 'B4', '2', '1');
INSERT INTO `kamar` VALUES ('15', 'B5', '2', '1');
INSERT INTO `kamar` VALUES ('16', 'C1', '3', '1');
INSERT INTO `kamar` VALUES ('17', 'C2', '3', '1');
INSERT INTO `kamar` VALUES ('18', 'C3', '3', '1');
INSERT INTO `kamar` VALUES ('19', 'C4', '3', '1');
INSERT INTO `kamar` VALUES ('20', 'C5', '3', '1');
INSERT INTO `kamar` VALUES ('21', 'D1', '4', '1');
INSERT INTO `kamar` VALUES ('22', 'D2', '4', '1');
INSERT INTO `kamar` VALUES ('23', 'D3', '4', '1');
INSERT INTO `kamar` VALUES ('24', 'D4', '4', '1');
INSERT INTO `kamar` VALUES ('25', 'D5', '4', '1');
INSERT INTO `kamar` VALUES ('26', 'A8', '1', '1');
INSERT INTO `kamar` VALUES ('36', 'A9', '1', '1');

-- ----------------------------
-- Table structure for ref_kamar_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_kamar_status`;
CREATE TABLE `ref_kamar_status` (
  `refKamarStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `refKamarStatusNama` varchar(255) DEFAULT '',
  PRIMARY KEY (`refKamarStatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ref_kamar_status
-- ----------------------------
INSERT INTO `ref_kamar_status` VALUES ('1', 'Available');
INSERT INTO `ref_kamar_status` VALUES ('2', 'Used');
INSERT INTO `ref_kamar_status` VALUES ('3', 'Maintenance');
INSERT INTO `ref_kamar_status` VALUES ('4', 'Forbidden');

-- ----------------------------
-- Table structure for ref_kamar_tipe
-- ----------------------------
DROP TABLE IF EXISTS `ref_kamar_tipe`;
CREATE TABLE `ref_kamar_tipe` (
  `refKamarTipeId` int(11) NOT NULL AUTO_INCREMENT,
  `refKamarTipeNama` varchar(255) DEFAULT NULL,
  `refKamarTipeHarga` int(11) DEFAULT NULL,
  `refKamarTipeImages` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`refKamarTipeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ref_kamar_tipe
-- ----------------------------
INSERT INTO `ref_kamar_tipe` VALUES ('1', 'Standar', '50000', '625234bd8b620.jpg');
INSERT INTO `ref_kamar_tipe` VALUES ('2', 'Deluxe', '100000', '6252455f844e2.jpg');
INSERT INTO `ref_kamar_tipe` VALUES ('3', 'Suite', '150000', '625245e2394e1.jpeg');
INSERT INTO `ref_kamar_tipe` VALUES ('4', 'Presidential', '250000', '625245f056327.jpg');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `transaksiId` int(11) NOT NULL AUTO_INCREMENT,
  `transaksiNamaPemesan` varchar(255) DEFAULT NULL,
  `transaksiTglMulai` date DEFAULT NULL,
  `transaksiTglSelesai` date DEFAULT NULL,
  `transaksiTipeKamarId` int(11) DEFAULT NULL,
  `transaksiKamarId` int(11) DEFAULT NULL,
  `transaksiTotal` varchar(255) DEFAULT NULL,
  `transaksiBayar` varchar(255) DEFAULT NULL,
  `transaksiStatus` enum('belum bayar','lunas') DEFAULT 'belum bayar',
  PRIMARY KEY (`transaksiId`),
  KEY `transaksiTipeKamarId` (`transaksiTipeKamarId`),
  KEY `transaksiKamarId` (`transaksiKamarId`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`transaksiTipeKamarId`) REFERENCES `ref_kamar_tipe` (`refKamarTipeId`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`transaksiKamarId`) REFERENCES `kamar` (`kamarId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('5', 'Vernalta', '2022-04-06', '2022-04-22', '1', '6', '50000', '50000', 'lunas');
INSERT INTO `transaksi` VALUES ('6', 'ilham', '2022-04-10', '2022-04-14', '4', '21', '250000', '4000', 'lunas');
INSERT INTO `transaksi` VALUES ('7', 'ilham', '2022-04-13', '2022-04-16', '1', '6', '150000', '200000', 'lunas');
INSERT INTO `transaksi` VALUES ('8', 'rin', '2023-04-10', '2022-04-15', '1', '6', '250000', '500000', 'lunas');
INSERT INTO `transaksi` VALUES ('9', 'Vernalta', '2022-04-11', '2022-04-15', '1', '1', '200000', '500000', 'lunas');
INSERT INTO `transaksi` VALUES ('10', 'Vernalta', '2022-04-11', '2022-04-12', '1', '1', '50000', null, 'belum bayar');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userRole` enum('worker','admin') DEFAULT NULL,
  `is_active` enum('false','true') DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'false');
INSERT INTO `user` VALUES ('2', 'worker1', 'ebad64149cc767ba26ef069819279fd5', 'worker', 'false');
INSERT INTO `user` VALUES ('3', 'nito', '7a5f24d2db07defda05a104df6e55471', 'worker', 'false');

-- ----------------------------
-- View structure for view_kamar
-- ----------------------------
DROP VIEW IF EXISTS `view_kamar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `view_kamar` AS SELECT
kamar.kamarId,
kamar.kamarKode,
ref_kamar_tipe.refKamarTipeNama,
ref_kamar_tipe.refKamarTipeHarga,
ref_kamar_tipe.refKamarTipeImages,
ref_kamar_status.refKamarStatusNama
FROM
kamar
INNER JOIN ref_kamar_status ON kamar.kamarStatusId = ref_kamar_status.refKamarStatusId
INNER JOIN ref_kamar_tipe ON kamar.kamarTipeId = ref_kamar_tipe.refKamarTipeId ;

-- ----------------------------
-- View structure for view_transaksi
-- ----------------------------
DROP VIEW IF EXISTS `view_transaksi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `view_transaksi` AS SELECT
transaksi.transaksiId,
transaksi.transaksiNamaPemesan,
transaksi.transaksiTglMulai,
transaksi.transaksiTglSelesai,
kamar.kamarKode,
ref_kamar_tipe.refKamarTipeNama,
transaksi.transaksiTotal,
transaksi.transaksiBayar,
transaksi.transaksiStatus
FROM
kamar
INNER JOIN ref_kamar_tipe ON kamar.kamarTipeId = ref_kamar_tipe.refKamarTipeId
INNER JOIN transaksi ON transaksi.transaksiTipeKamarId = ref_kamar_tipe.refKamarTipeId AND transaksi.transaksiKamarId = kamar.kamarId ;
DROP TRIGGER IF EXISTS `ubah_status`;
DELIMITER ;;
CREATE TRIGGER `ubah_status` AFTER INSERT ON `transaksi` FOR EACH ROW update kamar set kamarStatusId = 2 where kamarId = new.transaksiKamarId
;;
DELIMITER ;
