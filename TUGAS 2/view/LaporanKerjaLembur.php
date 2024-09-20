
<?php

include 'Database.php'; // Melakukan include pada file Database.php jika ditemukan

class LaporanKerjaLembur extends Database {
    // Fungsi untuk membaca data pengganti pengawas ujian
    public function readLaporanLembur() {
        $sql = "SELECT * FROM laporan_kerja_lembur";
        $result = $this->conn->query($sql);
        
        // Cek apakah query berhasil
        if ($result === false) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC); // Kembalikan hasil dalam bentuk array asosiatif
    }

    // Fungsi untuk membuat data pengganti pengawas ujian
    public function createLaporanLembur($data) {
        $stmt = $this->conn->prepare("INSERT INTO laporan_kerja_lembur (hari_tgl_laporan, waktu, uraian_pekerjaan, keterangan, dosen_id) VALUES (?, ?, ?, ?, ?)");
        
        // Binding parameter untuk query
        $stmt->bind_param('ssssssi', 
        $data['hari_tgl_laporan'], 
        $data['waktu'], 
        $data['uraian_pekerjaan'], 
        $data['keterangan'], 
        $data['dosen_id']);
        
        return $stmt->execute(); // Eksekusi query dan kembalikan hasil
    }
}
?>
