<?php
$id = $_GET['id'];
$peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman = '$id'");
$pinjaman = mysqli_fetch_array($peminjaman);
$id_buku = $pinjaman['id_buku'];
$buk = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
$buku = mysqli_fetch_array($buk);
$jumlah = $buku['jumlah'] + 1;
$tanggal = date("Y-m-d");


$query = mysqli_query($koneksi, "UPDATE buku SET jumlah = $jumlah WHERE id_buku = '$id_buku'");

$query = mysqli_query($koneksi, "UPDATE peminjaman SET 
status_peminjaman = 'dikembalikan',
tanggal_pengembalian = '$tanggal'
WHERE id_peminjaman = '$id'");

if ($query) {
    echo /*html*/ "
    <script>
        alert('Buku berhasil dikembalikan');
        location.href='?page=src/peminjaman/peminjaman';
    </script>";
} else {
    echo /*html*/ "
    <script>
        alert('Buku gagal dikembalikan');
        location.href='?page=src/peminjaman/peminjaman';
    </script>";
}