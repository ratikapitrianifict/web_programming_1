<?php
/**
 * Backend Pemroses Tambah Mahasiswa (proses_tambah.php)
 * Modul 4B & 5B - Web Programming 1
 */

require_once "auth.php";
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_mahasiswa.php");
    exit;
}

$nim           = trim($_POST["nim"] ?? "");
$nama          = trim($_POST["nama"] ?? "");
$program_studi = trim($_POST["program_studi"] ?? "");
$email         = trim($_POST["email"] ?? "");

if ($nim === "" || $nama === "" || $program_studi === "" || $email === "") {
    die("Semua field wajib diisi. Silakan kembali ke form.");
}

$stmt = $conn->prepare(
    "INSERT INTO mahasiswa (nim, nama, program_studi, email) VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
    die("Gagal menyiapkan query: " . $conn->error);
}

$stmt->bind_param(
    "ssss",
    $nim,
    $nama,
    $program_studi,
    $email
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: data_mahasiswa.php?status=sukses");
    exit;
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
    $stmt->close();
    $conn->close();
}
?>
