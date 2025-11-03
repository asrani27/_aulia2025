/*
 Navicat Premium Dump SQL

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80043 (8.0.43)
 Source Host           : localhost:3306
 Source Schema         : _aulia

 Target Server Type    : MySQL
 Target Server Version : 80043 (8.0.43)
 File Encoding         : 65001

 Date: 03/11/2025 21:57:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jadwal_audit
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_audit`;
CREATE TABLE `jadwal_audit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tim_audit_id` bigint unsigned NOT NULL,
  `tgl_audit` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_audit_tim_audit_id_foreign` (`tim_audit_id`),
  CONSTRAINT `jadwal_audit_tim_audit_id_foreign` FOREIGN KEY (`tim_audit_id`) REFERENCES `tim_audit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jadwal_audit
-- ----------------------------
BEGIN;
INSERT INTO `jadwal_audit` (`id`, `nama_instansi`, `alamat`, `tim_audit_id`, `tgl_audit`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES (1, 'instansi 1', 'jl pramuka', 1, '2025-11-13', 'Sedang Berlangsung', 'optional', '2025-11-03 12:17:31', '2025-11-03 12:18:56');
INSERT INTO `jadwal_audit` (`id`, `nama_instansi`, `alamat`, `tim_audit_id`, `tgl_audit`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES (2, 'fdg', 'dfg', 2, '2025-11-02', 'Ditunda', 'dfg', '2025-11-03 12:19:12', '2025-11-03 12:19:12');
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2025_11_03_033906_add_role_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2025_11_03_033943_create_pegawai_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2025_11_03_120001_create_tim_audit_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2025_11_03_120017_create_tim_audit_pegawai_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2025_11_03_121009_create_jadwal_audit_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2025_11_03_121123_change_tgl_audit_type_in_jadwal_audit_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2025_11_03_122115_create_pemeriksaan_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2025_11_03_122902_create_tindak_lanjut_table', 7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2025_11_03_123959_add_rekomendasi_saran_to_tindak_lanjut_table', 8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2025_11_03_134752_add_nomor_to_pemeriksaan_table', 9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2025_11_03_134807_add_nomor_to_tindak_lanjut_table', 10);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jkel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
BEGIN;
INSERT INTO `pegawai` (`id`, `nama`, `tgl_lahir`, `jkel`, `pangkat`, `golongan`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (1, 'Budi', '2025-11-03', 'L', 'dsfsdf', 'fdg', 'sad', '123243', 'fdxc dsfsdfsdf', '2025-11-03 11:56:53', '2025-11-03 11:57:07');
INSERT INTO `pegawai` (`id`, `nama`, `tgl_lahir`, `jkel`, `pangkat`, `golongan`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (2, 'jhb', '2025-11-02', 'L', 'jb', 'jhbjhb', 'jhb', 'jbjh', 'bjh', '2025-11-03 11:57:22', '2025-11-03 11:57:22');
INSERT INTO `pegawai` (`id`, `nama`, `tgl_lahir`, `jkel`, `pangkat`, `golongan`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (3, 'hnfgbfvds', '2025-11-04', 'P', 'fdgdf', 'dfg', 'dfg', 'fgsad', 'sdfsdgdfg', '2025-11-03 11:57:32', '2025-11-03 11:57:32');
COMMIT;

-- ----------------------------
-- Table structure for pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE `pemeriksaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal_audit_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `hasil_temuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemeriksaan_jadwal_audit_id_foreign` (`jadwal_audit_id`),
  CONSTRAINT `pemeriksaan_jadwal_audit_id_foreign` FOREIGN KEY (`jadwal_audit_id`) REFERENCES `jadwal_audit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pemeriksaan
-- ----------------------------
BEGIN;
INSERT INTO `pemeriksaan` (`id`, `nomor`, `jadwal_audit_id`, `tanggal`, `hasil_temuan`, `keterangan`, `created_at`, `updated_at`) VALUES (1, '4532', 1, '2025-11-13', 'bal bla bkla', 'bal bla bkla', '2025-11-03 12:26:49', '2025-11-03 13:51:23');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tim_audit
-- ----------------------------
DROP TABLE IF EXISTS `tim_audit`;
CREATE TABLE `tim_audit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_tim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tim_audit
-- ----------------------------
BEGIN;
INSERT INTO `tim_audit` (`id`, `nama_tim`, `bidang`, `created_at`, `updated_at`) VALUES (1, 'tim kijang', 'bidang 1', '2025-11-03 12:07:07', '2025-11-03 12:07:07');
INSERT INTO `tim_audit` (`id`, `nama_tim`, `bidang`, `created_at`, `updated_at`) VALUES (2, 'tim kelinci', 'bidang 2', '2025-11-03 12:07:26', '2025-11-03 12:07:26');
COMMIT;

-- ----------------------------
-- Table structure for tim_audit_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `tim_audit_pegawai`;
CREATE TABLE `tim_audit_pegawai` (
  `tim_audit_id` bigint unsigned NOT NULL,
  `pegawai_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tim_audit_id`,`pegawai_id`),
  KEY `tim_audit_pegawai_pegawai_id_foreign` (`pegawai_id`),
  CONSTRAINT `tim_audit_pegawai_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tim_audit_pegawai_tim_audit_id_foreign` FOREIGN KEY (`tim_audit_id`) REFERENCES `tim_audit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tim_audit_pegawai
-- ----------------------------
BEGIN;
INSERT INTO `tim_audit_pegawai` (`tim_audit_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES (1, 1, NULL, NULL);
INSERT INTO `tim_audit_pegawai` (`tim_audit_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES (1, 2, NULL, NULL);
INSERT INTO `tim_audit_pegawai` (`tim_audit_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES (1, 3, NULL, NULL);
INSERT INTO `tim_audit_pegawai` (`tim_audit_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES (2, 2, NULL, NULL);
INSERT INTO `tim_audit_pegawai` (`tim_audit_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES (2, 3, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for tindak_lanjut
-- ----------------------------
DROP TABLE IF EXISTS `tindak_lanjut`;
CREATE TABLE `tindak_lanjut` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemeriksaan_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindak_lanjut` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('S','DP','B') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'B' COMMENT 'S=Selesai, DP=Dalam Proses, B=Belum Diproses',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `rekomendasi_saran` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tindak_lanjut_pemeriksaan_id_foreign` (`pemeriksaan_id`),
  CONSTRAINT `tindak_lanjut_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tindak_lanjut
-- ----------------------------
BEGIN;
INSERT INTO `tindak_lanjut` (`id`, `nomor`, `pemeriksaan_id`, `tanggal`, `uraian`, `tindak_lanjut`, `status`, `keterangan`, `rekomendasi_saran`, `created_at`, `updated_at`) VALUES (1, NULL, 1, '2025-11-04', 'dfg', 'dfg', 'B', 'dfgdfgdfg', 'saran', '2025-11-03 12:42:32', '2025-11-03 12:42:50');
INSERT INTO `tindak_lanjut` (`id`, `nomor`, `pemeriksaan_id`, `tanggal`, `uraian`, `tindak_lanjut`, `status`, `keterangan`, `rekomendasi_saran`, `created_at`, `updated_at`) VALUES (2, '1234', 1, '2025-11-03', 'fdgd', 'fdg', 'B', 'dfg', 'dfg', '2025-11-03 13:51:02', '2025-11-03 13:51:02');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Admin User', '', 'admin@example.com', NULL, '$2y$10$0lWsMO/xBnVnKmr0uBoUdueXAWFUIGbWCE8phAc3fTEVTdCewKAlu', 'admin', NULL, '2025-11-03 03:54:17', '2025-11-03 03:56:26');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'andi', '', 'asrani.27@gmail.com', NULL, '$2y$12$Ceu/09C5z0182cBAlxclhucwbbnwOGV1IjoJUPXqblifeEOsxsp46', 'admin', NULL, '2025-11-03 11:47:57', '2025-11-03 11:49:06');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
