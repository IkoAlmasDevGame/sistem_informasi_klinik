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
                            <a href="?page=poli" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-poli" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container-fluid mb-4">
            <div class="card-header py-2">
                <h4 class="card-title"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-1">
                <form action="?aksi=poli-tambah" method="post">
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="card col-sm-8 col-md-8">
                            <div class="card-header">
                                <h4 class="card-title text-center"><?php echo $title ?></h4>
                            </div>
                            <div class="card-body mt-1 mt-lg-1">
                                <div class="form-group mt-1 mb-1">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Kode Poli</label>
                                        </div>
                                        <div class="col-sm-7 col-md-7">
                                            <input type="text" name="kd_poli" class="form-control" maxlength="10"
                                                required aria-required="TRUE" placeholder="masukkan kode poliklinik ..."
                                                id="">
                                        </div>
                                    </div>
                                    <div class="my-1"></div>
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Nama Poli</label>
                                        </div>
                                        <div class="col-sm-7 col-md-7">
                                            <input type="text" name="nm_poli" class="form-control" maxlength="30"
                                                required aria-required="TRUE" placeholder="masukkan nama poliklinik ..."
                                                id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-1 mt-1">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-outline-light">
                                            <i class="fa fa-save fa-1x"></i>
                                            <span>Simpan data</span>
                                        </button>
                                        <a href="?page=beranda" aria-current="page"
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
        <?php require_once("../ui/footer.php") ?>