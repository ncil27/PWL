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
-- Table `pengajuan_surat_if`.`jenis_surat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`jenis_surat` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`jenis_surat` (
  `kode_surat` INT NOT NULL,
  `jenis_surat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`kode_surat`))
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pengajuan_surat_if`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`role` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`role` (
  `id_role` INT NOT NULL,
  `role` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_role`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


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
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  INDEX `id_prodi_di_user_idx` (`id_prodi` ASC) ,
  INDEX `id_role_di_user_idx` (`id_role` ASC) ,
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
-- Table `pengajuan_surat_if`.`pengajuan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengajuan_surat_if`.`pengajuan` ;

CREATE TABLE IF NOT EXISTS `pengajuan_surat_if`.`pengajuan` (
  `id_pengajuan` VARCHAR(20) NOT NULL,
  `id_mhs` VARCHAR(9) NOT NULL,
  `kode_surat` INT NOT NULL,
  `status_pengajuan` INT NOT NULL DEFAULT 0,
  `file_surat` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  UNIQUE INDEX `surat_id_UNIQUE` (`id_pengajuan` ASC) ,
  INDEX `id_mhs_idx` (`id_mhs` ASC) ,
  INDEX `kode_surat_idx` (`kode_surat` ASC) ,
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
  INDEX `surat_id_idx` (`id_pengajuan` ASC) ,
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
  INDEX `surat_id_idx` (`id_pengajuan` ASC) ,
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
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_skma`),
  INDEX `surat_id_idx` (`id_pengajuan` ASC) ,
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
  INDEX `surat_id_idx` (`id_pengajuan` ASC) ,
  CONSTRAINT `pengantar_surat_id`
    FOREIGN KEY (`id_pengajuan`)
    REFERENCES `pengajuan_surat_if`.`pengajuan` (`id_pengajuan`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- begin attached script 'script_insert1'
-- INSERT untuk program_studi

INSERT INTO `pengajuan_surat_if`.`program_studi`
(`id_prodi`,
`program_studi`,`kode_prodi`)
VALUES
('72', 'S-1 Teknik Informatika','if'),
('73','S-1 Sistem Informasi','si'),
('71','S-2 Ilmu Komputer','ik');

insert into `pengajuan_surat_if`.`role`
(
 `id_role`,
 `role`)
VALUES
(0, 'Admin'),
(1, 'Kaprodi'),
(2, 'MO'),
(3, 'Mahasiswa');


insert into `pengajuan_surat_if`.`jenis_surat`
(
 `kode_surat`,
 `jenis_surat`)
VALUES
(0, 'Surat Keterangan Mahasiswa Aktif'),
(1, 'Surat Pengantar Tugas'),
(2, 'Laporan Hasil Studi'),
(3, 'Surat Keterangan Lulus');

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
0,
1,
'72'),
('2372202',
'2372202',
'Cecilia admin',
'admin@cecil.com',
'$2y$10$.lNomzKJerwAdTIq7Hf0aOtve9a497jc3dWQ4D.3p21zQ0qJbxjjC',
0,
1,
'73');
-- end attached script 'script_insert1'
-- begin attached script 'script_trigger_srt'
DELIMITER //

-- Trigger untuk surat_lhs
CREATE TRIGGER generate_id_surat_lhs
BEFORE INSERT ON surat_lhs
FOR EACH ROW
BEGIN
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(20); 
    DECLARE kode_prodi CHAR(2);
    
    -- Ambil kode prodi berdasarkan id_pengajuan
    SELECT u.id_prodi INTO kode_prodi
    FROM users u
    JOIN pengajuan p ON u.id_user = p.id_mhs
    WHERE p.id_pengajuan = NEW.id_pengajuan
    LIMIT 1;

    -- Ambil nomor urut terakhir untuk bulan & tahun ini
    SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(id_surat_lhs, '/', 1) AS UNSIGNED)), 0) INTO NoAkhir
    FROM surat_lhs
    WHERE SUBSTRING_INDEX(id_surat_lhs, '/', -1) = CONCAT(LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));

    -- Nomor urut baru
    SET NoBaru = NoAkhir + 1;

    -- Format ID: nomor/SKMA/kode_prodi/bulan/tahun
    SET id = CONCAT(LPAD(NoBaru, 3, '0'), '/SLHS/', kode_prodi, '/', LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));

    -- Set nilai ID yang akan diinsert
    SET NEW.id_surat_lhs = id;
END;
//

-- Trigger untuk surat_ket_lulus
CREATE TRIGGER generate_id_surat_ket_lulus
BEFORE INSERT ON surat_ket_lulus
FOR EACH ROW
BEGIN
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(20);
    DECLARE kode_prodi CHAR(2);

    SELECT u.id_prodi INTO kode_prodi
    FROM users u
    JOIN pengajuan p ON u.id_user = p.id_mhs
    WHERE p.id_pengajuan = NEW.id_pengajuan
    LIMIT 1;

    SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(id_surat_lulus, '/', 1) AS UNSIGNED)), 0) INTO NoAkhir
    FROM surat_ket_lulus
    WHERE SUBSTRING_INDEX(id_surat_lulus, '/', -1) = CONCAT(LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));

    SET NoBaru = NoAkhir + 1;
    SET id = CONCAT(LPAD(NoBaru, 3, '0'), '/SKL/', kode_prodi, '/', LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));
    SET NEW.id_surat_lulus = id;
END;
//

-- Trigger untuk surat_pengantar
CREATE TRIGGER generate_id_surat_pengantar
BEFORE INSERT ON surat_pengantar
FOR EACH ROW
BEGIN
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(20);
    DECLARE kode_prodi CHAR(2);

    SELECT u.id_prodi INTO kode_prodi
    FROM users u
    JOIN pengajuan p ON u.id_user = p.id_mhs
    WHERE p.id_pengajuan = NEW.id_pengajuan
    LIMIT 1;

    SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(id_surat_pengantar, '/', 1) AS UNSIGNED)), 0) INTO NoAkhir
    FROM surat_pengantar
    WHERE SUBSTRING_INDEX(id_surat_pengantar, '/', -1) = CONCAT(LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));

    SET NoBaru = NoAkhir + 1;
    SET id = CONCAT(LPAD(NoBaru, 3, '0'), '/SP/', kode_prodi, '/', LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));
    SET NEW.id_surat_pengantar = id;
END;
//

-- Trigger untuk surat_mhs_aktif
CREATE TRIGGER generate_id_surat_mhs_aktif
BEFORE INSERT ON surat_mhs_aktif
FOR EACH ROW
BEGIN
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(20);
    DECLARE kode_prodi CHAR(2);

    SELECT u.id_prodi INTO kode_prodi
    FROM users u
    JOIN pengajuan p ON u.id_user = p.id_mhs
    WHERE p.id_pengajuan = NEW.id_pengajuan
    LIMIT 1;

    SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(id_surat_skma, '/', 1) AS UNSIGNED)), 0) INTO NoAkhir
    FROM surat_mhs_aktif
    WHERE SUBSTRING_INDEX(id_surat_skma, '/', -1) = CONCAT(LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));

    SET NoBaru = NoAkhir + 1;
    SET id = CONCAT(LPAD(NoBaru, 3, '0'), '/SKMA/', kode_prodi, '/', LPAD(MONTH(CURDATE()), 2, '0'), '/', YEAR(CURDATE()));
    SET NEW.id_surat_skma = id;
END;
//

-- Trigger untuk pengajuan
CREATE TRIGGER generate_id_pengajuan
BEFORE INSERT ON pengajuan
FOR EACH ROW
BEGIN
    DECLARE NoAkhir INT;
    DECLARE NoBaru INT;
    DECLARE id VARCHAR(20);

    -- Ambil nomor urut terakhir untuk hari ini
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_pengajuan, 11, 4) AS UNSIGNED)), 0) INTO NoAkhir
    FROM pengajuan
    WHERE SUBSTRING(id_pengajuan, 5, 6) = DATE_FORMAT(CURDATE(), '%d%m%y');

    -- Tambahkan nomor urut baru
    SET NoBaru = NoAkhir + 1;

    -- Format ID: PGN-DDMMYYY-0001
    SET id = CONCAT('PGN-', DATE_FORMAT(CURDATE(), '%d%m%y'), '-', LPAD(NoBaru, 4, '0'));

    -- Set nilai id_pengajuan baru
    SET NEW.id_pengajuan = id;
END;
//

DELIMITER ;

-- end attached script 'script_trigger_srt'
