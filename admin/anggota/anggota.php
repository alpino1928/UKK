<?php
include 'koneksi.php'; 

$sql = "SELECT id_user, username, email, nama_lengkap, alamat FROM user"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Daftar User</h2>
    <a href="../dashboard.php">Kembali ke dashboard</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>username</th>
            <th>emial</th>
            <th>nama</th>
            <th>alamat</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td>
                <a href="edit.php?id_user=<?php echo $row['id_user']; ?>">Edit</a> |
                <a href="hapus.php?id_user=<?php echo $row['id_user']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="tambah.php">Tambah User</a>
</body>
</html>

<?php
$conn->close();
?>
