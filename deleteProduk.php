<?php
include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['delete'])) {
    $produk_id = $_POST['produk_id'];

    $sql = "DELETE FROM produk WHERE id = '$produk_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile deleted successfully!');</script>";
        header("Location: adminPenjualan.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: adminUser.php");
    exit();
}
?>
