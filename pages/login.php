<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DKV SMKN 3</title>
    <link rel="stylesheet" href="../WebsiteSekolah_DCT/assets/css/login.css">
</head>
<body>
    <?php
    include 'includes/header.php';
    ?>

    <div class="login-container">
        <h2>Login ke Jurusan DKV SMKN 3</h2>
        <form action="../actions/login_process.php" method="POST">
            <label for="name">Nama:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="role">Login sebagai:</label>
            <select name="role" id="role" onchange="toggleFields()" required>
                <option value="user">Siswa</option>
                <option value="admin">Admin</option>
            </select>

            <div id="user-fields">
                <label for="nisn">NISN:</label>
                <input type="text" name="nisn">
            </div>

            <div id="admin-fields" style="display: none;">
                <label for="pin_code">PIN Code (untuk admin):</label>
                <input type="password" name="pin_code">
            </div>

            <button type="submit">Login</button>
        </form>
        <a href="..\pages\register.php">Daftar</a>
    </div>

    <script>
        function toggleFields() {
            var role = document.getElementById("role").value;
            var userFields = document.getElementById("user-fields");
            var adminFields = document.getElementById("admin-fields");
            
            if (role === "user") {
                userFields.style.display = "block";
                adminFields.style.display = "none";
            } else {
                userFields.style.display = "none";
                adminFields.style.display = "block";
            }
        }
    </script>
</body>
</html>
