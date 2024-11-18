<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pembelian Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #FFB74D; /* Ubah warna tulisan menjadi #FFB74D */
        }
        .btn-primary {
            background-color: #FFB74D; /* Ubah warna tombol konfirmasi */
            border-color: #FFB74D; /* Ubah border tombol konfirmasi */
        }
        .btn-primary:hover {
            background-color: #e6a04d; /* Ubah warna saat hover */
            border-color: #e6a04d; /* Ubah border saat hover */
        }
        .form-check-label {
            margin-left: 0.5rem;
        }
    </style>
    <script>
        function togglePaymentOptions(selectedOption) {
            const bankOptions = document.getElementById("bankOptions");
            const eWalletOptions = document.getElementById("eWalletOptions");
            if (selectedOption === 'Transfer Bank') {
                bankOptions.style.display = "block";
                eWalletOptions.style.display = "none";
            } else {
                eWalletOptions.style.display = "block";
                bankOptions.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Registrasi Pembelian Tiket</h2>
        <form action="proses_registrasi.php" method="POST">
            <!-- Informasi Pribadi -->
            <div class="mb-4">
                <label for="fullName" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Masukkan Nama Lengkap Anda" required>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor Telepon Anda" required>
            </div>

            <!-- Pilihan Tiket -->
            <div class="mb-4">
                <label for="ticketType" class="form-label">Jenis Tiket</label>
                <select class="form-select" id="ticketType" name="ticketType" required>
                    <option selected disabled>Pilih Jenis Tiket</option>
                    <option value="regular">Tiket Reguler - Rp100,000</option>
                    <option value="vip">Tiket VIP - Rp250,000</option>
                    <option value="vvip">Tiket VVIP - Rp500,000</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="quantity" class="form-label">Jumlah Tiket</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="Masukkan Jumlah Tiket" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label class="form-label">Metode Pembayaran</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="paymentMethod" id="paymentMethod1" value="Transfer Bank" onclick="togglePaymentOptions('Transfer Bank')" required>
                    <label class="form-check-label" for="paymentMethod1">Transfer Bank</label>
                </div>
                <div id="bankOptions" style="display: none;">
                    <label for="bank" class="form-label">Pilih Bank</label>
                    <select class="form-select" name="bank" required>
                        <option selected disabled>Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="MANDIRI">MANDIRI</option>
                        <option value="BNI">BNI</option>
                    </select>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="paymentMethod" id="paymentMethod2" value="E-Wallet" onclick="togglePaymentOptions('E-Wallet')" required>
                    <label class="form-check-label" for="paymentMethod2">E-Wallet</label>
                </div>
                <div id="eWalletOptions" style="display: none;">
                    <label for="ewallet" class="form-label">Pilih E-Wallet</label>
                    <select class="form-select" name="ewallet" required>
                        <option selected disabled>Pilih E-Wallet</option>
                        <option value="DANA">DANA</option>
                        <option value="GOPAY">GOPAY</option>
                        <option value="SHOPEEPAY">SHOPEEPAY</option>
                    </select>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Konfirmasi Pembelian</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
