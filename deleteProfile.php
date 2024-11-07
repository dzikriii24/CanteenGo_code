<?php
include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM user WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile deleted successfully!');</script>";
        header("Location: adminUser.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: adminUser.php");
    exit();
}
?>
