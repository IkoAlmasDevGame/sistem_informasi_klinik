<?php 
if($_SESSION['jabatan'] == ""){
    echo "<script>document.location.href = '../../auth/index.php?info=gagal'</script>";
    die;
}
?>

<?php 
if($_SESSION['jabatan'] == "superadmin"){
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
            Poli Klinik Indonesia Islamic
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM tb_user WHERE email = '$_SESSION[email]'")); ?>
                    <i class="fa fa-2x fa-user-circle"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['jabatan'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                <i class="fa fa-home fa-1x"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Blank Page Nav -->
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?aksi=tambah-karyawan">
                <i class="fa fa-registered fa-1x"></i>
                <span>Daftar Karyawan</span>
            </a>
        </li><!-- End Blank Page Nav -->
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=karyawan">
                <i class="fa fa-registered fa-1x"></i>
                <span>Master Karyawan</span>
            </a>
        </li><!-- End Blank Page Nav -->
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href=""
                onclick="return confirm('Apakah anda ingin edit pengturan \nPoli Klinik Indonesia Islamic ?')">
                <i class="fa fa-gears fa-1x"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                onclick=" return confirm('Apakah anda ingin logout ?')">
                <i class="fa fa-sign-out-alt fa-1x"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside>
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php
}elseif($_SESSION['jabatan'] == "admin"){
?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                Poli Klinik Indonesia Islamic
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto mx-3">
            <ul>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-controls="dropdown">
                        <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM tb_user WHERE email = '$_SESSION[email]'")); ?>
                        <i class="fa fa-2x fa-user-circle"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <hr class="dropdown-divider">
                            <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">Jabatan : <?php echo $_SESSION['jabatan'] ?></div>
                            <hr class="dropdown-divider">
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header>
    <!-- ======= Header ======= -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                    <i class="fa fa-home fa-1x"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Blank Page Nav -->
            <hr class="border border-bottom border-dark">
            <h4 class="fs-5 fst-normal fw-semibold">Data Master</h4>
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=dokter">
                    <i class="fa fa-user-plus fa-1x"></i>
                    <span>Master Dokter</span>
                </a>
            </li><!-- End Blank Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=obat">
                    <i class="fas fa-capsules fa-1x"></i>
                    <span>Master Obat</span>
                </a>
            </li><!-- End Blank Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=pasien">
                    <i class="fa fa-hospital-user fa-1x"></i>
                    <span>Master Pasien</span>
                </a>
            </li><!-- End Blank Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=poli">
                    <i class="fa fa-database fa-1x"></i>
                    <span>Master Poli</span>
                </a>
            </li><!-- End Blank Page Nav -->
            <hr class="border border-bottom border-dark">
            <h4 class="fs-5 fst-normal fw-semibold">Data Master Lain</h4>
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=pendaftaran">
                    <i class="fas fa-clipboard-list fa-1x"></i>
                    <span>Data Pendaftaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=pemeriksaan">
                    <i class="fas fa-address-book fa-1x"></i>
                    <span>Data Pemeriksaan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=resepobat">
                    <i class="fas fa-scroll fa-1x"></i>
                    <span>Resep Obat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=pembayaran">
                    <i class="fas fa-shopping-cart fa-1x"></i>
                    <span>Kasir Pembayaran</span>
                </a>
            </li>
            <hr class="border border-top border-dark">
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                    onclick=" return confirm('Apakah anda ingin logout ?')">
                    <i class="fa fa-sign-out-alt fa-1x"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Blank Page Nav -->
        </ul>
    </aside>
    <!-- ======= Sidebar ======= -->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>
        <?php
}elseif($_SESSION['jabatan'] == "pembayaran"){
?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
            <div class="d-flex align-items-center justify-content-between">
                <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                    Poli Klinik Indonesia Islamic
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto mx-3">
                <ul>
                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-controls="dropdown">
                            <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM tb_user WHERE email = '$_SESSION[email]'")); ?>
                            <i class="fa fa-2x fa-user-circle"></i>
                            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <hr class="dropdown-divider">
                                <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                                <div class="mb-1"></div>
                                <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                                <div class="mb-1"></div>
                                <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                                <div class="mb-1"></div>
                                <div class="text-start">Jabatan : <?php echo $_SESSION['jabatan'] ?></div>
                                <hr class="dropdown-divider">
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header>
        <!-- ======= Header ======= -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                        <i class="fa fa-home fa-1x"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Blank Page Nav -->
                <hr class="border border-bottom border-dark">
                <h4 class="fs-5 fst-normal fw-semibold">Pembayaran Kasir</h4>
                <li class="nav-item">
                    <a class="nav-link collapsed" aria-current="page" href="?page=pembayaran">
                        <i class="fas fa-shopping-cart fa-1x"></i>
                        <span>Kasir Pembayaran</span>
                    </a>
                </li>
                <hr class="border border-top border-dark">
                <li class="nav-item">
                    <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                        onclick=" return confirm('Apakah anda ingin logout ?')">
                        <i class="fa fa-sign-out-alt fa-1x"></i>
                        <span>Logout</span>
                    </a>
                </li><!-- End Blank Page Nav -->
            </ul>
        </aside>
        <!-- ======= Sidebar ======= -->

        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                        </div>

                    </div><!-- End Right side columns -->

                </div>
            </section>
            <?php
}elseif($_SESSION['jabatan'] == "pendaftaran"){
?>
            <!-- ======= Header ======= -->
            <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                        Poli Klinik Indonesia Islamic
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div><!-- End Logo -->

                <nav class="header-nav ms-auto mx-3">
                    <ul>
                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-controls="dropdown">
                                <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM tb_user WHERE email = '$_SESSION[email]'")); ?>
                                <i class="fa fa-2x fa-user-circle"></i>
                                <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                            </a><!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <hr class="dropdown-divider">
                                    <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                                    <div class="mb-1"></div>
                                    <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                                    <div class="mb-1"></div>
                                    <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                                    <div class="mb-1"></div>
                                    <div class="text-start">Jabatan : <?php echo $_SESSION['jabatan'] ?></div>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul><!-- End Profile Dropdown Items -->
                        </li><!-- End Profile Nav -->

                    </ul>
                </nav><!-- End Icons Navigation -->

            </header>
            <!-- ======= Header ======= -->

            <!-- ======= Sidebar ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                            <i class="fa fa-home fa-1x"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!-- End Blank Page Nav -->
                    <hr class="border border-bottom border-dark">
                    <h4 class="fs-5 fst-normal fw-semibold">Pendaftaran Pasien</h4>
                    <li class="nav-item">
                        <a class="nav-link collapsed" aria-current="page" href="?page=pendaftaran">
                            <i class="fas fa-clipboard-list fa-1x"></i>
                            <span>Data Pendaftaran</span>
                        </a>
                    </li>
                    <hr class="border border-top border-dark">
                    <li class="nav-item">
                        <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                            onclick=" return confirm('Apakah anda ingin logout ?')">
                            <i class="fa fa-sign-out-alt fa-1x"></i>
                            <span>Logout</span>
                        </a>
                    </li><!-- End Blank Page Nav -->
                </ul>
            </aside>
            <!-- ======= Sidebar ======= -->

            <main id="main" class="main">
                <section class="section dashboard">
                    <div class="row">

                        <!-- Left side columns -->
                        <div class="col-lg-8">
                            <div class="row">

                            </div>

                        </div><!-- End Right side columns -->

                    </div>
                </section>
                <?php
}elseif($_SESSION['jabatan'] == "pemeriksaan"){
?>
                <!-- ======= Header ======= -->
                <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                            Poli Klinik Indonesia Islamic
                        </a>
                        <i class="bi bi-list toggle-sidebar-btn"></i>
                    </div><!-- End Logo -->

                    <nav class="header-nav ms-auto mx-3">
                        <ul>
                            <li class="nav-item dropdown pe-3">

                                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-controls="dropdown">
                                    <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM tb_user WHERE email = '$_SESSION[email]'")); ?>
                                    <i class="fa fa-2x fa-user-circle"></i>
                                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                                </a><!-- End Profile Iamge Icon -->

                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                    <li class="dropdown-header">
                                        <hr class="dropdown-divider">
                                        <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                                        <div class="mb-1"></div>
                                        <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                                        <div class="mb-1"></div>
                                        <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                                        <div class="mb-1"></div>
                                        <div class="text-start">Jabatan : <?php echo $_SESSION['jabatan'] ?></div>
                                        <hr class="dropdown-divider">
                                    </li>
                                </ul><!-- End Profile Dropdown Items -->
                            </li><!-- End Profile Nav -->

                        </ul>
                    </nav><!-- End Icons Navigation -->

                </header>
                <!-- ======= Header ======= -->
                <!-- ======= Sidebar ======= -->
                <aside id="sidebar" class="sidebar">
                    <ul class="sidebar-nav" id="sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                                <i class="fa fa-home fa-1x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li><!-- End Blank Page Nav -->
                        <hr class="border border-bottom border-dark">
                        <h4 class="fs-5 fst-normal fw-semibold">Pemeriksaan Pasien</h4>
                        <li class="nav-item">
                            <a class="nav-link collapsed" aria-current="page" href="?page=pemeriksaan">
                                <i class="fas fa-address-book fa-1x"></i>
                                <span>Data Pemeriksaan</span>
                            </a>
                        </li>
                        <hr class="border border-top border-dark">
                        <li class="nav-item">
                            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                                onclick=" return confirm('Apakah anda ingin logout ?')">
                                <i class="fa fa-sign-out-alt fa-1x"></i>
                                <span>Logout</span>
                            </a>
                        </li><!-- End Blank Page Nav -->
                    </ul>
                </aside>
                <!-- ======= Sidebar ======= -->

                <main id="main" class="main">
                    <section class="section dashboard">
                        <div class="row">

                            <!-- Left side columns -->
                            <div class="col-lg-8">
                                <div class="row">

                                </div>

                            </div><!-- End Right side columns -->

                        </div>
                    </section>
                    <?php
}else{
    echo "<script>document.location.href = '../../auth/index.php?info=gagal'</script>";
    die;
}
?>