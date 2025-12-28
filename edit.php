<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}
if (isset($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $query = mysqli_query($koneksi,"SELECT * FROM tengku_datausers WHERE idUser = '$idUser'");
    $tengkuData = mysqli_fetch_assoc($query);

    if (!$tengkuData){
        header('location: dataUser.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUser = $_POST['idUser'];
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE tengku_datausers SET nama = '$nama', username = '$username', email = '$email', password = '$password' WHERE idUser = '$idUser'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Data User Berhasil diubah');
        window.location='dataUser.php';
        </script>";
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
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
    <link rel="stylesheet" href="css/style.css">
    <title>Edit User</title>
</head>
<body>
    <div class="card">
        <div class="top">
        <div class="btnExit">
            <a href="dataUser.php"><img src="img/backarrow.png" alt="tombol"></a>
        </div>
        <h1>EDIT USER</h1>
        </div>
    <form action="edit.php?idUser=<?php echo $tengkuData['idUser']?>" method='POST'>
        <input type="hidden" name="idUser" value="<?php echo $tengkuData['idUser'];?>">
        <input type="text" name="nama" value="<?php echo $tengkuData['nama']?>" required>
        <input type="text" name="username" value="<?php echo $tengkuData['username']?>" required>
        <input type="text" name="email" value="<?php echo $tengkuData['email']?>" required>
        <input type="text" name="password" value="<?php echo $tengkuData['password']?>" required>
        <button type="submit"><p>Update</p></button>
    </form>
    </div>
</body>
</html>