<?php
include '../includes/db_connect.php';
// Fungsi untuk mendapatkan semua item galeri
function getGalleryItems($conn, $user_id = null) {
    $sql = "SELECT g.*, u.name as user_name FROM gallery g LEFT JOIN users u ON g.user_id = u.id";
    if ($user_id) {
        $sql .= " WHERE g.user_id = ?";
    }
    $sql .= " ORDER BY g.created_at DESC";
    
    $stmt = $conn->prepare($sql);
    if ($user_id) {
        $stmt->bind_param("i", $user_id);
    }
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Ambil semua item galeri
$gallery_items = getGalleryItems($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Karya Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/portfolio.css">
</head>
<body class="bg-light">
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="text-primary fw-bold">Galeri Karya Siswa</h1>
            <p class="fs-5">Karya - Karya Siswa kami</p>
        </div>

        <!-- Button to Add Gallery Item -->
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')): ?>
            <div class="text-center mb-4">
                <a href="../actions/add_gallery_item.php" class="btn btn-primary">Tambah Item Galeri</a>
            </div>
        <?php endif; ?>

        <!-- Grid Gallery Section -->
        <div class="row g-4">
            <?php foreach ($gallery_items as $item): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="<?php echo htmlspecialchars($item['image_path'] ?? 'default_image_path.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['title'] ?? 'Default Title'); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['title'] ?? 'Default Title'); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description'] ?? 'No description available.'); ?></p>
                            <p class="card-text"><small class="text-muted">Oleh: <?php echo htmlspecialchars($item['user_name'] ?? 'Unknown User'); ?></small></p>
                            <?php if (isset($_SESSION['role'])): ?>
    <?php if ($_SESSION['role'] == 'admin' || ($_SESSION['role'] == 'user' && $_SESSION['user_id'] == $item['user_id'])): ?>
        <a href="../actions/edit_gallery_item.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary">Edit</a>
        <a href="../actions/delete_gallery_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</a>
    <?php endif; ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    include  '../includes/footer.php';

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>