<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Ambil data mahasiswa untuk ditampilkan pada halaman pertama kali
$mahasiswa = query("SELECT * FROM mahasiswa");

// Cek jika form pencarian disubmit
if (isset($_POST["keyword"])) {
    // Panggil fungsi cari dan ambil hasil pencarian berdasarkan keyword
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
</head>
<body>

<a href="logout.php">Logout</a>

<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<!-- Form Pencarian dengan oninput -->
<form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Cari!</button>
</form>

<br>
<div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Nrp</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach( $mahasiswa as $row ): ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
            <a href="ubah.php?id=<?= $row['id']; ?>">ubah</a> |
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">hapus</a>
            </td>
            
            <td><img src="img/<?= $row["gambar"]; ?> " width="50px"></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["nrp"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr> 
        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>