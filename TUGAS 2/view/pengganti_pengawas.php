<?php
include 'PenggantiPengawasUjian.php';

$pengganti = new PenggantiPengawasUjian();
$dataPengganti = $pengganti->readPenggantiPengawas();
?>

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
