<?php
session_start();
session_destroy();  // Hapus semua session
header("Location: ../pages/login.php");  // Redirect ke halaman login
exit();
?>
