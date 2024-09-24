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
     <!-- Link ke file CSS eksternal -->
     <link rel="stylesheet" href="design_aplikasi/designDashboard/indexS.css">
     <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

h1, h2 {
    color: #2c3e50;
    text-align: center;
}

h1 {
    padding: 20px 0;
}

h2 {
    margin-bottom: 10px;
}

p {
    line-height: 1.6;
}

/* Gaya untuk notifikasi */
.notification {
    padding: 15px;
    margin: 20px auto;
    border-radius: 5px;
    border: 1px solid transparent;
    width: 90%;
    max-width: 600px;
    text-align: center;
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

/* Gaya untuk daftar paket wisata */
.paket-wisata {
    background-color: #fff;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 600px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #2980b9;
}

form {
    margin-top: 15px;
}

/* Responsif */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    .paket-wisata {
        width: 100%;
    }
}

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
