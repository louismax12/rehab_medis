CREATE DATABASE IF NOT EXISTS askes;
USE askes;

-- 1. Table pasien
CREATE TABLE IF NOT EXISTS pasien (
    no_rm VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    alamat TEXT,
    tgl_lahir DATE,
    no_telp VARCHAR(20),
    no_ktp VARCHAR(30),
    INDEX idx_nama (nama)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Table kunjungan
CREATE TABLE IF NOT EXISTS kunjungan (
    no_register VARCHAR(30) PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL,
    tgl_kunjungan DATE NOT NULL,
    dokter_id VARCHAR(5) NOT NULL, -- Merujuk ke NIP di hrd.datadasar
    status ENUM('baru', 'ulang', 'selesai') DEFAULT 'baru',
    FOREIGN KEY (no_rm) REFERENCES pasien(no_rm) ON DELETE CASCADE,
    INDEX idx_norm (no_rm),
    INDEX idx_dokter (dokter_id),
    INDEX idx_tgl (tgl_kunjungan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Table rekam_medis
CREATE TABLE IF NOT EXISTS rekam_medis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_register VARCHAR(30) NOT NULL,
    diagnosa_masuk TEXT,
    keluhan_utama TEXT,
    riwayat_sekarang TEXT,
    riwayat_dulu TEXT,
    riwayat_keluarga TEXT,
    jenis_form ENUM('umum', 'muskuloskeletal', 'kardiorespiratori', 'neuromuskuler') DEFAULT 'umum',
    detail_pemeriksaan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (no_register) REFERENCES kunjungan(no_register) ON DELETE CASCADE,
    INDEX idx_noregister (no_register)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 4. Table body_mapping
CREATE TABLE IF NOT EXISTS body_mapping (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rekam_medis_id INT NOT NULL,
    x_coord INT NOT NULL,
    y_coord INT NOT NULL,
    keterangan VARCHAR(255) NOT NULL,
    FOREIGN KEY (rekam_medis_id) REFERENCES rekam_medis(id) ON DELETE CASCADE,
    INDEX idx_rmid (rekam_medis_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
