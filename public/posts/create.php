<?php
session_start();
include "../../config/db.php";

// Proteksi admin
if ($_SESSION['role'] !== "admin") {
    header("Location: ../public/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $video_url = $_POST['video_url'];
    $created_by = $_SESSION['username'];

    $query = "INSERT INTO posts (title, content, video_url, created_by)
              VALUES ('$title', '$content', '$video_url', (SELECT id FROM users WHERE username='$created_by'))";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Postingan berhasil ditambahkan!'); window.location='../admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah postingan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Postingan</title>
    <link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>
<div class="container">

    <h2>Buat Postingan Baru</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Judul Materi" required>
        <textarea name="content" placeholder="Isi materi" required></textarea>
        <input type="text" name="video_url" placeholder="URL Video YouTube">
        <button type="submit" name="submit">Simpan</button>
        <button href="../admin.php" class="back-btn">Kembali</button>
    </form>
</div>
</body>
</html>
