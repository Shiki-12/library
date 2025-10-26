<?php
require "koneksi.php";


function register($userData)
{
    global $koneksi;
    $nama = htmlspecialchars($userData["nama"]);
    $username = htmlspecialchars($userData["username"]);
    $password = mysqli_real_escape_string($koneksi, $userData["password"]);
    $email = strtolower(stripslashes(htmlspecialchars($userData["email"])));
    $no_telepon = htmlspecialchars($userData["no_telepon"]);
    $alamat = htmlspecialchars($userData["alamat"]);
    $level = $userData["level"];
    $status = $userData["status"];
    $confirmPassword = mysqli_real_escape_string($koneksi, $userData["passwordConfirm"]);

    // Check if email already exists
    $existingUser = getUserByEmail($email);
    if (!$existingUser === null) {
        echo /*html*/ "
        <script>
            alert('Email sudah terdaftar');
        </script>
        ";
        return false;
    }

    // Check if password confirmation is correct
    if ($password !== $confirmPassword) {
        return false;
    }

    // Hash the password
    $hashedPassword = md5($password);

    // Insert the new user into the database
    $query = "INSERT INTO user (nama, username, password, email, alamat, no_telepon, level, status) VALUES ('$nama','$username', '$hashedPassword', '$email', '$alamat', '$no_telepon','$level','$status')";
    mysqli_query($koneksi, $query);



    return mysqli_affected_rows($koneksi);
}
// Retrieve a user by email
function getUserByEmail($email)
{
    global $koneksi;
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

// Upload gambar function
function uploadGambar($data): bool|string
{
    // Check if any image is uploaded

    $namaFile = $_FILES[(string) $data]["name"];
    $ukuranFile = $_FILES[(string) $data]["size"];
    $error = $_FILES[(string) $data]["error"];
    $tmpName = $_FILES[(string) $data]["tmp_name"];

    // Check if the uploaded file is an image
    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo /*html*/ "
        <script>
        alert('Pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo /*html*/ "
        <script>
        alert('The file you uploaded is not an image');
        alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // Check if the image size is greater than 1MB
    // cek jika ukuran file > 1mb
    if ($ukuranFile > 1000000) {
        echo /*html*/ "
        <script>
        alert('The image size is too large');
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    // Check if the image upload was successful
    if ($error !== UPLOAD_ERR_OK) {
        echo /*html*/ "
        <script>
        alert('Failed to upload the image');
        </script>";
        return false;
    }

    // Generate a new image name
    // lolos pengecekan gambar siap di upload
    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Move the uploaded image to the img folder
    if (!move_uploaded_file($tmpName, "global/assets/img/$namaFileBaru")) {
        echo /*html*/ "
        <script>
        alert('Failed to move the uploaded image');
        </script>";
        return false;
    }

    // pindahkan file ke folder img
    move_uploaded_file($tmpName, "global/assets/img/$namaFileBaru");
    return $namaFileBaru;
}

function uploadPDF($data){
    // Check if any pdf is uploaded

    $namaFile = $_FILES[(string) $data]["name"];
    $ukuranFile = $_FILES[(string) $data]["size"];
    $error = $_FILES[(string) $data]["error"];
    $tmpName = $_FILES[(string) $data]["tmp_name"];

    // Check if the uploaded file is an pdf
    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo /*html*/ "
        <script>
        alert('Pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ["pdf"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo /*html*/ "
        <script>
        alert('The file you uploaded is not a pdf');
        alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek jika ukuran file > 100mb
    if ($ukuranFile > 100000000) {
        echo /*html*/ "
        <script>
        alert('The pdf size is too large');
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    // Check if the pdf upload was successful
    if ($error !== UPLOAD_ERR_OK) {
        echo /*html*/ "
        <script>
        alert('Failed to upload the pdf');
        </script>";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Move the uploaded pdf to the pdf folder
    if (!move_uploaded_file($tmpName, "global/assets/pdf/$namaFileBaru")) {
        echo /*html*/ "
        <script>
        alert('Failed to move the uploaded pdf');
        </script>";
        return false;
    }

    // pindahkan file ke folder pdf
    move_uploaded_file($tmpName, "global/assets/pdf/$namaFileBaru");
    return $namaFileBaru;
}