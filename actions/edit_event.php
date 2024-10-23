<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../pages/eventdkv.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: ../pages/eventdkv.php');
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $image_path = $row['image_path'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = '../uploads/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }
    
    $video_path = $row['video_path'];
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $video_path = '../uploads/' . uniqid() . '_' . $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
    }
    
    $sql = "UPDATE events SET title = ?, description = ?, image_path = ?, video_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $title, $description, $image_path, $video_path, $id);
    $stmt->execute();
    
    header('Location: ../pages/eventdkv.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Edit Event</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="title">Judul Event:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>
        <label for="description">Deskripsi Event:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>
        <label for ="image">Foto Event:</label>
        <input type="file" id="image" name="image"><br><br>
        <label for="video">Video Event:</label>
        <input type="file" id="video" name="video"><br><br>
        <input type="submit" value="Simpan Perubahan">
    </form>

    <?php include '../includes/footer.php'; ?>
</body>
</html>