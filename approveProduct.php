<?php
include 'conect.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
  }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $product_id = $_POST['product_id'];

    // Update status produk menjadi 'approved'
    $sql = "UPDATE produk SET status = 'approved' WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil disetujui!');</script>";
        header("Location: adminPenjualan.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
