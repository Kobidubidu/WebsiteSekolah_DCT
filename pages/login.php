<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DKV SMKN 3</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
    <style>
        body {
            background-image: url("../assets/images/bg-login.png");
            background-size: cover;
            background-position: center;
        }
        .container {
            margin-top: 100px; /* Memberikan ruang untuk header */
        }
    </style>
    <script>
        function toggleFields() {
            var role = document.getElementById('role').value;
            var userFields = document.getElementById('user-fields');
            var adminFields = document.getElementById('admin-fields');

            if (role === 'admin') {
                userFields.style.display = 'none'; // Sembunyikan NISN
                adminFields.style.display = 'block'; // Tampilkan PIN
            } else {
                userFields.style.display = 'block'; // Tampilkan NISN
                adminFields.style.display = 'none'; // Sembunyikan PIN
            }
        }
    </script>
</head>
<body class="bg-dark text-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4" style="color: rgba(119, 48, 48, 0.5);">Login ke Jurusan DKV SMKN 3</h2>
                
                <img src="../assets/images/logobrand.png" alt="Logo DKV SM KN 3" class="logo" width='100' height='100'>
                
                <form action="../actions/login_process.php" method="POST" style="color: rgba(119, 48, 48,  0.5);">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Login sebagai:</label>
                        <select class="form-control" name="role" id="role" onchange="toggleFields()" required>
                            <option value="user">Siswa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <!-- Fields for user login -->
                    <div id="user-fields" class="form-group">
                        <label for="nisn">NISN:</label>
                        <input type="text" class="form-control" name="nisn">
                    </div>
                    
                    <!-- Fields for admin login -->
                    <div id="admin-fields" class="form-group" style="display: none;">
                        <label for="pin_code">PIN Code (untuk admin):</label>
                        <input type="password" class="form-control" name="pin_code">
                    </div>
                    
                    <button class="btn btn-danger btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>