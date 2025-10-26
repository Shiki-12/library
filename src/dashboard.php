<style>
    :root {
        --dark-bg: #121212;        /* Main background */
        --dark-surface: #1E1E1E;   /* Card background */
        --dark-hover: #2D2D2D;     /* Hover state */
        --text-primary: #FFFFFF;    /* Primary text */
        --text-secondary: #B3B3B3;  /* Secondary text */
        --accent-grey: #808080;     /* Accent color (replacing dark-gold) */
    }

    .dashboard-heading {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-grey); /* Changed from dark-gold */
        padding-bottom: 0.5rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .breadcrumb {
        background-color: var(--dark-surface);
        color: var(--light-cream);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .breadcrumb-item.active {
        color: var(--light-cream);
    }

    .card {
        background-color: var(--dark-surface);
        color: var(--text-primary);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1.5rem;
        min-height: 140px; /* Reduced from 160px */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 1rem; /* Reduced from 1.5rem */
        text-align: center;
        font-family: 'Crimson Text', serif;
        color: var(--light-cream);
    }

    .card-body .number {
        font-size: 2rem; /* Reduced from 2.5rem */
        font-weight: 600;
        margin-bottom: 0.3rem; /* Reduced from 0.5rem */
        color: var(--text-primary);
    }

    .card-body .label {
        font-size: 0.9rem; /* Reduced from 1.1rem */
        opacity: 0.9;
        color: var(--text-secondary);
    }

    .card-footer {
        background: var(--dark-hover);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.75rem 1rem; /* Reduced from 1rem 1.5rem */
    }

    .card.bg-success { background: linear-gradient(45deg, var(--dark-surface), #2E7D32); }
    .card.bg-warning { background: linear-gradient(45deg, var(--dark-surface), #FF8F00); }
    .card.bg-primary { background: linear-gradient(45deg, var(--dark-surface), #1565C0); }
    .card.bg-danger { background: linear-gradient(45deg, var(--dark-surface), #C62828); }

    .user-info-card {
        background: var(--dark-surface);
        color: var(--light-cream);
        margin-top: 2rem;
        padding: 1rem;
        border: 1px solid var(--accent-grey); /* Changed from dark-gold */
        border-radius: 15px; /* Match other cards */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-info-card h3 {
        color: var(--text-primary);
        font-family: 'Crimson Text', serif;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-grey); /* Changed from dark-gold */
        padding-bottom: 0.5rem;
    }

    .user-info-card .table {
        color: var(--light-cream) !important;
        margin-bottom: 0;
        background-color: transparent; /* Ensure table is transparent */
    }

    .user-info-card td {
        padding: 1rem;
        border: none;
        font-size: 1.1rem;
        vertical-align: middle;
        color: var (--text-primary) !important;
    }

    .user-info-card i {
        color: var(--accent-grey); /* Changed from dark-gold */
        width: 20px;
        text-align: center;
        margin-right: 15px; /* Increased spacing */
        display: inline-block; /* Ensures consistent spacing */
    }

    .user-info-text {
        display: inline-block;
        margin-left: 5px; /* Add space after icon */
        color: var(--text-primary) !important;
    }

    .user-info-card tr:hover {
        background: var(--dark-hover);
        border-radius: 5px;
    }

    .container-fluid {
        background-color: var(--dark-bg);
        min-height: auto;
        padding: 2rem;
    }

    .table td, 
    .table th,
    .user-info-text {
        color: var(--light-cream) !important;
    }

    .carousel-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .carousel-inner {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .carousel-item img {
        height: 400px;
        object-fit: cover;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.8;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 20px;
    }
</style>

<main>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <div class="container-fluid px-4">
        <h1 class="dashboard-heading">Main Page</h1>
        
        <!-- Carousel Section -->
        <div class="carousel-container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="global/assets/img/FUrZgt7XEAg2zyj.jpeg" class="d-block w-100" alt="Library Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="global/assets/img/img_0689-2-1.jpg" class="d-block w-100" alt="Library Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="global/assets/img/469814999_1788219625259587_2274242514110479401_n.jpg" class="d-block w-100" alt="Library Image 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori-Kategori </li>
        </ol>
        <div class="row">
            <?php if ($data['level'] != "peminjam") { ?>
                <div class="col-xl-2 col-md-4"> <!-- Changed from col-xl-3 col-md-6 -->
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="number">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?>
                            </div>
                            <div class="label">Total Kategori</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="?page=src/kategori/kategori">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4"> <!-- Changed from col-xl-3 col-md-6 -->
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="number">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku")); ?>
                            </div>
                            <div class="label">Total Buku</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="?page=src/buku/buku">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="col-xl-2 col-md-4"> <!-- Changed from col-xl-3 col-md-6 -->
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="number">
                            <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasan")); ?>
                        </div>
                        <div class="label">Total ulasan</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="?page=src/ulasan/ulasan">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4"> <!-- Changed from col-xl-3 col-md-6 -->
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="number">
                            <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM Peminjaman WHERE status_peminjaman = 'dipinjam'")); ?>
                        </div>
                        <div class="label">Total Peminjaman</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="?page=src/peminjaman/peminjaman">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <?php if ($data['level'] != "peminjam" && $data['level'] != "petugas") { ?>
                <div class="col-xl-2 col-md-4"> <!-- Changed from col-xl-3 col-md-6 -->
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="number">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user")); ?>
                            </div>
                            <div class="label">Total User</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="?page=src/user/user">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- User Info Card -->
        <div class="card user-info-card mt-4">
            <div class="card-body">
                <h3><i class="fas fa-user-circle me-2"></i>User Information</h3>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td width="20%" style="color: var(--text-primary);">
                                <i class="fas fa-user"></i><span class="user-info-text">Nama</span>
                            </td>
                            <td width="1" style="color: var(--text-primary);">:</td>
                            <td style="color: var(--text-primary);"><?php echo $data['nama']; ?></td>
                        </tr>
                        <tr>
                            <td style="color: var(--text-primary);">
                                <i class="fas fa-briefcase"></i><span class="user-info-text">Level</span>
                            </td>
                            <td style="color: var(--text-primary);">:</td>
                            <td style="color: var(--text-primary);"><?php echo $data['level']; ?></td>
                        </tr>
                        <tr>
                            <td style="color: var(--text-primary);">
                                <i class="fas fa-calendar"></i><span class="user-info-text">Tanggal Login</span>
                            </td>
                            <td style="color: var(--text-primary);">:</td>
                            <td style="color: var(--text-primary);"><?php echo date("d-m-Y")?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
