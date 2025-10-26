<?php
if (isset($_POST["search"])) {
    if (isset($_POST["keyword_peminjaman"])) {
        $keyword = $_POST["keyword_peminjaman"];
        // Updated query to search by nama instead of username
        $result = mysqli_query($koneksi, "SELECT * FROM peminjaman 
            LEFT JOIN user ON user.id_user = peminjaman.id_user 
            LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
            WHERE status_peminjaman = 'dipinjam' 
            AND user.nama LIKE '%$keyword%'");
    }
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM peminjaman 
        LEFT JOIN user ON user.id_user = peminjaman.id_user 
        LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
        WHERE status_peminjaman = 'dipinjam'");
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

    /* Remove dark-gold variable and use accent-grey instead */
    
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
        margin-bottom: 1.5rem;
    }

    .card h1 {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 2.5rem;
        text-align: center;
        margin: 1rem 0;
        padding: 0.5rem;
        border-bottom: 2px solid var(--accent-grey); /* Changed from dark-gold */
    }

    .card-body {
        padding: 2rem;
        color: var(--text-primary);
    }

    /* Table Styles */
    .table {
        background: var(--dark-surface);
        color: var (--text-primary);
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

    .btn-success, .btn-info {
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
        margin: 0;
        padding: 0;
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
        color: var (--text-primary);
        border: 1px solid var(--accent-grey);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button[type="submit"]:hover {
        background: var(--dark-hover);
        transform: scale(1.05);
    }

    /* Remove <br> tags */
    br {
        display: none;
    }

    /* Add these specific search form styles */
    .search-wrapper {
        margin-bottom: 1.5rem;
    }

    .search-form {
        background: var(--dark-surface);
        border: 1px solid var(--accent-grey);
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search-label {
        color: var(--text-primary);
        margin: 0;
        white-space: nowrap;
    }

    .search-input {
        background: var(--dark-hover);
        border: 1px solid var(--accent-grey);
        color: var(--text-primary);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        width: 300px;
    }

    .search-button {
        background: var(--dark-surface);
        color: var(--text-primary);
        border: 1px solid var(--accent-grey);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .search-button:hover {
        background: var(--dark-hover);
        transform: scale(1.05);
    }

    .page-header {
        background: var(--dark-surface);
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--accent-grey);
        margin-bottom: 2rem;
    }

    .page-header h1 {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 2.5rem;
        text-align: center;
        margin: 0;
    }

    .input-group {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
</style>

<div class="container-fluid">
    <header class="page-header">
        <h1>Laporan Peminjaman Buku</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- Action Buttons -->
                    <div class="action-buttons mb-3">
                        <a href="cetak.php" target="_blank" class="btn btn-success">
                            <i class="fas fa-print"></i> Cetak Data
                        </a>
                        <a href="histori_peminjaman.php" class="btn btn-info" target="_blank">
                            <i class="fas fa-history"></i> Histori Peminjaman
                        </a>
                    </div>

                    <!-- Search Form -->
                    <div class="search-wrapper">
                        <form action="" method="post" class="search-form">
                            <label for="keyword" class="search-label">Cari Peminjaman Dengan Nama:</label>
                            <input type="text" 
                                name="keyword_peminjaman" 
                                id="keyword" 
                                class="search-input" 
                                placeholder="Masukan nama peminjam" 
                                autocomplete="off">
                            <button type="submit" name="search" class="search-button">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </form>
                    </div>

                    <!-- Table Content -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Peminjaman</th>
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
</div>
