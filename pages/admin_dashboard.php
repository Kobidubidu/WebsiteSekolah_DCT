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
// Handle form submissions for deleting messages
if (isset($_POST['delete_message'])) {
    $message_id = $_POST['message_id'];
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $stmt->close();
}
// Fetch messages for display
$result_messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $result_messages->fetch_all(MYSQLI_ASSOC);
// Handle form submissions for adding, editing, and deleting users and admins
// Handle form submissions for adding, editing, and deleting users and admins
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adding a user
    if (isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $nisn = $_POST['nisn'];

        // Find the smallest available ID
        $result = $conn->query("SELECT MIN(id) AS min_id FROM users");
        $min_id = $result->fetch_assoc()['min_id'];

        // Check if the minimum ID is null (meaning there are no users)
        if ($min_id === null) {
            $new_id = 1; // If no users exist, start from 1
        } else {
            // Find the next available ID
            $new_id = $min_id;
            while ($conn->query("SELECT * FROM users WHERE id = $new_id")->num_rows > 0) {
                $new_id++;
            }
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (id, name, email, nisn) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $new_id, $name, $email, $nisn);
        $stmt->execute();
        $stmt->close();
    }

    // (The rest of your code remains unchanged)
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
    $admin_name = $_POST['name'];
    $admin_email = $_POST['email'];
    $pin_code = $_POST['pin_code'];

    // Find the smallest available ID
    $result = $conn->query("SELECT MIN(id) AS min_id FROM admin");
    $min_id = $result->fetch_assoc()['min_id'];

    // Check if the minimum ID is null (meaning there are no admins)
    if ($min_id === null) {
        $new_id = 1; // If no admins exist, start from 1
    } else {
        // Find the next available ID
        $new_id = $min_id;
        while ($conn->query("SELECT * FROM admin WHERE id = $new_id")->num_rows > 0) {
            $new_id++;
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO admin (id, name, email, pin_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $new_id, $admin_name, $admin_email, $pin_code);
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
        $admin_id = $_POST['id'];
        $admin_name = $_POST['name'];
        $admin_email = $_POST['email'];
        $pin_code = $_POST['pin_code'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE admin SET name = ?, email = ?, pin_code = ? WHERE id = ?");
        $stmt->bind_param("sssi", $admin_name, $admin_email, $pin_code, $admin_id);
        $stmt->execute();
        $stmt->close();
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
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <input type="text" name="nisn" value="<?php echo $user['nisn']; ?>" required>
    <button type="submit" name="edit_user">Edit</button>
</form>
                </td>
            </tr>
            <?php } ?>
        </table>
        <h2>Manager Admin</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="pin_code" placeholder="Pin_Code" required>
            <button type="submit" name="add_admin">Add Admin</button>
        </form>
        <h3>Admin List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Pin_Code</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($admins as $admin) {
            ?>
            <tr>
                <td><?php echo $admin['id']; ?></td>
                <td><?php echo $admin['name'];?></td>
                <td><?php echo $admin['email'];?></td>
                <td><?php echo $admin['pin_code'];?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="admin_id" value="<?php echo $admin['id'];?>">
                        <button type="submit" name="delete_admin">Delete</button>
                    </form>
                    <form method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
    <input type="text" name="name" value="<?php echo $admin['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $admin['email']; ?>" required>
    <input type="text" name="pin_code" value="<?php echo $admin['pin_code']; ?>" required>
    <button type="submit" name="edit_admin">Edit</button>
</form>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
<h2>Messages from Contact Form</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($messages as $message) { ?>
    <tr>
        <td><?php echo $message['id']; ?></td>
        <td><?php echo htmlspecialchars($message['name']); ?></td>
        <td><?php echo htmlspecialchars($message['email']); ?></td>
        <td><?php echo htmlspecialchars($message['message']); ?></td>
        <td><?php echo $message['created_at']; ?></td>
        <td>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                <button type="submit" name="delete_message">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
</html>

<?php
// Close the database connection
$conn->close();
?>