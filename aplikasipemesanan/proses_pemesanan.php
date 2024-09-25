<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari formulir
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $paket_id = $_POST['paket_id'];
    $tanggal = date('Y-m-d H:i:s');

    // Validasi: cek apakah nama hanya berisi angka
    if (ctype_digit($nama)) {
        // Redirect dengan pesan kesalahan jika nama berisi angka
        header('Location: index.php?error=nama_angka');
        exit;
    }

    // Validasi: cek apakah nomor telepon hanya berisi angka dan minimal 10 digit
    if (!ctype_digit($telepon) || strlen($telepon) < 10) {
        // Redirect dengan pesan kesalahan jika nomor telepon tidak valid
        header('Location: index.php?error=telepon_format');
        exit;
    }

    // Baca data pemesanan sebelumnya
    $file_pemesanan = 'data/pemesanan.json';
    if (file_exists($file_pemesanan)) {
        $pemesanan_data = json_decode(file_get_contents($file_pemesanan), true);
    } else {
        $pemesanan_data = [];
    }

    // Tambahkan pemesanan baru
    $pemesanan_baru = [
        'nama' => $nama,
        'email' => $email,
        'telepon' => $telepon,
        'paket_id' => $paket_id,
        'tanggal' => $tanggal,
    ];

    $pemesanan_data[] = $pemesanan_baru;

    // Simpan ke file JSON
    file_put_contents($file_pemesanan, json_encode($pemesanan_data));

    // Redirect kembali ke halaman utama dengan pesan sukses
    header('Location: index.php?success=1');
    exit;
}
