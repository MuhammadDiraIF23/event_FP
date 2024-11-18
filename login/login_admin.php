<?php
session_start();

// Masukkan file koneksi database
include 'db_connection.php'; // Pastikan path ke file koneksi sudah benar

// Inisialisasi pesan error login
$message = '';

// Proses login saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek email di database khusus admin
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND role = 'admin'"); // Pastikan ada kolom 'role' di tabel users untuk cek admin
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            header('Location: dashboard_admin.php'); // Arahkan ke halaman dashboard admin
            exit();
        } else {
            $message = 'Password salah!';
        }
    } else {
        $message = 'Email tidak ditemukan atau bukan admin!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Admin Mahabarata</title>
    <style>
        /* Style CSS tetap sama */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('/Final-Project/img/pendaki.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }
        .form {
            width: 400px;
            padding: 2rem;
            background-color: rgba(51, 51, 51, 0.8);
            text-align: center;
            border-radius: 8px;
        }
        .form h2 {
            font-size: 1.7rem;
            margin-bottom: 1rem;
        }
        .form input {
            width: 70%;
            margin-bottom: 1.5rem;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid white;
            text-align: center;
            padding: .5rem;
            color: white;
        }
        .form input[type="submit"] {
            width: 60%;
            padding: .7rem;
            background-color: #FFB74D;
            border: none;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            color: #222;
        }
        .icons {
            width: 220px;
            display: flex;
            justify-content: space-between;
            margin: 1rem auto;
        }
        .border-icon {
            height: 50px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            border-radius: 50%;
            font-size: 1.5rem;
            color: inherit;
            background-color: rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .border-icon:hover {
            background-color: #FFB74D;
            border-color: #FFB74D;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form sign-in">
        <h2>Mahabarata Admin</h2>
        <div class="icons">
            <a href="https://www.instagram.com/mahabarata_adventure" target="_blank" class="border-icon">
                <i class='bx bxl-instagram'></i>
            </a>
            <a href="https://www.tiktok.com/@mahabarata.advent" target="_blank" class="border-icon">
                <i class='bx bxl-tiktok'></i>
            </a>
            <a href="https://chat.whatsapp.com/CPxiH6jOd1Z1GO4FhpUbvW" target="_blank" class="border-icon">
                <i class='bx bxl-whatsapp'></i>
            </a>
        </div>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Masuk">
        </form>
        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
