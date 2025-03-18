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
  `kode_prodi` CHAR(2) NOT NULL,
  PRIMARY KEY (`id_prodi`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`role` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`role` (
  `id_role` INT NOT NULL,
  `role` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_role`))
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
  `id_role` INT NOT NULL,
  `status` INT NOT NULL,
  `id_prodi` CHAR(2) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `id_prodi_di_user_idx` (`id_prodi` ASC),
  INDEX `id_role_di_user_idx` (`id_role` ASC),
  CONSTRAINT `id_prodi_di_user`
    FOREIGN KEY (`id_prodi`)
    REFERENCES `pengajuan_surat_if`.`program_studi` (`id_prodi`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `id_role_di_user`
    FOREIGN KEY (`id_role`)
    REFERENCES `pengajuan_surat_if`.`role` (`id_role`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`jenis_surat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`jenis_surat` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`jenis_surat` (
  `kode_surat` INT NOT NULL,
  `jenis_surat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`kode_surat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`pengajuan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`pengajuan` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`pengajuan` (
  `id_pengajuan` VARCHAR(20) NOT NULL,
  `id_mhs` VARCHAR(9) NOT NULL,
  `kode_surat` INT NOT NULL,
  `status_pengajuan` INT NOT NULL,
  `file_surat` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  UNIQUE INDEX `surat_id_UNIQUE` (`id_pengajuan` ASC),
  INDEX `id_mhs_idx` (`id_mhs` ASC),
  INDEX `kode_surat_idx` (`kode_surat` ASC),
  CONSTRAINT `id_mhs`
    FOREIGN KEY (`id_mhs`)
    REFERENCES `pengajuan_surat_if`.`users` (`id_user`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `kode_surat`
    FOREIGN KEY (`kode_surat`)
    REFERENCES `pengajuan_surat_if`.`jenis_surat` (`kode_surat`)
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
  `id_surat_lhs` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `keperluan` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_lhs`),
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
  `id_surat_skma` VARCHAR(20) NOT NULL,
  `id_pengajuan` VARCHAR(9) NOT NULL,
  `semester` INT NOT NULL,
  `keperluan` VARCHAR(100) NOT NULL,
  `periode` VARCHAR(15) NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_surat_skma`),
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
-- begin attached script 'script_insert1'
USE `pengajuan_surat_if`;
SELECT * FROM USERS;

INSERT INTO `pengajuan_surat_if`.`program_studi`
(`id_prodi`,
`program_studi`,`kode_prodi`)
VALUES
('72', 'S-1 Teknik Informatika','if'),
('73','S-1 Sistem Informasi','si'),
('71','S-2 Ilmu Komputer','s2');

insert into `pengajuan_surat_if`.`role`
(
 `id_role`,
 `role`)
VALUES
(0, 'Admin'),
(1, 'Kaprodi'),
(2, 'MO'),
(3, 'Mahasiswa');

INSERT INTO `pengajuan_surat_if`.`users`
(`id_user`,
`username`,
`name`,
`email`,
`password`,
`id_role`,
`status`,
`id_prodi`)
VALUES
('2372061',
'2372061',
'Laura Puspa Ameliana',
'2372061@maranatha.ac.id',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
3,
1,
'72'),
('2372060',
'2372060',
'Cecilia Anna Hartanti Naibaho',
'2372060@maranatha.ac.id',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
3,
1,
'73'),
('2372601',
'2372601',
'Laura MO',
'laura.mo@gmail.co',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
2,
1,
'72'),
('2372600',
'2372600',
'Cecilia MO',
'cecil@mo.co',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
2,
1,
'73'),

('2372100',
'2372100',
'Laura kaprodi',
'kaprodi@if.laura',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
1,
1,
'72'),
('2372200',
'2372200',
'Cecilia kaprodi',
'kaprodi@cecil.com',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
1,
1,
'73'),

('2372101',
'2372101',
'Laura admin',
'admin@if.laura',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
1,
1,
'72'),
('2372202',
'2372202',
'Cecilia admin',
'admin@cecil.com',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
1,
1,
'73');



-- end attached script 'script_insert1'
