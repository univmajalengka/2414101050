<?php
if (isset($_POST['create'])) {
  include 'db.php';

  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $gambar = $_FILES['gambar']['name'] ?? '';
  $tempGambar = $_FILES['gambar']['tmp_name'] ?? '';
  $errorUpload = $_FILES['gambar']['error'] ?? UPLOAD_ERR_NO_FILE;

  $target_dir = realpath(__DIR__ . '/gambar');
  if ($target_dir === false) {
    $target_dir = __DIR__ . '../gambar';
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0775, true);
    }
  }

  $target_file = rtrim($target_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . basename($gambar);
  if (!is_writable($target_dir)) {
    echo "Folder tidak upload tidak diizinkan: $target_dir";
    exit;
  }

  if ($errorUpload === UPLOAD_ERR_OK && move_uploaded_file($tempGambar, $target_file)) {
    $sql = "INSERT INTO produk (nama, deskripsi, gambar) VALUES ('$nama', '$deskripsi', '$gambar')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Data berhasil disimpan.'); window.location.href='dashboard.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Error uploading file: " . $errorUpload;
  }

  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div class="mx-auto max-w-7xl py-10">
    <div class="flex flex-row justify-center items-center gap-4">
      <h1>Tambah Data</h1>
      <a href="dashboard.html" class="bg-blue-500 rounded-lg px-4 py-2">Kembali</a>
    </div>
    <div class="max-w-7xl mx-auto my-10">
      <div class="border p-4">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
            <input
              type="text"
              id="nama"
              name="nama"
              class="w-full border border-gray-300 rounded-lg px-4 py-2"
              required />
          </div>
          <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi:</label>
            <input
              type="text"
              id="deskripsi"
              name="deskripsi"
              class="w-full border border-gray-300 rounded-lg px-4 py-2"
              required />
          </div>
          <div class="mb-4">
            <label for="gambar" class="block text-gray-700 font-bold mb-2">Gambar:</label>
            <input
              type="file"
              id="gambar"
              name="gambar"
              accept="image/*"
              class="w-full border border-gray-300 rounded-lg px-4 py-2"
              required />
          </div>
          <button
            type="submit"
            name="create"
            class="bg-blue-500 rounded-lg px-4 py-2 text-white">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>