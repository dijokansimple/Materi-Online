<?php 
include "../config/db.php";    

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, role) 
              VALUES ('$username', '$hashed', 'user')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Gagal mendaftar. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Materi App</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h2>Register</h2>

        <?php if(isset($error)) : ?>
            <div class="alert"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
            <p class="redirect">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
