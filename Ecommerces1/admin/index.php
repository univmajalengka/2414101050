<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RzStore - Koleksi Parfum Premium</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-50 text-gray-800">

  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">

    <header class="text-center mb-12">
      <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Koleksi Parfum Eksklusif Kami</h1>
      <p class="mt-4 text-lg text-gray-600">Temukan aroma yang mendefinisikan diri Anda.</p>
      <a href="dashboard.php" class="mt-6 inline-block bg-gray-800 text-white rounded-lg px-6 py-3 text-base font-semibold shadow-md hover:bg-gray-700 transition-transform transform hover:scale-105">
        Ke Dashboard Admin
      </a>
    </header>

    <?php
    // PERUBAHAN: Menggunakan 'config.php' sesuai file koneksi yang dibuat sebelumnya.
    // Pastikan nama file ini benar.
    require_once 'db.php';

    if (isset($conn)) {
        $conn->close(); 
    }
    ?>

    <footer class="text-center mt-16 py-6 border-t border-gray-200">
      <p class="text-sm text-gray-500">&copy; <?= date('Y') ?> RzStore. All Rights Reserved.</p>
    </footer>

  </div>
</body>

</html>