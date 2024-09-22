<?php 
    namespace model;

    class resepobat {
        protected $db;
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create($kd_resep, $id_pemeriksaan, $keterangan, $jumlah_obat, $subharga_obat){
            $kd_resep = htmlentities($_POST['kd_resep']) ? htmlspecialchars($_POST['kd_resep']) : strip_tags($_POST['kd_resep']);
            $id_pemeriksaan = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
            $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);
            $jumlah_obat = htmlentities($_POST['jumlah_obt']) ? htmlspecialchars($_POST['jumlah_obt']) : strip_tags($_POST['jumlah_obt']);
            $subharga_obat = htmlentities($_POST['subharga_obt']) ? htmlspecialchars($_POST['subharga_obt']) : strip_tags($_POST['subharga_obt']);
            $tgl_resep = htmlentities($_POST['tgl_resep']) ? htmlspecialchars($_POST['tgl_resep']) : strip_tags($_POST['tgl_resep']);
            # SubTotal Obat
            $total = (int)(strip_tags($_POST['subharga_obt'])+strip_tags($_POST['tarif_dokter']));
            $stokobat = (int)(strip_tags($_POST['stok'])-strip_tags($_POST['jumlah_obt']));
            $stok = (int)strip_tags($stokobat);
            # DataBase Table
            $select = $this->db->query("SELECT * FROM tb_resep WHERE kd_resep = '$kd_resep' order by kd_resep asc");
            $cek = mysqli_num_rows($select);
            if($cek){
                if($kd_resep != ""){
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-resepobat'; alert('Kode Resep sudah ada, coba kode resep lainnya.');</script>";
                    die;
                }
            }else{
                $sql = "UPDATE tb_pemeriksaan SET status_periksa = '1' WHERE id_pemeriksaan='$id_pemeriksaan';";
                $sql .= "INSERT INTO tb_resep SET kd_resep='$kd_resep', id_pemeriksaan='$id_pemeriksaan', keterangan='$keterangan', 
                nama_obt='$_POST[nama_obt]', harga_obt='$_POST[harga_obt]', jumlah_obt='$jumlah_obat', subharga_obt='$subharga_obat', tarif_dkt='$_POST[tarif_dokter]',
                total='$total', status_rsp='0', tgl_resep='$tgl_resep';";
                $this->db->query("UPDATE tb_obat SET stok = '$stok' WHERE nm_obat='$_POST[nama_obt]'");
                $data = $this->db->multi_query($sql);
                if($data != ""){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=resepobat'; alert('Data sudah ter-simpan di poliklinik islamic indonesia.');</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?aksi=tambah-resepobat'; alert('Data tidak ter-simpan di poliklinik islamic indonesia.');</script>";
                    die;
                }
            }
        }
    }
?>