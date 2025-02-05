<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #007bff;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: rgb(0, 2, 3);
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(30, 30, 30);
        }
    </style>
</head>
<body>
    <h2>Halaman Registrasi</h2>
    <input type="text" id="fullname" placeholder="Masukkan Nama Lengkap">
    <input type="email" id="email" placeholder="Masukkan Email">
    <input type="text" id="username" placeholder="Masukkan Username">
    <input type="password" id="password" placeholder="Masukkan Password">
    <input type="text" id="address" placeholder="Masukkan Alamat">
    <button onclick="register()">Daftar</button>
    <a href="login.php">Login?</a> 

    <script>
        function register() {
            let fullname = document.getElementById("fullname").value;
            let email = document.getElementById("email").value;
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let address = document.getElementById("address").value;

            if (fullname === "" || email === "" || username === "" || password === "" || address === "") {
                alert("Semua field harus diisi!");
                return;
            }

            localStorage.setItem("fullname", fullname);
            localStorage.setItem("email", email);
            localStorage.setItem("username", username);
            localStorage.setItem("password", btoa(password)); 
            localStorage.setItem("address", address);

            alert("Registrasi berhasil! Silakan login.");
            window.location.href = "login.php"; 
        }
    </script>
</body>
</html>
