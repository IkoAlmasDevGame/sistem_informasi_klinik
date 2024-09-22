<?php 
    namespace model;

    class Docter {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kode_dokter, $nm_dokter, $spesialis, $id_poli, $tarif_dokter){
            $kode_dokter = htmlentities($_POST['kd_dokter']) ? htmlspecialchars($_POST['kd_dokter']) : strip_tags($_POST['kd_dokter']);
            $nm_dokter = htmlentities($_POST['nm_dokter']) ? htmlspecialchars($_POST['nm_dokter']) : strip_tags($_POST['nm_dokter']);
            $spesialis = htmlentities($_POST['spesialis_dokter']) ? htmlspecialchars($_POST['spesialis_dokter']) : strip_tags($_POST['spesialis_dokter']);
            $id_poli = htmlentities($_POST['id_poli']) ? htmlspecialchars($_POST['id_poli']) : strip_tags($_POST['id_poli']);
            $tarif_dokter = htmlentities($_POST['tarif_dokter']) ? htmlspecialchars($_POST['tarif_dokter']) : strip_tags($_POST['tarif_dokter']);
            // DataBase
            $table = "tb_dokter";
            $select = $this->db->query("SELECT * FROM $table WHERE kd_dokter = '$kode_dokter' order by kd_dokter asc");

            if($select->num_rows){
                if($kode_dokter != ""){
                    echo "<script>alert('maaf kode dokter ini sudah ada, coba ganti kode dokter lainnya ...'); 
                    document.location.href = '../ui/header.php?aksi=tambah-dokter'</script>";
                    die;
                }
            }else{
                $insert = "INSERT INTO $table SET kd_dokter='$kode_dokter', nm_dokter='$nm_dokter', spesialis_dokter='$spesialis', id_poli='$id_poli', tarif_dokter='$tarif_dokter'";
                $data = $this->db->query($insert);
                if($data != ""){
                    if($data){
                        echo "<script>alert('selamat anda sudah berhasil menambahkan data dokter baru'); 
                        document.location.href = '../ui/header.php?page=dokter'</script>";
                        die; 
                    }
                }else{
                    echo "<script>alert('anda gagal menambahkan data dokter baru');
                     document.location.href = '../ui/header.php?aksi=tambah-dokter'</script>";
                    die;
                }
            }
        }

        public function update($kode_dokter, $nm_dokter, $spesialis, $tarif_dokter, $id_dokter){
            $kode_dokter = htmlentities($_POST['kd_dokter']) ? htmlspecialchars($_POST['kd_dokter']) : strip_tags($_POST['kd_dokter']);
            $nm_dokter = htmlentities($_POST['nm_dokter']) ? htmlspecialchars($_POST['nm_dokter']) : strip_tags($_POST['nm_dokter']);
            $spesialis = htmlentities($_POST['spesialis_dokter']) ? htmlspecialchars($_POST['spesialis_dokter']) : strip_tags($_POST['spesialis_dokter']);
            $tarif_dokter = htmlentities($_POST['tarif_dokter']) ? htmlspecialchars($_POST['tarif_dokter']) : strip_tags($_POST['tarif_dokter']);
            $id_dokter = htmlentities($_POST['id_dokter']) ? htmlspecialchars($_POST['id_dokter']) : strip_tags($_POST['id_dokter']);
            // DataBase
            $table = "tb_dokter";
            $update = "UPDATE $table SET kd_dokter='$kode_dokter', nm_dokter='$nm_dokter', spesialis_dokter='$spesialis', tarif_dokter='$tarif_dokter' WHERE id_dokter='$id_dokter'";
            $data = $this->db->query($update);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda berhasil mengubah data dokter dengan atas nama $nm_dokter');
                     document.location.href = '../ui/header.php?page=dokter'</script>";
                    die; 
                }
            }else{
                echo "<script>alert('Anda tidak berhasil mengubah data dokter di poli klinik islamic indonesia ini.'); 
                document.location.href = '../ui/header.php?aksi=ubah-dokter&id_dokter=$id_dokter';</script>";
                die;
            }
        }

        public function delete($id_dokter){
            $id_dokter = htmlentities($_GET['id_dokter']) ? htmlspecialchars($_GET['id_dokter']) : strip_tags($_GET['id_dokter']);
            // DataBase
            $table = "tb_dokter";
            $delete = "DELETE FROM $table WHERE id_dokter = '$id_dokter'";
            $data = $this->db->query($delete);
            if($data != ""){
                if($data){
                    echo "<script>alert('selamat anda berhasil menghapus dokter');
                     document.location.href = '../ui/header.php?page=dokter'</script>";
                    die; 
                }
            }else{
                echo "<script>alert('Anda tidak berhasil menghapus data dokter di poli klinik islamic indonesia ini.'); 
                document.location.href = '../ui/header.php?page=dokter';</script>";
                die;
            }
        }
    }
?>