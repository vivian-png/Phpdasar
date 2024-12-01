<?php
// Mengimpor file functions.php jika ada
require 'functions.php'; // Pastikan fungsi submit() ada di file ini

// Koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    if (submit($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'index.php'; // Mengarahkan kembali ke halaman index
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'index.php'; // Mengarahkan kembali ke halaman index
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post">
        <ul>
            <li>
               <label for="nama">NAMA : </label>
               <input type="text" name="nama" id="nama">
            </li>
            <li>
               <label for="nrp">NRP : </label>
               <input type="text" name="nrp" id="nrp">
            </li>
            <li>
               <label for="email">EMAIL : </label>
               <input type="text" name="email" id="email">
            </li>
            <li>
               <label for="jurusan">JURUSAN : </label>
               <input type="text" name="jurusan" id="jurusan">
            </li>
            <li>
               <label for="gambar">GAMBAR : </label>
               <input type="text" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit"> Tambah Data! </button>
            </li>
        </ul>
    </form>
</body>
</html>
