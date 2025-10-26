<?php
// require '../../global/koneksi.php';
require '../../global/function.php';
// jika tombol registrasi ditekan
if (isset($_POST['register'])) {
    switch ($_POST['level']) {
        case 'peminjam':
            $_POST['status'] = 'approved';
            break;
        default:
            $_POST['level'] = 'pending';
            break;
    }
    if (register($_POST) > 0) {
        $_SESSION['register'] = true;
        echo"
        <script>
        alert('user baru berhasil ditambahkan!');
        document.location.href = 'login.php';
        </script>";
    } else {
        echo "
        <script>
        alert('user gagal ditambahkan!');
        document.location.href = 'register.php';
        </script>";
    }
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
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('../../global/assets/img/library-1834222_1280.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Georgia', serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #8B4513;
            border-color: #8B4513;
            transition: transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #A0522D;
            border-color: #A0522D;
            transform: scale(1.05);
        }
        .form-control {
            border-radius: 5px;
        }
        .form-check-label {
            font-family: 'Georgia', serif;
        }
    </style>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputFirstName" type="text"
                                                placeholder="Enter your name" name="nama" required />
                                            <label for="inputFirstName">Nama</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputFirstName" type="text"
                                                placeholder="Enter your username" name="username" required />
                                            <label for="inputFirstName">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputFirstName" type="tel"
                                                placeholder="Enter your phone number" name="no_telepon" required />
                                            <label for="inputFirstName">Phone Number</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="inputFirstName"
                                                placeholder="Enter your address" name="alamat" rows="5"
                                                required></textarea>
                                            <label for="inputFirstName">Address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email"
                                                placeholder="name@example.com" name="email" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password"
                                                        placeholder="Create a password" name="password" required />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm"
                                                        type="password" placeholder="Confirm password"
                                                        name="passwordConfirm" required />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select name="level" id="inputLevel" class="form-select">
                                                <option value="peminjam">Peminjam</option>
                                                <option value="petugas">Petugas</option>
                                            </select>
                                            <label for="inputEmail">Login as </label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <button type="submit" name="register"
                                                class="btn btn-primary btn-block">Registrasi!</button>
                                        </div>
                                        <input type="hidden" name="status" value="pending">
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="login.php" class="btn btn-primary">Sudah punya akun? Pergi ke login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 mt-auto" style="background-color: rgba(0, 0, 0, 0.5);">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Perpustakaan Digital 2024</div>
                        <div>
                            <a href="#" class="btn btn-primary btn-sm">Privacy Policy</a>
                            &middot;
                            <a href="#" class="btn btn-primary btn-sm">Terms &amp; Conditions</a>
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