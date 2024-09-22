<?php 
namespace controller;

use model\Authentication; //Pengguna
use model\Docter; //Dokter
use model\Poli; //polyclinic
use model\Obat; //drug
use model\Pasien; //people
use model\Pendaftaran; //registerd
use model\Pemeriksaan; //examination
use model\resepobat; // Prescription
use model\CashPayment; // Payment

class Pengguna {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Authentication($konfig);
    }

    public function buat(){
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
        $data = $this->konfig->create($email, $username, $password, $repassword, $nama, $jabatan);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : strip_tags($_GET['id_user']);
        $data = $this->konfig->delete($id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
        $id = htmlentities($_POST['id_user']) ? htmlspecialchars($_POST['id_user']) : strip_tags($_POST['id_user']);
        $data = $this->konfig->update($email, $username, $password, $repassword, $nama, $jabatan, $id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function SignIn(){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfig->Login($userInput,$password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Dokter {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Docter($konfig);
    }

    public function buat(){
        $kode_dokter = htmlentities($_POST['kd_dokter']) ? htmlspecialchars($_POST['kd_dokter']) : strip_tags($_POST['kd_dokter']);
        $nm_dokter = htmlentities($_POST['nm_dokter']) ? htmlspecialchars($_POST['nm_dokter']) : strip_tags($_POST['nm_dokter']);
        $spesialis = htmlentities($_POST['spesialis_dokter']) ? htmlspecialchars($_POST['spesialis_dokter']) : strip_tags($_POST['spesialis_dokter']);
        $id_poli = htmlentities($_POST['id_poli']) ? htmlspecialchars($_POST['id_poli']) : strip_tags($_POST['id_poli']);
        $tarif_dokter = htmlentities($_POST['tarif_dokter']) ? htmlspecialchars($_POST['tarif_dokter']) : strip_tags($_POST['tarif_dokter']);
        $data = $this->konfig->create($kode_dokter, $nm_dokter, $spesialis, $id_poli, $tarif_dokter);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kode_dokter = htmlentities($_POST['kd_dokter']) ? htmlspecialchars($_POST['kd_dokter']) : strip_tags($_POST['kd_dokter']);
        $nm_dokter = htmlentities($_POST['nm_dokter']) ? htmlspecialchars($_POST['nm_dokter']) : strip_tags($_POST['nm_dokter']);
        $spesialis = htmlentities($_POST['spesialis_dokter']) ? htmlspecialchars($_POST['spesialis_dokter']) : strip_tags($_POST['spesialis_dokter']);
        $tarif_dokter = htmlentities($_POST['tarif_dokter']) ? htmlspecialchars($_POST['tarif_dokter']) : strip_tags($_POST['tarif_dokter']);
        $id_dokter = htmlentities($_POST['id_dokter']) ? htmlspecialchars($_POST['id_dokter']) : strip_tags($_POST['id_dokter']);
        $data = $this->konfig->update($kode_dokter, $nm_dokter, $spesialis, $tarif_dokter, $id_dokter);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_dokter = htmlentities($_GET['id_dokter']) ? htmlspecialchars($_GET['id_dokter']) : strip_tags($_GET['id_dokter']);
        $data = $this->konfig->delete($id_dokter);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class polyclinic {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Poli($konfig);
    }

    public function buat(){
        $kd_poli = htmlentities($_POST['kd_poli']) ? htmlspecialchars($_POST['kd_poli']) : strip_tags($_POST['kd_poli']);
        $nm_poli = htmlentities($_POST['nm_poli']) ? htmlspecialchars($_POST['nm_poli']) : strip_tags($_POST['nm_poli']);
        $data = $this->konfig->create($kd_poli,$nm_poli);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kd_poli = htmlentities($_POST['kd_poli']) ? htmlspecialchars($_POST['kd_poli']) : strip_tags($_POST['kd_poli']);
        $nm_poli = htmlentities($_POST['nm_poli']) ? htmlspecialchars($_POST['nm_poli']) : strip_tags($_POST['nm_poli']);
        $id_poli = htmlentities($_POST['id_poli']) ? htmlspecialchars($_POST['id_poli']) : strip_tags($_POST['id_poli']);
        $data = $this->konfig->create($kd_poli,$nm_poli,$id_poli);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_poli = htmlentities($_GET['id_poli']) ? htmlspecialchars($_GET['id_poli']) : strip_tags($_GET['id_poli']);
        $data = $this->konfig->delete($id_poli);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Drug {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Obat($konfig);
    }

    public function buat(){
        $kd_obat = htmlentities($_POST['kd_obat']) ? htmlspecialchars($_POST['kd_obat']) : strip_tags($_POST['kd_obat']);
        $nm_obat = htmlentities($_POST['nm_obat']) ? htmlspecialchars($_POST['nm_obat']) : strip_tags($_POST['nm_obat']);
        $jenis_obat = htmlentities($_POST['jenis_obat']) ? htmlspecialchars($_POST['jenis_obat']) : strip_tags($_POST['jenis_obat']);
        $stok = htmlentities($_POST['stok']) ? htmlspecialchars($_POST['stok']) : strip_tags($_POST['stok']);
        $harga = htmlentities($_POST['harga_obat']) ? htmlspecialchars($_POST['harga_obat']) : strip_tags($_POST['harga_obat']);
        $exp_obat = htmlentities($_POST['exp_obat']) ? htmlspecialchars($_POST['exp_obat']) : strip_tags($_POST['exp_obat']);
        $data = $this->konfig->create($kd_obat, $nm_obat, $jenis_obat, $stok, $harga, $exp_obat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kd_obat = htmlentities($_POST['kd_obat']) ? htmlspecialchars($_POST['kd_obat']) : strip_tags($_POST['kd_obat']);
        $nm_obat = htmlentities($_POST['nm_obat']) ? htmlspecialchars($_POST['nm_obat']) : strip_tags($_POST['nm_obat']);
        $jenis_obat = htmlentities($_POST['jenis_obat']) ? htmlspecialchars($_POST['jenis_obat']) : strip_tags($_POST['jenis_obat']);
        $stok = htmlentities($_POST['stok']) ? htmlspecialchars($_POST['stok']) : strip_tags($_POST['stok']);
        $harga = htmlentities($_POST['harga_obat']) ? htmlspecialchars($_POST['harga_obat']) : strip_tags($_POST['harga_obat']);
        $exp_obat = htmlentities($_POST['exp_obat']) ? htmlspecialchars($_POST['exp_obat']) : strip_tags($_POST['exp_obat']);
        $id_obat = htmlentities($_POST['id_obat']) ? htmlspecialchars($_POST['id_obat']) : strip_tags($_POST['id_obat']);
        $data = $this->konfig->update($kd_obat, $nm_obat, $jenis_obat, $stok, $harga, $exp_obat, $id_obat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_obat = htmlentities($_GET['id_obat']) ? htmlspecialchars($_GET['id_obat']) : strip_tags($_GET['id_obat']);
        $data = $this->konfig->delete($id_obat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class people {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pasien($konfig);
    }

    public function buat(){
        $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
        $jenis_kelamin = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $tgl_lahir = htmlentities($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir']) : strip_tags($_POST['tgl_lahir']);
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : strip_tags($_POST['alamat']);
        $data = $this->konfig->create($nama_pasien, $jenis_kelamin, $tgl_lahir, $alamat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
        $jenis_kelamin = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $tgl_lahir = htmlentities($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir']) : strip_tags($_POST['tgl_lahir']);
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : strip_tags($_POST['alamat']);
        $id_pasien = htmlentities($_POST['id_pasien']) ? htmlspecialchars($_POST['id_pasien']) : strip_tags($_POST['id_pasien']);
        $data = $this->konfig->update($nama_pasien, $jenis_kelamin, $tgl_lahir, $alamat, $id_pasien);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_pasien = htmlentities($_GET['id_pasien']) ? htmlspecialchars($_GET['id_pasien']) : strip_tags($_GET['id_pasien']);
        $data = $this->konfig->delete($id_pasien);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Registerd {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pendaftaran($konfig);
    }

    public function daftar(){
        $kd_pendaftaran = htmlspecialchars($_POST['kd_pendaftaran']) ? htmlentities($_POST['kd_pendaftaran']) : strip_tags($_POST['kd_pendaftaran']);
        $id_pasien = htmlspecialchars($_POST['id_pasien']) ? htmlentities($_POST['id_pasien']) : strip_tags($_POST['id_pasien']);
        $id_dokter = htmlspecialchars($_POST['id_dokter']) ? htmlentities($_POST['id_dokter']) : strip_tags($_POST['id_dokter']);
        $id_poli = htmlspecialchars($_POST['id_poli']) ? htmlentities($_POST['id_poli']) : strip_tags($_POST['id_poli']);
        $data = $this->konfig->create($kd_pendaftaran, $id_pasien, $id_dokter, $id_poli);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function batal(){
        $id_pendaftaran = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
        $data = $this->konfig->cancel($id_pendaftaran);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Examination {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pemeriksaan($konfig);
    }

    public function pemeriksa(){
        $kd_pemeriksaan = htmlentities($_POST['kd_pemeriksaan']) ? htmlspecialchars($_POST['kd_pemeriksaan']) : strip_tags($_POST['kd_pemeriksaan']);
        $id_pendaftaran = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
        $keluhan = htmlentities($_POST['keluhan']) ? htmlspecialchars($_POST['keluhan']) : strip_tags($_POST['keluhan']);
        $diagnosa = htmlentities($_POST['diagnosa']) ? htmlspecialchars($_POST['diagnosa']) : strip_tags($_POST['diagnosa']);
        $tgl_pemeriksaan = htmlentities($_POST['tgl_pemeriksaan']) ? htmlspecialchars($_POST['tgl_pemeriksaan']) : strip_tags($_POST['tgl_pemeriksaan']);
        $data = $this->konfig->create($kd_pemeriksaan, $id_pendaftaran, $keluhan, $diagnosa, $tgl_pemeriksaan);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Prescription {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new resepobat($konfig);
    }

    public function rspobat(){
        $kd_resep = htmlentities($_POST['kd_resep']) ? htmlspecialchars($_POST['kd_resep']) : strip_tags($_POST['kd_resep']);
        $id_pemeriksaan = htmlentities($_POST['id_pendaftaran']) ? htmlspecialchars($_POST['id_pendaftaran']) : strip_tags($_POST['id_pendaftaran']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $jumlah_obat = htmlentities($_POST['jumlah_obt']) ? htmlspecialchars($_POST['jumlah_obt']) : strip_tags($_POST['jumlah_obt']);
        $subharga_obat = htmlentities($_POST['subharga_obt']) ? htmlspecialchars($_POST['subharga_obt']) : strip_tags($_POST['subharga_obt']);
        $data = $this->konfig->create($kd_resep, $id_pemeriksaan, $keterangan, $jumlah_obat, $subharga_obat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class payment {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new CashPayment($konfig);
    }

    public function bayar(){
        $kd_pembayaran = htmlentities($_POST['kd_pembayaran']) ? htmlspecialchars($_POST['kd_pembayaran']) : strip_tags($_POST['kd_pembayaran']);
        $id_resep = htmlentities($_POST['id_resep']) ? htmlspecialchars($_POST['id_resep']) : strip_tags($_POST['id_resep']);
        $nama_pasien = htmlentities($_POST['nm_pasien']) ? htmlspecialchars($_POST['nm_pasien']) : strip_tags($_POST['nm_pasien']);
        $total_pembayaran = htmlentities($_POST['total']) ? htmlspecialchars($_POST['total']) : strip_tags($_POST['total']);
        $jumlah_bayar = htmlentities($_POST['jumlah_bayar']) ? htmlspecialchars($_POST['jumlah_bayar']) : strip_tags($_POST['jumlah_bayar']);
        $kembalian = htmlentities($_POST['kembalian']) ? htmlspecialchars($_POST['kembalian']) : strip_tags($_POST['kembalian']);
        $tgl_pembayaran = htmlentities($_POST['tgl_pembayaran']) ? htmlspecialchars($_POST['tgl_pembayaran']) : strip_tags($_POST['tgl_pembayaran']);
        $data = $this->konfig->payment($kd_pembayaran,$id_resep,$nama_pasien,$total_pembayaran,$jumlah_bayar,$kembalian,$tgl_pembayaran);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

?>