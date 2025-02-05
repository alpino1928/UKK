<?php
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $sql = "DELETE FROM user WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        echo "anggota berhasil dihapus.";
        header("Location: anggota.php");
        exit();
    } else {
        echo "Gagal menghapus anggota: " . $conn->error;
    }
} else {
    echo "ID anggota tidak diberikan.";
    exit();
}

$conn->close();
?>
