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
-- Table `pengajuan_surat_if`.`program_studi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`program_studi` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`program_studi` (
  `id_prodi` CHAR(2) NOT NULL,
  `program_studi` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id_prodi`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`users` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`users` (
  `id_user` VARCHAR(9) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `role` ENUM("mahasiswa", "admin", "mo", "kaprodi") NOT NULL,
  `status` ENUM("aktif", "non-aktif") NOT NULL,
  `id_prodi` CHAR(2) NOT NULL,
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
  `jenis_surat` ENUM("skma", "lhs", "skl", "spt") NOT NULL,
  `status_pengajuan` ENUM("diterima", "ditolak", "diproses", "menunggu") NOT NULL,
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
