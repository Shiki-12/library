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

        body {
            background-color: var(--dark-bg);
            font-family: 'Crimson Text', serif;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 4rem;
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
        form {
            margin: 1rem 0;
            padding: 1rem;
        }

        label {
            color: var(--text-primary);
            margin-right: 1rem;
        }

        input[type="text"] {
            background: var(--dark-hover);
            border: 1px solid var(--accent-grey);
            color: var(--text-primary);
            padding: 0.5rem;
            border-radius: 4px;
            margin-right: 1rem;
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
            transform: scale(1.05);
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

        /* Remove <br> tags */
        br {
            display: none;
        }
    </style>
</head>
<body>
<?php 
if(isset($_POST["search"])) {
    if(isset($_POST["keyword_ulasan"])) {
        $keyword = $_POST["keyword_ulasan"];
        $result = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user ON ulasan.id_user = user.id_user LEFT JOIN buku ON buku.id_buku = ulasan.id_buku WHERE username LIKE '%$keyword%'");
    }
}else{
    $result = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user ON ulasan.id_user = user.id_user LEFT JOIN buku ON buku.id_buku = ulasan.id_buku");
}
?>


<div class="container-fluid">
    <div class="card mb-4">
        <h1 class="mt-4">Ulasan Buku</h1>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                        <a href="?page=src/ulasan/ulasan_tambah" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah data</a>
                    <form action="" method="post">
                        <label for="keyword">Cari ulasan dengan username :  </label>
                        <input type="text" name="keyword_ulasan" id="keyword" size="30" autofocus placeholder="Masukan username"
                            autocomplete="off">
                        <button type="submit" name="search">Cari</button>
                    </form>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $i = 1;
                    if ($result) {
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['ulasan']; ?></td>
                        <td><?php echo $data['rating']; ?></td>
                        <td>
                            <a href="?page=src/ulasan/ulasan_ubah&id=<?php echo $data['id_ulasan']; ?>"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
                                href="?page=src/ulasan/ulasan_hapus&id=<?php echo $data['id_ulasan']; ?>"
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
</body>
</html>