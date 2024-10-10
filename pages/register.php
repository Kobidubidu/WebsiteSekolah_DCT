<?php
// Memasukkan koneksi database
include('../includes/db_connect.php');

// Logika register
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi
    if ($password !== $confirm_password) {
        $error = "Password tidak cocok.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru ke database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php"); // Redirect ke login setelah sukses daftar
            exit();
        } else {
            $error = "Terjadi kesalahan: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DKV SMKN 3</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <h2>Daftar ke DKV SMKN 3</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
    </div>
</body>
</html>
