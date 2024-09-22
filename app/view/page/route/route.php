<?php 
require_once("../../../database/koneksi.php");
$data = $konfigs->query("SELECT * FROM tb_sistem WHERE status = '1' order by id_sistem asc") or mysqli_connect_errno();
$hasil = mysqli_fetch_array($data) or mysqli_error($data);
/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../model/pengguna.php");
$pengguna = new model\Authentication($konfigs);
require_once("../../../model/dokter.php");
$dokter = new model\Docter($konfigs);
require_once("../../../model/poli.php");
$polyclinic = new model\Poli($konfigs);
require_once("../../../model/obat.php");
$drug = new model\Obat($konfigs);
require_once("../../../model/pasien.php");
$people = new model\Pasien($konfigs);
require_once("../../../model/pendaftaran.php");
$registerd = new model\Pendaftaran($konfigs);
require_once("../../../model/pemeriksaan.php");
$examination = new model\Pemeriksaan($konfigs);
require_once('../../../model/resep.php');
$resep = new model\resepobat($konfigs);
require_once("../../../model/pembayaran.php");
$payment = new model\CashPayment($konfigs);
/* Files Controller */
require_once("../../../controller/controller.php");
$Authentication = new controller\Pengguna($konfigs);
$docter = new controller\Dokter($konfigs);
$poli = new controller\polyclinic($konfigs);
$obat = new controller\Drug($konfigs);
$pasien = new controller\people($konfigs);
$pendaftaran = new controller\Registerd($konfigs);
$pemeriksaan = new controller\Examination($konfigs);
$obatresep = new controller\Prescription($konfigs);
$bayar = new controller\payment($konfigs);

if(!isset($_GET['page'])){
}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
            
        case 'karyawan':
            $title = "Data Master Karyawan";
            require_once("../pengguna/pengguna.php");
            break;
            
        case 'dokter':
            $title = "Data Master dokter";
            require_once("../dokter/dokter.php");
            break;
            
        case 'obat':
            $title = "Data Master obat";
            require_once("../obat/obat.php");
            break;
            
        case 'pasien':
            $title = "Data Master pasien";
            require_once("../pasien/pasien.php");
            break;
            
        case 'poli':
            $title = "Data Master poli";
            require_once("../poli/poli.php");
            break;
            
        case 'pendaftaran':
            $title = "Data Master Pendaftaran";
            require_once("../Pendaftaran/Pendaftaran.php");
            break;
            
        case 'pemeriksaan':
            $title = "Data Master pemeriksaan";
            require_once("../pemeriksaan/pemeriksaan.php");
            break;
            
        case 'resepobat':
            $title = "Data Master Resep Obat";
            require_once("../resep/resep.php");
            break;
            
        case 'pembayaran':
            $title = "Data Master pembayaran";
            require_once("../pembayaran/pembayaran.php");
            break;

        case 'keluar':
            if(isset($_SESSION['status'])){                
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../auth/index.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
}else{
    switch($_GET['aksi']){
        # Master Karyawan
        case 'tambah-karyawan':
            $title = "Tambah Master Karyawan";
            $title2 = "Data Master Karyawan";
            require_once('../pengguna/tambah.php');
            break;
        case 'ubah-karyawan':
            $title = "Ubah Master Karyawan";
            $title2 = "Data Master Karyawan";
            require_once('../pengguna/ubah.php');
            break;
            case 'tambah-people':
                $Authentication->buat();
                break;
            case 'ubah-people':
                $Authentication->ubah();
                break;
            case 'hapus-karyawan':
                $Authentication->hapus();
                break;
        # Master Karyawan
        
        # Master Dokter
        case 'tambah-dokter':
            $title = "Tambah Master Dokter";
            $title2 = "Data Master Dokter";
            require_once("../dokter/tambah.php");
            break;
        case 'ubah-dokter':
            $title = "Ubah Master Dokter";
            $title2 = "Data Master Dokter";
            require_once("../dokter/ubah.php");
            break;
        case 'lihat-dokter':
            $title = "Lihat Master Dokter";
            $title2 = "Data Master Dokter";
            require_once("../dokter/lihat.php");
            break;
            case 'tambah-docter':
                $docter->buat();
                break;
            case 'ubah-docter':
                $docter->ubah();
                break;
            case 'hapus-docter':
                $docter->hapus();
                break;
        # Master Dokter

        # Master Poli Dokter
        case 'tambah-poli':
            $title = "Tambah Master Poli";
            $title2 = "Data Master Poli";
            require_once("../poli/tambah.php");
            break;
        case 'ubah-poli':
            $title = "Ubah Master Poli";
            $title2 = "Data Master Poli";
            require_once("../poli/ubah.php");
            break;
            case 'poli-tambah':
                $poli->buat();
                break;
            case 'poli-ubah':
                $poli->ubah();
                break;
            case 'hapus-poli':
                $poli->hapus();
                break;
        # Master Poli Dokter

        # Master Obat
        case 'tambah-obat':
            $title = "Tambah Master Obat";
            $title2 = "Data Master Obat";
            require_once("../obat/tambah.php");
            break;
        case 'ubah-obat':
            $title = "Ubah Master Obat";
            $title2 = "Data Master Obat";
            require_once("../obat/ubah.php");
            break;
        case 'lihat-obat':
            $title = "Lihat Master Obat";
            $title2 = "Data Master Obat";
            require_once("../obat/lihat.php");
            break;
            case 'obat-tambah':
                $obat->buat();
                break;
            case 'obat-ubah':
                $obat->ubah();
                break;
            case 'hapus-obat':
                $obat->hapus();
                break;
        # Master Obat

        # Master Pasien
        case 'tambah-pasien':
            $title = "Tambah Master Pasien";
            $title2 = "Data Master Pasien";
            require_once("../pasien/tambah.php");
            break;
        case 'ubah-pasien':
            $title = "Ubah Master Pasien";
            $title2 = "Data Master Pasien";
            require_once("../pasien/ubah.php");
            break;
        case 'lihat-pasien':
            $title = "Lihat Master Pasien";
            $title2 = "Data Master Pasien";
            require_once("../pasien/lihat.php");
            break;
            case 'pasien-tambah':
                $pasien->buat();
                break;
            case 'pasien-ubah':
                $pasien->ubah();
                break;
            case 'pasien-hapus':
                $pasien->hapus();
                break;
        # Master Pasien

        # Master pendaftaran
        case 'tambah-pendaftaran':
            $title = "Tambah Master pendaftaran";
            $title2 = "Data Master pendaftaran";
            require_once("../pendaftaran/tambah.php");
            break;
        case 'struk-pendaftaran':
            $title = "Struk pendaftaran";
            $title2 = "Data Master pendaftaran";
            require_once("../pendaftaran/struk_pendaftaran.php");
            break;
            case 'pasien-pendaftaran':
                $pendaftaran->daftar();
                break;
            case 'pasien-batal':
                $pendaftaran->batal();
                break;
        # Master pendaftaran

        # Master Pemeriksaan
        case 'tambah-pemeriksaan':
            $title = "Tambah Master pemeriksaan";
            $title2 = "Data Master pemeriksaan";
            require_once("../pemeriksaan/tambah.php");
            break;
        case 'lihat-pemeriksaan':
            $title = "Struk pemeriksaan";
            $title2 = "Data Master pemeriksaan";
            require_once("../pemeriksaan/lihat.php");
            break;
            case 'pasien-pemeriksaan':
                $pemeriksaan->pemeriksa();
                break;
        # Master Pemeriksaan

        # Master Resep Obat
        case 'tambah-resepobat':
            $title = "Tambah Master Resep Obat";
            $title2 = "Data Master Resep Obat";
            require_once("../resep/tambah.php");
            break;
        case 'lihat-resepobat':
            $title = "Lihat Resep Obat";
            $title2 = "Data Master Resep Obat";
            require_once('../resep/lihat.php');
            break;
        case 'strukresep-obat':
            $title = "Struk Resep Obat";
            $title2 = "Data Master Resep Obat";
            require_once('../resep/struk_resep.php');
            break;
            case 'resepobat-tambah':
                $obatresep->rspobat();
                break;
        # Master Resep Obat
        
        # Master Pembayaran
        case 'tambah-pembayaran':
            $title = "Tambah Pembayaran";
            $title2 = "Data Master Pembayaran";
            require_once('../pembayaran/tambah.php');
            break;
        case 'struk-pembayaran':
            require_once('../pembayaran/cetak_pembayaran.php');
            break;
            case 'pembayaran-tambah':
                $bayar->bayar();
                break;
        # Master Pembayaran

        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>