<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "admin"){
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
        <div class="panel panel-default container bg-body-tertiary rounded-1">
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
                            <a href="?page=obat" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title fst-normal fw-normal fs-5 text-dark">
                    <i class="fa fa-table fa-1x shadow"></i> <?php echo $title ?>
                </h4>
                <a href="?aksi=tambah-obat" aria-current="page" class="btn btn-dark btn-outline-light">
                    <i class="fa fa-plus fa-1x"></i>
                    <span>Tambah Master Obat</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <div class="container">
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
                                        <th class="table-layout-2 text-center">No</th>
                                        <th class="table-layout-2 text-center">Kode Obat</th>
                                        <th class="table-layout-2 text-center">Nama Obat</th>
                                        <th class="table-layout-2 text-center">Jenis</th>
                                        <th class="table-layout-2 text-center">Stok</th>
                                        <th class="table-layout-2 text-center">Harga</th>
                                        <th class="table-layout-2 text-center">Exp. Obat</th>
                                        <th class="table-layout-2 text-center">Status</th>
                                        <th class="table-layout-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM tb_obat";
                                        $data = $konfigs->query($sql);
                                        while($pecah = $data->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['kd_obat']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_obat']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['jenis_obat']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['stok']; ?></td>
                                        <td class="table-layout-2 text-center">Rp.
                                            <?php echo number_format($pecah['harga_obat']); ?>
                                        </td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['exp_obat']; ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php if ($pecah['stok'] <= 0) { ?>
                                            <span class="badge badge-danger fs-6 text-danger p-2">Kosong</span>
                                            <?php } else { ?>
                                            <span class="badge badge-success fs-6 text-success p-2">Tersedia</span>
                                            <?php } ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=lihat-obat&id_obat=<?php echo $pecah['id_obat']?>"
                                                onclick="return confirm('Apakah anda ingin melihat data obat ini ?');"
                                                aria-current="page" class="btn-primary btn-sm btn-outline-light btn">
                                                <i class="fas fa-eye fa-1x"></i>
                                            </a>
                                            <a href="?aksi=hapus-obat&id_obat=<?php echo $pecah['id_obat']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin menghapus data ini obat ini ?');"
                                                class="btn-danger btn-outline-light btn-sm btn">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>