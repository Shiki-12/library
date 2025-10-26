<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600&family=Garamond&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-bg: #121212;
            --dark-surface: #1E1E1E;
            --dark-hover: #2D2D2D;
            --text-primary: #FFFFFF;
            --text-secondary: #B3B3B3;
            --accent-grey: #808080;
        }

        body {
            background-color: var(--dark-bg);
            font-family: 'Crimson Text', serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            background: var(--dark-surface);
            padding: 1rem 0;
            border-bottom: 1px solid var(--accent-grey);
            margin: 0;
        }

        .page-header h1 {
            color: var(--text-primary);
            font-family: 'Crimson Text', serif;
            font-size: 2.5rem;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            background-color: var(--dark-bg);
            padding: 1.5rem;
            flex: 1;
        }

        .card {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
            color: var(--text-primary);
        }

        .form-control, select.form-control {
            background: var(--dark-hover);
            border: 1px solid var(--accent-grey);
            color: var(--text-primary);
            padding: 0.5rem;
            border-radius: 4px;
        }

        .form-control:focus {
            background: var(--dark-surface);
            border-color: var(--text-primary);
            color: var (--text-primary);
            box-shadow: none;
        }

        select.form-control option {
            background-color: var(--dark-surface);
            color: var(--text-primary);
        }

        label {
            color: var(--text-primary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        textarea {
            background: var(--dark-hover) !important;
            border: 1px solid var(--accent-grey) !important;
            color: var(--text-primary) !important;
            padding: 0.5rem;
            border-radius: 4px;
            min-height: 120px;
            width: 100%;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }

        .btn-primary, .btn-danger {
            background: var(--dark-surface);
            border-color: var(--accent-grey);
            color: var(--text-primary);
        }

        .btn:hover {
            transform: scale(1.05);
            background: var(--dark-hover);
        }

        /* Remove <br> tags */
        br {
            display: none;
        }

        .row {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Ubah User</h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <?php
                            $id = $_GET['id'];
                            if (isset($_POST['simpan'])) {
                                $nama = $_POST['nama'];
                                $username = $_POST['username'];
                                $email = $_POST['email'];
                                $no_telepon = $_POST['no_telepon'];
                                $level = $_POST['level'];
                                $status = $_POST['status'];
                                $query = mysqli_query($koneksi, "UPDATE user SET 
                                nama = '$nama',
                                username = '$username',
                                email = '$email',
                                no_telepon = '$no_telepon',
                                level = '$level',
                                status = '$status'
                                WHERE id_user = '$id'
                                ");
                                if ($query) {
                                    echo /*html*/ "
                                    <script>
                                        alert('Data Berhasil Diubah');
                                        location.href='?page=src/user/user';
                                    </script>";
                                } else {
                                    echo /*html*/ "
                                    <script>
                                        alert('Data Gagal Diubah');
                                        location.href='?page=src/user/user_ubah';
                                    </script>";
                                }
                            }
                            $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
                            $data = mysqli_fetch_array($query);
                            ?>


                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="Namakategori">Nama</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="nama" id="judul" class="form-control"
                                        value="<?= $data['nama'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="username">Username</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="username" id="username" class="form-control"
                                        value="<?= $data['username'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="<?= $data['email'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="alamat" id="alamat"><?= $data['alamat'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="no_telepon">Nomor Telfon</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                        value="<?= $data['no_telepon'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="level">Posisi</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="level" id="level" class="form-control">
                                        <option value="admin" <?php if ($data['level'] == 'admin') echo "selected"?>
                                        >Admin</option>
                                        <option value="petugas" <?php if ($data['level'] == 'petugas') echo "selected"?>>Petugas</option>
                                        <option value="peminjam" <?php if ($data['level'] == 'peminjam') echo "selected"?>>Peminjam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Pending" <?php if ($data['status'] == 'pending') echo "selected"?>>Pending</option>
                                        <option value="Approved" <?php if ($data['status'] == 'approved') echo "selected"?>>Approved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-9">
                                    <button type="submit" name="simpan" class="btn btn-primary" value="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-save" viewBox="0 0 16 16">
                                            <path
                                                d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z" />
                                        </svg>
                                        Ubah</button>
                                    <a href="?page=src/user/user" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-backspace"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                                            <path
                                                d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                        </svg>Kembali</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>