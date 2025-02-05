<?php
include 'koneksi.php'; 

// Modifikasi query untuk mengambil data cover
$sql = "SELECT id_buku, judul, penulis, penerbit, tahun_terbit, cover FROM buku"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Daftar Buku</h2>
    <a href="../dashboard.php">Kembali ke dashboard</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Cover</th> <!-- Tambahkan kolom Cover -->
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td>
                <!-- Menampilkan gambar cover -->
                <?php if ($row['cover']) { ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['cover']); ?>" alt="Cover Buku" width="100">
                <?php } else { ?>
                    <p>Tidak ada gambar</p>
                <?php } ?>
            </td>
            <td><?php echo htmlspecialchars($row['judul']); ?></td>
            <td><?php echo htmlspecialchars($row['penulis']); ?></td>
            <td><?php echo htmlspecialchars($row['penerbit']); ?></td>
            <td><?php echo htmlspecialchars($row['tahun_terbit']); ?></td>
            <td>
                <a href="edit.php?id_buku=<?php echo $row['id_buku']; ?>">Edit</a> |
                <a href="hapus.php?id_buku=<?php echo $row['id_buku']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <!-- Link to 'tambah.php' to add a new book -->
    <a href="tambah.php">Tambah Buku</a>
</body>
</html>

<?php
$conn->close();
?>
