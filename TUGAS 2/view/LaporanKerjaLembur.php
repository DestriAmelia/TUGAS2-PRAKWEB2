<?php

// menggunakan perintah 'include' pada file Database.php untuk membaca data
include 'Database.php'; 

// membuat kelas turunan
class LaporanKerjaLembur extends Database {
// Fungsi untuk membaca data pengganti pengawas ujian
    public function readLaporanLembur() {
        $sql = "SELECT * FROM laporan_kerja_lembur";
        $result = $this->conn->query($sql);
        
// mengecek query jika berhasil
        if ($result === false) {
            return [];
        }
// mengembalikan hasil dalam bentuk array asosiatif
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

// method 'createLaporanLembur' untuk membuat data pengganti pengawas ujian
    public function createLaporanLembur($data) {
        $stmt = $this->conn->prepare("INSERT INTO laporan_kerja_lembur (hari_tgl_laporan, waktu, uraian_pekerjaan, keterangan, dosen_id) VALUES (?, ?, ?, ?, ?)");
        
// menggunakan 'binding parameter' untuk query
        $stmt->bind_param('ssssssi', 
        $data['hari_tgl_laporan'], 
        $data['waktu'], 
        $data['uraian_pekerjaan'], 
        $data['keterangan'], 
        $data['dosen_id']);
        
 // mengeksekusi query dan mengembalikan hasil data    
        return $stmt->execute(); 
    }
}
?>
