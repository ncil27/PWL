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
CREATE SCHEMA IF NOT EXISTS `pengajuan_surat_if` DEFAULT CHARACTER SET utf8 ;
USE `pengajuan_surat_if` ;

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
  `role` VARCHAR(10) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `status` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat` (
  `surat_id` VARCHAR(20) NOT NULL,
  `jenis_surat` VARCHAR(50) NOT NULL,
  `status_pengajuan` VARCHAR(20) NOT NULL,
  `file_surat` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `id_mhs` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`surat_id`),
  INDEX `id_mhs_idx` (`id_mhs` ASC),
  UNIQUE INDEX `surat_id_UNIQUE` (`surat_id` ASC),
  CONSTRAINT `id_mhs`
    FOREIGN KEY (`id_mhs`)
    REFERENCES `pengajuan_surat_if`.`users` (`id_user`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_mhs_aktif`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_mhs_aktif` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_mhs_aktif` (
  `id_surat` VARCHAR(20) NOT NULL,
  `surat_id` VARCHAR(9) NULL,
  `semester` INT NULL,
  `keperluan` VARCHAR(100) NULL,
  PRIMARY KEY (`id_surat`),
  INDEX `surat_id_idx` (`surat_id` ASC),
  CONSTRAINT `mhs_surat_id`
    FOREIGN KEY (`surat_id`)
    REFERENCES `pengajuan_surat_if`.`surat` (`surat_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_pengantar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_pengantar` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_pengantar` (
  `id_surat_pengantar` VARCHAR(20) NOT NULL,
  `surat_id` VARCHAR(9) NOT NULL,
  `penerima` VARCHAR(100) NOT NULL,
  `kode_matkul` VARCHAR(10) NOT NULL,
  `periode` VARCHAR(10) NOT NULL,
  `tujuan` VARCHAR(100) NOT NULL,
  `topik` VARCHAR(100) NOT NULL,
  `data_mhs` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_surat_pengantar`),
  INDEX `surat_id_idx` (`surat_id` ASC),
  INDEX `surat_pengantar_matkul_idx` (`kode_matkul` ASC),
  CONSTRAINT `pengantar_surat_id`
    FOREIGN KEY (`surat_id`)
    REFERENCES `pengajuan_surat_if`.`surat` (`surat_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `surat_pengantar_matkul`
    FOREIGN KEY (`kode_matkul`)
    REFERENCES `pengajuan_surat_if`.`mata_kuliah` (`id_matkul`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_ket_lulus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_ket_lulus` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_ket_lulus` (
  `id_surat_lulus` VARCHAR(20) NOT NULL,
  `surat_id` VARCHAR(9) NOT NULL,
  `tgl_lulus` DATE NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_surat_lulus`),
  INDEX `surat_id_idx` (`surat_id` ASC),
  CONSTRAINT `lulus_surat_id`
    FOREIGN KEY (`surat_id`)
    REFERENCES `pengajuan_surat_if`.`surat` (`surat_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`surat_lhs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`surat_lhs` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`surat_lhs` (
  `id_surat` VARCHAR(20) NOT NULL,
  `surat_id` VARCHAR(9) NULL,
  `keperluan` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_surat`),
  INDEX `surat_id_idx` (`surat_id` ASC),
  CONSTRAINT `lhs_surat_id`
    FOREIGN KEY (`surat_id`)
    REFERENCES `pengajuan_surat_if`.`surat` (`surat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`notifikasi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`notifikasi` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`notifikasi` (
  `id_notifikasi` VARCHAR(20) NOT NULL,
  `id_penerima` VARCHAR(9) NULL,
  `id_pengirim` VARCHAR(9) NULL,
  `pesan` VARCHAR(30) NULL,
  `status` ENUM('terkirim', 'dibaca') NULL,
  `created_at` TIMESTAMP NULL,
  `surat_id` VARCHAR(20) NULL,
  PRIMARY KEY (`id_notifikasi`),
  INDEX `surat_id_idx` (`surat_id` ASC),
  INDEX `id_penerima_to_user_idx` (`id_penerima` ASC),
  INDEX `id_pengirim_to_user_idx` (`id_pengirim` ASC),
  CONSTRAINT `surat_notif`
    FOREIGN KEY (`surat_id`)
    REFERENCES `pengajuan_surat_if`.`surat` (`surat_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `id_penerima_to_user`
    FOREIGN KEY (`id_penerima`)
    REFERENCES `pengajuan_surat_if`.`users` (`id_user`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `id_pengirim_to_user`
    FOREIGN KEY (`id_pengirim`)
    REFERENCES `pengajuan_surat_if`.`users` (`id_user`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


DELIMITER //

CREATE TRIGGER generate_id_user 
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    DECLARE TahunSekarang CHAR(4);
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(9);

    -- Ambil tahun sekarang dalam format 4 digit (YYYY)
    SET TahunSekarang = DATE_FORMAT(CURDATE(), '%Y');

    -- Cari nomor urut terakhir di tahun ini
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_user, 7, 3) AS UNSIGNED)), 0) INTO NoAkhir
    FROM users
    WHERE SUBSTRING(id_user, 1, 4) = TahunSekarang;

    -- Generate nomor urut baru
    SET NoBaru = NoAkhir + 1;

    -- Format ID User: YYYY72XXX (tahun + kode prodi 72 + nomor urut 3 digit)
    SET id = CONCAT(TahunSekarang, "72", LPAD(NoBaru, 3, '0'));

    -- Set nilai id_user & username yang akan diinsert
    SET NEW.id_user = id;
END;
//

DELIMITER ;


INSERT INTO users (username,name, email, password, role, status, created_at, updated_at)
VALUES ('2372061','Laura Puspa', 'laura@example.com', hash('password123'), 'dosen', 'aktif', NOW(), NOW());

