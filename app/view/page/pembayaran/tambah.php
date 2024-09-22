<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "pembayaran"){
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
                            <a href="?page=pembayaran" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-pembayaran" aria-current="page"
                                class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-end align-items-center flex-wrap my-2">
                            <div class="col-sm-3 col-md-3">
                                <div class="btn-block disabled mx-4">
                                    <?php error_reporting(0); ?>
                                    <?php $data = $konfigs->query("SELECT * FROM tb_pembayaran ORDER BY kd_pembayaran DESC LIMIT 1"); ?>
                                    <?php $pecah = $data->fetch_assoc(); ?>
                                    <label>Data Terakhir :</label>
                                    <input type="text" class="form-control text-center"
                                        value="<?php echo $pecah['kd_pembayaran'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title text-center"><?php echo $title ?></h4>
                        <div class="border border-top border-dark"></div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-sm-10 col-md-10">
                                <form action="?aksi=pembayaran-tambah" class="rsp" method="post"
                                    enctype="multipart/form-data">
                                    <div class="form-group mt-1 mb-1">
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Kode Pembayaran</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" maxlength="10"
                                                    name="kd_pembayaran" value="TRA-" required>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Kode Resep</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="kd_resep" id="kd_resep"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">ID</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="id_resep" id="id_resep"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Pasien</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <select class="form-select" name="nm_pasien" id="nm_pasien"
                                                    onchange='dataResep(this.value)'>
                                                    <option value="0" disabled selected>Pilih Pasien</option>
                                                    <?php
                                                    $ambil2 = $konfigs->query("SELECT * FROM tb_resep a
                                                        JOIN tb_pemeriksaan b ON a.id_pemeriksaan = b.id_pemeriksaan
                                                        JOIN tb_pendaftaran c ON b.id_pendaftaran = c.id_pendaftaran
                                                        JOIN tb_pasien d ON c.id_pasien = d.id_pasien
                                                        JOIN tb_dokter e ON c.id_dokter = e.id_dokter
                                                        JOIN tb_poli f ON c.id_poli = f.id_poli WHERE a.status_rsp = '0'");
                                                    $dataArray = "var dataName = new Array();\n";
                                                    ?>
                                                    <?php while ($daftar = $ambil2->fetch_array()) { ?>
                                                    <option value="<?php echo $daftar['nm_pasien']; ?>">
                                                        <?php echo $daftar['nm_pasien']; ?>
                                                    </option>
                                                    <?php
                                                        $dataArray .= "dataName['" . $daftar['nm_pasien'] . "'] = {
                                                            id_resep:'" . $daftar['id_resep'] . "',
                                                            tarif_dokter:'" . $daftar['tarif_dokter'] . "',
                                                            nm_dokter:'" . $daftar['nm_dokter'] . "',
                                                            nm_poli:'" . $daftar['nm_poli'] . "',
                                                            nama_obt:'" . $daftar['nama_obt'] . "',
                                                            harga_obt:'" . $daftar['harga_obt'] . "',
                                                            jumlah_obt:'" . $daftar['jumlah_obt'] . "',
                                                            subharga_obt:'" . $daftar['subharga_obt'] . "',
                                                            total:'" . $daftar['total'] . "',
                                                            kd_resep:'" . $daftar['kd_resep'] . "'
                                                        };\n";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Poli Klinik</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="nm_poli" id="nm_poli"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Nama Dokter</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="nm_dokter" id="nm_dokter"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Tarif Dokter</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="tarif_dokter"
                                                    id="tarif_dokter" readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Obat</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="nama_obt" id="nama_obt"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Harga Obat</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="harga_obt" id="harga_obt"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Jumlah Obat</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="jumlah_obt"
                                                    id="jumlah_obt" readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Sub Total Obat</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="subharga_obt"
                                                    id="subharga_obt" readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Total Pembayaran</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="total" id="total" readonly
                                                    onkeyup="Hitung();">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Tanggal Pembayaran</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="tgl_pembayaran"
                                                    id="tgl_pembayaran" value="<?php echo date("Y-m-d"); ?>" required>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Sub Bayar</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="jumlah_bayar"
                                                    id="jumlah_bayar" onkeyup="Hitung();">
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="my-1"></div>
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Kembalian</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="kembalian" id="kembalian"
                                                    readonly>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="card-footer rounded-1 mt-1">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-outline-light">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span>Simpan data</span>
                                                </button>
                                                <a href="?page=pembayaran" aria-current="page"
                                                    class="btn btn-outline-light btn-secondary">Cancel</a>
                                                <button type="reset" class="btn btn-danger btn-outline-light">
                                                    <i class="fa fa-eraser fa-1x"></i>
                                                    <span>Hapus semua</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        function Hitung() {
            var total = document.getElementById('total').value;
            var jumlah_bayar = document.getElementById('jumlah_bayar').value;

            var hasil = parseFloat(jumlah_bayar) - parseFloat(total);
            if (!isNaN(hasil)) {
                document.getElementById('kembalian').value = hasil;
            };
        }
        </script>

        <script type="text/javascript">
        <?php echo $dataArray; ?>

        function dataResep(id) {
            document.getElementById('id_resep').value = dataName[id].id_resep;
            document.getElementById('tarif_dokter').value = dataName[id].tarif_dokter;
            document.getElementById('nm_dokter').value = dataName[id].nm_dokter;
            document.getElementById('nm_poli').value = dataName[id].nm_poli;
            document.getElementById('kd_resep').value = dataName[id].kd_resep;
            document.getElementById('nama_obt').value = dataName[id].nama_obt;
            document.getElementById('harga_obt').value = dataName[id].harga_obt;
            document.getElementById('jumlah_obt').value = dataName[id].jumlah_obt;
            document.getElementById('total').value = dataName[id].total;
            document.getElementById('subharga_obt').value = dataName[id].subharga_obt;
        };
        </script>
        <?php require_once("../ui/footer.php") ?>