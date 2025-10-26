<?php
session_start();
global $koneksi;
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");