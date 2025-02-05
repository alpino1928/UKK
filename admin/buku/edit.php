<?php
include 'koneksi.php';

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];
    
    $sql = "SELECT * FROM buku WHERE id_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    $buku = $result->fetch_assoc();

    if (!$buku) {
        die("Buku tidak ditemukan.");
    }
} else {
    die("ID buku tidak diberikan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $cover = $buku['cover']; // Default cover is the existing one

    // Check if a new cover image is uploaded
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if the file is a valid image
        $check = getimagesize($_FILES["cover"]["tmp_name"]);
        if ($check === false) {
            echo "File yang diupload bukan gambar.";
            exit();
        }
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover = $target_file; // Update cover path
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
            exit();
        }
    }

    $sql = "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, cover=? WHERE id_buku=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $judul, $penulis, $penerbit, $tahun_terbit, $cover, $id_buku);
    
    if ($stmt->execute()) {
        header("Location: buku.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        /* Body and general styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Image section styles */
        .cover-section {
            margin-top: 20px;
            text-align: center;
        }

        .cover-section img {
            max-width: 200px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Buku</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Judul:</label>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>
            
            <label>Penulis:</label>
            <input type="text" name="penulis" value="<?php echo htmlspecialchars($buku['penulis']); ?>" required>

            <label>Penerbit:</label>
            <input type="text" name="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>" required>
            
            <label>Tahun Terbit:</label>
            <input type="number" name="tahun_terbit" value="<?php echo htmlspecialchars($buku['tahun_terbit']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        
        <a href="buku.php">Kembali</a>
    </div>

</body>
</html>
