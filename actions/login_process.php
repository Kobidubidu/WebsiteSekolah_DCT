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
        
        if (isset($user['id'])) {

            // Ambil session_id dari database
            $session_id = $user['session_id']; // Pastikan kolom 'session_id' ada dalam tabel 'users' dan 'admin'
            $_SESSION['session_id'] = $session_id; // Simpan session_id ke dalam sesi
            
            // Menyimpan ID pengguna ke dalam sesi
            $_SESSION['user_id'] = $user['id']; // Store the user's ID from the database
            $_SESSION['username'] = $user['name']; // Store the user's name
            $_SESSION['role'] = $role; // Store the user's role

            

            // Debugging: Cek nilai sesi
            var_dump($_SESSION['user_id']); // This should show the user's ID
            var_dump($_SESSION['role']); // This should show the user's role
            var_dump($_SESSION['session_id']); // This should show the session ID from the database
        }

        // Redirect berdasarkan peran pengguna
        if ($role == 'user') {
            header("Location: ../pages/dashboard.php"); // Redirect ke dashboard siswa
        } else if ($role == 'admin') {
            header("Location: ../pages/admin_dashboard.php"); // Redirect ke dashboard admin
        }
        exit();
    } else {
        echo "Login gagal! Data tidak cocok.";
    }
}
?>