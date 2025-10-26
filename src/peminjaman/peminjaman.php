<?php
if (isset($_POST["search"])) {
    if (isset($_POST["keyword_peminjaman"])) {
        $keyword = $_POST["keyword_peminjaman"];
        $result = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user ON user.id_user = peminjaman.id_user LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku WHERE status_peminjaman = 'dipinjam' AND user.nama LIKE '%$keyword%'");
    }
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user ON user.id_user = peminjaman.id_user LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku WHERE status_peminjaman = 'dipinjam'");
}
?>

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

    .card {
        background: var(--dark-surface);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card h1 {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 2.5rem;
        text-align: center;
        margin: 1rem 0;
        padding: 1rem;
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

    /* Button Styles */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }

    .btn-success, .btn-primary, .btn-danger {
        background: var(--dark-surface);
        border-color: var(--accent-grey);
        color: var(--text-primary);
    }

    .btn:hover {
        transform: scale(1.05);
        background: var(--dark-hover);
    }

    /* Search Form Styles */
    form {
        margin: 1rem 0;
        padding: 1rem;
        background: var(--dark-surface);
        border-radius: 8px;
        display: flex;
        align-items: center;
        width: fit-content;
        float: right;
    }

    label {
        color: var(--text-primary);
        margin-right: 1rem;
        white-space: nowrap;
    }

    input[type="text"] {
        background: var(--dark-hover);
        border: 1px solid var(--accent-grey);
        color: var(--text-primary);
        padding: 0.5rem;
        border-radius: 4px;
        margin-right: 1rem;
        width: 200px;
    }

    button[type="submit"] {
        background: var(--dark-surface);
        color: var(--text-primary);
        border: 1px solid var(--accent-grey);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap;
    }

    button[type="submit"]:hover {
        background: var(--dark-hover);
    }

    /* Add clearfix to prevent floating issues */
    .card-body::after {
        content: "";
        display: table;
        clear: both;
    }
</style>

<div class="container-fluid">
    <div class="card mb-4">
        <h1 class="mt-4">Peminjaman Buku</h1>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <a href="?page=src/peminjaman/peminjaman_tambah" target="_blank" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah Peminjaman</a>
                <form action="" method="post">
                    <label for="keyword">Cari peminjaman dengan username : </label>
                    <input type="text" name="keyword_peminjaman" id="keyword" size="30" autofocus placeholder="Masukan Username"
                        autocomplete="off">
                    <button type="submit" name="search">Cari</button>
                </form>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Peminjaman</th>
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
                                <td><?php echo $data['tanggal_peminjaman']; ?></td>
                                <td><?php echo $data['tanggal_pengembalian']; ?></td>
                                <td><?php echo $data['status_peminjaman']; ?></td>
                                <td>
                                <?php 
                                if ($_SESSION["user"]["nama"] == $data["nama"]) {

                                
                                ?>
                                    <a href="?page=src/peminjaman/peminjaman_ubah&id=<?php echo $data['id_peminjaman']; ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Apakah anda yakin ingin mengembalikan buku ini?');"
                                        href="?page=src/peminjaman/peminjaman_hapus&id=<?php echo $data['id_peminjaman']; ?>"
                                        class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
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
