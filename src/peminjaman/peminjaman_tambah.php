<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
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
            padding: 4rem;
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
            color: var(--text-primary);
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
        <h1>Peminjaman Buku</h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <?php
                            if (isset($_POST['simpan'])) {
                                $id_buku = $_POST['id_buku'];
                                $id_user = $_SESSION['user']['id_user'];
                                $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                                $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                                $status_peminjaman = "dipinjam";
                                // cek apakah buku tersedia

                                $buk = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
                                $buku = mysqli_fetch_array($buk);
                                if ($buku['jumlah'] < 1) {
                                    echo /*html*/ "
                                    <script>
                                        alert('Stok buku tidak mencukupi');
                                        location.href='?page=src/peminjaman/peminjaman_tambah';
                                    </script>";
                                } else {
                                    // kurangi buku yang tersedia
                                    $stok = $buku['jumlah'] - 1;
                                    mysqli_query($koneksi, "UPDATE buku SET jumlah = '$stok' WHERE id_buku = '$id_buku'");
                                    $query = mysqli_query($koneksi, "INSERT INTO peminjaman(id_user, id_buku, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES('$id_user','$id_buku','$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");
                                    if ($query) {
                                        echo /*html*/ "
                                        <script>
                                            alert('Data Berhasil Disimpan');
                                            location.href='?page=src/peminjaman/peminjaman';
                                        </script>";
                                    } else {
                                        echo /*html*/ "
                                        <script>
                                            alert('Data Gagal Disimpan');
                                            location.href='?page=src/peminjaman/peminjaman_tambah';
                                        </script>";
                                    }
                                }
                            }
                            ?>


                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="Buku">Buku</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="id_buku" id="Buku" class="form-control">
                                        <?php
                                        $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                                        while ($buku = mysqli_fetch_array($buk)) {
                                            echo /*html*/ "
                                            <option value='$buku[id_buku]'>
                                                $buku[judul]
                                            </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="tanggal">Tanggal Peminjaman</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="tanggal_peminjaman" id="tanggal" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="tanggalPengembalian">Tanggal Pengembalian</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="tanggal_pengembalian" id="tanggalPengembalian" class="form-control">
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
                                        Simpan</button>
                                    <a href="?page=src/peminjaman/peminjaman" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg"
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