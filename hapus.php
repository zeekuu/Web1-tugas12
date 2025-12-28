<?php
include 'koneksi.php';

if (isset($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $query = "DELETE FROM tengku_datausers WHERE idUser = '$idUser'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data user berhasil dihapus.');
            window.location='dataUser.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>