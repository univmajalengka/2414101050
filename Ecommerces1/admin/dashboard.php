<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div class="mx-auto max-w-7xl py-10">
    <div class="flex flex-row justify-center items-center gap-4">
      <a href="index.php" class="bg-blue-500 rounded-lg px-4 py-2">Ke HOme</a>
      <h1>HALAMAN ADMIN</h1>
      <a href="create.php" class="bg-blue-500 rounded-lg px-4 py-2">Tambah Data</a>
    </div>
    <?php
    include 'db.php';

    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($sql);
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="border rounded-2xl overflow-hidden shadow bg-white">
            <!-- Gambar -->
            <img
              src="../gambar/<?= htmlspecialchars($row['image_url']) ?>"
              alt=""
              class="w-full h-56 object-cover" />

            <!-- Konten -->
            <div class="p-4 space-y-2">
              <h1 class="font-semibold text-lg text-gray-800"><?= htmlspecialchars($row['name']) ?></h1>
              <p class="text-sm text-gray-600"><?= htmlspecialchars($row['description']) ?></p>

              <div class="flex gap-2 mt-3">
                <a href="update.php?id=<?= urlencode($row['id']) ?>" class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg px-4 py-2 text-sm font-medium">Edit</a>
                <a href="delete.php?id=<?= urlencode($row['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="flex-1 text-center bg-red-500 hover:bg-red-600 text-white rounded-lg px-4 py-2 text-sm font-medium">Hapus</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="col-span-full text-center text-gray-500">Belum ada data!</p>
      <?php endif; ?>
    </div>

    <?php $conn->close(); ?>

  </div>
</body>

</html>s