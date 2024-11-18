<?php
// Koneksi ke database
$host = "localhost";
$user = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$database = "tiket_event"; // ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah data dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form registrasi dan melakukan sanitasi
    $nama = $conn->real_escape_string(trim($_POST['fullName']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $no_telepon = $conn->real_escape_string(trim($_POST['phone']));
    $jenis_tiket = $conn->real_escape_string(trim($_POST['ticketType']));
    $jumlah_tiket = intval($_POST['quantity']);
    $metode_pembayaran = $conn->real_escape_string(trim($_POST['paymentMethod']));
    $bank = isset($_POST['bank']) ? $conn->real_escape_string(trim($_POST['bank'])) : null; // Jika metode adalah Transfer Bank
    $ewallet = isset($_POST['ewallet']) ? $conn->real_escape_string(trim($_POST['ewallet'])) : null; // Jika metode adalah E-Wallet

    // Menentukan harga berdasarkan jenis tiket
    $harga_tiket = 0;
    switch ($jenis_tiket) {
        case "regular":
            $harga_tiket = 100000;
            break;
        case "vip":
            $harga_tiket = 250000;
            break;
        case "vvip":
            $harga_tiket = 500000;
            break;
    }

    // Menghitung total harga
    $total_harga = $harga_tiket * $jumlah_tiket;

    // Menyimpan data ke tabel registrasi menggunakan prepared statements
    $stmt = $conn->prepare("INSERT INTO registrasi (nama, email, no_telepon, jenis_tiket, jumlah_tiket, metode_pembayaran, harga) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $nama, $email, $no_telepon, $jenis_tiket, $jumlah_tiket, $metode_pembayaran, $total_harga);

    if ($stmt->execute()) {
        // Menentukan nomor rekening atau virtual account berdasarkan metode pembayaran
        $rekening = '';
        if ($metode_pembayaran === 'Transfer Bank') {
            // Anda dapat menyesuaikan informasi rekening berdasarkan pilihan bank
            switch ($bank) {
                case 'BCA':
                    $rekening = '123-456-7890 (Bank BCA)';
                    break;
                case 'MANDIRI':
                    $rekening = '234-567-8901 (Bank MANDIRI)';
                    break;
                case 'BNI':
                    $rekening = '345-678-9012 (Bank BNI)';
                    break;
            }
        } elseif ($metode_pembayaran === 'E-Wallet') {
            // Anda dapat menyesuaikan informasi virtual account berdasarkan pilihan e-wallet
            switch ($ewallet) {
                case 'dana':
                    $rekening = '0987-6543-2100 (DANA)';
                    break;
                case 'gopay':
                    $rekening = '1234-5678-9012 (GOPAY)';
                    break;
                case 'SHOPEEPAY':
                    $rekening = '3456-7890-1234 (SHOPEEPAY)';
                    break;
            }
        }

        // Menampilkan halaman konfirmasi pembayaran
        echo "
        <html>
        <head>
            <title>Konfirmasi Pembayaran</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container my-5'>
                <h2 class='text-center mb-4'>Konfirmasi Pembayaran</h2>
                
                <div class='card mb-4'>
                    <div class='card-header'>Pembayaran</div>
                    <div class='card-body'>
                        <p>Total Pembayaran: <strong>Rp" . number_format($total_harga, 0, ',', '.') . "</strong></p>
                        <p>Metode Pembayaran: " . ucfirst($metode_pembayaran) . "</p>
                        <p>Nomor Rekening / Virtual Account: <strong>$rekening</strong></p>
                        <p class='text-muted'>Selesaikan pembayaran sesuai dengan metode yang dipilih.</p>
                        
                        <div class='text-center'>
                            <a href='#' class='btn btn-success'>Selesai dan Konfirmasi</a>
                        </div>
                    </div>
                </div>

                <div class='card mb-4'>
                    <div class='card-header'>Instruksi Pembayaran</div>
                    <div class='card-body'>
                        <ul>
                            <li>Jika menggunakan Transfer Bank, harap transfer ke rekening bank yang Anda pilih.</li>
                            <li>Jika menggunakan E-Wallet, harap gunakan aplikasi sesuai pilihan Anda.</li>
                            <li>Jika pembayaran belum terkonfirmasi dalam 1x24 jam, hubungi layanan pelanggan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Menutup prepared statement
    $stmt->close();
} else {
    echo "Metode permintaan tidak valid.";
}

// Menutup koneksi
$conn->close();
?>
