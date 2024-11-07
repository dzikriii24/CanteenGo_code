<?php
include 'conect.php';


// Ambil ID gambar dari parameter GET


// Query untuk mengambil gambar
$query = "SELECT foto_produk FROM produk";
$stmt = $koneksi->prepare($query);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Set header untuk tipe gambar (misalnya image/png, image/jpeg)
    // Keluarkan data gambar
    echo $row['foto_produk'];
} else {
    // Tampilkan gambar default jika tidak ditemukan
    header("Content-Type: image/png");
    readfile("path/ke/gambar/default.png");
}

$stmt->close();
$koneksi->close();
exit();
?>