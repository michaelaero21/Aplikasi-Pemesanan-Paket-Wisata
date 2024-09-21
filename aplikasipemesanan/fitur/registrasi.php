<?php
$dataFile = 'data.json';
$dataRegistrasi = json_decode(file_get_contents($dataFile), true) ?? [];

// Fungsi untuk menambah data ke file JSON
function tambahDataRegistrasi($nama, $email, $telepon, $alamat, $paket) {
    global $dataRegistrasi, $dataFile;
    // Update fungsi untuk menerima alamat dan paket
    $registrasiBaru = [
        'nama' => $nama,
        'email' => $email,
        'telepon' => $telepon,
        'alamat' => $alamat,
        'paket' => $paket,
        'tanggal' => date('Y-m-d H:i:s')
    ];

    array_push($dataRegistrasi, $registrasiBaru);
    file_put_contents($dataFile, json_encode($dataRegistrasi, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];  
    $paket = $_POST['paket'];     

    if (!empty($nama) && !empty($email) && !empty($telepon) && !empty($alamat) && !empty($paket)) {
        tambahDataRegistrasi($nama, $email, $telepon, $alamat, $paket);
        echo "Registrasi berhasil!";
    } else {
        echo "Semua field harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var telepon = document.getElementById('telepon').value;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                alert("Email tidak valid.");
                return false;
            }

            if (isNaN(telepon) || telepon.length < 10) {
                alert("Nomor telepon harus berupa angka dan minimal 10 digit.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Formulir Registrasi Paket Wisata</h1>
    <form action="registrasi.php" method="POST" onsubmit="return validateForm()">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <label for="paket">Pilih Paket Wisata:</label><br>
            <select id="paket" name="paket" required>
                <option value="Paket A">Paket A</option>
                <option value="Paket B">Paket B</option>
                <option value="Paket C">Paket C</option>
            </select><br><br>
            
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
