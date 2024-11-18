<?php
include 'db_connection.php';  // Menghubungkan ke file koneksi database

// Ambil daftar anggota
$query = "SELECT * FROM members";  // Ganti dengan nama tabel anggota Anda
$stmt = $pdo->prepare($query);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan styling CSS Anda di sini */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <!-- Navbar Admin -->
    </nav>

    <div class="container py-5">
        <h3>Daftar Anggota</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $index => $member): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($member['name']) ?></td>
                    <td><?= htmlspecialchars($member['position']) ?></td>
                    <td><img src="img/<?= htmlspecialchars($member['image']) ?>" alt="Image" width="50" height="50"></td>
                    <td>
                        <a href="edit_member.php?id=<?= $member['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_member.php?id=<?= $member['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
