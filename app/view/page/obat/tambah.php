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
        <script type="text/javascript">
        function rupiah() {
            var uang = document.getElementById('nominal').value;
            uang = Intl.NumberFormat('id-ID', {
                style: "currency",
                currency: "IDR"
            }).format(uang).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            var rupiah = document.getElementById("rupiahText");
            rupiah.innerText = uang;
        }
        </script>
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
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-obat" aria-current="page" class="text-decoration-none text-primary">
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
                    <div class="container">
                        <form action="?aksi=obat-tambah" enctype="multipart/form-data" method="post">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-8 col-md-8">
                                    <div class="card-header py-1">
                                        <h4 class="card-title text-center"><?php echo $title ?></h4>
                                    </div>
                                    <div class="card-body mt-lg-2 mt-2">
                                        <div class="form-group">
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Kode Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="kd_obat" maxlength="10"
                                                        placeholder="masukkan kode obat ..." class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                            <div class="my-1"></div>
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Nama Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="nm_obat" maxlength="30"
                                                        placeholder="masukkan nama obat ..." class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                            <div class="my-1"></div>
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Jenis Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="jenis_obat" maxlength="25"
                                                        placeholder="masukkan jenis obat ..." class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                            <div class="my-1"></div>
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Stok Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="stok" maxlength="11" inputmode="numeric"
                                                        placeholder="masukkan stok obat ..." class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                            <div class="my-1"></div>
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Harga Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="harga_obat" maxlength="11"
                                                        placeholder="masukkan harga obat ..." class="form-control"
                                                        required aria-required="TRUE" onkeyup="rupiah(this)"
                                                        id="nominal">
                                                    <small id="rupiahText"></small>
                                                </div>
                                            </div>
                                            <div class="my-1"></div>
                                            <!--  -->
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 display-5 text-start fst-normal
                                                         fw-normal text-dark">Exp Obat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="date" name="exp_obat"
                                                        placeholder="masukkan exp obat ..." class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer rounded-1 mt-1">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-outline-light">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span>Simpan data</span>
                                                </button>
                                                <a href="?page=obat" aria-current="page"
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
        </div>
        <?php require_once("../ui/footer.php") ?>