<?php 
    namespace model;

    class Pemeriksaan {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kd_pemeriksaan, $id_pendaftaran, $keluhan, $diagnosa, $tgl_pemeriksaan){
            $kd_pemeriksaan = htmlentities($_POST['kd_pemeriksaan']) ? htmlspecialchars($_POST['kd_pemeriksaan']) : strip_tags($_POST['kd_pemeriksaan']);
            $id_pendaftaran = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
            $keluhan = htmlentities($_POST['keluhan']) ? htmlspecialchars($_POST['keluhan']) : strip_tags($_POST['keluhan']);
            $diagnosa = htmlentities($_POST['diagnosa']) ? htmlspecialchars($_POST['diagnosa']) : strip_tags($_POST['diagnosa']);
            $tgl_pemeriksaan = htmlentities($_POST['tgl_pemeriksaan']) ? htmlspecialchars($_POST['tgl_pemeriksaan']) : strip_tags($_POST['tgl_pemeriksaan']);
            #DataBase
            $select = $this->db->query("SELECT * FROM tb_pemeriksaan WHERE kd_pemeriksaan = '$kd_pemeriksaan' order by kd_pemeriksaan asc");
            if($select->num_rows){
                if($kd_pemeriksaan != ""){
                    echo "<script>alert('kode pemeriksaan pasien sudah ada, coba kode pemeriksaan yang lainnya.');
                     location = '../ui/header.php?aksi=tambah-pemeriksaan';</script>";
                    die;
                }
            }else{
                $sql = "UPDATE tb_pendaftaran SET status = '1' WHERE id_pendaftaran = '$id_pendaftaran';";
                $sql .= "INSERT INTO tb_pemeriksaan (id_pemeriksaan, kd_pemeriksaan, id_pendaftaran, keluhan, diagnosa, status_periksa, tgl_pemeriksaan)
                 VALUES ('', '$kd_pemeriksaan', '$id_pendaftaran', '$keluhan', '$diagnosa', '$tgl_pemeriksaan');";
                $data = mysqli_multi_query($this->db, $sql);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah di periksa oleh dokter \ndi Poliklinik Islamic Indonesia.');
                         document.location.href = '../ui/header.php?page=pemeriksaan';</script>";
                    }
                }else{
                    echo "<script>alert('paisen anda gagal di periksa oleh dokter.');
                     document.location.href = '../ui/header.php?aksi=tambah-pemeriksaan';</script>";
                }
            }
        }
    }
?>