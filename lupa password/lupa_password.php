<?php
session_start();
include 'db_connection.php'; // Pastikan path ke file koneksi sudah benar

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Jika email ditemukan, arahkan ke halaman reset password
        $_SESSION['reset_email'] = $email;
        header("Location: reset_password.php");
        exit();
    } else {
        $message = 'Email tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <style>
        /* Tambahkan gaya yang sesuai */
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Lupa Password</h2>
        <input type="email" name="email" placeholder="Masukkan Email Anda" required>
        <input type="submit" value="Kirim">
        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
