<?php
/**
 * File Keamanan Session Guard (auth.php)
 * Modul 5B - Web Programming 1
 * Diletakkan di baris paling atas pada setiap halaman yang membutuhkan login.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah session user_id sudah ada
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?pesan=belum_login");
    exit;
}
?>
