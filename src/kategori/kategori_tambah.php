<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
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
            flex: 1;
            min-height: calc auto /* Subtract header height */
        }

        .card {
            background: var(--dark-surface);
        }
        .card-body {
            padding: 8rem;
            color: var(--text-primary);
        }

        .row {
            margin-bottom: 1rem;
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
            border-color: var(--text-primary);
            color: var(--text-primary);
            box-shadow: none;
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

        /* Remove <br> tags spacing */
        br {
            display: none;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Tambah Kategori</h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <?php
                    if (isset($_POST['simpan'])) {
                        $kategori = $_POST['kategori'];
                        $query = mysqli_query($koneksi, "INSERT INTO kategori(kategori) VALUES ('$kategori')");
                        if ($query) {
                            echo /*html*/ "
                            <script>
                                alert('Data Berhasil Disimpan');
                                location.href='?page=src/kategori/kategori';
                            </script>";
                        } else {
                            echo /*html*/ "
                            <script>
                                alert('Data Gagal Disimpan');
                                location.href='?page=src/kategori/kategori_tambah';
                            </script>";
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="NamaKategori">Nama Kategori</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="kategori" id="NamaKategori" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-9">
                            <button type="submit" name="simpan" class="btn btn-primary" value="submit">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="?page=src/kategori/kategori" class="btn btn-danger">
                                <i class="bi bi-backspace"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>