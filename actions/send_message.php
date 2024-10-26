<?php
session_start();
include '../WebsiteSekolah_DCT/includes/db_connect.php'; // Pastikan Anda menyertakan koneksi database

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
            echo "Pesan Anda telah dikirim!";
        } else {
            echo "Terjadi kesalahan saat mengirim pesan.";
        }

        $stmt->close();
    } else {
        echo "Semua kolom harus diisi!";
    }
}

$conn->close();
?>