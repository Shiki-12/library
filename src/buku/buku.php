<?php

if (isset($_POST['search'])) {
    if (isset($_POST['keyword_judul'])) {
        $keyword = $_POST['keyword_judul'] ?? '';
        $result = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE judul LIKE '%$keyword%'");
    }
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
}

?>


<div class="container-fluid">
    <div class="card mb-4">
        <h1 class="mt-4 text-center">Buku</h1>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="?page=src/buku/buku_tambah" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah data</a>
                    <br>
                    <div class="search-wrapper">
                        <form action="" method="post" class="search-form">
                            <label for="keyword">Cari Judul:</label>
                            <input type="text" 
                                   name="keyword_judul" 
                                   id="keyword" 
                                   class="search-input" 
                                   placeholder="Masukan Judul"
                                   autocomplete="off">
                            <button type="submit" name="search" class="search-button">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </form>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $i = 1;
                        if (isset($result)) {
                            while ($data = mysqli_fetch_array($result)) {

                        ?>
                                <tr>
                                    
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <a href="global/download.php?file=<?php echo $data['file_buku'] ?>">
                                            <img src="global/assets/img/<?php echo $data['gambar']; ?>" width="100">
                                        </a>
                                    </td>
                                    <td><?php echo $data['kategori']; ?></td>
                                    <td><?php echo $data['judul']; ?></td>
                                    <td><?php echo $data['penulis']; ?></td>
                                    <td><?php echo $data['penerbit']; ?></td>
                                    <td><?php echo $data['tahun_terbit']; ?></td>
                                    <td><?php echo $data['deskripsi']; ?></td>
                                    <td><?php echo $data['jumlah'] ?>
                                    </td>
                                    </td>
                                    <td>
                                        <a href="?page=src/buku/buku_ubah&id=<?php echo $data['id_buku']; ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
                                            href="?page=src/buku/buku_hapus&id=<?php echo $data['id_buku']; ?>"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
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

</div>

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
    }

    h1 {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
    }

    h1.text-center {
        text-align: center;
        width: 100%;
        margin-bottom: 2rem;
        padding: 1rem;
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
    }

    /* Search Form Styles */
    .search-wrapper {
        margin-bottom: 1.5rem;
    }

    .search-form {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--dark-surface);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--accent-grey);
        margin: 1rem 0;
    }

    .search-input {
        background: var(--dark-hover);
        border: 1px solid var(--accent-grey);
        color: var(--text-primary);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        width: 300px;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--text-primary);
        background: var(--dark-surface);
    }

    .search-button {
        background: var(--dark-surface);
        color: var(--text-primary);
        border: 1px solid var(--accent-grey);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        background: var(--dark-hover);
        transform: scale(1.05);
    }

    /* Remove conflicting form styles */
    form {
        margin: 0;
        padding: 0;
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
    }

    .btn-success {
        background: var(--dark-surface);
        border-color: var(--accent-grey);
        color: var(--text-primary);
    }

    .btn-primary {
        background: var(--dark-surface);
        border-color: var(--accent-grey);
    }

    .btn-danger {
        background: var(--dark-surface);
        border-color: var(--accent-grey);
    }

    .btn:hover {
        transform: scale(1.05);
        background: var(--dark-hover);
    }

    /* Image Styles */
    img {
        border-radius: 4px;
        border: 1px solid var(--accent-grey);
    }

    /* Icon Styles */
    .fas {
        color: var(--text-primary);
        margin-right: 0.5rem;
    }

    /* Global CSS variables */
    :root {
        --dark-bg: #121212;        /* Main background */
        --dark-surface: #1E1E1E;   /* Card background */
        --dark-hover: #2D2D2D;     /* Hover state */
        --text-primary: #FFFFFF;    /* Primary text */
        --text-secondary: #B3B3B3;  /* Secondary text */
        --accent-grey: #808080;     /* Changed from gold to grey */
    }

    /* Global styles */
    body {
        font-family: 'Crimson Text', Georgia, serif;
        background-color: var(--dark-bg);
        color: var(--text-primary);
    }

    /* Card styles */
    .card {
        background-color: var(--dark-surface);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: var(--dark-surface);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .card-body {
        color: var(--text-primary);
    }

    /* Table styles */
    .table {
        color: var(--text-primary);
    }

    .table thead th {
        background-color: var(--dark-surface);
        color: var(--text-primary);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table td {
        color: var(--text-primary);
        border-color: rgba(255, 255, 255, 0.1);
    }

    /* Form styles */
    .form-control {
        background-color: var(--dark-surface);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var (--text-primary);
    }

    .form-control:focus {
        background-color: var(--dark-hover);
        border-color: var(--accent-grey);
        color: var (--text-primary);
    }

    /* Button styles */
    .btn-primary {
        background-color: var(--dark-surface);
        border-color: var(--accent-grey);
        color: var(--text-primary);
    }

    .btn-primary:hover {
        background-color: var(--dark-hover);
        border-color: var(--accent-grey);
        transform: scale(1.05);
    }

    /* Link styles */
    a {
        color: var(--text-primary);
        text-decoration: none;
    }

    a:hover {
        color: var(--accent-grey);
    }

    /* Footer styles */
    footer {
        background: var(--dark-surface) !important;
        color: var(--text-primary) !important;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--dark-bg);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--dark-surface);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--accent-grey);
    }
</style>