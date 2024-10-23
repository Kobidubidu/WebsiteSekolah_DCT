<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DKV SMKN 3</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css"> <!-- Gunakan CSS yang sama -->
    <style>
        body {
            background-image: url("../assets/images/bg-login.png"); /* Ganti dengan jalur yang benar */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
        }
    </style>
</head>
<body class="bg-dark text-light">
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4" style="color: rgba(119, 48, 48, 0.5);">Register ke Jurusan DKV SMKN 3</h2>
                
                <form action="../actions/register_process.php" method="POST" style="color: rgba(119, 48, 48, 0.5);">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Daftar sebagai:</label>
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

                    <button class="btn btn-danger btn-block" type="submit">Register</button>
                </form>
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

    <?php include '../includes/footer.php'; ?>
</body>
</html>