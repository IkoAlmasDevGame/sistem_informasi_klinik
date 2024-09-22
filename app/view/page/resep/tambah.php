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
                            <a href="?page=resepobat" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title2 ?>
                            </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=tambah-resepobat" aria-current="page"
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
                        <div class="d-flex justify-content-end align-items-center flex-wrap my-2">
                            <div class="col-sm-3 col-md-3">
                                <div class="btn-block disabled mx-4">
                                    <?php error_reporting(0); ?>
                                    <?php $data = $konfigs->query("SELECT * FROM tb_resep ORDER BY id_resep DESC LIMIT 1"); ?>
                                    <?php $pecah = $data->fetch_assoc(); ?>
                                    <label>Data Terakhir :</label>
                                    <input type="text" class="form-control text-center"
                                        value="<?php echo $pecah['kd_resep'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title text-center"><?php echo $title ?></h4>
                        <div class="border border-top border-dark"></div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-sm-10 col-md-10">
                                <form action="?aksi=resepobat-tambah" enctype="multipart/form-data" class="rsp"
                                    method="post">
                                    <div class="form-group mt-1 mb-1">
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Kode Resep</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" maxlength="10" name="kd_resep"
                                                    value="RSP-" required>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">ID</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="id_pendaftaran"
                                                    id="id_pendaftaran" readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Pasien</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <select class="form-select" name="id_pemeriksaan" id="id_pemeriksaan"
                                                    onchange='dataPemeriksaan(this.value)'>
                                                    <option value="0" disabled selected>Pilih Pasien</option>
                                                    <?php
                                                $ambil2 = $konfigs->query("SELECT * FROM tb_pemeriksaan a
                                                    JOIN tb_pendaftaran b ON a.id_pendaftaran = b.id_pendaftaran
                                                    JOIN tb_pasien c ON b.id_pasien = c.id_pasien
                                                    JOIN tb_dokter d ON b.id_dokter = d.id_dokter
                                                    JOIN tb_poli e ON b.id_poli = e.id_poli WHERE a.status_periksa = '0'");
                                                $dataArray = "var dataName = new Array();\n";

                                                ?>
                                                    <?php while ($daftar = $ambil2->fetch_array()) { ?>
                                                    <option value="<?php echo $daftar['id_pemeriksaan']; ?>">
                                                        <?php echo $daftar['nm_pasien']; ?>
                                                    </option>
                                                    <?php
                                                    $dataArray .= "dataName['" . $daftar['id_pemeriksaan'] . "'] = {
                                                        tarif_dokter:'" . $daftar['tarif_dokter'] . "',
                                                        nm_dokter:'" . $daftar['nm_dokter'] . "',
                                                        nm_poli:'" . $daftar['nm_poli'] . "',
                                                        tgl_pendaftaran:'" . $daftar['tgl_pendaftaran'] . "',
                                                        tgl_pemeriksaan:'" . $daftar['tgl_pemeriksaan'] . "',
                                                        keluhan:'" . $daftar['keluhan'] . "',
                                                        diagnosa:'" . $daftar['diagnosa'] . "',
                                                        id_pendaftaran:'" . $daftar['id_pendaftaran'] . "'
                                                    };\n";
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
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
                                        <div class="my-2"></div>
                                        <!--  -->
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
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Poli</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="nm_poli" id="nm_poli"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Tanggal Daftar</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="date" class="form-control" name="tgl_pendaftaran"
                                                    id="tgl_pendaftaran" readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Tanggal Periksa</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="date" class="form-control" name="tgl_pemeriksaan"
                                                    id="tgl_pemeriksaan" readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Keluhan</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <textarea name="keluhan" class="form-control" readonly id="keluhan"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Diagnosa</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <textarea name="diagnosa" class="form-control" readonly id="diagnosa"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="border border-top border-dark"></div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Obat</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <select class="form-select" name="nama_obt" id="nm_obat"
                                                    onchange='dataObat(this.value)'>
                                                    <option value="0" disabled selected>Pilih Obat</option>
                                                    <?php
                                                    $ambil3 = $konfigs->query("SELECT * FROM tb_obat WHERE stok > 0");
                                                        $dataArray2 = "var dataName2 = new Array();\n";
                                                    ?>

                                                    <?php while ($obat = $ambil3->fetch_array()) { ?>
                                                    <option value="<?php echo $obat['nm_obat']; ?>">
                                                        <?php echo $obat['nm_obat']; ?> - <?php echo $obat['stok']; ?>
                                                        Stok
                                                    </option>
                                                    <?php
                                                    $dataArray2 .= "dataName2['" . $obat['nm_obat'] . "'] = {
                                                        harga_obat:'" . $obat['harga_obat'] . "', 
                                                        stok:'". $obat['stok'] ."'
                                                        };\n";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Harga</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="harga_obt" id="harga_obat"
                                                    onkeyup="Hitung();" readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Jumlah</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="jumlah_obt"
                                                    id="jumlah_obt" onkeyup="Hitung();">
                                                <input type="hidden" name="stok" readonly id="stok">
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Total Harga</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="text" class="form-control" name="subharga_obt"
                                                    id="subharga_obt" readonly>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="border border-top border-dark"></div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Keterangan</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <textarea name="keterangan" class="form-control" id=""
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <!--  -->
                                        <div hidden class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="fs-5 display-5 text-start 
                                                    fst-normal fw-normal text-dark">Tanggal Resep</label>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <input type="hidden" class="form-control" name="tgl_resep"
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
                                            <a href="?page=resepobat" aria-current="page"
                                                class="btn btn-outline-light btn-secondary">Cancel</a>
                                            <button type="reset" class="btn btn-danger btn-outline-light">
                                                <i class="fa fa-eraser fa-1x"></i>
                                                <span>Hapus semua</span>
                                            </button>
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
        $(".rsp").keyup(function() {
            var tarif_dokter = $("#tarif_dokter").val()
            var nm_dokter = $("#nm_dokter").val()
            var nm_poli = $("#nm_poli").val()
            var tgl_pendaftaran = $("#tgl_pendaftaran").val()
            var tgl_pemeriksaan = $("#tgl_pemeriksaan").val()
            var keluhan = $("#keluhan").val()
            var diagnosa = $("#diagnosa").val()
        });
        </script>
        <script type="text/javascript">
        function Hitung() {
            var harga_obat = document.getElementById('harga_obat').value;
            var jumlah_obt = document.getElementById('jumlah_obt').value;
            var hasil = parseFloat(harga_obat) * parseFloat(jumlah_obt);

            if (!isNaN(hasil)) {
                document.getElementById('subharga_obt').value = hasil;
            }
        }
        </script>

        <script type="text/javascript">
        <?php echo $dataArray; ?>

        function dataPemeriksaan(id) {
            document.getElementById('tarif_dokter').value = dataName[id].tarif_dokter;
            document.getElementById('nm_dokter').value = dataName[id].nm_dokter;
            document.getElementById('nm_poli').value = dataName[id].nm_poli;
            document.getElementById('tgl_pendaftaran').value = dataName[id].tgl_pendaftaran;
            document.getElementById('tgl_pemeriksaan').value = dataName[id].tgl_pemeriksaan;
            document.getElementById('keluhan').value = dataName[id].keluhan;
            document.getElementById('diagnosa').value = dataName[id].diagnosa;
            document.getElementById('id_pendaftaran').value = dataName[id].id_pendaftaran;
        };
        </script>

        <script type="text/javascript">
        <?php echo $dataArray2; ?>

        function dataObat(id) {
            document.getElementById('harga_obat').value = dataName2[id].harga_obat;
            document.getElementById('stok').value = dataName2[id].stok;
        };
        </script>
        <?php require_once("../ui/footer.php") ?>