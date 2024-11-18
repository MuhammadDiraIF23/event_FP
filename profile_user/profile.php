<?php
// Memastikan tidak ada output sebelum tag PHP
session_start();

// Inisialisasi variabel untuk pesan
$message = '';
$imagePath = '';

// Mengecek apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $bio = $_POST['bio'];

    // Proses upload file gambar
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0) {
        // Folder tempat menyimpan gambar yang diupload
        $uploadDir = 'uploads/';

        // Memastikan folder 'uploads' ada, jika tidak ada maka buat
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Membuat folder dengan izin 755
        }

        // Menyiapkan path lengkap untuk file yang akan di-upload
        $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);

        // Memindahkan file dari temporary folder ke folder yang diinginkan
        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
            // Jika upload berhasil
            $message = "Gambar profil berhasil diupload.";
            $imagePath = $uploadFile; // Menyimpan path gambar untuk ditampilkan
        } else {
            // Jika upload gagal
            $message = "Gagal mengupload gambar profil.";
        }
    } else {
        // Jika tidak ada gambar yang diupload atau ada error pada file
        $message = "Tidak ada gambar yang diupload atau ada kesalahan.";
    }

    // Redirect ke halaman dashboard (opsional)
    // header('Location: dashboard.php');
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Mahabarata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Profil Anda</h1>

        <!-- Menampilkan pesan berhasil atau gagal -->
        <?php if ($message): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Menampilkan gambar yang sudah di-upload -->
        <?php if ($imagePath): ?>
            <div class="mb-3">
                <label for="uploadedImage" class="form-label">Gambar Profil yang Diunggah:</label><br>
                <img src="<?php echo $imagePath; ?>" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            </div>
        <?php endif; ?>

        <!-- Form untuk mengisi profil dan mengupload gambar -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Tuliskan sedikit tentang diri Anda"></textarea>
            </div>

            <div class="mb-3">
                <label for="profilePic" class="form-label">Gambar Profil</label>
                <input type="file" class="form-control" id="profilePic" name="profilePic" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Profil</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
