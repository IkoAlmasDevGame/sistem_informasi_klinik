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
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-dokter" aria-current="page" class="text-decoration-none text-primary">
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
                    <form action="?aksi=tambah-docter" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-8">
                                <div class="card-header">
                                    <h4 class="card-title text-center"><?php echo $title ?></h4>
                                </div>
                                <div class="card-body mt-1 mt-lg-1">
                                    <div class="form-group">
                                        <div
                                            class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Kode Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="kd_dokter" class="form-control" maxlength="10"
                                                    required aria-required="TRUE" placeholder="masukkan kode dokter ..."
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div
                                            class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Nama Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="nm_dokter" class="form-control" maxlength="30"
                                                    required aria-required="TRUE" placeholder="masukkan nama dokter ..."
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div
                                            class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Spesialis Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="spesialis_dokter" class="form-control"
                                                    maxlength="25" required aria-required="TRUE"
                                                    placeholder="masukkan spesialis dokter ..." id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div
                                            class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Poli Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <select name="id_poli" class="form-select" required id="">
                                                    <option value="">Pilih Poli Dokter</option>
                                                    <?php 
                                                $sql = "SELECT * FROM tb_poli order by id_poli asc";
                                                $data = $konfigs->query($sql);
                                                while($pecah = $data->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $pecah['id_poli']?>">
                                                        <?php echo $pecah['nm_poli']?>
                                                    </option>
                                                    <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div
                                            class="form-inline row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Tarif Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="tarif_dokter" class="form-control"
                                                    maxlength="11" inputmode="numeric" required aria-required="TRUE"
                                                    placeholder="masukkan tarif dokter ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer rounded-1 mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-outline-light">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Simpan data</span>
                                            </button>
                                            <a href="?page=dokter" aria-current="page"
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