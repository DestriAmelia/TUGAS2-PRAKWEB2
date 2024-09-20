# TUGAS2 PRAKWEB2

# *Pengganti Pengawas Ujian dan Laporan Kerja Lembur*

## *Penggunaan*

### *Tutorial langkah-langkah membuat Database di MySQL:*

1. *Membuat Database:*
   buatlah database dengan nama bebas (contoh : tugas_2) dan buat dua tabel yang sesuai:

   sql
   CREATE TABLE pengganti_pengawas_ujian (
       pengganti_id INT NOT NULL AUTO_INCREMENT,
       nama_pengawas_diganti VARCHAR(255) NOT NULL,
       unit_kerja VARCHAR(255) NOT NULL,
       hari_tgl_penggantian DATETIME NOT NULL,
       jam TIME NOT NULL,
       ruang VARCHAR(50) NOT NULL,
       nama_pengawas_pengganti VARCHAR(255) NOT NULL,
       dosen_id INT NOT NULL,
       PRIMARY KEY (pengganti_id)
   );

   CREATE TABLE laporan_kerja_lembur (
       lembur_id INT NOT NULL AUTO_INCREMENT,
       hari_tgl_laporan DATE NOT NULL,
       waktu TIME NOT NULL,
       uraian_pekerjaan VARCHAR(255) NOT NULL,
       keterangan VARCHAR(255) NOT NULL,
       dosen_id INT NOT NULL,
       PRIMARY KEY (lembur_id)
   );
   

2. *Mengaktifkan server:*
   Aktifkan server (contohnys : XAMPP, Laragon).
---

## *Overview*
Repositori ini bertujuan untuk mengimplementasi data sederhana dalam PHP dengan Object-Oriented Programming (OOP) yang berinteraksi dengan database MySQL. Studi kasus yang digunakan adalah *Pengganti Pengawas Ujian* dan *Laporan Kerja Lembur sesuai dengan perintah pada tugas. Kode ini menggunakan konsep dasar OOP seperti **enkapsulasi, **inheretance, dan **polimorfisme, serta menyinggung sedikit mengenai operasi dasar **Create, Read, Update, Delete* (CRUD).

### *Struktur File:*
1. *Database.php*: Merupakan kelas untuk mengelola koneksi Database MySQL yang didalamnya terdapat atribut dan metode.
2. *PenggantiPengawasUjian.php*: Sebuah elas untuk menambahkan CRUD OOP terkait tabel pengganti_pengawas_ujian.
3. *LaporanKerjaLembur.php*: Sebuah kelas untuk menambahkan CRUD OOP terkait tabel laporan_kerja_lembur.

---

## *Penjabaran dari code yang telah dibuat*

### **1. File Database.php**
File 'Database.php' bertugas untuk membuat koneksi ke database MySQL menggunakan mysqli. Kelas ini menyediakan koneksi yang akan digunakan oleh kelas turunan.

php
<?php
class Database {
    protected $conn;  // Properti koneksi yang diakses oleh kelas turunan

    public function __construct() {
        // Koneksi ke database
        $this->conn = new mysqli('localhost', 'root', '', 'tugas_2');

        // Cek jika terjadi error koneksi
        if ($this->conn->connect_error) {
            die("Koneksi ke database gagal: " . $this->conn->connect_error);
        }
    }
}
?>


#### *Penjelasan:*
- *$conn*: Variabel yang menyimpan koneksi database.
- *__construct()*: Metode konstruktor yang dijalankan ketika kelas diinisialisasi, untuk membangun koneksi ke MySQL.
- Jika terjadi error koneksi, sistem akan menampilkan pesan error dan menghentikan eksekusi.

### **2. File PenggantiPengawasUjian.php**
File ini mendefinisikan kelas PenggantiPengawasUjian, yang merupakan turunan dari kelas Database. Kelas ini memiliki dua fungsi utama: readPenggantiPengawas() untuk membaca data dan createPenggantiPengawas() untuk menambah data.

php
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


#### *Penjelasan:*
- *PenggantiPengawasUjian*: Kelas ini mewarisi kelas Database sehingga dapat mengakses properti $conn.
  
- *readPenggantiPengawas()*: Fungsi ini membaca data dari tabel pengganti_pengawas_ujian menggunakan query SQL SELECT *. Hasilnya diambil dalam bentuk array asosiatif dengan fetch_all(MYSQLI_ASSOC).

- *createPenggantiPengawas()*: Fungsi ini menambah data ke tabel pengganti_pengawas_ujian menggunakan prepared statement. Parameter dimasukkan melalui bind_param() untuk menghindari SQL injection.

### **3. File LaporanKerjaLembur.php**
Mirip dengan PenggantiPengawasUjian.php, file ini mendefinisikan kelas LaporanKerjaLembur untuk operasi CRUD pada tabel laporan_kerja_lembur.

php
<?php
include 'Database.php'; // Melakukan include pada file Database.php jika ditemukan

class LaporanKerjaLembur extends Database {
    // Fungsi untuk membaca laporan kerja lembur
    public function readLaporanLembur() {
        $sql = "SELECT * FROM laporan_kerja_lembur";
        $result = $this->conn->query($sql);

        // Cek apakah query berhasil
        if ($result === false) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fungsi untuk membuat laporan kerja lembur
    public function createLaporanLembur($data) {
        $stmt = $this->conn->prepare("INSERT INTO laporan_kerja_lembur (hari_tgl_laporan, waktu, uraian_pekerjaan, keterangan, dosen_id) VALUES (?, ?, ?, ?, ?)");
        
        // Binding parameter untuk query
        $stmt->bind_param('ssssi', 
            $data['hari_tgl_laporan'], 
            $data['waktu'], 
            $data['uraian_pekerjaan'], 
            $data['keterangan'], 
            $data['dosen_id']
        );
        
        return $stmt->execute();
    }
}
?>


#### *Penjelasan:*
- Kelas *LaporanKerjaLembur* juga merupakan turunan dari kelas Database.
- *readLaporanLembur()* dan *createLaporanLembur()* bekerja mirip dengan metode pada kelas PenggantiPengawasUjian, tetapi diterapkan pada tabel laporan_kerja_lembur.

### **4. File test.php**
File ini digunakan untuk menguji koneksi database sederhana.

php
<?php
include 'Database.php';

$db = new Database();
echo "Koneksi berhasil!";
?>


#### *Penjelasan:*
- Menggunakan file ini, Anda dapat memastikan bahwa koneksi ke database berjalan dengan baik.
- Jika koneksi berhasil, pesan "Koneksi berhasil!" akan muncul.

---

## *Catatan*
- Pastikan server MySQL Anda sudah berjalan, dan database serta tabel sudah sesuai dengan yang dibutuhkan.
- Struktur dasar ini dapat dikembangkan lebih lanjut dengan menambahkan operasi Update dan Delete.

---

