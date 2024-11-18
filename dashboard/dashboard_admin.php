<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Menyatakan karakter encoding dan viewport untuk responsivitas halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Mahabarata</title>
    
    <!-- Menyertakan CSS Bootstrap dari CDN untuk desain yang responsif dan komponen UI yang siap pakai -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        /* Styling khusus untuk kartu-kartu di dashboard */
        .card {
            border-radius: 15px; /* Membuat sudut kartu melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan */
        }
        
        .card-header {
            font-weight: bold; /* Membuat teks header kartu lebih tebal */
        }
        
        .card-body {
            padding: 20px; /* Menambahkan ruang di dalam kartu */
        }
        
        /* Styling untuk tombol kustom */
        .btn-custom {
            background-color: #FFB74D; /* Warna latar belakang tombol */
            border: 1px solid #FFB74D; /* Border dengan warna yang sama */
            color: white; /* Warna teks tombol */
        }
        
        /* Efek hover untuk tombol */
        .btn-custom:hover {
            background-color: #FF9800; /* Warna tombol saat di-hover */
        }
        
        /* Menyusun posisi vertikal isi tabel */
        .table th, .table td {
            vertical-align: middle; /* Menyusun isi tabel agar berada di tengah */
        }
        
        /* Styling untuk gambar di tabel */
        .table img {
            border-radius: 5px; /* Memberikan sudut gambar menjadi lebih lembut */
        }
        
        /* Styling untuk tombol close pada alert */
        .alert-dismissible {
            position: relative; /* Posisi tombol close agar terlihat dengan jelas */
        }

        .navbar-nav {
            width: 100%;
        }
        .navbar-nav .nav-item:last-child {
            margin-left: auto; /* Memindahkan logout ke kanan */
        }
    </style>
</head>
<body>
    <!-- Navbar Admin, tempat menu navigasi -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <!-- Logo dan judul dashboard -->
            <a class="navbar-brand" href="#">
                <img src="img/mahabarata2.png" alt="Logo" width="40" height="40"> <!-- Logo yang ditampilkan di navbar -->
                <span class="ms-2" style="font-size: 24px; color: black;">Dashboard Admin Mahabarata</span>
            </a>
            
            <!-- Tombol untuk membuka navbar di perangkat kecil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Daftar menu navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Dashboard</a></li> <!-- Link ke Dashboard -->
                    <li class="nav-item"><a class="nav-link" href="manage_members.php">Kelola Anggota</a></li> <!-- Link untuk mengelola anggota -->
                    <li class="nav-item"><a class="nav-link" href="manage_events.php">Kelola Acara</a></li> <!-- Link untuk mengelola acara -->
                    <!-- Tombol Logout di pojok kanan -->
                    <li class="nav-item">
                        <button class="btn btn-danger ms-auto" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun Anda?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten utama dashboard -->
    <div class="container py-5">
        <!-- Pemberitahuan (Alert) Data Berhasil Diperbarui -->
        <?php if (isset($_GET['update_success']) && $_GET['update_success'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data anggota berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Kartu untuk menampilkan total anggota -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Anggota
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Anggota</h5>
                        <p class="card-text">5 Anggota Terdaftar</p> <!-- Teks yang menampilkan jumlah anggota -->
                    </div>
                </div>
            </div>

            <!-- Kartu untuk menampilkan total acara -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Acara
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Acara</h5>
                        <p class="card-text">3 Acara Tersedia</p> <!-- Teks yang menampilkan jumlah acara -->
                    </div>
                </div>
            </div>

            <!-- Kartu untuk aksi cepat (tambah anggota dan acara) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Aksi Cepat
                    </div>
                    <div class="card-body d-grid gap-2">
                        <!-- Tombol untuk menambah anggota, menggunakan kelas d-grid agar tombol memiliki ukuran yang sama -->
                        <a href="add_member.php" class="btn btn-custom">Tambah Anggota</a> 
                        <!-- Tombol untuk menambah acara -->
                        <a href="add_event.php" class="btn btn-custom">Tambah Acara</a> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Anggota -->
        <h3 class="mt-5 mb-3">Daftar Anggota</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th> <!-- Kolom untuk nomor urut -->
                    <th>Nama</th> <!-- Kolom untuk nama anggota -->
                    <th>Jabatan</th> <!-- Kolom untuk jabatan anggota -->
                    <th>Gambar</th> <!-- Kolom untuk gambar anggota -->
                    <th>Aksi</th> <!-- Kolom untuk aksi (edit dan hapus) -->
                </tr>
            </thead>
            <tbody>
                <!-- Loop anggota dari database (contoh anggota 1) -->
                <tr>
                    <td>1</td> <!-- Nomor urut anggota -->
                    <td>Rizki Teguh</td> <!-- Nama anggota -->
                    <td>Ketua</td> <!-- Jabatan anggota -->
                    <td><img src="img/ketua.jpg" alt="Ketua" width="50" height="50"></td> <!-- Gambar anggota -->
                    <td>
                        <!-- Tombol Edit -->
                        <a href="edit_member.php?id=1" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <!-- Tombol Hapus -->
                        <a href="delete_member.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"><i class="bi bi-trash"></i> Hapus</a>
                    </td>
                </tr>
                <!-- Data lainnya bisa ditambahkan di sini -->
            </tbody>
        </table>
    </div>

    <!-- Menyertakan script JavaScript untuk Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
