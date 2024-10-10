<?php
// Memasukkan koneksi database
include('../includes/db_connect.php');

// Memulai session
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Jika sudah login, redirect ke dashboard\
    
    exit();
}

// Logika login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitasi input
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Query untuk mengecek user
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect ke dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DKV SMKN 3</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login ke DKV SMKN 3</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
    </div>
</body>
</html>
