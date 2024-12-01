<?php 
// $_GET
$mahasiswa = [
    [
    "nama" => "Vivian Elsya Velyana",
    "nrp" => "048998777",
    "email" => "vivianelsyaveliana@gmail.com",
    "jurusan" => "Rekayasa Perangkat Lunak",
    "gambar" => "viviann.jpg"
    ],
    [
        "nama" => "Erion Erlangga",
        "nrp" => "05545677",
        "email" => "erionn@gmail.com",
        "jurusan" => "Teknik Sepeda Motor",
        "gambar" => "mingyu.jpg"
        ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GET</title>
</head>
<body>
    <h1>Daftar mahasiswa</h1>
    <ul>    <?php foreach( $mahasiswa as $mhs ): ?>
        <li>
          <a href="latihan2.php?nama=<?=$mhs["nama"];?>%nrp=<?= $mhs["nrp"];?>&email=<?= $mhs["email"];?>&jurusan=<?= $mhs["jurusan"];?>"><?= $mhs["nama"]; ?></a>
        </li>
        <?php endforeach; ?>
    
    </ul>

</body>
</html>