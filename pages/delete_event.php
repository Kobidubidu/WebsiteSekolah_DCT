<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: eventdkv.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: eventdkv.php');
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();

header('Location: eventdkv.php');
exit();
?>