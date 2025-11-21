<?php
session_start();
include "../../config/db.php";

// Proteksi admin
if ($_SESSION['role'] !== "admin") {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Hapus postingan
$query = "DELETE FROM posts WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Postingan berhasil dihapus!'); window.location='../admin.php';</script>";
} else {
    echo "Gagal menghapus postingan.";
}
?>
