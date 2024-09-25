<?php
// Baca data dari file JSON
$json_data = file_get_contents('../data/paket_wisata.json');
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

        .paket-wisata {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Halaman Utama</h1>
    <h2>Daftar Paket Wisata</h2>

    <!-- Menampilkan notifikasi jika ada pesan -->
    <?php if (isset($_GET['success'])): ?>
        <div class="notification notification-success">
            <strong>Success:</strong> Paket wisata pesanan Anda berhasil dipilih!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="notification notification-error">
            <strong>Error:</strong> 
            <?php 
            if ($_GET['error'] == 'nama_angka') {
                echo "Nama tidak boleh mengandung angka!";
            } elseif ($_GET['error'] == 'telepon_format') {
                echo "Nomor telepon tidak valid! Pastikan nomor telepon hanya berisi angka dan minimal 10 digit.";
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- Menampilkan daftar paket wisata -->
    <?php foreach ($paket_wisata as $paket): ?>
        <div class="package-card">
            <h2><?= $paket['nama'] ?></h2>
            <img src="<?= $paket['gambar'] ?>" alt="<?= $paket['nama'] ?>" style="max-width: 300px; height: auto;">
            
            <div class="info-box">
                <label>Deskripsi:</label>
                <p><?= $paket['deskripsi'] ?></p>
            </div>
            <div class="info-box">
                <label>Harga:</label>
                <p>Rp <?= number_format($paket['harga'], 0, ',', '.') ?></p>
            </div>
            <div class="info-box">
                <label>Durasi:</label>
                <p><?= $paket['durasi'] ?></p>
            </div>

            <!-- Formulir pemesanan -->
            <form action="proses_pemesanan.php" method="POST">
                <input type="hidden" name="paket_id" value="<?= $paket['id'] ?>">
                <input type="hidden" name="deskripsi" value="<?= $paket['deskripsi'] ?>">
                <input type="hidden" name="harga" value="<?= $paket['harga'] ?>">
                <input type="hidden" name="durasi" value="<?= $paket['durasi'] ?>">

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
