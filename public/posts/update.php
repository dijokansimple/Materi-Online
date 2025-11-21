<?php
session_start();
include "../../config/db.php";

// Proteksi admin
if ($_SESSION['role'] !== "admin") {
    header("Location: ../login.php");
    exit;
}

// Pastikan ada ID
if (!isset($_GET['id'])) {
    echo "ID postingan tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Ambil data postingan
$result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id'");
$post = mysqli_fetch_assoc($result);

if (!$post) {
    echo "Postingan tidak ditemukan.";
    exit;
}

// Jika tombol submit ditekan
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $video_url = $_POST['video_url'];

    $query = "UPDATE posts 
              SET title='$title', content='$content', video_url='$video_url'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Postingan berhasil diperbarui!'); window.location='../admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui postingan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>
<div class="container">

    <h2>Edit Postingan</h2>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']); ?>" required>
        <textarea name="content" required><?= htmlspecialchars($post['content']); ?></textarea>
        <input type="text" name="video_url" value="<?= htmlspecialchars($post['video_url']); ?>">
        <button type="submit" name="submit">Update</button>
        <a href="../admin.php" class="back-btn">Kembali</a>
    </form>
</div>
</body>
</html>
