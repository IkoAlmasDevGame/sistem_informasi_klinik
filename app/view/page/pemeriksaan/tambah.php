<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "pemeriksaan"){
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
                            <a href="?aksi=tambah-pemeriksaan" aria-current="page"
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
                                <?php $data = $konfigs->query("SELECT * FROM tb_pemeriksaan ORDER BY id_pemeriksaan DESC LIMIT 1"); ?>
                                <?php $pecah = $data->fetch_assoc(); ?>
                                <label>Data Terakhir :</label>
                                <input type="text" class="form-control text-center"
                                    value="<?php echo $pecah['kd_pemeriksaan'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <form action="?aksi=pasien-pemeriksaan" method="post" enctype="multipart/form-data">
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
                                                <input type="text" name="kd_pemeriksaan" maxlength="10"
                                                    class="form-control" value="PRK-" id="" required
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
                                                     fw-normal text-dark">Pilih Pasien</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <select class="form-select" required aria-required="TRUE"
                                                    name="id_pendaftaran" onchange='changeValue(this.value)'>
                                                    <option value="0" disabled selected>Pilih Pasien</option>
                                                    <?php
                                                $ambil2 = $konfigs->query("SELECT * FROM tb_pendaftaran a
                                                    JOIN tb_pasien b ON a.id_pasien = b.id_pasien
                                                    JOIN tb_dokter c ON a.id_dokter = c.id_dokter
                                                    JOIN tb_poli d ON a.id_poli =  d.id_poli WHERE a.status = '0'");
                                                $dataArray = "var dataName = new Array();\n";
                                                ?>
                                                    <?php while ($daftar = $ambil2->fetch_array()) { ?>
                                                    <option value="<?php echo $daftar['id_pendaftaran']; ?>">
                                                        <?php echo $daftar['nm_pasien']; ?>
                                                    </option>
                                                    <?php
                                                    $dataArray .= "dataName['" . $daftar['id_pendaftaran'] . "'] = {
                                                        kd_pendaftaran:'" . $daftar['kd_pendaftaran'] . "',
                                                        nm_dokter:'" . $daftar['nm_dokter'] . "',
                                                        nm_poli:'" . $daftar['nm_poli'] . "',
                                                        tgl_pendaftaran:'" . $daftar['tgl_pendaftaran'] . "'
                                                    };\n";
                                                }
                                                ?>
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
                                                     fw-normal text-dark">Kode Pendaftaran</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <input type="text" name="kd_pendaftaran" maxlength="10"
                                                    class="form-control" id="kd_pendaftaran" required
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
                                                     fw-normal text-dark">Nama Dokter</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <input type="text" name="nm_dokter" readonly maxlength="30"
                                                    class="form-control" id="nm_dokter" required aria-required="TRUE">
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
                                                <input type="text" name="nm_poli" maxlength="30" class="form-control"
                                                    id="nm_poli" required readonly aria-required="TRUE">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Tanggal Pendaftaran</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <input type="date" name="tgl_pendaftaran"
                                                    class="form-control date-formate" readonly id="tgl_pendaftaran"
                                                    required aria-required="TRUE">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-start flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Keluhan</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <textarea name="keluhan" maxlength="255" rows="3" class="form-control"
                                                    required aria-required="TRUE" id=""></textarea>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-start flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Diagnosa</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <textarea name="diagnosa" maxlength="255" rows="3" class="form-control"
                                                    required aria-required="TRUE" id=""></textarea>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-group row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start fst-normal
                                                     fw-normal text-dark">Tanggal Pemeriksaan</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5 date-formate">
                                                <input type="date" readonly class="form-control" name="tgl_pemeriksaan"
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
                                            <a href="?page=pemeriksaan" aria-current="page"
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
        <script type="text/javascript">
        <?php echo $dataArray; ?>

        function changeValue(id) {
            document.getElementById('kd_pendaftaran').value = dataName[id].kd_pendaftaran;
            document.getElementById('nm_dokter').value = dataName[id].nm_dokter;
            document.getElementById('nm_poli').value = dataName[id].nm_poli;
            document.getElementById('tgl_pendaftaran').value = dataName[id].tgl_pendaftaran;
        };
        </script>
        <?php require_once("../ui/footer.php") ?>