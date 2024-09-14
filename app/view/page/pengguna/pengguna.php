<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['jabatan'] == "superadmin"){
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
                            <a href="?page=karyawan" aria-current="page" class="text-decoration-none text-primary">
                                <?php echo $title ?>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container-fluid mb-4 mb-lg-4">
            <div class="card-header py-2">
                <h4 class="card-title fs-5 fw-normal fst-normal"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-1 mt-lg-1">
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
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">Nama Pengguna</th>
                                        <th class="table-layout-2 text-center">User Name</th>
                                        <th class="table-layout-2 text-center">Email Pengguna</th>
                                        <th class="table-layout-2 text-center">Password</th>
                                        <th class="table-layout-2 text-center">Jabatan</th>
                                        <th class="table-layout-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM tb_user where jabatan = 'admin' or jabatan = 'pembayaran' or jabatan = 'pendaftaran' or jabatan = 'pemeriksaan' order by id_user asc";
                                        $data = $config->prepare($sql);
                                        $data->execute();
                                    foreach($data as $isi){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nama'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['username'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['email'] ?></td>
                                        <td class="table-layout-2 text-center">Password Ter-Enkripsi</td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['jabatan'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=hapus-people&id_user=<?=$isi['id_user']?>"
                                                onclick="return confirm('apakah anda ingin hapus karyawan ini ?')"
                                                aria-current="page" class="btn btn-sm btn-secondary btn-outline-danger">
                                                <i class="fa fa-1x fa-trash"></i>
                                            </a>
                                            <a href="?aksi=ubah-karyawan&id_user=<?=$isi['id_user']?>"
                                                onclick="return confirm('Apakah anda ingin edit karyawan ini ?')"
                                                aria-current="page" class="btn btn-sm btn-secondary btn-outline-light">
                                                <i class="fa fa-1x fa-pen-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>