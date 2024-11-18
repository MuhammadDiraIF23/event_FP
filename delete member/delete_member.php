<?php
include 'db_connection.php';  // Menghubungkan ke database

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data anggota berdasarkan ID
    $query = "DELETE FROM members WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    
    header('Location: manage_members.php');  // Redirect setelah menghapus anggota
    exit;
}
?>
