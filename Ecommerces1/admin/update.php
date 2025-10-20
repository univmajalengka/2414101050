<?php
include 'db.php';

$id = $_GET['id'] ?? null;
$row = null;

if ($id) {
  $sql = "SELECT * FROM products WHERE id=$id";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
  } else {
    echo "Data tidak ditemukan!";
    exit();
  }
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $gambar = $_FILES['gambar']['name'];
  $target_dir = "../gambar/";
  $target_file = $target_dir . basename($gambar);

  if ($gambar) {
    // ambil gambar lama
    $sql = "SELECT image_url FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $old = $result->fetch_assoc();
    $old_image = $old['image_url'];

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
      $sql = "UPDATE products
                    SET name='$nama', description='$deskripsi', image_url='$gambar' 
                    WHERE id=$id";
      if ($conn->query($sql) === TRUE) {
        if ($old_image && file_exists($target_dir . $old_image)) {
          unlink($target_dir . $old_image);
        }
        echo "<script>alert(' berhasil diperbarui!');window.location.href='dashboard.php';</script>";
      } else {
        echo "Error: " . $conn->error;
      }
    } else {
      echo "Gagal upload gambar.";
    }
  } else {
    $sql = "UPDATE products SET name='$nama', description='$deskripsi' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert(' berhasil diperbarui!');window.location.href='dashboard.php';</script>";
    } else {
      echo "Error: " . $conn->error;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Anggota</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div class="mx-auto max-w-4xl py-10">
    <div class="flex flex-row justify-between items-center mb-8">
      <h1 class="text-2xl font-bold">Edit Data Anggota</h1>
      <a href="index.php" class="bg-red-500 hover:bg-red-600 text-white rounded-lg px-4 py-2">
        Kembali
      </a>
    </div>
    <div class="border p-6 rounded-lg shadow-md bg-white">
      <form action="update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?? ''; ?>" />

        <div>
          <label for="nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
          <input
            type="text"
            id="nama"
            name="nama"
            value="<?php echo $row['nama'] ?? ''; ?>"
            class="w-full border border-gray-300 rounded-lg px-4 py-2"
            required />
        </div>

        <div>
          <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
          <input
            type="text"
            id="deskripsi"
            name="deskripsi"
            value="<?php echo $row['deskripsi'] ?? ''; ?>"
            class="w-full border border-gray-300 rounded-lg px-4 py-2"
            required />
        </div>

        <div>
          <label for="gambar" class="block text-gray-700 font-bold mb-2">Foto Anggota:</label>
          <input
            type="file"
            id="gambar"
            name="gambar"
            accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-2" />
          <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>

          <?php if (!empty($row['gambar'])): ?>
            <div class="mt-4">
              <p class="text-gray-600 mb-2">Foto saat ini:</p>
              <img src="gambar/<?php echo $row['gambar']; ?>" alt="Foto Anggota" class="w-40 h-40 object-cover rounded-lg border" />
            </div>
          <?php endif; ?>
        </div>

        <button
          type="submit"
          name="update"
          class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-4 py-2">
          Perbarui
        </button>
      </form>
    </div>
  </div>
</body>

</html>