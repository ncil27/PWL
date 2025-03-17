-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pengajuan_surat_if
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pengajuan_surat_if` ;

-- -----------------------------------------------------
-- Schema pengajuan_surat_if
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pengajuan_surat_if` DEFAULT CHARACTER SET utf8mb3 ;
USE `pengajuan_surat_if` ;

-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`cache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`cache` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`cache_locks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`cache_locks` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`failed_jobs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`failed_jobs` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`job_batches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`job_batches` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`jobs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`jobs` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`mata_kuliah`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`mata_kuliah` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`mata_kuliah` (
  `id_matkul` VARCHAR(10) NOT NULL,
  `nama_matkul` VARCHAR(100) NOT NULL,
  `kelas` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_matkul`),
  UNIQUE INDEX `id_matkul_UNIQUE` (`id_matkul` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`migrations` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`password_reset_tokens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`password_reset_tokens` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`program_studi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`program_studi` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`program_studi` (
  `id_prodi` CHAR(2) NOT NULL,
  `program_studi` VARCHAR(25) NOT NULL,
  `kode_prodi` CHAR(2) NOT NULL,
  PRIMARY KEY (`id_prodi`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`users` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`users` (
  `id_user` VARCHAR(9) NOT NULL,
  `username` VARCHAR(9) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `role` ENUM('mahasiswa', 'admin', 'mo', 'kaprodi') NOT NULL,
  `status` ENUM('aktif', 'non-aktif') NOT NULL,
  `id_prodi` CHAR(2) NOT NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `id_prodi_di_user_idx` (`id_prodi` ASC),
  CONSTRAINT `id_prodi_di_user`
    FOREIGN KEY (`id_prodi`)
    REFERENCES `pengajuan_surat_if`.`program_studi` (`id_prodi`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`pengajuan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`pengajuan` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`pengajuan` (
  `id_pengajuan` VARCHAR(20) NOT NULL,
  `id_mhs` VARCHAR(9) NOT NULL,
  `jenis_surat` ENUM('skma', 'lhs', 'skl', 'spt') NOT NULL,
  `status_pengajuan` ENUM('diterima', 'ditolak', 'diproses', 'menunggu') NOT NULL,
  `file_surat` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  UNIQUE INDEX `surat_id_UNIQUE` (`id_pengajuan` ASC),
  INDEX `id_mhs_idx` (`id_mhs` ASC),
  CONSTRAINT `id_mhs`
    FOREIGN KEY (`id_mhs`)
    REFERENCES `pengajuan_surat_if`.`users` (`id_user`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`sessions` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC),
  INDEX `sessions_last_activity_index` (`last_activity` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_ket_lulus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_ket_lulus` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_ket_lulus` (
  `id_surat_lulus` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `tgl_lulus` DATE NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_lulus`),
  INDEX `surat_id_idx` (`id_pengajuan` ASC),
  CONSTRAINT `lulus_surat_id`
    FOREIGN KEY (`id_pengajuan`)
    REFERENCES `pengajuan_surat_if`.`pengajuan` (`id_pengajuan`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_lhs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_lhs` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_lhs` (
  `id_surat` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `keperluan` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat`),
  INDEX `surat_id_idx` (`id_pengajuan` ASC),
  CONSTRAINT `lhs_surat_id`
    FOREIGN KEY (`id_pengajuan`)
    REFERENCES `pengajuan_surat_if`.`pengajuan` (`id_pengajuan`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_mhs_aktif`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_mhs_aktif` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_mhs_aktif` (
  `id_surat` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `semester` INT NOT NULL,
  `keperluan` VARCHAR(100) NOT NULL,
  `periode` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_surat`),
  INDEX `surat_id_idx` (`id_pengajuan` ASC),
  CONSTRAINT `mhs_surat_id`
    FOREIGN KEY (`id_pengajuan`)
    REFERENCES `pengajuan_surat_if`.`pengajuan` (`id_pengajuan`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_pengantar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_pengantar` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_pengantar` (
  `id_surat_pengantar` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `penerima` VARCHAR(100) NOT NULL,
  `kode_matkul` VARCHAR(10) NOT NULL,
  `periode` VARCHAR(10) NOT NULL,
  `tujuan` VARCHAR(100) NOT NULL,
  `topik` VARCHAR(100) NOT NULL,
  `data_mhs` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_pengantar`),
  INDEX `surat_id_idx` (`id_pengajuan` ASC),
  INDEX `surat_pengantar_matkul_idx` (`kode_matkul` ASC),
  CONSTRAINT `pengantar_surat_id`
    FOREIGN KEY (`id_pengajuan`)
    REFERENCES `pengajuan_surat_if`.`pengajuan` (`id_pengajuan`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `surat_pengantar_matkul`
    FOREIGN KEY (`kode_matkul`)
    REFERENCES `pengajuan_surat_if`.`mata_kuliah` (`id_matkul`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
