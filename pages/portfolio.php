<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Karya Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgba(119, 48, 48, 0.5);
            color: #333;
        }

        header {
            background-color: #4c14cf;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 24px;
            color: white;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header nav ul li {
            margin-right: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            background-color: #4c14cf;
            color: white;
        }

        .hero h1 {
            margin: 0;
            font-size: 36px;
        }

        .gallery {
            background-color: white;
            padding: 40px;
            margin: 20px auto;
            max-width: 1200px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .gallery h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4c14cf;
        }

        .gallery .projects {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .gallery .projects img {
            width: 100%;
            border-radius: 10px;
        }

        footer {
            background-color: rgba(119, 48, 48, 0.5);
            color: white;
            padding: 20px 0;
        }

        footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        footer .contact-info {
            margin: 10px 0;
        }

        footer .contact-info a {
            color: white;
            text-decoration: none;
        }

        footer .contact-info a:hover {
            text-decoration: underline;
        }

        footer .links {
            display: flex;
            justify-content: space-around;
        }

        footer .links ul {
            list-style: none;
            padding: 0;
        }

        footer .links ul li {
            margin-bottom: 5px;
        }

        footer .links ul li a {
            color: white;
            text-decoration: none;
        }

        footer .links ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php
    include '../includes/header.php';
    ?>

    <section class="hero">
        <h1>Galeri Karya Siswa</h1>
        <p>Karya - Karya Siswa kami</p>
    </section>

    <section class="gallery">
        <h2>Galeri Projek pembuatan Design kelas XI - A</h2>
        <p>9 September 2024</p>
        <div class="projects">
            <img src="project1.jpg" alt="Project 1">
            <img src="project2.jpg" alt="Project 2">
            <img src="project3.jpg" alt="Project 3">
            <img src="project4.jpg" alt="Project 4">
            <img src="project5.jpg" alt="Project 5">
            <img src="project6.jpg" alt="Project 6">
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="contact-info">
                <p>Contact Us</p>
                <p>Phone: +0182371002</p>
                <a href="#">Facebook</a> | 
                <a href="#">Instagram</a> | 
                <a href="#">Email</a>
            </div>
            <div class="links">
                <ul>
                    <li><a href="#">Organization</a></li>
                    <li><a href="#">Osis</a></li>
                    <li><a href="#">PMR</a></li>
                    <li><a href="#">MPK</a></li>
                </ul>
                <ul>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">History Class</a></li>
                    <li><a href="#">Accounting Class</a></li>
                    <li><a href="#">Design and Coding</a></li>
                    <li><a href="#">Database siswa</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>
