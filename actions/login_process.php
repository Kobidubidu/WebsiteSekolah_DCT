<?php
session_start();
require_once '../includes/db_connect.php'; // File koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = $_POST['role']; // Mendapatkan peran (siswa atau admin)

    // Prepare SQL query based on user role
    if ($role == 'user') {
        $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
        $sql = "SELECT * FROM users WHERE email = '$email' AND name = '$name' AND nisn = '$nisn'";
    } else if ($role == 'admin') {
        $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);
        $sql = "SELECT * FROM admin WHERE email = '$email' AND name = '$name' AND pin_code = '$pin_code'";
    } else {
        echo "Role tidak valid.";
        exit();
    }

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Save user information in session
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $role;

        // Save user_id to session
        $_SESSION['user_id'] = $user['id']; // Ensure 'id' exists in both tables

        // Redirect based on user role
        if ($role == 'user') {
            header("Location: ../pages/dashboard.php"); // Redirect to student dashboard
        } else if ($role == 'admin') {
            header("Location: ../pages/admin_dashboard.php"); // Redirect to admin dashboard
        }
        exit();
    } else {
        echo "Login gagal! Data tidak cocok.";
    }
}
?>