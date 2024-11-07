<?php
include 'conect.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {
    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM produk WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil ditolak dan dihapus!');</script>";
        header("Location: adminPenjualan.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
