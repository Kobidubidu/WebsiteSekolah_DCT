<?php
session_start();
require_once '../includes/db_connect.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = $_POST['role']; // Mendapatkan peran (siswa atau admin)

    if ($role == 'user') {
        $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
        
        // Cek apakah email sudah terdaftar
        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $emailResult = mysqli_query($conn, $checkEmail);

        if (mysqli_num_rows($emailResult) > 0) {
            echo "Email sudah terdaftar!";
        } else {
            // Query untuk menyimpan data siswa
            $sql = "INSERT INTO users (name, email, nisn) VALUES ('$name', '$email', '$nisn')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $name;
                $_SESSION['role'] = 'user';
                header("Location: ../pages/dashboard.php"); // Redirect ke dashboard siswa
                exit();
            } else {
                echo "Terjadi kesalahan: " . mysqli_error($conn);
            }
        }
    } elseif ($role == 'admin') {
        $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);
        
        // Cek apakah email sudah terdaftar
        $checkEmail = "SELECT * FROM admin WHERE email = '$email'";
        $emailResult = mysqli_query($conn, $checkEmail);

        if (mysqli_num_rows($emailResult) > 0) {
            echo "Email admin sudah terdaftar!";
        } else {
            // Query untuk menyimpan data admin
            $sql = "INSERT INTO admin (name, email, pin_code) VALUES ('$name', '$email', '$pin_code')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $name;
                $_SESSION['role'] = 'admin';
                header("Location: ../pages/admin_dashboard.php"); // Redirect ke dashboard admin
                exit();
            } else {
                echo "Terjadi kesalahan: " . mysqli_error($conn);
            }
        }
    }
}
?>
    