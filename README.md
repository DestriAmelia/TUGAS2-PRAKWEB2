# TUGAS2 PRAKWEB2

# *Pengganti Pengawas Ujian dan Laporan Kerja Lembur*

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

2. *Mengaktifkan server:*
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

// menggunakan perintah 'include' untuk mengimpor file eksternal ke dalam kode file 'PenggantipengawasUjian.php' dan mengevaluasinya di tempat file 'Database.php'.
```sh
include 'Database.php'; 
```
// membuat kelas PenggantiPengawasUjian yang diwarisi dari kelas Database
```sh
class PenggantiPengawasUjian extends Database {
```
// method 'read' untuk membaca data pengganti pengawas ujian
```sh
    public function readPenggantiPengawas() {
        $sql = "SELECT * FROM pengganti_pengawas_ujian";
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
// method 'create' untuk membuat data pengganti pengawas ujian
```sh
    public function createPenggantiPengawas($data) {
        $stmt = $this->conn->prepare("INSERT INTO pengganti_pengawas_ujian (nama_pengawas_diganti, unit_kerja, hari_tgl_penggantian, jam, ruang, nama_pengawas_pengganti, dosen_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
 ```       
// menambahkan 'Binding parameter' untuk query
```sh
        $stmt->bind_param('ssssssi', 
            $data['nama_pengawas_diganti'], 
            $data['unit_kerja'], 
            $data['hari_tgl_penggantian'], 
            $data['jam'], 
            $data['ruang'], 
            $data['nama_pengawas_pengganti'], 
            $data['dosen_id']
        );
```
   // menjalankan query dan mengembalikan hasil data  
```sh
        return $stmt->execute(); 
    }
}
```

#### *Penjelasan:*
- *PenggantiPengawasUjian*: Merupakan kelas anak jadi kelas ini dapat mewarisi kelas Database sehingga dapat mengakses properti $conn.
  
- *readPenggantiPengawas()*: Metode atau fungsi ini membaca data dari tabel pengganti_pengawas menggunakan query SQL SELECT * FROM. Hasilnya diambil dalam bentuk array asosiatif dengan fetch_all(MYSQLI_ASSOC).

- *createPenggantiPengawas()*: Metode atau fungsi ini menambah data ke tabel pengganti_pengawas_ujian menggunakan prepared statement. Parameter dimasukkan melalui bind_param() untuk menghindari SQL injection.

### **3. File LaporanKerjaLembur.php**
Sama dengan PenggantiPengawasUjian.php, file ini mendefinisikan kelas LaporanKerjaLembur untuk operasi CRUD pada tabel laporan_lembur.

// menggunakan perintah 'include' untuk mengimpor file eksternal ke dalam kode file 'LaporanKerjaLembur.php' dan mengevaluasinya di tempat file 'Database.php'.

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
- Kelas *LaporanKerjaLembur* juga sama dengan kelas PenggantiPengawasUjian yang merupakan turunan dari kelas Database.
- *readLaporanLembur()* dan *createLaporanLembur()* merupakan metode untuk membaca dan membuat yang bekerja mirip dengan metode pada kelas PenggantiPengawasUjian, tetapi dalam kelas LaporanKerjaLembur diterapkan pada tabel laporan_kerja_lembur.

### *4. File index.php*
Untuk membuat tampilan DASHBOARD
```sh
index <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengganti Pengawas & Laporan Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="pengganti_pengawas.php">Pengganti Pengawas Ujian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan_lembur.php">Laporan Kerja Lembur</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center" style="color:red;font-family:verdana;"> Ola! <br> Welcome to My Dashboard Tugas 2</h1>
        <p class="text-center" style="font:message-box">Navigasikan di atas terdapat menu pengganti pengawas ujian dan laporan kerja lembur <br> jika kalian klik maka akan kalian akan melihat data yang ada di dalamnya.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
### **Output Index.php**
<img width="957" alt="dashboard" src="https://github.com/user-attachments/assets/f187db7c-dc51-4a9d-8f6a-58013a07bb61">


### **5. File pengganti-pengawas.php**
File ini ntuk membuat tampilan dan tabel pada PenggantiPengawasUjian

// menggunakan perintah 'include' untuk mengimpor file eksternal ke dalam kode file 'pengganti-pengawas.php' dan mengevaluasinya di tempat file 'PenggantiPengawasUjian.php'.
```sh
include 'PenggantiPengawasUjian.php';

$pengganti = new PenggantiPengawasUjian();
$dataPengganti = $pengganti->readPenggantiPengawas();
```
// membuat tampilan dan tabel pada PenggantiPengawasUjian
```sh
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengganti Pengawas Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 style="font-family:courier;color:pink;" ><center>Pengganti Pengawas Ujian<center></h1>
        <table class="table table-bordered table-striped">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Nama Pengawas Diganti</th>
                    <th>Unit Kerja</th>
                    <th>Hari/Tanggal Penggantian</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Nama Pengawas Pengganti</th>
                    <th>Dosen ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataPengganti as $pengganti): ?>
                    <tr>
                        <td><?= $pengganti['pengganti_id'] ?></td>
                        <td><?= $pengganti['nama_pengawas_diganti'] ?></td>
                        <td><?= $pengganti['unit_kerja'] ?></td>
                        <td><?= $pengganti['hari_tgl_penggantian'] ?></td>
                        <td><?= $pengganti['jam'] ?></td>
                        <td><?= $pengganti['ruang'] ?></td>
                        <td><?= $pengganti['nama_pengawas_pengganti'] ?></td>
                        <td><?= $pengganti['dosen_id'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
### **Output pengganti-pengawas.php**
<img width="949" alt="penggantipengawas" src="https://github.com/user-attachments/assets/7f61ba92-2700-4945-a431-dbbfa1a4ebc3">


### **6. File laporan-lembur.php**
File ini untuk membuat tampilan dan tabel pada LaporanKerjaLembur

// menggunakan perintah 'include' untuk mengimpor file eksternal ke dalam kode file 'laporan-lempur.php' dan mengevaluasinya di tempat file 'LaporanKerjaLembur.php'.
```sh
include 'LaporanKerjaLembur.php';

$laporan = new LaporanKerjaLembur();
$dataLaporan = $laporan->readLaporanLembur();
```
// untuk membuat tampilan dan tabel pada LaporanKerjaLembur
```sh
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerja Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 style="color:pink;font-family:courier;"><center>Laporan Kerja Lembur</center></h1>
        <table class="table table-bordered table-striped">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Hari/Tanggal Laporan</th>
                    <th>Waktu</th>
                    <th>Uraian Pekerjaan</th>
                    <th>Keterangan</th>
                    <th>Dosen ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataLaporan as $laporan): ?>
                    <tr>
                        <td><?= $laporan['lembur_id'] ?></td>
                        <td><?= $laporan['hari_tgl_laporan'] ?></td>
                        <td><?= $laporan['waktu'] ?></td>
                        <td><?= $laporan['uraian_pekerjaan'] ?></td>
                        <td><?= $laporan['keterangan'] ?></td>
                        <td><?= $laporan['dosen_id'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div
```
#### *Output laporan-lembur.php*

<img width="959" alt="kerja lembur" src="https://github.com/user-attachments/assets/342d71af-2a50-41f6-b7a4-b06f8a795f6a">


