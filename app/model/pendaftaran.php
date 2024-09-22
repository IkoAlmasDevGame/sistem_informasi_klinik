<?php 
    namespace model;

    class Pendaftaran {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kd_pendaftaran, $id_pasien, $id_dokter, $id_poli){
            $kd_pendaftaran = htmlspecialchars($_POST['kd_pendaftaran']) ? htmlentities($_POST['kd_pendaftaran']) : strip_tags($_POST['kd_pendaftaran']);
            $id_pasien = htmlspecialchars($_POST['id_pasien']) ? htmlentities($_POST['id_pasien']) : strip_tags($_POST['id_pasien']);
            $id_dokter = htmlspecialchars($_POST['id_dokter']) ? htmlentities($_POST['id_dokter']) : strip_tags($_POST['id_dokter']);
            $id_poli = htmlspecialchars($_POST['id_poli']) ? htmlentities($_POST['id_poli']) : strip_tags($_POST['id_poli']);
            $tgl_pendaftaran = htmlspecialchars($_POST['tgl_pendaftaran']) ? htmlentities($_POST['tgl_pendaftaran']) : strip_tags($_POST['tgl_pendaftaran']);
            # DataBase
            $table = "tb_pendaftaran";
            $select = $this->db->query("SELECT * FROM tb_pendaftaran WHERE kd_pendaftaran = '$kd_pendaftaran' order by kd_pendaftaran asc");
            if($select->num_rows){
                if($kd_pendaftaran != ""){
                    echo "<script>alert('kode pendaftaran antrian sudah ada coba, kode pendaftaran lainnya.');
                     document.location.href = '../ui/header.php?aksi=tambah-pendaftaran';</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET kd_pendaftaran = '$kd_pendaftaran', id_pasien = '$id_pasien', id_dokter = '$id_dokter', id_poli = '$id_poli', status = '0', tgl_pendaftaran = '$tgl_pendaftaran'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah membuat perjanjian pemeriksaan dokter');
                         document.location.href = '../ui/header.php?page=pendaftaran';</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('anda belum membuat pemeriksaan perjanjian pemeriksaan dokter');
                     document.location.href = '../ui/header.php?aksi=tambah-pendaftaran';</script>";
                    die;
                }
            }
        }

        public function cancel($id_pendaftaran){
            $id_pendaftaran = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
            # DataBase
            $table = "tb_pendaftaran";
            $cancel = "UPDATE $table SET status = '2' WHERE id_pendaftaran = '$id_pendaftaran'";
            $data = $this->db->query($cancel);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda sudah cancel perjanjian pendaftaran pemeriksaan dokter.+');
                     document.location.href = '../ui/header.php?page=pendaftaran';</script>";
                    die;
                }
            }else{
                echo "<script>alert('anda belum cancel perjanjian pendaftaran pemeriksaan dokter.');
                 document.location.href = '../ui/header.php?page=pendaftaran';</script>";
                die;
            }
        }
    }
?>