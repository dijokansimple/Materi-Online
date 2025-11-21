<?php 
session_start();
include "../config/db.php";

// Proteksi role user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// Ambil semua postingan
$posts = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Materi</title>
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>
<div class="container">

    <header>
        <h2>Daftar Materi</h2>
        <a href="logout.php" class="btn-logout">Logout</a>
    </header>

    <div class="cards">
        <?php while ($p = mysqli_fetch_assoc($posts)) : ?>
            <div class="card">
                <h3><?= htmlspecialchars($p['title']); ?></h3>
                <a href="view.php?id=<?= $p['id']; ?>">Lihat</a>
            </div>
        <?php endwhile; ?>
    </div>

</div>
</body>
</html>
