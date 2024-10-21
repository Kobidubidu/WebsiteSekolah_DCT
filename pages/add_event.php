<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: eventdkv.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = '../uploads/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }
    
    $video_path = null;
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $video_path = '../uploads/' . uniqid() . '_' . $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
    }
    
    $sql = "INSERT INTO events (title, description, image_path, video_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $title, $description, $image_path, $video_path);
    $stmt->execute();
    
    header('Location: eventdkv.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Tambah Event Baru</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <label for="title">Judul Event:</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="description">Deskripsi Event:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <label for="image">Foto Event:</label>
        <input type="file" id="image" name="image"><br><br>
        <label for="video">Video Event:</label>
        <input type="file" id="video" name="video"><br><br>
        <input type="submit" value="Tambah Event">
    </form>

    <?php include '../includes/footer.php'; ?>
</body>
</html>