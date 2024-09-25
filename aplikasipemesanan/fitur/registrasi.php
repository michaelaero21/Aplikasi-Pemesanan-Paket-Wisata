<?php
$dataFile = '../data/data.json'; 
$dataRegistrasi = json_decode(file_get_contents($dataFile), true) ?? [];

// Definisikan variabel message di awal
$message = ''; 

// Fungsi untuk menambah data ke file JSON
function tambahDataRegistrasi($nama, $email, $telepon, $alamat) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];  
    $syaratKetentuan = isset($_POST['syarat_ketentuan']); // Cek apakah checkbox disetujui

    // Pastikan semua field harus diisi dan syarat ketentuan disetujui
    if (!empty($nama) && !empty($email) && !empty($telepon) && !empty($alamat) && $syaratKetentuan) {
        tambahDataRegistrasi($nama, $email, $telepon, $alamat);
        
        // Redirect ke halaman paket wisata setelah berhasil registrasi
        header("Location: ../paket_wisata/index.php?success=registrasi_berhasil");
        exit();
    } else {
        $message = "Semua field harus diisi dan syarat & ketentuan harus disetujui!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="../designRegister/style.css">
    <script>
        function validateForm() {
            var nama = document.getElementById('nama').value;
            var email = document.getElementById('email').value;
            var telepon = document.getElementById('telepon').value;
            var alamat = document.getElementById('alamat').value; 
            var syaratKetentuan = document.getElementById('syarat_ketentuan').checked; // Cek checkbox

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var namaPattern = /^[A-Za-z\s]+$/; 

            if (!namaPattern.test(nama)) {
                alert("Nama tidak boleh mengandung angka atau karakter khusus.");
                return false;
            }

            if (!emailPattern.test(email)) {
                alert("Email tidak valid.");
                return false;
            }

            if (isNaN(telepon) || telepon.length < 10) {
                alert("Nomor telepon harus berupa angka dan minimal 10 digit.");
                return false;
            }

            if (!alamat) {
                alert("Alamat harus diisi.");
                return false;
            }

            if (!syaratKetentuan) {
                alert("Anda harus menyetujui syarat dan ketentuan.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Daftarkan Akun Anda</h1>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="registrasi.php" method="POST" onsubmit="return validateForm()">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <input type="checkbox" id="syarat_ketentuan" name="syarat_ketentuan">
        <label for="syarat_ketentuan" style="display: inline;">Saya menyetujui syarat dan ketentuan.</label><br><br>

        <input type="submit" value="Daftar">
    </form>
</body>
</html>
