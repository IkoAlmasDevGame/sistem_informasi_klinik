<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "admin" || $_SESSION['jabatan'] == "pendaftaran"){
                require_once("../ui/header.php");
                require_once("../../../database/koneksi.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default container-fluid bg-body-tertiary rounded-1">
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo $title ?></h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary">
                                Beranda
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=pendaftaran" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container-fluid mb-4">
            <div class="card-header py-2">
                <h4 class="card-title fst-normal
                 fw-normal fs-5 text-dark">
                    <i class="fa fa-table fa-1x shadow"></i> <?php echo $title ?>
                </h4>
                <?php if($_SESSION['jabatan'] == "pendaftaran") : ?>
                <a href="?aksi=tambah-pendaftaran" aria-current="page" class="btn btn-dark btn-outline-light">
                    <i class="fa fa-user-plus fa-1x"></i>
                    <span>Tambah Pendaftaran</span>
                </a>
                <?php endif; ?>
            </div>
            <div class="card-body mt-1">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <select name="length" id="example1_length" aria-controls="example2_length" required>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">Kode Daftar</th>
                                        <th class="table-layout-2 text-center">Nama Pasien</th>
                                        <th class="table-layout-2 text-center">Dokter</th>
                                        <th class="table-layout-2 text-center">Poli</th>
                                        <th class="table-layout-2 text-center">Tanggal Daftar</th>
                                        <th class="table-layout-2 text-center">Action</th>
                                        <th class="table-layout-2 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $data = $konfigs->query("SELECT * FROM tb_pendaftaran a JOIN tb_pasien b ON a.id_pasien = b.id_pasien
                                        JOIN tb_dokter c ON a.id_dokter = c.id_dokter JOIN tb_poli d ON a.id_poli =  d.id_poli"); ?>
                                    <?php while($pecah = mysqli_fetch_assoc($data)){ ?>
                                    <tr>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $pecah['kd_pendaftaran']; ?>
                                        </td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_pasien']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_dokter']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_poli']; ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $pecah['tgl_pendaftaran']; ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php if ($pecah['status'] == 0) { ?>
                                            <a href="?aksi=pasien-batal&id_pendaftaran=<?php echo $pecah['id_pendaftaran']; ?>"
                                                class="btn-danger btn-outline-light btn-sm btn">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <a href="?aksi=struk-pendaftaran&kd_pendaftaran=<?php echo $pecah['kd_pendaftaran']?>"
                                                aria-current="page" class="btn btn-info btn-outline-light btn-sm">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <?php } elseif ($pecah['status'] == 1) { ?>
                                            <a href="#" class="btn-secondary btn-sm btn">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <?php } else { ?>
                                            <a href="#" class="btn-secondary btn-sm btn">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <?php } ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php if ($pecah['status'] == 0) { ?>
                                            <span class="badge badge-secondary text-secondary fs-6 p-2">Belum
                                                Diperiksa</span>
                                            <?php } elseif ($pecah['status'] == 1) { ?>
                                            <span class="badge badge-success text-success fs-6 p-2">Sudah
                                                Diperiksa</span>
                                            <?php } else { ?>
                                            <span class="badge badge-danger text-danger fs-6 p-2">Dibatalkan</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>