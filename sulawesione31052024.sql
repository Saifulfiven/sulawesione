/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : sulawesione

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 31/05/2024 18:48:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlahpemilih` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tps` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `yangdipilih` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for beritas
-- ----------------------------
DROP TABLE IF EXISTS `beritas`;
CREATE TABLE `beritas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of beritas
-- ----------------------------

-- ----------------------------
-- Table structure for dapils
-- ----------------------------
DROP TABLE IF EXISTS `dapils`;
CREATE TABLE `dapils`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kabupaten` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_provinsi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_kandidat` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jeniskandidat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dapils
-- ----------------------------
INSERT INTO `dapils` VALUES (1, '3', NULL, '1', 'pilkab', '2024-05-30 15:16:36', '2024-05-30 15:16:36');
INSERT INTO `dapils` VALUES (2, '2', NULL, '2', 'pilkab', '2024-05-30 15:17:07', '2024-05-30 15:17:07');
INSERT INTO `dapils` VALUES (3, '5', NULL, '3', 'pilkab', '2024-05-30 15:17:41', '2024-05-30 15:17:41');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kabupatens
-- ----------------------------
DROP TABLE IF EXISTS `kabupatens`;
CREATE TABLE `kabupatens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namakabupaten` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_propinsi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kabupatens
-- ----------------------------
INSERT INTO `kabupatens` VALUES (1, 'Kabupaten Boalemo', 'kabupaten-boalemo', '1', '2024-05-30 14:12:21', '2024-05-30 14:12:21');
INSERT INTO `kabupatens` VALUES (2, 'Kabupaten Bone Bolango', 'kabupaten-bone-bolango', '1', '2024-05-30 14:18:43', '2024-05-30 14:18:43');
INSERT INTO `kabupatens` VALUES (3, 'Kabupaten Gorontalo', 'kabupaten-gorontalo', '1', '2024-05-30 14:19:15', '2024-05-30 14:19:15');
INSERT INTO `kabupatens` VALUES (4, 'Kabupaten Gorontalo Utara', 'kabupaten-gorontalo-utara', '1', '2024-05-30 14:19:49', '2024-05-30 14:19:49');
INSERT INTO `kabupatens` VALUES (5, 'Kabupaten Pohuwato', 'kabupaten-pohuwato', '1', '2024-05-30 14:20:23', '2024-05-30 14:20:23');
INSERT INTO `kabupatens` VALUES (6, 'Kota Gorontalo', 'kota-gorontalo', '1', '2024-05-30 14:20:56', '2024-05-30 14:20:56');

-- ----------------------------
-- Table structure for kandidats
-- ----------------------------
DROP TABLE IF EXISTS `kandidats`;
CREATE TABLE `kandidats`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namakandidat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kandidats
-- ----------------------------
INSERT INTO `kandidats` VALUES (1, 'H Ramli Anwar', '1717079124_hjramli.jpg', '2024-05-30 14:25:24', '2024-05-30 14:25:24');
INSERT INTO `kandidats` VALUES (2, 'Hendra Hemeto', '1717079774_hendra-hemeto-1_169.jpeg', '2024-05-30 14:36:14', '2024-05-30 14:36:14');
INSERT INTO `kandidats` VALUES (3, 'Saiful Mbuinga', '1717079810_saipul mbuinga.jpg', '2024-05-30 14:36:50', '2024-05-30 14:36:50');

-- ----------------------------
-- Table structure for kecamatans
-- ----------------------------
DROP TABLE IF EXISTS `kecamatans`;
CREATE TABLE `kecamatans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namakecamatan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kabupaten` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kecamatans
-- ----------------------------
INSERT INTO `kecamatans` VALUES (1, 'Dulupi', '1', '2024-05-30 14:22:46', '2024-05-30 14:22:46');
INSERT INTO `kecamatans` VALUES (2, 'Mananggu', '1', '2024-05-30 14:23:18', '2024-05-30 14:23:18');
INSERT INTO `kecamatans` VALUES (3, 'Paguyaman', '1', '2024-05-30 14:23:41', '2024-05-30 14:23:41');
INSERT INTO `kecamatans` VALUES (4, 'Tilamuta', '1', '2024-05-30 14:23:58', '2024-05-30 14:23:58');
INSERT INTO `kecamatans` VALUES (5, 'Wonosari', '1', '2024-05-30 14:24:17', '2024-05-30 14:24:17');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_05_06_082704_create_beritas_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_05_11_010840_create_pemilihs_table', 2);
INSERT INTO `migrations` VALUES (7, '2024_05_13_165950_create_admins_table', 2);
INSERT INTO `migrations` VALUES (8, '2024_05_15_013642_create_kabupatens_table', 2);
INSERT INTO `migrations` VALUES (9, '2024_05_15_014246_create_kecamatans_table', 2);
INSERT INTO `migrations` VALUES (10, '2024_05_15_014457_create_provinsis_table', 2);
INSERT INTO `migrations` VALUES (11, '2024_05_16_005010_create_kandidats_table', 2);
INSERT INTO `migrations` VALUES (12, '2024_05_16_063830_create_timpenggunas_table', 2);
INSERT INTO `migrations` VALUES (13, '2024_05_16_075544_add_emailpass_ke__timpenggunas', 2);
INSERT INTO `migrations` VALUES (14, '2024_05_22_172246_create_dapils_table', 2);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pemilihs
-- ----------------------------
DROP TABLE IF EXISTS `pemilihs`;
CREATE TABLE `pemilihs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenispilihan` tinyint NOT NULL,
  `id_dapil` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_timpengguna` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_desa` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kecamatan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kabupaten` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_provinsi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemilihs
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for provinsis
-- ----------------------------
DROP TABLE IF EXISTS `provinsis`;
CREATE TABLE `provinsis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namaprovinsi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of provinsis
-- ----------------------------
INSERT INTO `provinsis` VALUES (1, 'Gorontalo', 'gorontalo', '2024-05-30 14:03:36', '2024-05-30 14:03:36');
INSERT INTO `provinsis` VALUES (2, 'Sulawesi Utara', 'sulawesi-utara', '2024-05-30 14:03:59', '2024-05-30 14:03:59');
INSERT INTO `provinsis` VALUES (3, 'Sulawesi Tengah', 'sulawesi-tengah', '2024-05-30 14:04:14', '2024-05-30 14:04:14');
INSERT INTO `provinsis` VALUES (4, 'Sulawesi Tenggara', 'sulawesi-tenggara', '2024-05-30 14:04:39', '2024-05-30 14:04:39');
INSERT INTO `provinsis` VALUES (5, 'Sulawesi Selatan', 'sulawesi-selatan', '2024-05-30 14:05:02', '2024-05-30 14:05:02');
INSERT INTO `provinsis` VALUES (6, 'Sulawesi Barat', 'sulawesi-barat', '2024-05-30 14:05:21', '2024-05-30 14:05:21');

-- ----------------------------
-- Table structure for timpenggunas
-- ----------------------------
DROP TABLE IF EXISTS `timpenggunas`;
CREATE TABLE `timpenggunas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_kecamatan` int NULL DEFAULT NULL,
  `id_kabupaten` int NULL DEFAULT NULL,
  `id_provinsi` int NULL DEFAULT NULL,
  `jumlahpemilihrumahtangga` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nomortps` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `kontak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jenistim` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_timinti` int NULL DEFAULT NULL,
  `id_dapil` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of timpenggunas
-- ----------------------------
INSERT INTO `timpenggunas` VALUES (1, 'Saiful', '7773010202000012', 3, 1, 1, NULL, NULL, 'Jl. adakah rt 3 rw 1', '0859393939902', 'latitude', 'longitude', 'A', 0, '1', '1', 'pengguna.png', '2024-05-30 15:31:30', '2024-05-30 15:49:00', 'timintigortal@gmail.com', '123456');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
