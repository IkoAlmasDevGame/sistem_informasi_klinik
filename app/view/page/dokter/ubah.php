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
                            <a href="?page=dokter" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=ubah-dokter&id_dokter=<?php echo $_GET['id_dokter']?>" aria-current="page"
                                class="text-decoration-none text-primary">
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
                <?php if(isset($_GET['id_dokter'])){ ?>
                <?php 
                    $id = htmlspecialchars($_GET['id_dokter']);
                    $sql = "SELECT * FROM tb_dokter JOIN tb_poli ON tb_dokter.id_poli = tb_poli.id_poli WHERE id_dokter = '$id'";
                    $data = $konfigs->query($sql);
                    while($pecah = $data->fetch_assoc()){    
                ?>
                <div class="table-responsive">
                    <form action="?aksi=ubah-docter" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-8">
                                <div class="card-header">
                                    <h4 class="card-title text-center"><?php echo $title ?></h4>
                                </div>
                                <div class="card-body mt-1 mt-lg-1">
                                    <input type="hidden" name="id_dokter" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Kode Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="kd_dokter"
                                                    value="<?php echo $pecah['kd_dokter']?>" class="form-control"
                                                    maxlength="10" required aria-required="TRUE"
                                                    placeholder="masukkan kode dokter ..." id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Nama Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="nm_dokter"
                                                    value="<?php echo $pecah['nm_dokter']?>" class="form-control"
                                                    maxlength="30" required aria-required="TRUE"
                                                    placeholder="masukkan nama dokter ..." id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Spesialis Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="spesialis_dokter"
                                                    value="<?php echo $pecah['spesialis_dokter']?>" class="form-control"
                                                    maxlength="25" required aria-required="TRUE"
                                                    placeholder="masukkan spesialis dokter ..." id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Poli Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="nm_poli" value="<?php echo $pecah['nm_poli']?>"
                                                    class="form-control" readonly required aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center 
                                            align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start
                                                 fw-normal fst-normal">Tarif Dokter</label>
                                            </div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="tarif_dokter"
                                                    value="<?php echo $pecah['tarif_dokter']?>" class="form-control"
                                                    maxlength="11" inputmode="numeric" required aria-required="TRUE"
                                                    placeholder="masukkan tarif dokter ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer rounded-1 mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-outline-light">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Update data</span>
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
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>