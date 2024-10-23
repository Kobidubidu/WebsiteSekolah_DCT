<?php
include '../includes/db_connect.php';


$sql = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event DKV</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Event DKV</h1>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <a href="add_event.php" class="btn btn-primary">Tambah Event Baru</a>
    <?php endif; ?>

    <div class="events-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="event-item">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <?php if ($row['image_path']): ?>
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Event Image">
                <?php endif; ?>
                <?php if ($row['video_path']): ?>
                    <video controls>
                        <source src="<?php echo htmlspecialchars($row['video_path']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                    <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>