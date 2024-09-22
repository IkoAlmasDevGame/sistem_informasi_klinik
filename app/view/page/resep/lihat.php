<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "pemeriksaan" || $_SESSION['jabatan'] == "admin"){
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
                            <a href="?page=resepobat" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=lihat-resepobat&id_resep=<?php echo $_GET['id_resep']?>" aria-current="page"
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
                <h4 class="card-title text-center"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">
                    <?php if(isset($_GET['id_resep'])): ?>
                    <?php $ambil = $konfigs->query("SELECT * FROM tb_resep a JOIN tb_pemeriksaan b ON a.id_pemeriksaan = b.id_pemeriksaan 
                        JOIN tb_pendaftaran c ON b.id_pendaftaran = c.id_pendaftaran JOIN tb_pasien d ON c.id_pasien = d.id_pasien 
                        JOIN tb_dokter e ON c.id_dokter = e.id_dokter JOIN tb_poli f ON f.id_poli = f.id_poli WHERE id_resep='$_GET[id_resep]'"); ?>
                    <?php $pecah = $ambil->fetch_assoc(); ?>
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="card col-sm-9 col-md-9">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                                <div class="col-md-9 fw-bold">
                                    Data Resep Obat : <?php echo $pecah['kd_resep']; ?>
                                </div>
                                <div class="col-md-2 fw-bold">
                                    <label>Status : </label>
                                    <?php if ($pecah['status_rsp'] == 0) { ?>
                                    <div class="badge badge-danger text-danger p-2">Belum Bayar</div>
                                    <?php } elseif ($pecah['status_rsp'] == 1) { ?>
                                    <div class="badge badge-success text-success p-2">Sudah Bayar</div>
                                    <?php } else { ?>
                                    <div class="badge badge-danger p-2">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--  -->
                                <div class="rsp">
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Kode Resep</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="kd_resep"
                                                value="<?php echo $pecah['kd_resep']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start 
                                                fst-normal fw-normal text-dark">ID
                                                Pendaftaran</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0"
                                                name="id_pendaftaran" value="<?php echo $pecah['id_pendaftaran']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Nama Pasien</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="nm_pasien"
                                                value="<?php echo $pecah['nm_pasien']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Nama Dokter</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="nm_dokter"
                                                value="<?php echo $pecah['nm_dokter']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Tarif Dokter</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="tarif_dokter"
                                                value="<?php echo "Rp. " . number_format($pecah['tarif_dokter']); ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Poli Klinik</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="nm_poli"
                                                value="<?php echo $pecah['nm_poli']; ?>" id="nm_poli" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Tanggal Daftar</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0"
                                                name="tgl_pendaftaran" value="<?php echo $pecah['tgl_pendaftaran']; ?>"
                                                id="tgl_pendaftaran" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Tanggal Periksa</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0"
                                                name="tgl_pemeriksaan" value="<?php echo $pecah['tgl_pemeriksaan']; ?>"
                                                id="tgl_pemeriksaan" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-start">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Keluhan</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <textarea class="form-control border border-0" name="keluhan" id="keluhan"
                                                rows="3" readonly><?php echo $pecah['keluhan']; ?></textarea>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-start">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Diagnosa</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <textarea class="form-control border border-0" name="diagnosa" id="diagnosa"
                                                rows="3" readonly><?php echo $pecah['diagnosa']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="my-2"></div>
                                    <!--  -->
                                    <div class="border border-top"></div>
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Obat</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="nama_obt"
                                                id="nama_obt" value="<?php echo $pecah['nama_obt']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Harga</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="harga_obt"
                                                id="harga_obt"
                                                value="<?php echo "Rp. " . number_format($pecah['harga_obt']); ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Jumlah</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="jumlah_obt"
                                                id="harga_obt" value="<?php echo $pecah['jumlah_obt']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Sub Harga Obat</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="subharga_obt"
                                                id="harga_obt"
                                                value="<?php echo "Rp. " . number_format($pecah['subharga_obt']); ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Total Bayar</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="total"
                                                id="total"
                                                value="<?php echo "Rp. " . number_format($pecah['total']); ?>" readonly>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <div class="form-group row justify-content-between flex-wrap align-items-start">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Keterangan</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <textarea class="form-control border border-0" name="keterangan"
                                                id="keterangan" rows="3"
                                                readonly><?php echo $pecah['keterangan']; ?></textarea>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="my-2"></div>
                                    <!--  -->
                                    <div class="form-group row justify-content-between flex-wrap align-items-center">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="" class="fs-5 display-5 text-start
                                             fst-normal fw-normal text-dark">Tanggal Resep</label>
                                        </div>
                                        <div class="col-sm-5 col-md-5">
                                            <input type="text" class="form-control border border-0" name="tgl_resep"
                                                value="<?php echo $pecah['tgl_resep']; ?>" id="tgl_resep" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <a href="?page=resepobat" aria-current="page"
                                            class="btn btn-default btn-outline-secondary">
                                            Kembali
                                        </a>
                                        <a href="?aksi=strukresep-obat&kd_resep=<?php echo $pecah['kd_resep']; ?>"
                                            aria-current="page" class="btn btn-secondary btn-outline-light">
                                            Struk Resep
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>