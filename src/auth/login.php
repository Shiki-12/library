<?php
require "../../global/koneksi.php";
// cek apakah sudah ada cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil data user berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('md5', $row['email'])) {
        $_SESSION['user'] = $row;
        header("location: ../../index.php");
    }
}

function set_remember_me_cookie($user)
{
    setcookie('id', $user['id_user'], time() + 360);
    setcookie('key', hash('md5', $user['email']), time() + 360);
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
    <title>Login Ke Perpustakaan Digital</title>
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
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login Perpustakaan Digital</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $username = $_POST['username'];
                                        $password = md5($_POST['password']);
                                        $email = $_POST['email'];
                                        $status = "approved";

                                        $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND email = '$email' AND status = '$status'");
                                        $cek = mysqli_num_rows($data);
                                        if ($cek > 0) {
                                            $data_user = mysqli_fetch_array($data);
                                            $_SESSION['login'] = 1;
                                            echo/*html*/ "<script>alert('Login Berhasil!')</script>";
                                            header("location: ../../index.php");
                                            if (isset($_POST['remember'])) {
                                                set_remember_me_cookie($data_user);
                                            }else{
                                                $_SESSION['user'] = $data_user;
                                            }
                                        } else {
                                            echo /*html*/"<script>alert('Username, Password, atau Email Salah!\\n Atau User belum di approved')</script>";
                                        }
                                    }
                                    ?>

                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Username" type="username"
                                                placeholder="Username" name="username" />
                                            <label for="Username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email"
                                                placeholder="name@example.com" name="email" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password"
                                                placeholder="Password" name="password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember
                                                Me</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="register.php" class="btn btn-primary">Butuh akun? Sign up!</a>
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