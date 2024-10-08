Anda bisa menggunakan server bawaan PHP untuk menjalankan proyek di `localhost:8080`. Berikut adalah langkah-langkah untuk menjalankan aplikasi PHP menggunakan built-in PHP server:

1. **Pastikan PHP Terinstal di Komputer Anda**
Anda perlu memastikan bahwa PHP sudah terinstal di sistem Anda. Untuk memeriksa, buka terminal atau command prompt dan ketik: php -v

Jika PHP terinstal, Anda akan melihat versi PHP yang terpasang. Jika belum terinstal, Anda bisa mengunduh dan menginstalnya dari [php.net](https://www.php.net/downloads).

2. **Menjalankan Server PHP Bawaan**

**Langkah 1: Buka Terminal atau Command Prompt**

Buka terminal atau command prompt, lalu navigasikan ke folder proyek yang berisi file `registrasi.php`.

Untuk folder `aplikasipemesanan`: cd path/to/your/project/aplikasipemesanan

> Pastikan Anda mengganti `path/to/your/project/` dengan direktori aktual tempat proyek Anda berada.

**Langkah 2: Menjalankan Server PHP pada Port 8080**
Untuk menjalankan server PHP pada `localhost:8080`, gunakan perintah berikut: php -S localhost:8080

Jika Anda berada di folder `aplikasipemesanan`, ini akan menjalankan file `registrasi.php` terlebih dahulu dan ketika berhasil submit, kemudian akan dilanjutkan dengan file `index.php` yang berisi paket wisata pada `localhost:8080`.

3. **Mengakses Aplikasi di Browser**
Setelah menjalankan server, buka browser dan masukkan URL berikut:
- Untuk **registrasi** (folder `aplikasipemesanan`): [http://localhost:8080/fitur/registrasi.php]
