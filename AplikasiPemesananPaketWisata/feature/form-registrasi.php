<?php
// Fungsi untuk memuat data dari file JSON
function load_users() {
    $file = '../data/users.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([])); // Buat file kosong jika belum ada
    }
    $data = file_get_contents($file);
    return json_decode($data, true); // Decode menjadi array
}

// Fungsi untuk menyimpan data ke file JSON
function save_user($new_user) {
    $file = '../data/users.json';
    $users = load_users(); // Muat data pengguna saat ini

    // Tambahkan pengguna baru
    $users[] = $new_user;

    // Simpan kembali ke file JSON
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input sederhana
    if ($name && $email && $password) {
        // Data pengguna baru
        $new_user = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password
        ];

        // Simpan pengguna baru ke file JSON
        save_user($new_user);

        // Redirect ke halaman sukses atau tampilkan pesan sukses
        echo "Registrasi berhasil! <a href='../index.php'>Kembali ke halaman utama</a>";
    } else {
        echo "Semua bidang harus diisi!";
    }
}
?>

<!-- Form Registrasi -->
<h2>Formulir Registrasi</h2>
<form method="POST" action="form-registrasi.php">
    <label for="name">Nama:</label>
    <input type="text" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Daftar</button>
</form>
