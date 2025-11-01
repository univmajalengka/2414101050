<?php
// Sertakan file konfigurasi database.
// Skrip akan berhenti jika file config.php tidak ditemukan.
require_once 'config.php';

// Sekarang Anda bisa menggunakan variabel $conn untuk menjalankan query SQL.
$sql = "SELECT id, name, price FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tampilkan data produk
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nama: " . $row["name"]. " - Harga: " . $row["price"]. "<br>";
    }
} else {
    echo "Tidak ada produk yang ditemukan.";
}

// Jangan lupa untuk menutup koneksi setelah selesai.
$conn->close();
?>