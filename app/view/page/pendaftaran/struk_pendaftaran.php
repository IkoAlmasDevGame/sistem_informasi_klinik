<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Struk Pendaftaran</title>
        <style type="text/css">
        body {
            width: 250px;
        }

        img {
            width: 40%;
            height: 40%;
            display: block;
            margin: auto;
        }

        p {
            margin-top: 0px;
            text-align: center;
            margin-bottom: 0px;
        }
        </style>
    </head>

    <body>
        <p>
            <span style="font-size: 16px; font-weight: bold;">Poliklinik Islamic Indonesia </span><br>
            <span style="font-size: 13px;">Jl. Jatinegara, Telp : (123) 9876543</span><br>
            <span style="font-size: 12px;">E-mail: support@rsislamicindo.com</span>
        </p>
        <?php 
        function tgl_indo($tanggal){
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
        
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
        
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        ?>
        <?php require_once("../../../database/koneksi.php"); ?>
        <?php if(isset($_GET['kd_pendaftaran'])): ?>
        <?php 
        $kode = htmlspecialchars($_GET['kd_pendaftaran']); 
        $data = $konfigs->query("SELECT * FROM tb_pendaftaran a JOIN tb_poli b ON a.id_poli = b.id_poli WHERE kd_pendaftaran='$kode'");
        ?>
        <?php while($pecah = mysqli_fetch_assoc($data)){ ?>
        <p>
            <span style="font-size: 50px; margin-top: 0px;
                 font-weight: bold;"><?php echo $pecah['kd_pendaftaran']; ?></span><br>
            <span style="font-size: 20px; margin-top: 0px;"><?php echo $pecah['nm_poli']; ?></span><br>
            <span style="font-size: 23px; margin-top: 0px;
                 font-weight: bold;"><?php echo tgl_indo($pecah['tgl_pendaftaran']); ?></span>
        </p>
        <?php } ?>
        <?php endif; ?>
        <script type="text/javascript">
        window.print();
        </script>
    </body>

</html>