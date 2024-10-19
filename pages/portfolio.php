<?php
session_start();
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
    <!-- ... (head content) ... -->
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <section class="hero">
        <h1>Galeri Karya Siswa</h1>
        <p>Karya - Karya Siswa kami</p>
    </section>

    <section class="gallery">
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')): ?>
            <a href="add_gallery_item.php" class="btn btn-primary">Tambah Item Galeri</a>
        <?php endif; ?>

        <div class="projects">
            <?php foreach ($gallery_items as $item): ?>
                <div class="gallery-item">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                    <p>Oleh: <?php echo htmlspecialchars($item['user_name']); ?></p>
                    
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || ($_SESSION['role'] == 'user' && $_SESSION['user_id'] == $item['user_id']))): ?>
                        <a href="edit_gallery_item.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="delete_gallery_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>