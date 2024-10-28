<?php
session_start();
include '../includes/db_connect.php'; // Pastikan Anda menyertakan koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validasi input
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Siapkan dan jalankan query untuk menyimpan pesan
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            // Jika berhasil, alihkan ke halaman kontak dengan pesan sukses
            header("Location: ../pages/contact.php?status=success");
            exit(); // Pastikan untuk keluar setelah redirect
        } else {
            // Jika terjadi kesalahan saat menyimpan pesan
            header("Location: ../pages/contact.php?status=error&message=Kesalahan saat mengirim pesan.");
            exit();
        }

        $stmt->close();
    } else {
        // Jika ada kolom yang tidak diisi
        header("Location: ../pages/contact.php?status=error&message=Semua kolom harus diisi!");
        exit();
    }
}

$conn->close();
?>