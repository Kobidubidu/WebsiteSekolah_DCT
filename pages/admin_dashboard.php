<?php
include_once '../includes/header.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Include database connection
include_once '../includes/db_connect.php';

// Check if the database connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submissions for adding, editing, and deleting users and admins
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adding a user
    if (isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $nisn = $_POST['nisn'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (name, email, nisn) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $nisn);
        $stmt->execute();
        $stmt->close();
    }

    // Deleting a user
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }

    // Editing a user
    if (isset($_POST['edit_user'])) {
        $user_id = $_POST['user_id']; // Get the user ID from the hidden input
        $name = $_POST['name'];
        $email = $_POST['email'];
        $nisn = $_POST['nisn'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, nisn = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $nisn, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    // Adding an admin
    if (isset($_POST['add_admin'])) {
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $pin_code = $_POST['pin_code'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO admin (name, email, pin_code) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $admin_name, $admin_email, $pin_code);
        $stmt->execute();
        $stmt->close();
    }

    // Deleting an admin
    if (isset($_POST['delete_admin'])) {
        $admin_id = $_POST['admin_id'];
        $stmt = $conn->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $stmt->close();
    }

    // Editing an admin
    if (isset($_POST['edit_admin'])) {
        $admin_id = $_POST['admin_id'];
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $pin_code = $_POST['pin_code'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE admin SET name = ?, email = ?, pin_code = ? WHERE id = ?");
        $stmt->bind_param("sssi", $admin_name, $admin_email, $pin_code, $admin_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch users for display
$result_users = $conn->query("SELECT * FROM users");
$users = $result_users->fetch_all(MYSQLI_ASSOC);

// Fetch admins for display
$result_admins = $conn->query("SELECT * FROM admin");
$admins = $result_admins->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DKV SMKN 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1, h2, h3 {
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat datang, <?php echo $_SESSION['username']; ?> (Admin)</h1>
        
        <h2>Manage Users</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="nisn" placeholder="NISN" required>
            <button type="submit" name="add_user">Add User</button>
        </form>
        
        <h3>User List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>NISN</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['nisn']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="delete_user">Delete</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="edit_user">Edit</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>