<?php
require "../config/db.php";

$posts = mysqli_query($conn, "SELECT * FROM posts");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="container">

    <header>
        <h2>Admin Panel</h2>
        <div class="top-buttons">
            <a href="posts/create.php" class="btn btn-create">Buat Postingan Baru</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </header>

    <div class="cards">
        <?php while ($p = mysqli_fetch_assoc($posts)) : ?>
            <div class="card">
                <h3><?= htmlspecialchars($p['title']); ?></h3>
                <div class="actions">
                    <a href="posts/update.php?id=<?= $p['id']; ?>">Edit</a>
                    <a href="posts/delete.php?id=<?= $p['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>
</body>
</html>
