<?php
/**
 * File: config.php
 * Deskripsi: File untuk konfigurasi dan koneksi ke database.
 */

// --- Pengaturan Database --- //

// Alamat server database Anda. Biasanya 'localhost' jika database berada di server yang sama.
$servername = "localhost";

// Nama pengguna untuk mengakses database. Default untuk XAMPP/LAMP biasanya 'root'.
$username = "root";

// Kata sandi untuk pengguna database. Default untuk XAMPP/LAMP biasanya kosong.
$password = "";

// Nama database yang ingin Anda hubungkan.
$dbname = "rzstore_db";


// --- Buat Koneksi --- //

// Membuat objek koneksi baru menggunakan MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);


// --- Periksa Koneksi --- //

// Memeriksa apakah terjadi kesalahan saat mencoba menghubungkan.
// Jika connect_error bernilai true, berarti koneksi gagal.
if ($conn->connect_error) {
    // Menghentikan eksekusi skrip dan menampilkan pesan kesalahan.
    // Sebaiknya jangan tampilkan error detail di lingkungan produksi untuk alasan keamanan.
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Mengatur set karakter ke utf8mb4 untuk mendukung berbagai macam karakter (termasuk emoji).
// Ini adalah praktik yang baik untuk aplikasi web modern.
$conn->set_charset("utf8mb4");

?>