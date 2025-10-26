<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id'");

if ($query) {
    echo /*html*/ "
    <script>
    alert('Data Berhasil Dihapus');
    location.href='?page=src/buku/buku';
    </script>";
} else {
    echo /*html*/ "
    <script>
    alert('Data Gagal Dihapus');
    location.href='?page=src/buku/buku';
    </script>";
}