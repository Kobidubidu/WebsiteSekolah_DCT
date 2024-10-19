<?php
session_start();

// Cek apakah pengguna sudah login dan apakah rolenya adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DKV SMKN 3</title>
</head>
<body>
    <?php
    include '../includes/header.php';
    ?>
    <h1>Selamat datang, <?php echo $_SESSION['username']; ?> (Admin)</h1>
    <p>Ini adalah dashboard admin.</p>
    <a href="../actions/logout.php">Logout</a>
</body>
</html>
