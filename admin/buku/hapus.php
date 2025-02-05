<?php
include 'koneksi.php';

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Query hapus buku
    $sql = "DELETE FROM buku WHERE id_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_buku);

    if ($stmt->execute()) {
        echo "Buku berhasil dihapus.";
        header("Location: buku.php");
        exit();
    } else {
        echo "Gagal menghapus buku: " . $conn->error;
    }
} else {
    echo "ID buku tidak diberikan.";
    exit();
}

$conn->close();
?>
