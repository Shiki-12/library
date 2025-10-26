<?php
require 'global/function.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id_user = $_COOKIE['id'];
    $query = "SELECT * FROM user WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    $data = $_SESSION['user'];
}

if (!isset($data)) {
    header("Location: src/auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600&family=Garamond&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --wood-brown: #333333;      /* Changed to dark grey */
            --light-brown: #4D4D4D;     /* Changed to lighter grey */
            --light-cream: #F5F5DC;     /* Kept for contrast */
            --dark-gold: #808080;       /* Changed to medium grey */
            --shadow-color: rgba(0, 0, 0, 0.3);
            --dark-bg: #121212;         /* Main background */
            --dark-surface: #1E1E1E;    /* Card/Nav background */
            --dark-hover: #2D2D2D;      /* Hover state */
            --text-primary: #FFFFFF;    /* Primary text */
            --text-secondary: #B3B3B3;  /* Secondary text */
        }

        body {
            font-family: 'Crimson Text', Georgia, serif;
            background-color: #1A1A1A; /* Changed to darker grey */
        }

        /* Navbar Styles */
        .sb-topnav {
            background: var(--dark-surface) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            color: var(--text-primary) !important;
        }

        .navbar-nav .nav-link {
            color: var(--text-secondary) !important;
        }

        .navbar-nav .nav-link:hover {
            color: var(--text-primary) !important;
        }

        /* Updated Sidebar Styles */
        .sb-sidenav-dark {
            background: var(--dark-surface) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sb-sidenav-dark .sb-sidenav-menu {
            padding: 2rem 0;
            background: var(--dark-bg);
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link {
            color: var(--text-secondary);
            font-family: 'Crimson Text', serif;
            font-size: 1.1rem;
            padding: 1rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            background: transparent;
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover {
            color: var(--text-primary);
            background: var(--dark-hover);
            border-left: 3px solid var(--dark-gold);
            transform: translateX(5px);
        }

        .sb-sidenav-menu-heading {
            color: var(--text-secondary) !important;
            font-size: 1.2rem;
            font-family: 'Garamond', serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 1rem 0 0.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.5rem;
        }

        .sb-sidenav-footer {
            background: var(--dark-surface) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
            padding: 1rem;
        }

        .sb-sidenav-footer .small {
            color: var(--text-secondary);
            opacity: 0.8;
        }

        .sb-sidenav-footer .user-name {
            color: var(--text-primary);
        }

        /* Content Area Styles */
        #layoutSidenav_content {
            background-color: var(--light-cream);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Card Styles */
        .card {
            border: 1px solid var(--dark-gold);
            box-shadow: 0 4px 6px var(--shadow-color);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--dark-hover);
            border-color: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--dark-gold);
            border-color: var(--dark-gold);
            transform: scale(1.05);
        }

        /* Table Styles */
        .table {
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--dark-gold);
        }

        .table thead th {
            background-color: var(--wood-brown);
            color: var(--light-cream);
            font-family: 'Garamond', serif;
            border-bottom: 2px solid var(--dark-gold);
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(to right, var(--wood-brown), var(--light-brown)) !important;
            color: var(--light-cream) !important;
            border-top: 2px solid var(--dark-gold);
            padding: 0.5rem; /* Reduced padding */
            margin-top: auto;
        }

        footer .container-fluid {
            padding: 0 1rem; /* Reduced container padding */
        }

        footer .text-light {
            font-family: 'Crimson Text', serif;
            font-size: 0.9rem;
            margin: 0; /* Remove any margin */
        }

        .py-4 {
            padding-top: 0.5rem !important; /* Reduce top padding */
            padding-bottom: 0.5rem !important; /* Reduce bottom padding */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--wood-brown);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-gold);
        }

        /* Custom Icons */
        .fa-tachometer-alt::before {
            content: "\f0e4"; /* Antiquated dashboard icon */
        }
        
        .fa-table::before {
            content: "\f02d"; /* Book icon for categories */
        }

        .fa-book::before {
            content: "\f518"; /* Scroll icon for books */
        }

        .fa-users::before {
            content: "\f500"; /* Classic users icon */
        }

        .fa-book-open::before {
            content: "\f518"; /* Vintage book icon */
        }

        .fa-comment::before {
            content: "\f075"; /* Classic comment icon */
        }

        /* Update the search input in navbar */
        .form-control {
            background-color: var(--dark-hover);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .form-control:focus {
            background-color: var(--dark-bg);
            border-color: var(--dark-gold);
            color: var(--text-primary);
        }

        /* Update dropdown menu */
        .dropdown-menu {
            background-color: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item {
            color: var(--text-secondary);
        }

        .dropdown-item:hover {
            background-color: var(--dark-hover);
            color: var(--text-primary);
        }

        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a href="index.php?" class="navbar-brand ps-3">Perpustakaan Digital</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="src/auth/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="?">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Navigasi</div>
                        <?php
                        
                        if ($data['level'] != "peminjam") {
                        ?>

                            <a class="nav-link" href="?page=src/kategori/kategori">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kategori
                            </a>
                            <a class="nav-link" href="?page=src/buku/buku">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Buku
                            </a>
                            <?php if ($data['level'] == "admin") { ?>

                                <a href="?page=src/user/user" class="nav-link">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    User
                                </a>
                            <?php
                            }
                        } else {
                            ?>

                            <a class="nav-link" href="?page=src/peminjaman/peminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Peminjaman
                            </a>
                        <?php } ?>

                        <a class="nav-link" href="?page=src/ulasan/ulasan">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                            Ulasan
                        </a>
                        <?php
                        if ($data['level'] != "peminjam") {
                        ?>
                            <a class="nav-link" href="?page=src/laporan/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Laporan peminjaman
                            </a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <div class="user-name">
                        <i class="fas fa-user-circle me-2"></i>
                        <?php echo $data['nama']; ?>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?php
                $page = $_GET['page'] ?? 'src/dashboard';

                if (file_exists($page . '.php')) {
                    require "$page.php";
                } else {
                    require '404.php';
                }
                ?>

            </main>
            <footer class="py-4 mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-light">Copyright &copy; Perpustakaan Digital 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>