<?php
try {
    $host = 'localhost'; // atau IP server database
    $dbname = 'mahabarata_advent';
    $username = 'root'; // ganti dengan username database Anda
    $password = ''; // ganti dengan password database Anda

    // Mengatur PDO untuk MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //set PDO Error
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>