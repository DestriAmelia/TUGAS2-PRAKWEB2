<?php

  // membuat kelas Database untuk koneksi
  class Database { 
  // membuat properti 'privat' tujuannya agar hanya dapat diakses oleh class yang ada di Database
  private $db_host = "localhost";
  private $db_user = "root";  // username database
  private $db_pass = "";  // password database
  private $db_name = "tugas_2";  // nama database
  protected $conn; // untuk menyiapkan koneksi dengan database
 
  // method untuk melakukan koneksi kedatabase dengan fungsi 'contsruct'
  public function __construct() 
  {
    
  // inisialisasi koneksi objek intansi dari kelas Database
    $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    if(!$this->conn) { // untuk menampilkan pesan jika konesi tidak tejadi
      
      echo "Gagal terhubung";
    }
  }
}
