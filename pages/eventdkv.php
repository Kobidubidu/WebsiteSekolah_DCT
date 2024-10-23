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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/portfolio.css">
</head>
<body class="bg-light">
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="text-primary fw-bold">Event DKV</h1>
            <p class="fs-5">Acara dan Kegiatan DKV kami</p>
        </div>

        <!-- Button to Add Event -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="text-center mb-4">
                <a href="../actions/add_event.php" class="btn btn-primary">Tambah Event Baru</a>
            </div>
        <?php endif; ?>

        <!-- Event List Section -->
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="<?php echo htmlspecialchars($row['image_path'] ?? 'default_image_path.jpg'); ?>" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <?php if ($row['video_path']): ?>
                                <video controls class="w-100 mb-2">
                                    <source src="<?php echo htmlspecialchars($row['video_path']); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                <a href="../actions/edit_event.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                                <a href="../actions/delete_event.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    include  '../includes/footer.php';

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>