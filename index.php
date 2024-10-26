<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DKV SMKN 3 BANDUNG</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="..\WebsiteSekolah_DCT\assets\css\index.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top" style="background-color: rgba(119, 48, 48, 0.5);">
    <div class="container">
        <img src="..\WebsiteSekolah_DCT\assets\images\Logobrand.png" alt="Logo DKV SMKN 3 Bandung" width="100" height="100">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT/pages/admin_dashboard.php">Dashboard Admin</a></li>
                    <?php elseif ($_SESSION['role'] == 'user'): ?>
                        <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT/pages/dashboard.php">Dashboard Siswa</a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="..\WebsiteSekolah_DCT\index.php">Featured</a></li>
                <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT\pages\About.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT\pages\contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT\pages\eventdkv.php">Event DKV</a></li>
                <li class="nav-item"><a class="nav-link" href="../WebsiteSekolah_DCT\pages\portfolio.php">Portofolio Siswa</a></li>
            </ul>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="../WebsiteSekolah_DCT/actions/logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="../WebsiteSekolah_DCT/pages/login.php" class="btn btn-primary ms-3">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
</nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex justify-content-center align-items-center">
        <div class="hero-content text-center">
            <h1>Berkarya Dan Berjaya Bersama DKV SMKN 3 Bandung</h1>
            <p>Selamat datang di website jurusan DKV SMKN 3 Bandung</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
    </section>

    <!-- Info Cards Section -->
    <div class="container py-5">
        <div class="row text-center">
            <!-- Photography Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card p-4 shadow-sm rounded">
                    <div class="icon mb-3">📷</div>
                    <h4>Photography</h4>
                    <a href="#">See More →</a>
                </div>
            </div>
            
            <!-- Videography Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card p-4 shadow-sm rounded">
                    <div class="icon mb-3">🎥</div>
                    <h4>Videography</h4>
                    <a href="#">See More →</a>
                </div>
            </div>
            
            <!-- Graphic Design Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card p-4 shadow-sm rounded">
                    <div class="icon mb-3">💻</div>
                    <h4>Graphic Design</h4>
                    <a href="#">See More →</a>
                </div>
            </div>
        </div>
    
        <!-- New Row for Animation Card -->
        <div class="row text-center">
            <!-- Animation Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card p-4 shadow-sm rounded">
                    <div class="icon mb-3">🚶🏻‍♂</div>
                    <h4>Animation</h4>
                    <a href="#">See More →</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Welcome Section -->
<section class="welcome-section text-center py-5" style="color: black;">
    <div class="container">
        <h2 class="welcome-title">Kepala Jurusan DKV</h2>
        <p>Lorem ipsum dolor sit amet consectetur. Id nulla cras amet amet. Morbi convallis eu volutpat risus eget facilisis sodales enim.</p>
        <p>Duis blandit amet ultricies quis non mattis vulputate. Ut interdum integer viverra nisl ullamcorper leo nisi tellus nisi.</p>
        <div class="school-head-profile mt-4">
            <img src="../WebsiteSekolah_DCT/assets/images/pak ismail.jpg" alt="Kepala Sekolah" class="rounded-circle">
            <h4 class="mt-3">Mohamad Ismail</h4>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<?php
include '../WebsiteSekolah_DCT/includes/db_connect.php';
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
<div class="container">
    <h2 class="text-center my-4">Galeri Karya Siswa</h2>
    <div class="row g-4">
        <?php foreach ($gallery_items as $item): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="<?php echo htmlspecialchars('../WebsiteSekolah_DCT/uploads/' . $item['image_path'] ?? 'default_image_path.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['title'] ?? 'Default Title'); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['title'] ?? 'Default Title'); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($item['description'] ?? 'No description available.'); ?></p>
                        <p class="card-text"><small class="text-muted">Oleh: <?php echo htmlspecialchars($item['user_name'] ?? 'Unknown User'); ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Student Achievements Section -->
<section class="achievements-section py-5 text-center" style="color: black;">
    <div class="container">
        <h4 class="mb-4">Hasil perjuangan para siswa setelah kelulusan</h4>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h2>99</h2>
                <p>Siswa Bekerja setelah kelulusan</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h2>99</h2>
                <p>Siswa melanjutkan pendidikan tinggi</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h2>99</h2>
                <p>Siswa Berwirausahawan</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Organization</h5>
          <ul>
            <li><a href="#">Osis</a></li>
            <li><a href="#">PMR</a></li>
            <li><a href="#">MPK</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>FAQs</h5>
          <ul>
            <li><a href="#">Kelebihan dari Sekolah ini</a></li>
            <li><a href="#">Mendukung kemampuan siswa</a></li>
            <li><a href="#">Jumlah Kerjasama dalam Pihak</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Features</h5>
          <ul>
            <li><a href="#">Videography</a></li>
            <li><a href="#">Photography</a></li>
            <li><a href="#">Graphic Design</a></li>
            <li><a href="#">Animation</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <p class="text-muted">Copyright &copy; 2023 Your School</p>
        </div>
        <div class="col-md-6 text-md-right">
          <ul class="social-icons">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>