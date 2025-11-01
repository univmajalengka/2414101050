<?php
require_once 'session_check.php';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // --- PERUBAHAN: Ambil data yang SESUAI form & database rzstore_db ---
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description']; // Mengganti 'long_description'

    // --- Variabel non-existent DIHAPUS ---
    // $category_id, $normal_price, $stock, $is_featured TIDAK ADA di database Anda.

    
    // --- PENYESUAIAN PATH UPLOAD ---
    // Di database Anda, path-nya adalah 'pict project e/...'
    // Kita asumsikan file PHP ini ada di folder 'admin/', jadi '../' adalah root.
    $target_dir = "../pict project e/"; 
    
    // Buat folder jika tidak ada (opsional tapi disarankan)
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }


    // --- Logika Upload Gambar 1: image_url (Gambar Utama/Icon) ---
    // Mengambil nama file yang ada dari form (jika tidak upload baru)
    $image_url_path = $_POST['existing_image_url'] ?? null;
    
    // Jika ada file BARU diupload untuk 'image_url'
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        // Path *relatif* untuk disimpan di DB
        $filename = uniqid('prod_icon_') . basename($_FILES["image_url"]["name"]);
        $target_file = $target_dir . $filename; // Path lengkap untuk upload
        
        if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
            $image_url_path = "pict project e/" . $filename; // Path untuk disimpan ke DB
        }
    }

    // --- Logika Upload Gambar 2: slider_image_url (Gambar Slider) ---
    // Mengambil nama file yang ada dari form
    $slider_image_url_path = $_POST['existing_slider_image_url'] ?? null;

    // Jika ada file BARU diupload untuk 'slider_image_url'
    if (isset($_FILES['slider_image_url']) && $_FILES['slider_image_url']['error'] == 0) {
        $filename = uniqid('prod_slider_') . basename($_FILES["slider_image_url"]["name"]);
        $target_file = $target_dir . $filename; // Path lengkap untuk upload

        if (move_uploaded_file($_FILES["slider_image_url"]["tmp_name"], $target_file)) {
            $slider_image_url_path = "pict project e/" . $filename; // Path untuk disimpan ke DB
        }
    }


    if ($id) { // UPDATE
        // --- PERUBAHAN: Query UPDATE disesuaikan dengan kolom database ---
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=?, image_url=?, slider_image_url=? WHERE id=?");
        // --- PERUBAHAN: bind_param disesuaikan (string, double, string, string, string, int) ---
        $stmt->bind_param("sdsssi", $name, $price, $description, $image_url_path, $slider_image_url_path, $id);
        $stmt->execute();
        $status = "diperbarui";
    } else { // INSERT
        // --- PERUBAHAN: Query INSERT disesuaikan dengan kolom database ---
        $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_url, slider_image_url) VALUES (?, ?, ?, ?, ?)");
        // --- PERUBAHAN: bind_param disesuaikan (string, double, string, string, string) ---
        $stmt->bind_param("sdsss", $name, $price, $description, $image_url_path, $slider_image_url_path);
        $stmt->execute();
        $status = "ditambahkan";
    }
    
    $stmt->close();
    header("Location: produk.php?status=" . $status);
    exit();
}
?>