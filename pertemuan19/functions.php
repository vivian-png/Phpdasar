<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function hapus($id)
{
    global $conn;
    // Pastikan Anda melindungi query dengan prepared statements atau escaping agar terhindar dari SQL Injection
    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function submit($data) 
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }
    
    $query = "INSERT INTO mahasiswa
                VALUES
              ('','$nama', '$nrp', '$email', '$jurusan', '$gambar')
              ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
             </script>";
        return false; 
    }

    // Cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
             </script>";
        return false; 
    }

    // Lolos pengecekkan, gambar siap diupload
    // Gemerate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

    return $namaFileBaru;



}


function ubah($data) {
    global $conn;

    $id = $data["id"];

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error']=== 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
              WHERE id = '$id'
                ";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    global $conn;

    // Mencegah SQL Injection dengan menggunakan mysqli_real_escape_string
    $keyword = mysqli_real_escape_string($conn, $keyword);

    // Query pencarian
    $query = "SELECT * FROM mahasiswa
                  WHERE
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";

    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('username yang dipilih sudah terdaftar!')
              </script>";
        return false;
    }

    // Cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
               </script>"; 
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");

    return mysqli_affected_rows($conn);

}



?>