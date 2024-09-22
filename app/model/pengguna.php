<?php 
    namespace model;

    class Authentication {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function update($email, $username, $password, $repassword, $nama, $jabatan, $id){
            $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
            $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
            $password = md5(htmlspecialchars($_POST['password']), false);
            $repassword = md5(htmlspecialchars($_POST['password']), false);
            $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
            $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
            $id = htmlentities($_POST['id_user']) ? htmlspecialchars($_POST['id_user']) : strip_tags($_POST['id_user']);
            // Database Tabel
            $table = "tb_user";
            // Database Create
            $update = "UPDATE $table SET email = '$email', username = '$username', password = '$password', repassword = '$repassword', nama = '$nama', jabatan = '$jabatan' WHERE id_user = '$id'";
            $data = $this->db->query($update);
            if($data != ""){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=karyawan'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=ubah-karyawan&id_user=$id'</script>";
                die;
            }
        }

        public function create($email, $username, $password, $repassword, $nama, $jabatan){
            $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
            $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
            $password = md5(htmlspecialchars($_POST['password']), false);
            $repassword = md5(htmlspecialchars($_POST['password']), false);
            $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
            $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
            // Database Tabel
            $table = "tb_user";
            // Database Create
            $select = $this->db->query("SELECT * FROM $table WHERE nama = '$nama' && email = '$email' && username = '$username'");
            $cekselect = mysqli_num_rows($select);
            if($cekselect){
                if($email != "" || $username != "" || $nama != ""){
                    echo "<script>alert('Maaf Nama Karyawan ini sudah ada ...');
                    document.location.href = '../ui/header.php?aksi=tambah-karyawan'</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET email = '$email', username = '$username', password = '$password', repassword = '$repassword', nama = '$nama', jabatan = '$jabatan'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah berhasil membuat akun baru karyawan \nPoli Klinik Islamic Indonesia'); 
                        document.location.href = '../ui/header.php?page=karyawan';</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('Maaf anda tidak berhasil membuat akun baru karyawan \nPoli Klinik Islamic Indonesia');
                    document.location.href = '../ui/header.php?aksi=tambah-karyawan'</script>";
                    die;
                }
            }
        }

        public function delete($id){
            $id = htmlentities($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : strip_tags($_GET['id_user']);
            $table = "tb_user";
            $delete = "DELETE FROM $table WHERE id_user = '$id'";
            $data = $this->db->query($delete);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah berhasil menghapus karyawan di \nPoli Klinik Islamic Indonesia');
                     document.location.href = '../ui/header.php?page=karyawan';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda gagal menghapus data karyawan di \nPoli Klinik Islamic Indonesia');
                 document.location.href = '../ui/header.php?page=karyawan';</script>";
                die;
            }
        }

        public function Login($userInput, $password){
            session_start();
            $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
            $password = md5(htmlspecialchars($_POST['password']), false);
            password_verify($password, PASSWORD_DEFAULT);

            if($userInput == "" || $password == ""){
                echo "<script>document.location.href = '../auth/index.php?info=kosong';</script>";
                die;
            }

            $table = "tb_user";
            $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' || email = '$userInput' and password = '$password'";
            $data = $this->db->query($sql);
            $cek = mysqli_num_rows($data);

            if($cek > 0){
                $response = array($userInput, $password);
                $response[$table] = $response;
                if($row = $data->fetch_assoc()){
                    if($row['jabatan'] == "superadmin"){
                        // SESSION DataBase
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['jabatan'] = "superadmin";
                        echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                    }elseif($row['jabatan'] == "admin"){
                        // SESSION DataBase
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['jabatan'] = "admin";
                        echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                    }elseif($row['jabatan'] == "pembayaran"){
                        // SESSION DataBase
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['jabatan'] = "pembayaran";
                        echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                    }elseif($row['jabatan'] == "pendaftaran"){
                        // SESSION DataBase
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['jabatan'] = "pendaftaran";
                        echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                    }elseif($row['jabatan'] == "pemeriksaan"){
                        // SESSION DataBase
                        $_SESSION['id'] = $row['id_user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['jabatan'] = "pemeriksaan";
                        echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                    }
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    $_COOKIE['cookies'] = $userInput;
                    setcookie($response[$table], $row, time() + (86400 * 30), "/");
                    array_push($response[$table], $row);
                    exit;
                }
            }else{
                $_SESSION['status'] = false;
                $_SERVER['HTTPS'] = "off";
                echo "<script>document.location.href = '../auth/index.php?info=gagal';</script>";
                exit;
            }
        }
    }
?>