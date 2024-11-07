<?php
include 'conect.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Query untuk mendapatkan foto_profile
    $sql = "SELECT fotoprofile FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto_profile = $row['fotoprofile'];

        // Mengatur header untuk gambar
        header("Content-Type: image/jpeg"); // Ganti dengan tipe gambar yang sesuai
        echo $foto_profile; // Tampilkan gambar
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Image not found.";
    }

    $stmt->close();
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "No username provided.";
}
?>
