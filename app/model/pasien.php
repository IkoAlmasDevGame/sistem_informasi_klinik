<?php 
    namespace model;

    class Pasien {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($nama_pasien, $jenis_kelamin, $tgl_lahir, $alamat){
            $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
            $jenis_kelamin = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
            $tgl_lahir = htmlentities($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir']) : strip_tags($_POST['tgl_lahir']);
            $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : strip_tags($_POST['alamat']);
            // DataBase Table
            $table = "tb_pasien";
            $select = $this->db->query("SELECT * FROM $table WHERE nm_pasien = '$nama_pasien' order by nm_pasien asc");
            if($select->num_rows){
                if($nama_pasien != ""){
                    echo "<script>alert('mohon maaf nama pasien sudah ada di database poliklinik islamic indonesia.');
                     document.location.href = '../ui/header.php?page=tambah-pasien';</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET nm_pasien = '$nama_pasien', jenis_kelamin = '$jenis_kelamin', tgl_lahir = '$tgl_lahir', alamat = '$alamat'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah terdaftar di data pasien poliklinik islamic indonesia.');
                         document.location.href = '../ui/header.php?page=pasien';</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('anda gagal terdaftar di data pasien poliklinik islamic indonesia.');
                     document.location.href = '../ui/header.php?page=tambah-pasien';</script>";
                    die;
                }
            }
        }

        public function update($nama_pasien, $jenis_kelamin, $tgl_lahir, $alamat, $id_pasien){
            $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
            $jenis_kelamin = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
            $tgl_lahir = htmlentities($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir']) : strip_tags($_POST['tgl_lahir']);
            $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : strip_tags($_POST['alamat']);
            $id_pasien = htmlentities($_POST['id_pasien']) ? htmlspecialchars($_POST['id_pasien']) : strip_tags($_POST['id_pasien']);
            // DataBase Table
            $table = "tb_pasien";
            $update = "UPDATE $table SET nm_pasien = '$nama_pasien', jenis_kelamin = '$jenis_kelamin', tgl_lahir = '$tgl_lahir', alamat = '$alamat' WHERE id_pasien = '$id_pasien'";
            $data = $this->db->query($update);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah berhasil mengubah data pasien di poliklinik islamic indonesia.');
                     document.location.href = '../ui/header.php?page=pasien';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda gagal mengubah data pasien di poliklinik islamic indonesia.');
                 document.location.href = '../ui/header.php?page=obat-pasien&id_pasien=$id_pasien';</script>";
                die;
            }
        }

        public function delete($id_pasien){
            $id_pasien = htmlentities($_GET['id_pasien']) ? htmlspecialchars($_GET['id_pasien']) : strip_tags($_GET['id_pasien']);
            // DataBase Table
            $table = "tb_pasien";
            $delete = "DELETE FROM $table WHERE id_pasien = '$id_pasien'";
            $data = $this->db->query($delete);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah berhasil menghapus data pasien \ndi poliklinik islamic indonesia.');
                     document.location.href = '../ui/header.php?page=pasien';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda gagal menghapus data pasien di poliklinik islamic indonesia.');
                 document.location.href = '../ui/header.php?page=pasien';</script>";
                die;
            }
        }
    }
?>