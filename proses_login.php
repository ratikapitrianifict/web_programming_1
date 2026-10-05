<?php
/**
 * Backend Pemrosesan Login (proses_login.php)
 * Modul 5B - Web Programming 1
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
    header("Location: login.php?error=1");
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password_hash, nama_lengkap FROM users WHERE username = ? LIMIT 1");
if (!$stmt) {
    die("Gagal menyiapkan query: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user   = $result->fetch_assoc();

if ($user && password_verify($password, $user["password_hash"])) {
    // Regenerasi session ID untuk mencegah session fixation attack
    session_regenerate_id(true);

    $_SESSION["user_id"]      = $user["id"];
    $_SESSION["username"]     = $user["username"];
    $_SESSION["nama_lengkap"] = $user["nama_lengkap"];

    $stmt->close();
    $conn->close();

    header("Location: dashboard.php");
    exit;
}

$stmt->close();
$conn->close();

header("Location: login.php?error=1");
exit;
?>
