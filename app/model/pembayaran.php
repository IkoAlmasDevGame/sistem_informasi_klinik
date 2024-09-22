<?php 
    namespace model;

    class CashPayment {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function payment($kd_pembayaran,$id_resep,$nama_pasien,$total_pembayaran,$jumlah_bayar,$kembalian,$tgl_pembayaran){
            $kd_pembayaran = htmlentities($_POST['kd_pembayaran']) ? htmlspecialchars($_POST['kd_pembayaran']) : strip_tags($_POST['kd_pembayaran']);
            $id_resep = htmlentities($_POST['id_resep']) ? htmlspecialchars($_POST['id_resep']) : strip_tags($_POST['id_resep']);
            $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
            $total_pembayaran = htmlentities($_POST['total']) ? htmlspecialchars($_POST['total']) : strip_tags($_POST['total']);
            $jumlah_bayar = htmlentities($_POST['jumlah_bayar']) ? htmlspecialchars($_POST['jumlah_bayar']) : strip_tags($_POST['jumlah_bayar']);
            $kembalian = htmlentities($_POST['kembalian']) ? htmlspecialchars($_POST['kembalian']) : strip_tags($_POST['kembalian']);
            $tgl_pembayaran = htmlentities($_POST['tgl_pembayaran']) ? htmlspecialchars($_POST['tgl_pembayaran']) : strip_tags($_POST['tgl_pembayaran']);
            # DataBase
            $table = "tb_pembayaran";
            $select = $this->db->query("SELECT * FROM $table WHERE kd_pembayaran = '$kd_pembayaran' order by kd_pembayaran asc");
            $cek = mysqli_num_rows($select);

            if($cek){
                if($kd_pembayaran != ""){
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pembayaran'; alert('kode pembayaran telah ada, coba ganti kode pembayaran lainnya.');</script>";
                    die;
                }
            }else{
                $sql = "INSERT INTO $table (kd_pembayaran, id_resep, nama_pasien, total_pembayaran, jumlah_bayar, kembalian, tgl_pembayaran, status_pembayaran)
                  VALUES ('$kd_pembayaran', '$id_resep', '$nama_pasien', '$total_pembayaran', '$jumlah_bayar', '$kembalian', '$tgl_pembayaran', '1')";
                $this->db->query("UPDATE tb_resep SET status_rsp = '1' WHERE id_resep = '$id_resep'");
                $data = $this->db->query($sql);
                if($data != ""){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=pembayaran'; alert('transaksi pembayaran berhasil');</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-pembayaran'; alert('transaksi pembayaran gagal');</script>";
                    die;
                }
            }
        }
    }
?>