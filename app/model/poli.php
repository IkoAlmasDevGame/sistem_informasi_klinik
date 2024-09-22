<?php 
    namespace model;

    class Poli {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kd_poli, $nm_poli){
            $kd_poli = htmlentities($_POST['kd_poli']) ? htmlspecialchars($_POST['kd_poli']) : strip_tags($_POST['kd_poli']);
            $nm_poli = htmlentities($_POST['nm_poli']) ? htmlspecialchars($_POST['nm_poli']) : strip_tags($_POST['nm_poli']);
            // Database
            $table = "tb_poli";
            $select = $this->db->query("SELECT * FROM $table WHERE kd_poli = '$kd_poli' order by kd_poli asc");
            if($select->num_rows){
                if($kd_poli != ""){
                    echo "<script>alert('Kode Poli sudah ada, coba ganti kode poli lainnya.');
                     document.location.href = '../ui/header.php?aksi=tambah-poli';</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET kd_poli = '$kd_poli', nm_poli = '$nm_poli'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah berhasil menambahkan poli klinik khusus dokter.');
                         document.location.href = '../ui/header.php?page=poli';</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('anda telah gagal menambahkan poli klinik khsusu dokter');
                     document.location.href = '../ui/header.php?aksi=tambah-poli';</script>";
                    die;
                }
            }
        }

        public function update($kd_poli, $nm_poli, $id_poli){
            $kd_poli = htmlentities($_POST['kd_poli']) ? htmlspecialchars($_POST['kd_poli']) : strip_tags($_POST['kd_poli']);
            $nm_poli = htmlentities($_POST['nm_poli']) ? htmlspecialchars($_POST['nm_poli']) : strip_tags($_POST['nm_poli']);
            $id_poli = htmlentities($_POST['id_poli']) ? htmlspecialchars($_POST['id_poli']) : strip_tags($_POST['id_poli']);
            // Database
            $table = "tb_poli";
            $update = "UPDATE $table SET kd_poli = '$kd_poli', nm_poli = '$nm_poli' WHERE id_poli = '$id_poli'";
            $data = $this->db->query($update);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda berhasil mengubah data poli klinik khsusus dokter.');
                     document.location.href = '../ui/header.php?page=poli';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda gagal mengubah data poli klinik.');
                 document.location.href = '../ui/header.php?aksi=ubah-poli&id_poli=$id_poli';</script>";
                die;
            }
        }

        public function delete($id_poli){
            $id_poli = htmlentities($_GET['id_poli']) ? htmlspecialchars($_GET['id_poli']) : strip_tags($_GET['id_poli']);
            // Database
            $table = "tb_poli";
            $delete = "DELETE FROM $table WHERE id_poli = '$id_poli'";
            $data = $this->db->query($delete);
            if($data != ""){
                if($data){
                    echo "<script>alert('anda berhasil menghapus data poli khusus dokter ini.');
                     document.location.href = '../ui/header.php?page=poli';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda gagal menghapus data poli khusus dokter.');
                 document.location.href = '../ui/header.php?page=poli';</script>";
                die;
            }
        }
    }
?>