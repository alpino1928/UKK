<?php
include('koneksi.php'); // Pastikan file koneksi database sudah benar

// Ambil data peminjaman dari database
$peminjaman = $koneksi->query("SELECT p.id_peminjaman, u.nama_lengkap, b.judul, p.tanggal_peminjaman, p.tanggal_pengembalian, p.status
                               FROM peminjaman p
                               JOIN user u ON p.id_user = u.id_user
                               JOIN buku b ON p.id_buku = b.id_buku");

// Proses pengembalian buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peminjaman = $_POST['id_peminjaman'];
    $tanggal_pengembalian = date("Y-m-d");

    // Update status menjadi 'dikembalikan'
    $query = "UPDATE peminjaman SET status='dikembalikan', tanggal_pengembalian='$tanggal_pengembalian' 
              WHERE id_peminjaman='$id_peminjaman'";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Buku berhasil dikembalikan!'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <a href="../dashboard.php">kembali ke dashboard</a>
        <h2 class="text-center text-success">Daftar Peminjaman Buku</h2>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $peminjaman->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama_lengkap']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['tanggal_peminjaman']; ?></td>
                        <td><?= $row['tanggal_pengembalian']; ?></td>
                        <td>
                            <?php if ($row['status'] == "dipinjam") { ?>
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            <?php } else { ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == "dipinjam") { ?>
                                <form method="POST">
                                    <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman']; ?>">
                                    <button type="submit" class="btn btn-warning">Kembalikan</button>
                                </form>
                            <?php } else { ?>
                                <button class="btn btn-secondary" disabled>Sudah Dikembalikan</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
