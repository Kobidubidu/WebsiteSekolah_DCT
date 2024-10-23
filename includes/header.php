<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\assets\css\header.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top" style="background-color: rgba(119, 48, 48, 0.5);">
    <div class="container">
        <img src="..\assets\images\Logobrand.png" alt="Logo DKV SMKN 3 Bandung" width="100" height="100">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="../pages/admin_dashboard.php">Dashboard Admin</a></li>
                    <?php elseif ($_SESSION['role'] == 'user'): ?>
                        <li class="nav-item"><a class="nav-link" href="../pages/dashboard.php">Dashboard Siswa</a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="..\index.php">Featured</a></li>
                <li class="nav-item"><a class="nav-link" href="..\pages\About.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="..\pages\contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="..\pages\eventdkv.php">Event DKV</a></li>
                <li class="nav-item"><a class="nav-link" href="..\pages\portfolio.php">Portofolio Siswa</a></li>
            </ul>
            <?php
            if(isset($_SESSION['username'])) {
                echo '<div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            ' . htmlspecialchars($_SESSION['username']) . '
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../actions/logout.php">Logout</a></li>
                        </ul>
                      </div>';
            } else {
                echo '<a href="login.php" class="btn btn-primary ms-3">Login</a>';
            }
            ?>
        </div>
    </div>
</nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>