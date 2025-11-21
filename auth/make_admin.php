<?php
include "../config/db.php";

// Data admin baru
$username = "admin";
$password = "admin123";
$role = "admin";

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert admin
$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";

if (mysqli_query($conn, $query)) {
    echo "Admin berhasil dibuat!<br>";
    echo "Username: $username<br>";
    echo "Password: $password (sudah di-hash)";
} else {
    echo "Gagal membuat admin: " . mysqli_error($conn);
}
