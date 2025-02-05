<?php
include('koneksi.php');

if (isset($_GET['id'])) {
    $id_peminjaman = $_GET['id'];
    $query = "UPDATE peminjaman SET status='dikembalikan' WHERE id_peminjaman='$id_peminjaman'";
    
    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Buku berhasil dikembalikan!'); window.location.href='buku.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}
?>
