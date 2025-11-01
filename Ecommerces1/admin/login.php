<?php

session_start();

if (isset($_SESSION['admin_id'])) {

    header('Location: index.php');

    exit();

}

// PERBAIKAN 1: Path 'require_once' diubah untuk naik satu level

require_once '../config.php';



$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);

    $password = trim($_POST['password']);



    $stmt = $conn->prepare("SELECT id, nama_lengkap, password, role FROM admins WHERE username = ?");

    if (!$stmt) {

        $error = 'Database error: ' . $conn->error;

    } else {

        $stmt->bind_param("s", $username);

        if (!$stmt->execute()) {

            $error = 'Execute error: ' . $stmt->error;

        } else {

            // PERBAIKAN 2: Mengganti get_result() dengan store_result() dan bind_result()

            $stmt->store_result(); // Simpan hasil query



            // Cek apakah ada 1 baris hasil (user ditemukan)

            if ($stmt->num_rows === 1) {

                // Ikat hasil ke variabel

                $stmt->bind_result($admin_id, $admin_name, $admin_password, $admin_role);

                $stmt->fetch(); // Ambil datanya



                // PERBAIKAN 3: Masalah keamanan diperbaiki (hanya gunakan password_verify)

                if (password_verify($password, $admin_password)) {

                    // Password benar, buat session

                    $_SESSION['admin_id'] = $admin_id;

                    $_SESSION['admin_name'] = $admin_name;

                    $_SESSION['admin_level'] = $admin_role;

                    header('Location: index.php');

                    exit();

                } else {

                    // Password salah

                    $error = 'Username atau password salah!';

                }

            } else {

                // Username tidak ditemukan

                $error = 'Username atau password salah!';

            }

        }

        $stmt->close();

    }

}

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #f4f7f6; }

        .login-card { max-width: 400px; width: 100%; }

    </style>

</head>

<body>

    <div class="card login-card shadow-sm">

        <div class="card-body p-4">

            <h2 class="text-center fw-bold mb-4">Admin Login</h2>

            <?php if ($error): ?>

                <div class="alert alert-danger"><?php echo $error; ?></div>

            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">

                    <label for="username" class="form-label">Username</label>

                    <input type="text" name="username" id="username" class="form-control" required>

                </div>

                <div class="mb-3">

                    <label for="password" class="form-label">Password</label>

                    <input type="password" name="password" id="password" class="form-control" required>

                </div>

                <div class="d-grid">

                    <button type="submit" class="btn btn-primary">Login</button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>