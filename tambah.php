<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM tengku_datausers WHERE email = '$email'";
$result2 = mysqli_query($koneksi, $query);
$tengkuData = mysqli_fetch_assoc($result2);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = htmlspecialchars($_POST["nama"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query =" INSERT INTO tengku_datausers (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$password')";

    if(mysqli_query($koneksi, $query)){
        echo "<script>
            alert('Data User Berhasil Ditambahkan.');
            window.location='dataUser.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon website" href="img/icon.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Tambah User</title>
</head>
<body>
<div class="main-container">
    <div class="nav">
        <div class="btn">
        <h1><?php echo $tengkuData['username']?></h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="dataUser.php">Data User</a>
        <a href="tambah.php" class='active'>Tambah User</a>
        </div>
        <div class="btn-logout">
           <button><a href="logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar?')"><p>Logout</p></a></button>
        </div>    
    </div>
    <div class="form-container">
        <form action="tambah.php" method="post">
            <h2>TAMBAH USER</h2>
            <input type="text" name="nama" placeholder='Nama' autocomplete='off' required>
            <input type="text" name="username" placeholder='Username' autocomplete='off' required>
            <input type="email" name="email" placeholder='Email' autocomplete='off' required>
            <input type="password" name="password" placeholder='Password' autocomplete='off' required>
            <button type="submit" class='btn-tambah'><a>Tambah</a></button>
        </form>
    </div>
</div>
</body>
</html>