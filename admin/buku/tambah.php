<?php
// Masukkan file koneksi
include 'koneksi.php';

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // Proses upload file cover
    $cover = $_FILES['cover'];
    $cover_name = $cover['name'];
    $cover_tmp = $cover['tmp_name'];
    $cover_size = $cover['size'];

    // Cek ekstensi file dan ukuran file
    $valid_extensions = array("jpg", "jpeg", "png");
    $file_extension = strtolower(pathinfo($cover_name, PATHINFO_EXTENSION));

    if (in_array($file_extension, $valid_extensions) && $cover_size < 2000000) {
        $cover_new_name = uniqid() . "." . $file_extension;
        $upload_dir = "uploads/" . $cover_new_name;

        // Pindahkan file cover ke folder 'uploads'
        move_uploaded_file($cover_tmp, $upload_dir);

        // Query untuk menyimpan data buku ke database
        $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, cover) 
                VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$cover_new_name')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Buku berhasil ditambahkan!'); window.location.href='buku.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('File cover tidak valid. Pastikan file gambar dengan ukuran kurang dari 2MB.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #007bff;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Buku</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input name="judul" type="text" placeholder="Masukkan judul" required>
            <input name="penulis" type="text" placeholder="Masukkan penulis" required>
            <input name="penerbit" type="text" placeholder="Masukkan penerbit" required>
            <input name="tahun_terbit" type="date" required>
            <input name="cover" type="file" required>
            
            <button type="submit" name="submit">Tambah Buku</button>
            <a href="buku.php">Kembali</a>
        </form>
    </div>
</body>
</html>
