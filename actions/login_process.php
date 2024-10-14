<?php
session_start();
require_once '../includes/db_connect.php'; // File koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = $_POST['role']; // Mendapatkan peran (siswa atau admin)

    if ($role == 'user') {
        $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);

        // Query untuk siswa
        $sql = "SELECT * FROM users WHERE email = '$email' AND name = '$name' AND nisn = '$nisn'";
    } else if ($role == 'admin') {
        $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);

        // Query untuk admin
        $sql = "SELECT * FROM admin WHERE email = '$email' AND name = '$name' AND pin_code = '$pin_code'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Simpan session pengguna
        $_SESSION['username'] = $user['name'];

        if ($role == 'user') {
            $_SESSION['role'] = 'user';
            header("Location: ../pages/dashboard.php"); // Redirect ke dashboard siswa
        } else if ($role == 'admin') {
            $_SESSION['role'] = 'admin';
            header("Location: ../pages/admin_dashboard.php"); // Redirect ke dashboard admin
        }
        exit();
    } else {
        echo "Login gagal! Data tidak cocok.";
    }
}
?>
