<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 50px 20px;
        }
        h1 {
            color: #007bff;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #000;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            margin: 10px;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #007bff;
        }
        .image-container {
            margin: 20px 0;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PERPUSTAKAAN DIGITAL</h1>
        <div class="image-container">
            <img src="img/book.png" alt="Perpustakaan Digital">
        </div>
        <a href="admin/login.php" class="btn">ADMIN</a>
        <a href="petugas/login.php" class="btn">PETUGAS</a>
        <a href="anggota/login.php" class="btn">ANGGOTA</a>
        <a href="register.php" class="btn">REGISTER</a>
    </div>
</body>
</html>
