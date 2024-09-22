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
                            <a href="?page=dokter" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title fst-normal
                 fw-normal fs-5 text-dark">
                    <i class="fa fa-table fa-1x shadow"></i> <?php echo $title ?>
                </h4>
                <a href="?aksi=tambah-dokter" aria-current="page" class="btn btn-dark btn-outline-light">
                    <i class="fa fa-user-plus fa-1x"></i>
                    <span>Tambah Master Dokter</span>
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
                                        <th class="table-layout-2 text-center">Kode Dokter</th>
                                        <th class="table-layout-2 text-center">Dokter</th>
                                        <th class="table-layout-2 text-center">Spesialis</th>
                                        <th class="table-layout-2 text-center">Poli</th>
                                        <th class="table-layout-2 text-center">Tarif</th>
                                        <th class="table-layout-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    $sql = "SELECT * FROM tb_dokter JOIN tb_poli ON tb_dokter.id_poli = tb_poli.id_poli";
                                    $data = $konfigs->query($sql);
                                    while($pecah = $data->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['kd_dokter']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_dokter']; ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $pecah['spesialis_dokter']; ?>
                                        </td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_poli']; ?></td>
                                        <td class="table-layout-2 text-center">Rp.
                                            <?php echo number_format($pecah['tarif_dokter']); ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=lihat-dokter&id_dokter=<?php echo $pecah['id_dokter']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin melihat data dokter ini ?')"
                                                class="btn btn-outline-light btn-info btn-sm">
                                                <i class="fas fa-eye"></i></i>
                                            </a>
                                            <a href="?aksi=ubah-dokter&id_dokter=<?php echo $pecah['id_dokter']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin mengedit data dokter ini ?')"
                                                class="btn btn-outline-light btn-secondary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="?aksi=hapus-docter&id_dokter=<?php echo $pecah['id_dokter']?>"
                                                aria-current="page" class="btn btn-outline-light btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda ingin menghapus data ini dokter ini ?')">
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