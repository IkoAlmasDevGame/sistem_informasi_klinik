<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "pendaftaran"){
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
                            <a href="?page=pendaftaran" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-pendaftaran" aria-current="page"
                                class="text-decoration-none text-primary">
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
                    <div class="d-flex justify-content-end align-items-center flex-wrap my-2">
                        <div class="col-sm-3 col-md-3">
                            <div class="btn-block disabled mx-4">
                                <?php error_reporting(0); ?>
                                <?php $data = $konfigs->query("SELECT * FROM tb_pendaftaran ORDER BY id_pendaftaran DESC LIMIT 1"); ?>
                                <?php $pecah = $data->fetch_assoc(); ?>
                                <label>Data Terakhir :</label>
                                <input type="text" class="form-control text-center"
                                    value="<?php echo $pecah['kd_pendaftaran'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <form action="?aksi=pasien-pendaftaran" method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-7 col-md-7">
                                <div class="card-header">
                                    <h4 class="card-title text-center"><?php echo $title ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mt-1 mt-lg-1">
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Kode Pendaftaran</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <input type="text" name="kd_pendaftaran" maxlength="10"
                                                    class="form-control" value="DTF-" id="" required
                                                    aria-required="TRUE">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Nama Pasien</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <select name="id_pasien" class="form-select" required
                                                    aria-required="TRUE" id="">
                                                    <option value="0" disabled selected>Pilih Pasien</option>
                                                    <?php
                                                        $ambil2 = $konfigs->query("SELECT * FROM tb_pasien");
                                                        $pecah2 = $ambil2->fetch_assoc();
                                                    ?>
                                                    <?php foreach ($ambil2 as $pasien) : ?>
                                                    <option value="<?php echo $pasien['id_pasien']; ?>">
                                                        <?php echo $pasien['nm_pasien']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Poli</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <select class="form-select" required aria-required="TRUE" name="id_poli"
                                                    id="">
                                                    <option value="0" disabled selected>Pilih Poli</option>
                                                    <?php
                                                    $ambil3 = $konfigs->query("SELECT * FROM tb_poli");
                                                    $pecah3 = $ambil3->fetch_assoc();
                                                    ?>

                                                    <?php foreach ($ambil3 as $poli) : ?>
                                                    <option value="<?php echo $poli['id_poli']; ?>">
                                                        <?php echo $poli['nm_poli']; ?></option>
                                                    <?php endforeach; ?>
                                                    <?php $poli_id = $_POST['id_poli']; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Dokter</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <select class="form-select" required aria-required="TRUE" id=""
                                                    name="id_dokter">
                                                    <option value="0" disabled selected>Pilih Dokter</option>
                                                    <?php
                                                    $ambil4 = $konfigs->query("SELECT * FROM tb_dokter JOIN tb_poli ON tb_dokter.id_poli = tb_poli.id_poli");
                                                    $pecah4 = $ambil4->fetch_assoc();
                                                    ?>

                                                    <?php foreach ($ambil4 as $dokter) : ?>
                                                    <option value="<?php echo $dokter['id_dokter']; ?>">
                                                        <?php echo $dokter['nm_dokter']; ?> -
                                                        <?php echo $dokter['nm_poli']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-group row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Tanggal Pendaftaran</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5 date-formate">
                                                <input type="date" class="form-control" name="tgl_pendaftaran"
                                                    value="<?php echo date("Y-m-d"); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer rounded-1 mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-outline-light">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Simpan data</span>
                                            </button>
                                            <a href="?page=pendaftaran" aria-current="page"
                                                class="btn btn-outline-light btn-secondary">Cancel</a>
                                            <button type="reset" class="btn btn-danger btn-outline-light">
                                                <i class="fa fa-eraser fa-1x"></i>
                                                <span>Hapus semua</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>