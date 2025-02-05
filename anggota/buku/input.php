<?php
include('koneksi.php'); // Pastikan file koneksi ada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_peminjaman = date("Y-m-d");
    $tanggal_pengembalian = date("Y-m-d", strtotime("+7 days"));
    
    // Query INSERT untuk menambahkan peminjaman
    $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_peminjaman, tanggal_pengembalian, status) 
              VALUES ('$id_user', '$id_buku', '$tanggal_peminjaman', '$tanggal_pengembalian', 'dipinjam')";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Peminjaman berhasil!'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Error: " . $koneksi->error . "');</script>";
    }
}
?>
