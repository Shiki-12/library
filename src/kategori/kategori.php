<?php
if (isset($_POST["search"])) {
    if (isset($_POST["keyword_kategori"])) {
        $keyword = $_POST["keyword_kategori"];
        $result = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori LIKE '%$keyword%'");
    }
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM kategori");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        :root {
            --dark-bg: #121212;
            --dark-surface: #1E1E1E;
            --dark-hover: #2D2D2D;
            --text-primary: #FFFFFF;
            --text-secondary: #B3B3B3;
            --accent-grey: #808080;
        }

        .container-fluid {
            background-color: var(--dark-bg);
            padding: 2rem;
            margin: 0;
        }

        h1 {
            color: var(--text-primary);
            font-family: 'Crimson Text', serif;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            padding: 1rem;
        }

        .card {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 2rem;
            color: var(--text-primary);
        }

        /* Table Styles */
        .table {
            background: var(--dark-surface);
            color: var(--text-primary);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .table th {
            background: var(--dark-hover);
            color: var(--text-primary);
            padding: 1rem;
            border-color: var(--accent-grey);
        }

        .table td {
            color: var(--text-secondary);
            padding: 0.75rem;
            border-color: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
        }

        /* Search Form Styles */
        .search-form {
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        label {
            color: var(--text-primary);
            margin: 0;
        }

        input[type="text"] {
            background: var(--dark-hover);
            border: 1px solid var(--accent-grey);
            color: var(--text-primary);
            padding: 0.5rem;
            border-radius: 4px;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .btn-success {
            background: var(--dark-surface);
            border-color: var(--accent-grey);
            color: var(--text-primary);
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

        button[type="submit"] {
            background: var(--dark-surface);
            color: var(--text-primary);
            border: 1px solid var(--accent-grey);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: var(--dark-hover);
        }
    </style>
</head>

<div class="container-fluid">
    <div class="card mb-4">
        <h1 class="mt-4">Kategori</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="?page=src/kategori/kategori_tambah" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah data
                    </a>
                    
                    <form action="" method="post" class="search-form">
                        <label for="keyword">Cari Kategori : </label>
                        <input type="text" name="keyword_kategori" id="keyword" size="30" autofocus 
                            placeholder="Masukan Kategori" autocomplete="off">
                        <button type="submit" name="search">Cari</button>
                    </form>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $i = 1;
                        if ($result) {
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $data['kategori']; ?></td>
                                    <td>
                                        <a href="?page=src/kategori/kategori_ubah&id=<?php echo $data['id_kategori']; ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a><a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
                                            href="?page=src/kategori/kategori_hapus&id=<?php echo $data['id_kategori']; ?>"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }else {
                            echo /*html*/ "
                            <script>
                            alert('Data tidak ditemukan');
                            </script>
                            ";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>