<?php

// melakukan perintah 'include; pada file Database.php untuk membaca data
include 'Database.php'; 

class PenggantiPengawasUjian extends Database {
// method 'read' untuk membaca data pengganti pengawas ujian
    public function readPenggantiPengawas() {
        $sql = "SELECT * FROM pengganti_pengawas_ujian";
        $result = $this->conn->query($sql);
        
// mengecek query jika berhasil
        if ($result === false) {
            return [];
        }
// mengembalikan hasil dalam bentuk array asosiatif
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

// method 'create' untuk membuat data pengganti pengawas ujian
    public function createPenggantiPengawas($data) {
        $stmt = $this->conn->prepare("INSERT INTO pengganti_pengawas_ujian (nama_pengawas_diganti, unit_kerja, hari_tgl_penggantian, jam, ruang, nama_pengawas_pengganti, dosen_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
// menambahkan 'Binding parameter' untuk query
        $stmt->bind_param('ssssssi', 
            $data['nama_pengawas_diganti'], 
            $data['unit_kerja'], 
            $data['hari_tgl_penggantian'], 
            $data['jam'], 
            $data['ruang'], 
            $data['nama_pengawas_pengganti'], 
            $data['dosen_id']
        );
   // menjalankan query dan mengembalikan hasil data     
        return $stmt->execute(); 
    }
}
?>
