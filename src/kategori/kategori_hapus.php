<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id'");

if ($query) {
    echo /*html*/ "
    <script>
    alert('Data Berhasil Dihapus');
    location.href='?page=src/kategori/kategori';
    </script>";
} else {
    echo /*html*/ "
    <script>
    alert('Data Gagal Dihapus');
    location.href='?page=src/kategori/kategori';
    </script>";
}