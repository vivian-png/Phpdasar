<?php
$siswa = [
    [
        "nis" => "07634119",
        "nama" => "Vivian Elsya Velyana",
        "email" => "vivianelsyaveliana@gmail.com",
        "jurusan" => "Rekayasa Perangkat Lunak",
        "gambar" => "fotoaku.jpg"
    ],
    [
        "nis" => "06545699",
        "nama" => "Arsa Renjana Anindita",
        "email" => "haiiakuarsa0@gmail.com",
        "jurusan" => "Desain Komunikasi Visual",
        "gambar" => "fotoarsaa.jpg"
    ]
]
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Siswa</title>
<head>

<body>
    <h1>Daftar Siswa</h1>

    <?php foreach ($siswa as $s): ?>
        <ul>
            <li>
                <img src="img/<?= $s["gambar"]; ?>" width="200px">
            </li>
            <li>Nama : <?= $s["nama"]; ?></li>
            <li>NIS : <?= $s["nis"]; ?></li>
            <li>Jurusan : <?= $s["jurusan"]; ?></li>
            <li>Email : <?= $s["email"]; ?></li>
        </ul>
      <?php endforeach; ?>
    </body>

    </html