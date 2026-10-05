<?php
/**
 * Halaman Dashboard Utama (dashboard.php)
 * Modul 5B - Web Programming 1
 */

require_once "auth.php";
require_once "koneksi.php";

// Ambil statistik jumlah mahasiswa untuk ringkasan di dashboard
$total_mhs = 0;
$query_count = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
if ($query_count) {
    $row_count = $query_count->fetch_assoc();
    $total_mhs = $row_count['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Web Programming 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Dashboard Application Lab</h1>
        <p>Tugas Praktik Web Programming 1 - Authentication &amp; Session</p>
    </header>

    <nav>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="data_mahasiswa.php">Data Mahasiswa</a>
        <a href="form_mahasiswa.php">Tambah Mahasiswa</a>
        <a href="index.html">Biodata Publik</a>
        <a href="logout.php" class="nav-logout">Logout (<?= htmlspecialchars($_SESSION["username"]); ?>)</a>
    </nav>

    <main>
        <section class="card">
            <h2>Selamat Datang</h2>
            <p style="font-size: 1.1rem; line-height: 1.6;">
                Halo, <strong><?= htmlspecialchars($_SESSION["nama_lengkap"]); ?></strong>!
            </p>
            <div class="message sukses" style="margin-top: 14px;">
                &check; Anda sudah berhasil melewati proses <strong>Authentication</strong> dan session Anda saat ini aktif.
            </div>
            <p>
                Halaman ini dilindungi secara ketat oleh <code>auth.php</code>. Pengguna yang belum login atau belum memiliki session yang valid tidak akan dapat mengakses halaman ini maupun data mahasiswa.
            </p>
        </section>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; margin-bottom: 20px;">
            <div class="card" style="margin-bottom: 0;">
                <h3 style="margin-top: 0; color: #1f4e79;">Data Mahasiswa</h3>
                <p style="font-size: 2rem; font-weight: bold; margin: 8px 0; color: #1f4e79;">
                    <?= $total_mhs; ?> <span style="font-size: 1rem; font-weight: normal; color: #64748b;">Record</span>
                </p>
                <p style="color: #64748b; font-size: 0.9rem;">
                    Data terhubung dengan MySQL database <code>web_programming_1</code>.
                </p>
                <a href="data_mahasiswa.php" style="display: inline-block; margin-top: 8px; color: #1f4e79; font-weight: 600; text-decoration: none;">
                    Buka Data Mahasiswa &raquo;
                </a>
            </div>

            <div class="card" style="margin-bottom: 0;">
                <h3 style="margin-top: 0; color: #1f4e79;">Informasi Akun</h3>
                <p style="margin: 6px 0;"><strong>Username:</strong> <?= htmlspecialchars($_SESSION["username"]); ?></p>
                <p style="margin: 6px 0;"><strong>Nama:</strong> <?= htmlspecialchars($_SESSION["nama_lengkap"]); ?></p>
                <p style="margin: 6px 0;"><strong>Status:</strong> <span style="color: #16a34a; font-weight: bold;">Logged In</span></p>
                <a href="logout.php" style="display: inline-block; margin-top: 8px; color: #dc2626; font-weight: 600; text-decoration: none;">
                    Keluar / Logout &raquo;
                </a>
            </div>
        </div>

        <section class="card">
            <h3>Navigasi Cepat Aplikasi</h3>
            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 12px;">
                <a href="data_mahasiswa.php" class="btn-action">&bull; Lihat Daftar Mahasiswa (Modul 3B/4B)</a>
                <a href="form_mahasiswa.php" class="btn-action">&bull; Input Mahasiswa Baru (Modul 4B)</a>
                <a href="logout.php" class="btn-action btn-danger">&bull; Akhiri Sesi (Logout)</a>
            </div>
        </section>
    </main>

    <footer>
        <p>Copyright &copy; 2026 - Web Programming 1</p>
    </footer>

</body>
</html>
<?php
$conn->close();
?>
