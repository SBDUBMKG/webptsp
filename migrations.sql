-- ----------------------------------------------------------------
-- THIS FILE CONTAINS SQL STATEMENTS TO MIGRATE THE DATABASE SCHEMA
-- FROM DEVELOPMENT TO PRODUCTION
--
-- @Author: ArkjuniorK
-- @Date: 2024-11-28
-- @Version: 1.0.0
-- @Copyright: 2024 PT. Infini Kreasi Nusantara
-- ----------------------------------------------------------------
-- Specify the database
USE `db_bmkg`;

-- Create table of blocked users for internal chats
CREATE TABLE `ac_blck_usr` (
    `usr_id` int(11) DEFAULT NULL,
    `blckd_usr_id` int(11) DEFAULT NULL,
    UNIQUE KEY `user_id` (`usr_id`, `blckd_usr_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_general_ci;

-- Create table contains all user's messages
CREATE TABLE `ac_msgs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `m_frm` int(11) NOT NULL,
    `m_to` int(11) NOT NULL,
    `msg` text CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `is_read` enum ('0', '1') NOT NULL DEFAULT '0',
        `frm_del` tinyint (1) NOT NULL DEFAULT 0,
        `to_del` tinyint (1) NOT NULL DEFAULT 0,
        `dt_upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_general_ci;

-- Create table to store user's last message
CREATE TABLE `ac_usrs_msgs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usr_id` int(11) NOT NULL,
    `msg_id` int(11) NOT NULL,
    `dt_upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_general_ci;

-- Alter m_layanan table,
ALTER TABLE `m_layanan`
ADD COLUMN `satuan_en` varchar(255) NULL AFTER `satuan`,
ADD COLUMN `display_coloumn_en` text NULL AFTER `display_coloumn`;

-- Add indexing to m_layanan table
CREATE INDEX `layanan` ON `m_layanan` (`layanan`);

CREATE INDEX `layanan_en` ON `m_layanan` (`layanan_en`);

-- Alter tbl_admin table,
ALTER TABLE `tbl_admin`
ADD COLUMN `ac_online` tinyint (1) NOT NULL DEFAULT 0,
ADD COLUMN `ac_image` varchar(255) NULL;

-- Add indexing to tbl_admin table
CREATE INDEX `nama` ON `tbl_admin` (`nama`);

CREATE INDEX `no_hp` ON `tbl_admin` (`no_hp`);

CREATE INDEX `pekerjaan` ON `tbl_admin` (`pekerjaan`);

CREATE INDEX `tanggal_lahir` ON `tbl_admin` (`tanggal_lahir`);

CREATE INDEX `jenis_kelamin` ON `tbl_admin` (`jenis_kelamin`);

-- Alter table tbl_detail_permohonan,
ALTER TABLE `tbl_detail_permohonan`
ADD COLUMN `jumlah_dokumen` int(11) NULL AFTER `jumlah_hari`,
ADD COLUMN `tahapan_proses` tinyint (4) NULL AFTER `status`;

-- Alter table tbl_file_menu,
ALTER TABLE `tbl_file_menu`
ADD COLUMN `nama_file_en` varchar(255) NULL AFTER `nama_file`;

-- Alter table tbl_halaman_menu
ALTER TABLE `tbl_halaman_menu`
ADD COLUMN `nama_halaman_en` varchar(255) NULL AFTER `nama_halaman`;

-- Add tbl_libur table
CREATE TABLE `tbl_libur` (
    `id_libur` int(11) NOT NULL AUTO_INCREMENT,
    `tgl_mulai` date DEFAULT NULL,
    `tgl_akhir` date DEFAULT NULL,
    `keterangan` varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id_libur`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Alter table tbl_permohonan
ALTER TABLE `tbl_permohonan`
ADD COLUMN `no_surat_keluar` varchar(255) NULL AFTER `tanggal_permohonan`,
ADD COLUMN `tgl_surat_keluar` date NULL AFTER `no_surat_keluar`;

-- Add indexing to tbl_permohonan table
CREATE INDEX `id_pemohon` ON `tbl_permohonan` (`id_pemohon`);

CREATE INDEX `no_permohonan` ON `tbl_permohonan` (`no_permohonan`);

CREATE INDEX `tanggal_verifikasibendahara` ON `tbl_permohonan` (`tanggal_verifikasibendahara`);

-- Add indexing to tbl_perusahaan table
CREATE INDEX `email` ON `tbl_perusahaan` (`email`);

CREATE INDEX `no_telepon` ON `tbl_perusahaan` (`no_telepon`);

CREATE INDEX `perusahaan` ON `tbl_perusahaan` (`perusahaan`);

-- Alter table tbl_slider
ALTER TABLE `tbl_slider`
ADD COLUMN `title` varchar(255) NULL NULL AFTER `id_slider`,
ADD COLUMN `urutan` smallint(6) NULL;
