<?php
require_once 'session_check.php';
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. CEK KETERKAITAN DENGAN TABEL 'orders' (Sesuai database Anda)
    // Kita tidak bisa menghapus produk jika sudah ada di riwayat pesanan.
    $check_stmt = $conn->prepare("SELECT id FROM orders WHERE product_id = ? LIMIT 1");
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Produk terkait dengan pesanan, JANGAN HAPUS!
        $check_stmt->close();
        header("Location: produk.php?status=gagal_terkait"); // Kirim status error
        exit();
    }
    $check_stmt->close();

    
    // 2. JIKA AMAN (TIDAK TERKAIT PESANAN), LANJUTKAN PENGHAPUSAN

    // Ambil path gambar SEBELUM menghapus data-nya dari DB
    $img_stmt = $conn->prepare("SELECT image_url, slider_image_url FROM products WHERE id = ?");
    $img_stmt->bind_param("i", $id);
    $img_stmt->execute();
    $img_stmt->bind_result($image_url, $slider_image_url);
    $img_stmt->fetch();
    $img_stmt->close();

    // Hapus data produk dari database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // 3. HAPUS FILE GAMBAR (Sesuai komentar di kode Anda)
    if ($stmt->affected_rows > 0) {
        // Hapus gambar utama
        // Asumsi: path 'pict project e/...' relatif dari folder root (../)
        if (!empty($image_url) && file_exists('../' . $image_url)) {
            @unlink('../' . $image_url); 
        }
        // Hapus gambar slider
        if (!empty($slider_image_url) && file_exists('../' . $slider_image_url)) {
            @unlink('../' . $slider_image_url);
        }
    }
    
    $stmt->close();
    header("Location: produk.php?status=dihapus");
    exit();
}
?>