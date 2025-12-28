<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$cekDuplikasi = mysqli_query($koneksi, "SELECT * FROM tengku_datausers WHERE email = '$email' OR username = '$username'");
if(mysqli_num_rows($cekDuplikasi) > 0){
    $data = mysqli_fetch_array($cekDuplikasi);

    if($data['username'] == $username){
        echo  "<script>
            alert('Username nya Udah Ada Mas');
            history.back();
        </script>";
    } else {
        echo "<script>
            alert('Emailnya Udah Ada Mas');
            history.back();
        </script>";
    }
} else {
    $query = "INSERT INTO tengku_datausers (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$password')";

    $result =  mysqli_query($koneksi, $query);
    if($result){
        echo "<script>
            alert('Registrasi Berhasil');
            window.location='index.html';
        </script>";
    } else {
        echo "register gagal " . mysqli_error($koneksi);
    }
}
?>