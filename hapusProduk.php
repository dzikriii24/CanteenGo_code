<?php
include 'conect.php';
session_start();

// Cek apakah user sudah login dan ada ID produk yang diterima
if (!isset($_SESSION['username']) || !isset($_GET['id'])) {
    header("Location: profileUser.php");
    exit;
}

$id_produk = $_GET['id'];

// Query untuk menghapus produk berdasarkan ID
$sql = "DELETE FROM produk WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id_produk);
    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman profil dengan pesan sukses
        $_SESSION['message'] = "Produk berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat menghapus produk.";
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Terjadi kesalahan pada query.";
}

// Redirect ke halaman profil
header("Location: profileUser.php");
exit;
?>
