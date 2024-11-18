<?php
include 'db_connection.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $position = $_POST['position'];
    $image = $_FILES['image']['name'];
    
    // Proses upload gambar
    move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $image);
    
    // Insert data anggota baru ke database
    $query = "INSERT INTO members (name, position, image) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $position, $image]);
    
    header('Location: manage_members.php'); // Redirect setelah data berhasil ditambahkan
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <!-- Navbar Admin -->
    </nav>

    <div class="container py-5">
        <h3>Tambah Anggota</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Anggota</button>
        </form>
    </div>
</body>
</html>
