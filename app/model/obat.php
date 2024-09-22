<?php 
    namespace model;

    class Obat {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kd_obat, $nm_obat, $jenis_obat, $stok, $harga, $exp_obat){
            $kd_obat = htmlentities($_POST['kd_obat']) ? htmlspecialchars($_POST['kd_obat']) : strip_tags($_POST['kd_obat']);
            $nm_obat = htmlentities($_POST['nm_obat']) ? htmlspecialchars($_POST['nm_obat']) : strip_tags($_POST['nm_obat']);
            $jenis_obat = htmlentities($_POST['jenis_obat']) ? htmlspecialchars($_POST['jenis_obat']) : strip_tags($_POST['jenis_obat']);
            $stok = htmlentities($_POST['stok']) ? htmlspecialchars($_POST['stok']) : strip_tags($_POST['stok']);
            $harga = htmlentities($_POST['harga_obat']) ? htmlspecialchars($_POST['harga_obat']) : strip_tags($_POST['harga_obat']);
            $exp_obat = htmlentities($_POST['exp_obat']) ? htmlspecialchars($_POST['exp_obat']) : strip_tags($_POST['exp_obat']);
            // DataBase
            $table = "tb_obat";
            $select = $this->db->query("SELECT * FROM $table WHERE kd_obat = '$kd_obat' order by kd_obat asc");
            
            if($select->num_rows){
                if($kd_obat != ""){
                    echo "<script>alert('maaf kode obat ini sudah tersedia dengan \nnama obat : $nm_obat, coba membuat kode lainnya.');
                     document.location.href = '../ui/header.php?aksi=tambah-obat';</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET kd_obat='$kd_obat', nm_obat='$nm_obat', jenis_obat='$jenis_obat', stok='$stok', harga_obat='$harga', exp_obat='$exp_obat'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah berhasil menambahkan obat di \nPoli klinik Islamic Indonesia.');
                         document.location.href = '../ui/header.php?page=obat';</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('maaf anda gagal menambahkan daftar obat di \nPoli klinik Islamic Indonesia.');
                     document.location.href = '../ui/header.php?aksi=tambah-obat';</script>";
                    die;
                }
            }
        }

        public function update($kd_obat, $nm_obat, $jenis_obat, $stok, $harga, $exp_obat, $id_obat){
            $kd_obat = htmlentities($_POST['kd_obat']) ? htmlspecialchars($_POST['kd_obat']) : strip_tags($_POST['kd_obat']);
            $nm_obat = htmlentities($_POST['nm_obat']) ? htmlspecialchars($_POST['nm_obat']) : strip_tags($_POST['nm_obat']);
            $jenis_obat = htmlentities($_POST['jenis_obat']) ? htmlspecialchars($_POST['jenis_obat']) : strip_tags($_POST['jenis_obat']);
            $stok = htmlentities($_POST['stok']) ? htmlspecialchars($_POST['stok']) : strip_tags($_POST['stok']);
            $harga = htmlentities($_POST['harga_obat']) ? htmlspecialchars($_POST['harga_obat']) : strip_tags($_POST['harga_obat']);
            $exp_obat = htmlentities($_POST['exp_obat']) ? htmlspecialchars($_POST['exp_obat']) : strip_tags($_POST['exp_obat']);
            $id_obat = htmlentities($_POST['id_obat']) ? htmlspecialchars($_POST['id_obat']) : strip_tags($_POST['id_obat']);
            // DataBase
            $table = "tb_obat";
            $update = "UPDATE $table SET kd_obat='$kd_obat', nm_obat='$nm_obat', jenis_obat='$jenis_obat', stok='$stok', harga_obat='$harga', exp_obat='$exp_obat' WHERE id_obat = '$id_obat'";
            $data = $this->db->query($update);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah berhasil mengubah obat di \nPoli klinik Islamic Indonesia.');
                     document.location.href = '../ui/header.php?page=obat';</script>";
                    die;
                }
            }else{
                echo "<script>alert('maaf anda gagal mengubah daftar obat di \nPoli klinik Islamic Indonesia.');
                 document.location.href = '../ui/header.php?aksi=ubah-obat&id_obat=$id_obat';</script>";
                die;
            }
        }

        public function delete($id_obat){
            $id_obat = htmlentities($_GET['id_obat']) ? htmlspecialchars($_GET['id_obat']) : strip_tags($_GET['id_obat']);
            // DataBase
            $table = "tb_obat";
            $delete = "DELETE FROM $table WHERE id_obat = '$id_obat'";
            $data = $this->db->query($delete);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah berhasil menghapus obat di \nPoli klinik Islamic Indonesia.');
                     document.location.href = '../ui/header.php?page=obat';</script>";
                    die;
                }
            }else{
                echo "<script>alert('maaf anda gagal menghapus daftar obat di \nPoli klinik Islamic Indonesia.');
                 document.location.href = '../ui/header.php?page=obat';</script>";
                die;
            }
        }
    }
?>