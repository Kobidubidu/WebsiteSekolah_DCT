<?php
include '../includes/header.php';
include '../includes/db_connect.php';


if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['image'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_path = '../uploads/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        
        $sql = "INSERT INTO gallery (user_id, title, description, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $_SESSION['user_id'], $title, $description, $image_path);

        $stmt->execute();
        
        header('Location: ../pages/portfolio.php');
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (head content) ... -->
</head>
<body>

    <section class="hero">
        <h1>Tambah Item Galeri</h1>
        <p>Tambahkan karya Anda ke galeri</p>
    </section>

    <section class="form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" required><br><br>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required></textarea><br><br>
            <label for="image">Gambar:</label>
            <input type="file" id="image" name="image" required><br><br>
            <input type="submit" value="Tambah">
        </form>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>