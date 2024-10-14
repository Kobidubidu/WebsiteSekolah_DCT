<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\WebsiteSekolah_DCT\assets\css\About.css">
    <style>
        .image-container {
            position: relative;
            overflow: hidden;
        }
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 123, 255, 0.5); /* Blue overlay with 50% opacity */
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="WebSekolah.html">Featured</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\WebsiteSekolah_DCT\pages\About.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact_us.html">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="EventDKV.html">Event DKV</a></li>
                    <li class="nav-item"><a class="nav-link" href="PortofolioSiswa.html">Portofolio Siswa</a></li>
                </ul>
                <a href="login.html" class="btn btn-primary ms-3">Login</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 image-container">
                <img src="https://plus.unsplash.com/premium_photo-1683887034552-4635692bb57c?q=80&w=1769&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Students walking" class="img-fluid">
                <div class="image-overlay"></div>
            </div>
            <div class="col-md-4 image-container">
                <img src="https://images.unsplash.com/photo-1460518451285-97b6aa326961?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Students studying" class="img-fluid">
                <div class="image-overlay"></div>
            </div>
            <div class="col-md-4 image-container">
                <img src="https://plus.unsplash.com/premium_photo-1663957874137-9f154d8863e1?q=80&w=1772&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Classroom scene" class="img-fluid">
                <div class="image-overlay"></div>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="about-us-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>About Us</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="..\assets\images\Indonesia map.png" class="img-fluid" alt="Map">
                </div>
                <div class="col-md-6">
                    <h2>Lokasi</h2>
                    <p>Jl. Nama jalan Indonesia, No. 21B, Kec. Unknown, Kab. Bandung, Jawa Barat</p>
                    <p>Jl. Nama jalan Tradisional, 07, Kec. Unknown, Kab. Gunung kidul, DI Yogyakarta</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>