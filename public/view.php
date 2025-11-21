<?php
session_start();
include "../config/db.php";
$base_url = '/MATERI_APP'; 

// Proteksi user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID materi tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Ambil data materi
$result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id'");
$materi = mysqli_fetch_assoc($result);

if (!$materi) {
    echo "Materi tidak ditemukan.";
    exit;
}

// Convert YouTube URL ke embed, biar apa bang ??? biar bisa ditampilin di iframe, simpleny : gweh admin upload video youtube link, terus di view.php di convert ke embed biar bisa di tampilin di iframe. mikirs kidzs.
function convertYouTube($url) {
    $pattern1 = '/https?:\\/\\/www\\.youtube\\.com\\/watch\\?v=([a-zA-Z0-9_-]+)/';
    $pattern2 = '/https?:\\/\\/youtu.be\\/([a-zA-Z0-9_-]+)/';

    if (preg_match($pattern1, $url, $match)) {
        return "https://www.youtube.com/embed/" . $match[1];
    }

    if (preg_match($pattern2, $url, $match)) {
        return "https://www.youtube.com/embed/" . $match[1];
    }

    return $url;
}

$embed_url = convertYouTube($materi['video_url']);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $materi['title']; ?></title>
    <link rel="stylesheet" href="/assets/css/view.css">


</head>
<body>

<div class="container">

    <a class="back-btn" href="user.php">← Kembali</a>

    <h1><?= $materi['title']; ?></h1>

    <div class="content">
        <?= nl2br($materi['content']); ?>
    </div>

    <div class="video-wrapper">
        <iframe 
            src="<?= $embed_url; ?>" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>
    </div>

</div>

</body>
</html>

