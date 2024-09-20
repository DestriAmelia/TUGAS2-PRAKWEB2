<?php

class Database { // pembuatan class Database untuk melakukan koneksi
  // pembuatan atribut privat agar hanya dapat diakses oleh class Database
  private $db_host = "localhost";
  private $db_user = "root";  // username database
  private $db_pass = "";  // password database
  private $db_name = "tugas_2";  // nama database
  protected $conn; // untuk menyiapkan koneksi dengan database
 

  public function __construct() // untuk melakukan koneksi kedatabase
  {
    // inisialisasi koneksi
    $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    if(!$this->conn) { // untuk menampilkan pesan jika konesi tidak tejadi
      
      echo "Gagal terhubung";
    }
  }

}