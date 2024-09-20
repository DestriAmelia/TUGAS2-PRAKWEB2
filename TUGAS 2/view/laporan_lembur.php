<?php
include 'LaporanKerjaLembur.php';

$laporan = new LaporanKerjaLembur();
$dataLaporan = $laporan->readLaporanLembur();
?>

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
