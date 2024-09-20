<?php

include 'Database.php'; // Melakukan include pada file Database.php jika ditemukan

class PenggantiPengawasUjian extends Database {
    // Fungsi untuk membaca data pengganti pengawas ujian
    public function readPenggantiPengawas() {
        $sql = "SELECT * FROM pengganti_pengawas_ujian";
        $result = $this->conn->query($sql);
        
        // Cek apakah query berhasil
        if ($result === false) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC); // Kembalikan hasil dalam bentuk array asosiatif
    }

    // Fungsi untuk membuat data pengganti pengawas ujian
    public function createPenggantiPengawas($data) {
        $stmt = $this->conn->prepare("INSERT INTO pengganti_pengawas_ujian (nama_pengawas_diganti, unit_kerja, hari_tgl_penggantian, jam, ruang, nama_pengawas_pengganti, dosen_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Binding parameter untuk query
        $stmt->bind_param('ssssssi', 
            $data['nama_pengawas_diganti'], 
            $data['unit_kerja'], 
            $data['hari_tgl_penggantian'], 
            $data['jam'], 
            $data['ruang'], 
            $data['nama_pengawas_pengganti'], 
            $data['dosen_id']
        );
        
        return $stmt->execute(); // Eksekusi query dan kembalikan hasil
    }
}
?>
