<?php
session_start(); // Mulai session

// Hapus semua session
session_unset();
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: /path/to/login.php"); // Ganti '/path/to/login.php' dengan path yang benar ke file login.php Anda
exit();
?>
