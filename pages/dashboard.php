<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - DKV SMKN 3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include_once '../includes/header.php';
include '../includes/db_connect.php'; // Pastikan Anda sudah mengatur koneksi database di sini

// Cek apakah pengguna sudah login dan apakah rolenya adalah user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit(); // Keluar dari script jika pengguna tidak terautentikasi
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Proses Edit Akun
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_account'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nisn = $_POST['nisn'];
    
    // Update informasi akun
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, nisn = ? WHERE id = ?");
    $stmt->bind_param("ssii", $name, $email, $nisn, $user_id);
    $stmt->execute();
}

// Ambil informasi akun pengguna
$user_query = $conn->prepare("SELECT name, email, nisn FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user_info = $user_result->fetch_assoc();

// Proses Tambah Karya
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_gallery'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_path = 'uploads/' . basename($_FILES['image']['name']);

    // Upload file
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    $stmt = $conn->prepare("INSERT INTO gallery (user_id, title, description, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $description, $image_path);
    $stmt->execute();
}

// Ambil karya pengguna
$gallery_query = $conn->prepare("SELECT * FROM gallery WHERE user_id = ?");
$gallery_query->bind_param("i", $user_id);
$gallery_query->execute();
$gallery_result = $gallery_query->get_result();
?>

<div class="container mt-5">
    <h1>Informasi Akun</h1>
    <!-- Form untuk mengedit akun -->
    <h2>Edit Akun</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>" required>
        </div>
        <div class="form-group">
            <label>NISN:</label>
            <input type="text" class="form-control" name="nisn" value="<?php echo htmlspecialchars($user_info['nisn']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="edit_account">Simpan Perubahan</button>
    </form>

    <!-- Form untuk menambahkan karya -->
    <h2>Tambah Karya</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label>Gambar:</label>
            <input type