<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['reset_email'];

    if ($new_password === $confirm_password) {
        // Update password di database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Hapus session reset email dan arahkan ke halaman login
        unset($_SESSION['reset_email']);
        header("Location: login_user.php");
        exit();
    } else {
        $message = 'Password tidak cocok!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Tambahkan gaya yang sesuai */
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Reset Password</h2>
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
        <input type="submit" value="Reset Password">
        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
