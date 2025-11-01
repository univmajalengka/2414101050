<?php
require_once 'session_check.php';
// Mengganti 'db.php' agar konsisten dengan file Anda sebelumnya
require_once '../config.php'; 

$is_edit = false;
$page_title = 'Tambah Produk';

// PERUBAHAN: Menyesuaikan array $product dengan database rzstore_db
$product = [
    'id' => '', 
    'name' => '', 
    'price' => '', 
    'description' => '', 
    'image_url' => '',
    'slider_image_url' => '' // Menambahkan ini dari database
];

// Jika ini adalah mode edit (ada ID di URL)
if (isset($_GET['id'])) {
    $is_edit = true;
    $page_title = 'Edit Produk';
    $id = intval($_GET['id']);
    
    // --- PERUBAHAN BESAR DIMULAI DI SINI ---
    
    // 1. Ganti query untuk HANYA mengambil kolom yang ADA di database rzstore_db
    $stmt = $conn->prepare("SELECT id, name, price, description, image_url, slider_image_url FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $stmt->store_result(); 

    if($stmt->num_rows > 0) {
        // 2. Bind HANYA kolom yang ada
        $stmt->bind_result(
            $p_id, $p_name, $p_price, $p_description, $p_image_url, $p_slider_image_url
        );
        
        $stmt->fetch();
        
        // 3. Buat ulang array $product agar sesuai
        $product = [
            'id' => $p_id, 
            'name' => $p_name, 
            'price' => $p_price, 
            'description' => $p_description, // 'description' dari DB
            'image_url' => $p_image_url, // 'image_url' dari DB
            'slider_image_url' => $p_slider_image_url // 'slider_image_url' dari DB
        ];
    }
    // --- PERUBAHAN BERAKHIR DI SINI ---
    $stmt->close();
}

// --- DIHAPUS ---
// Query $categories dihapus karena tabel 'categories' tidak ada di database Anda
// $categories = $conn->query("SELECT * FROM categories ORDER BY name"); 
// Baris ini akan menyebabkan error fatal jika tidak dihapus.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3 class="mb-4">Panel Admin</h3>
    <p class="text-white-50 small ms-3">Login sebagai <?php echo htmlspecialchars($_SESSION['admin_name']); ?></p>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="pesanan.php">Pesanan</a></li>
        <li class="nav-item"><a class="nav-link active" href="produk.php">Produk</a></li>
        <li class="nav-item mt-auto"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <h2 class="mb-4"><?php echo $page_title; ?></h2>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Produk</h5>
        </div>
        <div class="card-body">
            <form action="produk_save.php" method="POST" enctype="multipart/form-data"> 
                
                <?php if($is_edit): ?>
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" placeholder="Contoh: 99000" required>
                    </div>
                    </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="image_url" class="form-label">Gambar Utama (Icon)</label>
                    <input type="file" id="image_url" name="image_url" class="form-control">
                    <input type="hidden" name="existing_image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>">
                    <?php if($is_edit && !empty($product['image_url'])): ?>
                        <div class="mt-2">
                            <small class="form-text text-muted">Gambar saat ini:</small>
                            <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" height="80" class="ms-2 rounded" alt="Gambar Produk">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="slider_image_url" class="form-label">Gambar Slider (Besar)</label>
                    <input type="file" id="slider_image_url" name="slider_image_url" class="form-control">
                    <input type="hidden" name="existing_slider_image_url" value="<?php echo htmlspecialchars($product['slider_image_url']); ?>">
                    <?php if($is_edit && !empty($product['slider_image_url'])): ?>
                        <div class="mt-2">
                            <small class="form-text text-muted">Gambar saat ini:</small>
                            <img src="../<?php echo htmlspecialchars($product['slider_image_url']); ?>" height="80" class="ms-2 rounded" alt="Gambar Produk">
                        </div>
                    <?php endif; ?>
                </div>

                </div>
        <div class="card-footer text-end">
                <a href="produk.php" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>