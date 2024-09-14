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
/* Files Controller */
require_once("../../../controller/controller.php");
$Authentication = new controller\Pengguna($konfigs);

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
            $title = "Data Master pemeriksaan";
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
            # code...
            break;
        case 'ubah-dokter':
            # code...
            break;
            case 'tambah-docter':
                # code...
                break;
            case 'ubah-docter':
                # code...
                break;
            case 'hapus-docter':
                # code...
                break;
        # Master Dokter
        
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>