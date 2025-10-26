<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_ulasan = '$id'");

if ($query) {
    echo /*html*/ "
    <script>
    alert('Data Berhasil Dihapus');
    location.href='?page=src/ulasan/ulasan';
    </script>";
} else {
    echo /*html*/ "
    <script>
    alert('Data Gagal Dihapus');
    location.href='?page=src/ulasan/ulasan';
    </script>";
}