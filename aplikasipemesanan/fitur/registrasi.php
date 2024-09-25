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
$error = [];
$formData = ['nama' => '', 'email' => '', 'telepon' => '', 'alamat' => '']; // Default form data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Simpan data form untuk ditampilkan kembali jika ada error
    $formData = ['nama' => $nama, 'email' => $email, 'telepon' => $telepon, 'alamat' => $alamat];

    // Validasi input
    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $error[] = "Nama harus terdiri dari huruf saja.";
    }
    if (empty($telepon) || !preg_match("/^[0-9]+$/", $telepon)) {
        $error[] = "Nomor telepon harus terdiri dari angka saja.";
    }
    if (empty($email) || empty($alamat)) {
        $error[] = "Email dan alamat harus diisi!";
    }

    // Jika tidak ada error, tambah data registrasi
    if (empty($error)) {
        tambahDataRegistrasi($nama, $email, $telepon, $alamat);
        // Redirect ke halaman yang sama dengan pesan sukses
        header('Location: registrasi.php?status=success');
        exit;
    } else {
        $message = implode("<br>", $error); // Menggabungkan error menjadi satu string
    }
}

// Cek apakah ada status sukses di URL
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Registrasi berhasil!";
    // Kosongkan data form setelah sukses
    $formData = ['nama' => '', 'email' => '', 'telepon' => '', 'alamat' => ''];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="../designRegister/style.css">
</head>

<body>

    <!-- Menampilkan pesan sukses atau error -->
    <?php if ($message): ?>
        <p style="color: red; text-align: center; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <h1>Daftarkan Akun Anda</h1>
    <!-- Kontainer Form -->
    <form action="registrasi.php" method="POST">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($formData['nama']); ?>" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required><br><br>

        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon" value="<?php echo htmlspecialchars($formData['telepon']); ?>" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($formData['alamat']); ?>" required><br><br>

        <!-- Checkbox Syarat dan Ketentuan -->
        <label>
            <input type="checkbox" id="setuju" name="setuju" required>
            Saya setuju dengan <a href="#">syarat dan ketentuan</a>
        </label><br><br>
        
        <input type="submit" value="Daftar">
    </form>
</body>
</html>