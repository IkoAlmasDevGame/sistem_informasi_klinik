<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "admin" || $_SESSION['jabatan'] == "pemeriksaan"){
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
                            <a href="?page=pemeriksaan" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=lihat-pemeriksaan&id_pemeriksaan=<?php echo $_GET['id_pemeriksaan']?>"
                                aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">
                    <?php if(isset($_GET['id_pemeriksaan'])): ?>
                    <?php $id = htmlspecialchars($_GET['id_pemeriksaan']); ?>
                    <?php $data = $konfigs->query("SELECT * FROM tb_pemeriksaan a JOIN tb_pendaftaran b ON a.id_pendaftaran = b.id_pendaftaran 
                    JOIN tb_pasien c ON b.id_pasien = c.id_pasien JOIN tb_poli d ON b.id_poli = d.id_poli JOIN tb_dokter e ON b.id_dokter = e.id_dokter WHERE id_pemeriksaan='$id'"); ?>
                    <?php foreach($data as $pecah){ ?>
                    <div class="card container">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9 fw-bold">
                                    Data Pemeriksaan : <?php echo $pecah['kd_pemeriksaan']; ?>
                                </div>
                                <div class="col-md-3 fw-bold">
                                    <label class="ms-5">Status : </label>
                                    <?php if ($pecah['status_periksa'] == 0) { ?>
                                    <span class="badge badge-danger text-danger p-2">Belum Menerima Resep</span>
                                    <?php } elseif ($pecah['status_periksa'] == 1) { ?>
                                    <span class="badge badge-success text-success p-2">Sudah Menerima Resep</span>
                                    <?php } else { ?>
                                    <span class="badge badge-danger p-2">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body container">
                            <div class="form-group my-2">
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Kode Pemeriksaan</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="kd_pemeriksaan"
                                            value="<?php echo $pecah['kd_pemeriksaan']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Nama Pasien</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="nm_pasien"
                                            value="<?php echo $pecah['nm_pasien']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Nama Dokter</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="nm_dokter"
                                            value="<?php echo $pecah['nm_dokter']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Poli</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="nm_poli"
                                            value="<?php echo $pecah['nm_poli']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Tanggal Daftar</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="tgl_pendaftaran"
                                            value="<?php echo $pecah['tgl_pendaftaran']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Keluhan</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <textarea class="form-control" name="keluhan" rows="3"
                                            readonly><?php echo $pecah['keluhan']; ?></textarea>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Diagnosa</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <textarea class="form-control" name="diagnosa" rows="3"
                                            readonly><?php echo $pecah['diagnosa']; ?></textarea>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="my-2"></div>
                                <!--  -->
                                <div class="form-group row justify-content-between flex-wrap align-items-center">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="" class="fs-5 display-5 text-start fst-normal 
                                        fw-normal text-dark">Tanggal Pemeriksaan</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <input type="text" class="form-control" name="tgl_pemeriksaan"
                                            value="<?php echo $pecah['tgl_pemeriksaan']; ?>" readonly>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>