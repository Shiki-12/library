<?php
require 'global/function.php';
// cek apakah user sudah register



// jika tombol registrasi ditekan
if (isset($_POST['lanjutRegistrasi'])) {
//     if (register($_POST) > 0) {
$_SESSION['register'] = true;
switch ($_POST['level']) {
    case 'peminjam':
        header("location: registerPeminjam.php");
        break;

    case 'petugas':
        header("location: registerPetugas.php");
        break;

    default:
        header("location: login.php");
        break;
}
//     }
} else {
    echo /*html*/ "
        <script>
        alert('user gagal ditambahkan!');
        document.location.href = 'login.php';
        </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register Perpustakaan Digital</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Ingin login sebagai ?</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating">
                                            <select name="level" id="select" class="form-control" required>
                                                <option value="petugas">Petugas</option>
                                                <option value="peminjam">Peminjam</option>
                                            </select>
                                            <label for="select" class="small mb-1">level</label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <button type="submit" name="lanjutRegistrasi"
                                                class="btn btn-primary btn-block">Lanjut Registrasi!</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <br><br><br>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>