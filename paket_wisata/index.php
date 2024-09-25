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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Tiga kolom */
            gap: 20px;
            /* Jarak antar kolom */
            padding: 20px;
        }

        .paket {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .paket img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .paket h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .paket p {
            color: #666;
            margin-bottom: 15px;
        }

        form div {
            margin-bottom: 10px;
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
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
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