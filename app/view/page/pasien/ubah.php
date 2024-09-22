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
                            <a href="?page=pasien" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=ubah-pasien&id_pasien=<?php echo $_GET['id_pasien']?>" aria-current="page"
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
                    <?php if(isset($_GET['id_pasien'])): ?>
                    <?php $data = $konfigs->query("SELECT * FROM tb_pasien WHERE id_pasien = '$_GET[id_pasien]'"); ?>
                    <?php while($pecah = mysqli_fetch_assoc($data)){ ?>
                    <form action="?aksi=pasien-ubah" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-8">
                                <div class="card-header py-1">
                                    <h4 class="card-title text-center"><?php echo $title ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mt-1 mb-1">
                                        <input type="hidden" name="id_pasien" value="<?php echo $pecah['id_pasien']?>">
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                     fst-normal fw-normal text-dark">Nama Pasien</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="nm_pasien"
                                                    value="<?php echo $pecah['nm_pasien']?>" maxlength="30" required
                                                    aria-required="TRUE" placeholder="masukkan nama pasien ..."
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                     fst-normal fw-normal text-dark">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <select name="jenis_kelamin" class="form-select" required
                                                    aria-required="TRUE" id="">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option <?php if($pecah['jenis_kelamin'] == "Laki-Laki"){?> selected
                                                        <?php } ?> value="Laki-Laki">Laki-Laki</option>
                                                    <option <?php if($pecah['jenis_kelamin'] == "Perempuan"){?> selected
                                                        <?php } ?> value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                     fst-normal fw-normal text-dark">Tanggal Lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <div class="date-formate">
                                                    <input type="date" name="tgl_lahir"
                                                        value="<?php echo $pecah['tgl_lahir']?>" class="form-control"
                                                        required aria-required="TRUE" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                     fst-normal fw-normal text-dark">Alamat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <textarea name="alamat" style="height: 100px; min-height: 100%;"
                                                    class="form-control" required aria-required="TRUE"
                                                    placeholder="masukkan alamat rumah pasien ..."
                                                    id=""><?php echo $pecah['alamat'] ?></textarea>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                    <div class="card-footer rounded-1 mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-outline-light">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Update data</span>
                                            </button>
                                            <a href="?page=pasien" aria-current="page"
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
                    <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>