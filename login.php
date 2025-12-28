<?php
session_start();
include 'koneksi.php';

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT * FROM tengku_datausers WHERE email = '$email'";
$result = mysqli_query($koneksi, $query);

if(mysqli_num_rows($result) > 0) {
    $tengku_user = mysqli_fetch_assoc($result);

    if(password_verify($password, $tengku_user["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["email"] = $tengku_user["email"];
        header('location: dashboard.php');
    } else { 
        echo "<script>
            alert('Passwordnya Salah Mas');
            window.location='index.html';
        </script>";
    }
} else {
    echo "<script>
            alert('Emailnya Gada Mas');
            window.location='index.html';
        </script>";
}
?>

