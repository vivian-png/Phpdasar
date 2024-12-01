<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;

}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa where id = $id");

    return mysqli_affected_rows($conn);
}

function submit($data)
{
    global $conn;

    $nama= htmlspecialchars($data["nama"]);
    $nrp= htmlspecialchars($data["nrp"]);
    $email= htmlspecialchars($data["email"]);
    $jurusan= htmlspecialchars($data["jurusan"]);
    $gambar= htmlspecialchars($data["gambar"]);
    
    $query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";


    mysqli_query( $conn, $query);

    return mysqli_affected_rows( $conn);
}

?>