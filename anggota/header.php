<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Saya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Selamat Datang di Perpustakaan Digital</h1>
        <nav>
            <ul>
            <img src="../img/logo.png" alt="Logo" style="max-width: 100px;">
                <li><a href="buku/buku.php">Peminjaman</a></li>
                <li><a href="buku/peminjaman.php">Riwayat</a></li>
                <li><a href="../index.php">Logout</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <?php else: ?>      
                    <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
