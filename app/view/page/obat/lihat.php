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
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=lihat-obat&id_obat=<?php echo $_GET['id_obat']?>" aria-current="page"
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
                <div class="container">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-8">
                                <div class="card-header">
                                    <h4 class="card-title text-center"><?php echo $title ?></h4>
                                </div>
                                <?php if(isset($_GET['id_obat'])): ?>
                                <div class="card-body">
                                    <?php 
                                    $id = htmlspecialchars($_GET['id_obat']);
                                    $sql = "SELECT * FROM tb_obat WHERE id_obat = '$id'";
                                    $data = $konfigs->query($sql);
                                    while($pro = $data->fetch_assoc()){
                                    ?>
                                    <div class="form-group mt-1 mb-1">
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Kode Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="" class="form-control border border-0"
                                                    value="<?php echo $pro['kd_obat']?>" readonly required id=""
                                                    placeholder="masukkan kode obat ...">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Nama Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="" class="form-control border border-0"
                                                    value="<?php echo $pro['nm_obat']?>" readonly required id=""
                                                    placeholder="masukkan nama obat ...">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Jenis Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="" class="form-control border border-0"
                                                    value="<?php echo $pro['jenis_obat']?>" readonly required id=""
                                                    placeholder="masukkan jenis obat ...">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Stok Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="" class="form-control border border-0"
                                                    value="<?php echo $pro['stok']?>" readonly required id=""
                                                    placeholder="masukkan stok obat ...">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Harga Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="" class="form-control border border-0"
                                                    value="Rp. <?php echo number_format($pro['harga_obat'])?>" readonly
                                                    required id="" placeholder="masukkan harga obat ...">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Expired Obat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="date" name="" class="form-control border border-0"
                                                    value="<?php echo $pro['exp_obat']?>" readonly required id=""
                                                    placeholder="masukkan expired obat ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <a href="?page=obat" aria-current="page"
                                                class="btn btn-outline-light btn-secondary">Cancel</a>
                                            <a href="?aksi=ubah-obat&id_obat=<?php echo $pro['id_obat']?>"
                                                onclick="return confirm('Apakah anda ingin mengedit data obat ini ?');"
                                                aria-current="page" class="btn-warning btn-outline-light btn">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit Obat</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>