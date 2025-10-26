<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Buku</title>
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
        }

        .page-header {
            background: var(--dark-surface);
            padding: 1.5rem 0;
            margin: 0;
            border-bottom: 1px solid var(--accent-grey);
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
            padding: 2rem;
            margin: 0;
        }

        .card {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .card-body {
            padding: 2rem;
            color: var(--text-primary);
        }

        label {
            color: var(--text-primary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: var(--dark-hover);
            border: 1px solid var(--accent-grey);
            color: var(--text-primary);
            padding: 0.5rem;
            border-radius: 4px;
        }

        .form-control:focus {
            background: var(--dark-surface);
            border-color: var (--text-primary);
            color: var(--text-primary);
            box-shadow: none;
        }

        select.form-control {
            background-color: var(--dark-hover);
            color: var(--text-primary);
        }

        select.form-control option {
            background-color: var(--dark-surface);
            color: var(--text-primary);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }

        .btn-primary,
        .btn-danger {
            background: var(--dark-surface);
            border-color: var(--accent-grey);
            color: var(--text-primary);
        }

        .btn:hover {
            transform: scale(1.05);
            background: var(--dark-hover);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Fix file input appearance */
        input[type="file"].form-control {
            padding: 0.375rem 0.75rem;
        }

        /* Remove <br> tags spacing */
        br {
            display: none;
        }

        .row {
            margin-bottom: 1.5rem;
        }

        img {
            border-radius: 4px;
            border: 1px solid var(--accent-grey);
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Ubah Buku</h1>
    </div>

    <div class="container-fluid">
        <?php
        $id = $_GET['id'];

        // First, fetch the book data before using it
        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
        $data = mysqli_fetch_array($query);

        // Check if data is found, else handle the error
        if (!$data) {
            echo "<script>alert('Data not found'); location.href='?page=buku';</script>";
            exit;
        }
        ?>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" enctype="multipart/form-data">

                            <!-- Kategori -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="Namakategori">Kategori</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="id_kategori" id="Namakategori" class="form-control">
                                        <?php
                                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                                        while ($kategori = mysqli_fetch_array($kat)) {
                                        ?>
                                            <option
                                                <?php if ($kategori['id_kategori'] == $data['id_kategori']) echo "selected"; ?>
                                                value='<?= $kategori['id_kategori'] ?>'>
                                                <?= $kategori['kategori'] ?>
                                            </option>";
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Judul -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="judul">Judul</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="judul" id="judul" class="form-control"
                                        value="<?= $data['judul'] ?>">
                                </div>
                            </div>

                            <!-- Penulis -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="penulis">Penulis</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="author" id="penulis" class="form-control"
                                        value="<?= $data['penulis'] ?>">
                                </div>
                            </div>

                            <!-- Penerbit -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="penerbit">Penerbit</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="penerbit" id="penerbit" class="form-control"
                                        value="<?= $data['penerbit'] ?>">
                                </div>
                            </div>

                            <!-- Tahun Terbit -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="tahunTerbit">Tahun Terbit</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="tahun_terbit" id="tahunTerbit" class="form-control"
                                        value="<?= $data['tahun_terbit'] ?>">
                                </div>
                            </div>

                            <!-- Jumlah -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="jumlah">Jumlah</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                                        value="<?= $data['jumlah'] ?>">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="deskripsi">Deskripsi</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="deskripsi" id="deskripsi" rows="5"
                                        class="form-control"><?= $data['deskripsi'] ?></textarea>
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="gambar">Gambar</label>
                                </div>
                                <div class="col-md-9">
                                    <img src="global/assets/img/<?= $data['gambar'] ?>" alt="Gambar Buku" width="100px" height="auto">
                                    <input type="file" accept=".jpg, .png, .jpeg" name="gambar" id="gambar" class="form-control">
                                    <input type="hidden" name="old_gambar" value="<?= $data['gambar'] ?>">
                                </div>
                            </div>

                            <!-- file pdf -->
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="pdf">File Buku</label>
                                </div>
                                <div class="col-md-9">
                                    <a href="global/download.php?file=<?= $data['file_buku'] ?>">Download PDF</a>
                                    <input type="file" accept=".pdf" name="pdf" id="pdf" class="form-control">
                                    <input type="hidden" name="old_pdf" value="<?= $data['file_buku'] ?>">
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
                                    <a href="?page=src/buku/buku" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg"
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


        <?php
        // Process form submission after the book data is fetched and validated
        if (isset($_POST['simpan'])) {
            $id_kategori = $_POST['id_kategori'];
            $judul = $_POST['judul'];
            $penulis = $_POST['author'];
            $penerbit = $_POST['penerbit'];
            $tahun_terbit = $_POST['tahun_terbit'];
            $deskripsi = $_POST['deskripsi'];
            $jumlah = $_POST['jumlah'];
            $old_gambar = $_POST['old_gambar'];
            $old_pdf = $_POST['old_pdf'];

            $gambar = ($_FILES['gambar']['error'] === 4) ? $old_gambar : uploadGambar("gambar");
            if (!$gambar) {
                return false;
            }

            $pdf = ($_FILES['pdf']['error'] === 4) ? $old_pdf : uploadPDF("pdf");
            if (!$pdf) {
                return false;
            }


            if (((int)($_POST["jumlah"]) <= 0)) {
                echo /*html*/ "
        <script>
            alert('Jumlah tidak boleh kurang dari 0');
            location.href='?page=src/buku/buku_ubah&id=$id';
        </script>";
            } else {

                $query = mysqli_query(
                    $koneksi,
                    "UPDATE buku SET 
            id_kategori = '$id_kategori',
            judul = '$judul',
            penulis = '$penulis',
            penerbit = '$penerbit',
            tahun_terbit = '$tahun_terbit',
            deskripsi = '$deskripsi',
            jumlah = '$jumlah',
            gambar = '$gambar',
            file_buku = '$pdf'
            WHERE id_buku = '$id'"
                );
                if ($query) {
                    echo /*html*/ "
            <script>
                alert('Data Berhasil Diubah');
                location.href='?page=src/buku/buku';
            </script>";
                } else {
                    echo /*html*/ "
            <script>
            alert('Data Gagal Diubah');
            location.href='?page=src/buku/buku_tambah';
            </script>";
                }
            }
        }
        ?>