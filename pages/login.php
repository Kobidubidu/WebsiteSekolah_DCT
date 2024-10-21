<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DKV SMKN 3</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body class="bg-dark text-light">
    <?php include 'includes/header.php'; ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card" style="width: 30rem; background-color: #300f05;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login ke Jurusan DKV SMKN 3</h2>
                <form action="../actions/login_process.php" method="POST">
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
                    <div id="user-fields" class="form-group">
                        <label for="nisn">NISN:</label>
                        <input type="text" class="form-control" name="nisn">
                    </div>
                    <div id="admin-fields" class="form-group" style="display: none;">
                        <label for="pin_code">PIN Code (untuk admin):</label>
                        <input type="password" class="form-control" name="pin_code">
                    </div>
                    <button class="btn btn-warning btn-block" type="submit">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="../pages/register.php" class="text-light">Daftar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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