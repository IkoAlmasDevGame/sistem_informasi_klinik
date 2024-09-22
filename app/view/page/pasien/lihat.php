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
                            <a href="?aksi=lihat-pasien&id_pasien=<?php echo $_GET['id_pasien']?>" aria-current="page"
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
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="card col-sm-8 col-md-8">
                            <div class="card-header py-1">
                                <h4 class="card-title text-center"><?php echo $title ?></h4>
                            </div>
                            <?php if(isset($_GET['id_pasien'])): ?>
                            <div class="card-body">
                                <?php 
                                    $id = htmlspecialchars($_GET['id_pasien']);
                                    $sql = "SELECT * FROM tb_pasien WHERE id_pasien = '$id'";
                                    $data = $konfigs->query($sql);
                                while($pro = $data->fetch_assoc()){
                                    $exp = explode("-", $pro['tgl_lahir']);
                                ?>
                                <div class="form-group mt-1 mb-1">
                                    <!--  -->
                                    <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start 
                                            fst-normal fw-normal text-dark">Nama Pasien</label>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <input type="text" name="" value="<?php echo $pro['nm_pasien']?>" readonly
                                                required class="form-control border border-0 fs-5 display-5" id="">
                                        </div>
                                    </div>
                                    <div class="my-1"></div>
                                    <!--  -->
                                    <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start 
                                            fst-normal fw-normal text-dark">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <input type="text" name="" value="<?php echo $pro['jenis_kelamin']?>"
                                                readonly required class="form-control border border-0 fs-5 display-5"
                                                id="">
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
                                        <div class="col-sm-6 col-md-6">
                                            <input type="text" name=""
                                                value="<?php echo $exp[2]." / ".$exp[1]." / ".$exp[0] ?>" readonly
                                                required class="form-control border border-0 fs-5 display-5" id="">
                                        </div>
                                    </div>
                                    <div class="my-1"></div>
                                    <!--  -->
                                    <div class="form-inline row justify-content-center 
                                            align-items-start flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start 
                                            fst-normal fw-normal text-dark">Alamat Pasien</label>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <textarea name="" class="form-control border border-0" readonly
                                                style="height: 100px; min-height: 100%;"
                                                id=""><?php echo $pro['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                                <div class="card-footer rounded-1 mt-1">
                                    <div class="text-center">
                                        <?php if($_SESSION['jabatan'] == "admin"): ?>
                                        <a href="?page=pasien" aria-current="page"
                                            class="btn btn-outline-light btn-secondary">Cancel</a>
                                        <a href="?aksi=ubah-pasien&id_pasien=<?php echo $pro['id_pasien']?>"
                                            aria-current="page" class="btn btn-outline-light btn-secondary">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit Pasien</span>
                                        </a>
                                        <?php elseif($_SESSION['jabatan'] == "pendaftaran"): ?>
                                        <a href="?page=pasien" aria-current="page"
                                            class="btn btn-outline-light btn-secondary">Cancel</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>