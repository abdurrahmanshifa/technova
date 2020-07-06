/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : aplikasi_technova

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 06/07/2020 15:31:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_lengkap` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` enum('Administrator','Employee') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nip`(`nip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, '1234567890', 'Abdurrahman Shifa', '$2y$10$eIdf4k2NMu7K2h0O95upJ.CgnHv.S7wrU6jqd5ujrXWCqIqVpxvy.', 'Laki - laki', '2020-01-01', 'abdurrahmanshifa@gmail.com', NULL, '1', 'Administrator', '2020-07-06 11:37:01', '2020-07-05 18:57:51', '2020-07-06 01:39:09');
INSERT INTO `karyawan` VALUES (2, '1234567891', 'Mikasa', '$2y$10$Cp17NwOtp8Of5w1mrdaqIeqkvKK.tkV9x9K5BQ2Wqt2hgJgJv62EO', 'Perempuan', '2020-07-05', 'kisahpelajar@yahoo.com', 'Jl Kh Hasyim Ashari', '1', 'Employee', '2020-07-06 11:14:01', '2020-07-05 21:28:10', '2020-07-05 21:58:25');
INSERT INTO `karyawan` VALUES (3, '1234567892', 'Armin', '$2y$10$q5F5mkpqW1BCbt6joXCN..4/3i4b3KsRyZ7Tyyk0gE/7cPY16RlkW', 'Laki - laki', '2020-07-06', 'kisahabdur@gmail.com', 'Testing', '0', 'Employee', '2020-07-06 10:40:15', '2020-07-06 10:20:15', '2020-07-06 13:11:41');

-- ----------------------------
-- Table structure for tugas
-- ----------------------------
DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(255) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tugas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `long` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_pekerjaan` enum('menunggu','proses','selesai') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tugas
-- ----------------------------
INSERT INTO `tugas` VALUES (1, 2, 'av83g', 'Internet mati', '2020-07-06', 'Harap segera diperbaiki', '106.6845973', '-6.1994609', 'Jl. KH Hasyim Ashari, RT.003/RW.001, Kenanga, Tangerang City, Banten, Indonesia', 'selesai', '2020-07-06 10:14:58', '2020-07-06 14:31:03');
INSERT INTO `tugas` VALUES (2, 2, 'bic61', 'Internet mati', '2020-07-06', 'Testinggg', '106.7054493', '-6.1915021', 'Jl. KH. Ahmad Dahlan, RT.007/RW.001, Petir, Tangerang City, Banten, Indonesia', 'proses', '2020-07-06 13:13:52', '2020-07-06 14:57:40');
INSERT INTO `tugas` VALUES (3, 2, 'jk0os', 'Jaringan mati', '2020-07-06', 'Test', '106.6633349', '-6.182505499999999', 'Jalan Irigasi Sipon, RT.005/RW.002, North Poris Plawad, Tangerang City, Banten, Indonesia', 'menunggu', '2020-07-06 14:11:02', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `birthday` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contact` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Marc Kevin', 'Flores', 'boy', '1998-08-06', 'marckevinflores@gmail.com', '09092884082', 'Princetown Bagumbong Caloocan City');
INSERT INTO `users` VALUES (2, 'Kim Paolo', 'Flores', 'boy', '2001-06-06', 'kimpaolo@gmail.com', '543534', 'Bagumbong Caloocan City');

SET FOREIGN_KEY_CHECKS = 1;
