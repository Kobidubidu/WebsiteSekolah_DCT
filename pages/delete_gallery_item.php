<?php
session_start();
include '../includes/db_connect.php';

if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM gallery WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $gallery_item = $stmt->get_result()->fetch_assoc();
        
        if ($gallery_item) {
            if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['user_id'] == $gallery_item['user_id'])) {
                $sql = "DELETE FROM gallery WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                
                unlink($gallery_item['image_path']);
                
                header('Location: portfolio.php');
                exit;
            } else {
                header('Location: portfolio.php');
                exit;
            }
        } else {
            header('Location: portfolio.php');
            exit;
        }
    } else {
        header('Location: portfolio.php');
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
?>