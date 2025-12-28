<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: index.html");
    exit;
}

    $email = $_SESSION['email'];
    $query = "SELECT * FROM tengku_datausers WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $tengkuData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon website" href="img/icon.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="nav">
        <div class="btn">
        <h1><?php echo $tengkuData['username']?></h1>
        <a href="dashboard.php" class='active'>Dashboard</a>
        <a href="dataUser.php">Data User</a>
        <a href="tambah.php">Tambah User</a>
        </div>
        <div class="btn-logout">
           <button><a href="logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar?')"><p>Logout</p></a></button>
        </div>    
    </div>
    <div class="main">
        <h1>Selamat Datang, <?php echo $tengkuData['username']; ?>👻</h1>
        <p>Ini Adalah Halaman Dashboard</p>
    </div>
    <img class='gif' src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExd2l3ZTBlcWpiNGUycGRzZTZwd2RsMDduaWo0aGlqdGpidXZ4d3FkdSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/eoVusT7Pi9ODe/giphy.gif" alt="">
</body>
</html>