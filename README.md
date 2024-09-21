# TUGAS2 PRAKWEB2

# *Pengganti Pengawas Ujian dan Laporan Kerja Lembur*

## *Penggunaan*

### *Tutorial langkah-langkah membuat Database di MySQL:*

1. *Membuat Database:*
   buatlah database dengan nama bebas (contoh : tugas_2) dan buat dua tabel yang sesuai:

```sh
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
``` 

3. *Mengaktifkan server:*
   Aktifkan server (contohnys : XAMPP, Laragon).

## *Overview*
Repositori ini bertujuan untuk mengimplementasi data sederhana dalam PHP dengan Object-Oriented Programming (OOP) yang berinteraksi dengan database MySQL. Studi kasus yang digunakan adalah *Pengganti Pengawas Ujian* dan *Laporan Kerja Lembur sesuai dengan perintah pada tugas. Kode ini menggunakan konsep dasar OOP seperti **enkapsulasi, **inheretance, dan **polimorfisme, serta menyinggung sedikit mengenai operasi dasar **Create, Read, Update, Delete* (CRUD).

### *Struktur File:*
1. *Database.php*: Merupakan kelas untuk mengelola koneksi Database MySQL yang didalamnya terdapat atribut dan metode.
2. *PenggantiPengawasUjian.php*: Sebuah elas untuk menambahkan CRUD OOP terkait tabel pengganti_pengawas_ujian.
3. *LaporanKerjaLembur.php*: Sebuah kelas untuk menambahkan CRUD OOP terkait tabel laporan_kerja_lembur.

## *Penjabaran dari code yang telah dibuat*

### **1. File Database.php**
File 'Database.php' bertugas untuk membuat koneksi ke database MySQL menggunakan mysqli. Kelas ini menyediakan koneksi yang akan digunakan oleh kelas turunan.

<?php

  // membuat kelas Database untuk koneksi

```sh
  class Database { 
```

  // membuat properti 'privat' tujuannya agar hanya dapat diakses oleh 

```sh
class yang ada di Database
  private $db_host = "localhost";
  private $db_user = "root";  // username database
  private $db_pass = "";  // password database
  private $db_name = "tugas_2";  // nama database
  protected $conn; // untuk menyiapkan koneksi dengan database
```
  // method untuk melakukan koneksi kedatabase dengan fungsi 'contsruct'
  
```sh 
  public function __construct() 
  {
```
  
  // inisialisasi koneksi objek intansi dari kelas Database

```sh
    $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
```
    // untuk menampilkan pesan jika koneksi tidak tejadi

```sh
     if(!$this->conn) { 
      
      echo "Gagal terhubung";
    }
  }
}
```

#### *Penjelasan:*
- *$conn*: merupakan variabel untuk menyimpan koneksi database.
- *__construct()*: merupakan sebuah fungsi atau metode 'konstruktor' yang dijalankan ketika kelas diinisialisasi, untuk membangun koneksi ke MySQL.
- Apabila codingan mengalami error koneksi, sistem akan menampilkan pesan error dan menghentikan eksekusi.

### **2. File PenggantiPengawasUjian.php**
File ini mendefinisikan kelas PenggantiPengawasUjian, yang merupakan turunan dari kelas Database. Kelas ini memiliki dua fungsi utama: readPenggantiPengawas() untuk membaca data dan createPenggantiPengawas() untuk menambah data.


<?php

// Melakukan 'include' pada file Database.php
include 'Database.php'; 

penggantian pengawasan ujian <?php

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


#### *Penjelasan:*
- *PenggantiPengawasUjian*: Merupakan kelas anak jadi kelas ini dapat mewarisi kelas Database sehingga dapat mengakses properti $conn.
  
- *readPenggantiPengawas()*: Metode atau fungsi ini membaca data dari tabel pengganti_pengawas menggunakan query SQL SELECT * FROM. Hasilnya diambil dalam bentuk array asosiatif dengan fetch_all(MYSQLI_ASSOC).

- *createPenggantiPengawas()*: Metode atau fungsi ini menambah data ke tabel pengganti_pengawas_ujian menggunakan prepared statement. Parameter dimasukkan melalui bind_param() untuk menghindari SQL injection.

### **3. File LaporanKerjaLembur.php**
Sama dengan PenggantiPengawasUjian.php, file ini mendefinisikan kelas LaporanKerjaLembur untuk operasi CRUD pada tabel laporan_lembur.

 <?php

// menggunakan perintah 'include' pada file Database.php untuk membaca data

```sh
include 'Database.php'; 
```

// membuat kelas turunan

```sh
class LaporanKerjaLembur extends Database {
// Fungsi untuk membaca data pengganti pengawas ujian
    public function readLaporanLembur() {
        $sql = "SELECT * FROM laporan_kerja_lembur";
        $result = $this->conn->query($sql);
```

// mengecek query jika berhasil

```sh
        if ($result === false) {
            return [];
        }
```

// mengembalikan hasil dalam bentuk array asosiatif

```sh
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
```

// method 'createLaporanLembur' untuk membuat data pengganti pengawas ujian

```sh
    public function createLaporanLembur($data) {
        $stmt = $this->conn->prepare("INSERT INTO laporan_kerja_lembur (hari_tgl_laporan, waktu, uraian_pekerjaan, keterangan, dosen_id) VALUES (?, ?, ?, ?, ?)");
```

// menggunakan 'binding parameter' untuk query

```sh
        $stmt->bind_param('ssssssi', 
        $data['hari_tgl_laporan'], 
        $data['waktu'], 
        $data['uraian_pekerjaan'], 
        $data['keterangan'], 
        $data['dosen_id']);
```

 // mengeksekusi query dan mengembalikan hasil data

 ```sh
        return $stmt->execute(); 
    }
}
?>
```


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

