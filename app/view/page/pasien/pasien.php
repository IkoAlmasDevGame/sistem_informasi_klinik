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
                            <a href="?page=pasien" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container-fluid mb-4">
            <div class="card-header py-2">
                <h4 class="card-title fst-normal
                 fw-normal fs-5 text-dark">
                    <i class="fa fa-table fa-1x shadow"></i> <?php echo $title ?>
                </h4>
                <?php if($_SESSION['jabatan'] == "admin"): ?>
                <a href="?aksi=tambah-pasien" aria-current="page" class="btn btn-dark btn-outline-light">
                    <i class="fa fa-user-plus fa-1x"></i>
                    <span>Tambah Master Pasien</span>
                </a>
                <?php endif; ?>
            </div>
            <div class="card-body mt-1">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <select name="length" id="example1_length" aria-controls="example2_length" required>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">No</th>
                                        <th class="table-layout-2 text-center">Nama Pasien</th>
                                        <th class="table-layout-2 text-center">Jenis Kelamin</th>
                                        <th class="table-layout-2 text-center">Tanggal Lahir</th>
                                        <th class="table-layout-2 text-center">Alamat</th>
                                        <th class="table-layout-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php $data = $konfigs->query("SELECT * FROM tb_pasien"); ?>
                                    <?php while ($pecah = $data->fetch_assoc()) { ?>
                                    <?php $exp = explode("-", $pecah['tgl_lahir']); ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $nomor; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['nm_pasien']; ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $pecah['jenis_kelamin']; ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $exp[2]." / ".$exp[1]." / ".$exp[0] ?>
                                        </td>
                                        <td class="table-layout-2 text-center"><?php echo $pecah['alamat']; ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php if ($_SESSION["jabatan"] == 'admin') : ?>
                                            <a href="?aksi=lihat-pasien&id_pasien=<?php echo $pecah['id_pasien']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin melihat data pasien ini ?');"
                                                class="btn-primary btn-outline-light btn-sm btn">
                                                <i class="fas fa-eye"></i></i>
                                            </a>
                                            <a href="?aksi=ubah-pasien&id_pasien=<?php echo $pecah['id_pasien']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin mengedit data pasien ini ?');"
                                                class="btn-warning btn-sm btn">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="?aksi=pasien-hapus&id_pasien=<?php echo $pecah['id_pasien']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin menghapus data ini pasien ini ?');"
                                                class="btn-danger btn-outline-light btn-sm btn">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php elseif ($_SESSION["jabatan"] == 'pendaftaran') : ?>
                                            <a href="?aksi=lihat-pasien&id_pasien=<?php echo $pecah['id_pasien']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin melihat data pasien ini ?');"
                                                class="btn-primary btn-outline-light btn-sm btn">
                                                <i class="fas fa-eye"></i></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>