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
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.getElementById('passwrd');
            const repassword = document.getElementById('repasswrd');
            const error = document.getElementById('error');
            const success = document.getElementById('success');

            function validatePasswords() {
                if (password.value === repassword.value &&
                    password.value !== '' && repassword.value !== '') {
                    success.style.display = 'block';
                    error.style.display = 'none';
                } else {
                    success.style.display = 'none';
                    if (password.value === '' || repassword.value === '') {
                        error.style.display = 'none';
                    } else {
                        error.style.display = 'block';
                    }
                }
            }
            // Menambahkan event listener untuk 'keyup' pada kedua input
            password.addEventListener('keyup', validatePasswords);
            repassword.addEventListener('keyup', validatePasswords);
            // Opsional: Validasi saat input kehilangan fokus
            password.addEventListener('blur', validatePasswords);
            repassword.addEventListener('blur', validatePasswords);
        });
        </script>
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
                            <a href="?aksi=tambah-karyawan" aria-current="page"
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
            <div class="card-body mt-1 mt-lg-1">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <form action="?aksi=tambah-people" method="post">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-8 col-md-8 shadow shadow-sm bg-body-secondary">
                                    <div class="card-header shadow shadow-lg">
                                        <h4 class="card-title text-center"><?php echo $title ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mt-1 mt-lg-1">
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">E - mail</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="email" name="email" required aria-required="TRUE"
                                                        class="form-control" maxlength="100"
                                                        placeholder="masukkan email karyawan baru ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mt-lg-1">
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">User Name</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="username" required aria-required="TRUE"
                                                        class="form-control" maxlength="100"
                                                        placeholder="masukkan username karyawan baru ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mt-lg-1">
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">Kata Sandi</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="password" name="password" required aria-required="TRUE"
                                                        class="form-control" maxlength="255"
                                                        placeholder="masukkan kata sandi karyawan baru ..."
                                                        id="passwrd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mt-lg-1">
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">Ulangi Kata Sandi</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="password" name="repassword" required
                                                        aria-required="TRUE" class="form-control" maxlength="255"
                                                        placeholder="masukkan ulang kata sandi karyawan baru ..."
                                                        id="repasswrd">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-end 
                                                flex-wrap me-4 me-lg-5">
                                                <p style="color: salmon; display: none; " id="error">
                                                    Password dan Repassword anda tidak cocok</p>
                                                <p style="color: green; display: none;" id="success">
                                                    Password dan Repassword anda cocok
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mt-lg-1">
                                            <div class="form-inline row justify-content-center
                                                 align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">Nama Karyawan</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="nama" required aria-required="TRUE"
                                                        class="form-control" maxlength="80"
                                                        placeholder="masukkan nama karyawan ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="fs-5 text-dark text-start 
                                                        fst-normal fw-normal">Jabatan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <select name="jabatan" required aria-required="TRUE"
                                                        aria-disabled="false" class="form-select" id="">
                                                        <option value="">Pilih Jabatan</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="pembayaran">Pembayaran</option>
                                                        <option value="pendaftaran">Pendaftaran</option>
                                                        <option value="pemeriksaan">Pemeriksaan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer rounded-1 mt-1">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-outline-light">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span>Simpan data</span>
                                                </button>
                                                <a href="?page=beranda" aria-current="page"
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