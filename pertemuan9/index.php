<?php
require 'functions.php';
$Mahasiswa = query("SELECT * FROM Mahasiswa");
?>

<!DOCTYPE html>
<html>
<head>
      <title>Halaman Admin</title>
</head>
<body>

<h1>Daftar Mahasiswa</h1>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>

    <?php foreach( $Mahasiswa as $row ): ?>
    <tr>
        <td><?= $row["id"]; ?></td>
        <td>
            <a href="">ubah</a> |
            <a href="">hapus</a>
        </td>
        <td><img src="img/<?=$row["gambar"]; ?> " width="50"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr> 
    <?php endforeach; ?>

</table>

</body>
</html>