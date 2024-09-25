<?php
$dataFile = '../data/data.json';
$dataRegistrasi = json_decode(file_get_contents($dataFile), true) ?? [];

// Fungsi untuk menambah data ke file JSON
function tambahDataRegistrasi($nama, $email, $telepon, $alamat)
{
    global $dataRegistrasi, $dataFile;
    $registrasiBaru = [
        'nama' => $nama,
        'email' => $email,
        'telepon' => $telepon,
        'alamat' => $alamat,
        'tanggal' => date('Y-m-d H:i:s')
    ];

    array_push($dataRegistrasi, $registrasiBaru);
    file_put_contents($dataFile, json_encode($dataRegistrasi, JSON_PRETTY_PRINT));
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    if (!empty($nama) && !empty($email) && !empty($telepon) && !empty($alamat)) {
        tambahDataRegistrasi($nama, $email, $telepon, $alamat);
        // Redirect ke halaman yang sama dengan pesan sukses
        header('Location: registrasi.php?status=success');
        exit;
    } else {
        $message = "Semua field harus diisi!";
    }
}

// Cek apakah ada status sukses di URL
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Registrasi berhasil!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<<<<<<< HEAD
    <div class="background-container">
        <div class="container">
            <h2>Registrasi Pantai</h2>
            <form>
                <div class="input-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="phone">Telepon</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="input-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Saya setuju dengan <a href="#">syarat dan ketentuan</a></label>
                </div>
                <button type="submit">Daftar</button>
            </form>
        </div>
    </div>
=======
    <!-- Menampilkan pesan sukses atau error -->
    <?php if ($message): ?>
        <p style="color: green; text-align: center; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <h1>Daftarkan Akun Anda</h1>
    
    <!-- Kontainer Form -->
    <form action="registrasi.php" method="POST" onsubmit="return validateForm()">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <!-- Checkbox Syarat dan Ketentuan -->
        <label>
            <input type="checkbox" id="setuju" name="setuju" required>
            Saya setuju dengan <a href="#">syarat dan ketentuan</a>
        </label><br><br>
        
        <input type="submit" value="Daftar">
    </form>
>>>>>>> 09dee5d4bf377cbe4f50e74c3ffa854df7e874d6
</body>

</html>