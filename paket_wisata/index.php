<?php
// Baca data dari file JSON
$json_data = file_get_contents('data/paket_wisata.json');
$paket_wisata = json_decode($json_data, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata</title>
    <link rel="stylesheet" href="../designDashboard/indexS.css">
    <style>
        .notification {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .notification-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .notification-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>

<body>
    <h1>Halaman Utama</h1>
    <h2>Daftar Paket Wisata</h2>
    <!-- Menampilkan notifikasi kesalahan jika nama atau nomor telepon tidak valid -->
    <?php if (isset($_GET['error'])): ?>
        <?php if ($_GET['error'] == 'nama_angka'): ?>
            <div class="notification notification-error">
                <strong>Error:</strong> Nama tidak boleh berupa angka. Silakan masukkan nama yang benar.
            </div>
        <?php elseif ($_GET['error'] == 'telepon_format'): ?>
            <div class="notification notification-error">
                <strong>Error:</strong> Nomor telepon harus berisi minimal 10 digit dan hanya terdiri dari angka.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Menampilkan notifikasi sukses jika pemesanan berhasil -->
    <?php if (isset($_GET['success'])): ?>
        <div class="notification notification-success">
            <strong>Success:</strong> Paket wisata berhasil dipesan!
        </div>
    <?php endif; ?>

    <!-- Menampilkan daftar paket wisata -->
    <?php foreach ($paket_wisata as $paket): ?>
        <div>
            <h2><?= $paket['nama'] ?></h2>
            <p><?= $paket['deskripsi'] ?></p>
            <p>Harga: Rp <?= number_format($paket['harga'], 0, ',', '.') ?></p>
            <p>Durasi: <?= $paket['durasi'] ?></p>
            <!-- Formulir pemesanan -->
            <form action="proses_pemesanan.php" method="POST">
                <input type="hidden" name="paket_id" value="<?= $paket['id'] ?>">
                <div>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="telepon">Nomor Telepon:</label>
                    <input type="text" name="telepon" required>
                </div>
                <button type="submit">Pesan Paket</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>