CREATE DATABASE sim_gizi;
USE sim_gizi;

CREATE TABLE mitra (
    id_mitra INT AUTO_INCREMENT PRIMARY KEY,
    nama_mitra VARCHAR(100),
    jenis VARCHAR(50),
    alamat TEXT,
    status_verifikasi ENUM('Pending', 'Terverifikasi', 'Ditolak')
);

CREATE TABLE dapur (
    id_dapur INT AUTO_INCREMENT PRIMARY KEY,
    nama_dapur VARCHAR(100),
    alamat TEXT,
    penanggung_jawab VARCHAR(100),
    kontak VARCHAR(20),
    id_mitra INT,
 
    CONSTRAINT fk_dapur_mitra
    FOREIGN KEY (id_mitra)
    REFERENCES mitra(id_mitra)
    ON UPDATE CASCADE
    ON DELETE SET NULL
);

