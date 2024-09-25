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

</head>

<body>
    <header>
        <h1 style="text-align:center;">Paket Wisata Tropis</h1>
        <p style="text-align:center;">Temukan petualangan wisata terbaik untuk Anda</p>
    </header>

    <div class="container">
        <!-- Paket Wisata Section -->
        <?php foreach ($paket_wisata as $paket): ?>
            <div class="paket">
                <!-- Tambahkan gambar untuk setiap paket -->
                <img src="images/<?= $paket['gambar1'] ?>" alt="<?= $paket['nama'] ?>">
                <img src="images/<?= $paket['gambar2'] ?>" alt="<?= $paket['nama'] ?>">
                <img src="images/<?= $paket['gambar3'] ?>" alt="<?= $paket['nama'] ?>">
                <h2><?= $paket['nama'] ?></h2>
                <p><?= $paket['deskripsi'] ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($paket['harga'], 0, ',', '.') ?></p>
                <p><strong>Durasi:</strong> <?= $paket['durasi'] ?></p>

                <!-- Form untuk pemesanan -->
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
    </div>
</body>

</html>