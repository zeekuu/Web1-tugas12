<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

$result = mysqli_query(mysql: $koneksi, query: "SELECT * FROM tengku_datausers");

$email = $_SESSION['email'];
$query = "SELECT * FROM tengku_datausers WHERE email = '$email'";
$result2 = mysqli_query($koneksi, $query);
$tengkuData = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon website" href="img/icon.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Data User</title>
</head>
<body>
    <div class="main-container">
    <div class="nav">
        <div class="btn">
        <h1><?php echo $tengkuData['username']?></h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="dataUser.php" class='active'>Data User</a>
        <a href="tambah.php">Tambah User</a>
        </div>
        <div class="btn-logout">
           <button><a href="logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar?')"><p>Logout</p></a></button>
        </div>  
    </div>
    <div class="table">
        <table class="user-table">
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
                if(mysqli_num_rows($result) > 0) {
                    while($tengku_data = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $tengku_data["nama"]; ?></td>
                <td><?php echo $tengku_data["username"]; ?></td>
                <td><?php echo $tengku_data["email"]; ?></td>
                <td>******</td>
                <td><button class='btn-edit'><a href="edit.php?idUser=<?php echo $tengku_data['idUser']; ?>">Edit</a></button> |
                    <button class='btn-delete'><a href="hapus.php?idUser=<?php echo $tengku_data['idUser'];?>" onclick='return confirm("apakah anda yakin hapus data");'>Delete</a></button>
            
            </td>
            </tr>
            <?php
                }
            }else{
            ?>
            <tr align="center">
                <td colspan="6">Belum Ada Data User</td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    </div>
</body>
</html>