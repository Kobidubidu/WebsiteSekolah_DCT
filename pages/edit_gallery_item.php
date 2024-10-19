<?php
session_start();
include '../includes/db_connect.php';

if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM gallery WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $gallery_item = $stmt->get_result()->fetch_assoc();
        
        if ($gallery_item) {
            if (isset($_POST['title']) && isset($_POST['description'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                
                if (isset($_FILES['image'])) {
                    $image_path = '../uploads/' . uniqid() . '_' . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
                } else {
                    $image_path = $gallery_item['image_path'];
                }
                
                $sql = "UPDATE gallery SET title = ?, description = ?, image_path = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $title, $description, $image_path, $id);
                $stmt->execute();
                
                header('Location: portfolio.php');
                exit;
            }
        } else {
            header('Location: portfolio.php');
            exit;
        }
    } else {
        header('Location: portfolio.php');
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
    <?php include '../includes/header.php'; ?>

    <section class="hero">
        <h1>Edit Item Galeri</h1>
        <p>Edit karya Anda di galeri</p>
    </section>

    <section class="form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($gallery_item['title']); ?>" required><br><br>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($gallery_item['description']); ?></textarea><br><br >
            <label for="image">Gambar:</label>
            <input type="file" id="image" name="image"><br><br>
            <input type="submit" value="Simpan">
        </form>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>