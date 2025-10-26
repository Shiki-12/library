<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");

if ($query) {
    echo /*html*/ "
    <script>
    alert('Data Berhasil Dihapus');
    location.href='?page=src/user/user';
    </script>";
} else {
    echo /*html*/ "
    <script>
    alert('Data Gagal Dihapus');
    location.href='?page=src/user/user';
    </script>";
}
