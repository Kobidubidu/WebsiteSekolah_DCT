<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - DKV SMKN 3</title>
</head>
<body>
<?php
include '../includes/header.php';
session_start();

// Cek apakah pengguna sudah login dan apakah rolenya adalah user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit(); 
}
?>
    <h1>Selamat datang, <?php echo $_SESSION['username']; ?> (Siswa)</h1>
    <p>Ini adalah dashboard siswa.</p>
    <a href="../pages/upload_portfolio.php">upload</a>
    <a href="../actions/logout.php">Logout</a>
</body>
</html>
