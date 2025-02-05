<?php
include('koneksi.php'); // Pastikan file koneksi sudah benar

// Ambil data anggota dan buku dari database
$user = $koneksi->query("SELECT id_user, nama_lengkap FROM user");
$buku = $koneksi->query("SELECT id_buku, judul FROM buku");

// Proses peminjaman buku jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_peminjaman = date("Y-m-d");
    $tanggal_pengembalian = date("Y-m-d", strtotime("+7 days"));

    $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_peminjaman, tanggal_pengembalian, status) 
              VALUES ('$id_user', '$id_buku', '$tanggal_peminjaman', '$tanggal_pengembalian', 'dipinjam')";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Peminjaman berhasil!'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <a href="../dashboard.php">kembali kedashboard</a>
        <h2 class="text-center text-primary">Form Peminjaman Buku</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Pilih Anggota</label>
                <select name="id_user" class="form-control" required>
                    <option value="">Pilih Anggota</option>
                    <?php while ($row = $user->fetch_assoc()) { ?>
                        <option value="<?= $row['id_user']; ?>"><?= $row['nama_lengkap']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="">Pilih Buku</option>
                    <?php while ($row = $buku->fetch_assoc()) { ?>
                        <option value="<?= $row['id_buku']; ?>"><?= $row['judul']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Pinjam</button>
        </form>
    </div>
</body>
</html>
