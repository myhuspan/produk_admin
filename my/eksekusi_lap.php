<?PHP
    session_start();
    ini_set("memory_limit","10G");
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    
    $pusridcard="";
    if (isset($_SESSION['IDCARD'])) $pusridcard=$_SESSION['IDCARD'];

    if (empty($pusridcard)) {
        echo "Anda harus login ulang...";
        exit;
    }

?>


<?PHP
    $pmodule="";
    if (isset($_GET['module'])) $pmodule=$_GET['module'];


    if ($pmodule=="prytransaksiproyek"){
        include 'module/mod_pry_transaksiproyek/laporandetailproyek.php';
    }elseif ($pmodule=="rpttransaskijurnal"){
        include 'module/mod_rpt_laptransaskijurnal/aksi_laptransaskijurnal.php';
    }elseif ($_GET['module']=='rptbukubesar'){
        include 'module/mod_rpt_lapbukubesar/aksi_lapbukubesar.php';
    }elseif ($_GET['module']=='rptrugilaba'){
        include 'module/mod_rpt_laprugilaba/aksi_laprugilaba.php';
    }elseif ($_GET['module']=='rptneraca'){
        include 'module/mod_rpt_lapneraca/aksi_lapneraca.php';
    }elseif ($_GET['module']=='rptneracadetail'){
        include 'module/mod_rpt_lapneraca/lihatneracabb.php';
    }elseif ($_GET['module']=='rptneracadetailcoa'){
        include 'module/mod_rpt_lapneraca/lihatneracabbcoa.php';
    }elseif ($_GET['module']=='rptekuitas'){
        include 'module/mod_rpt_lapekuitas/aksi_lapekuitas.php';
    }elseif ($_GET['module']=='rptrinciancf'){
        include 'module/mod_rpt_laptransaskidetailcf/aksi_laptransaskidetailcf.php';
    }elseif ($_GET['module']=='rptdatacoa'){
        include 'module/mod_rpt_lapdatacoa/aksi_lapdatacoa.php';
    }elseif ($_GET['module']=='rptlapproyek'){
        include 'module/mod_rpt_lapdatapoyek/aksi_lapdatapoyek.php';
    }elseif ($_GET['module']=='finpenerimaan'){
        include 'module/mod_fin_penerimaan/printdatainput.php';
    }elseif ($_GET['module']=='finpengeluaran'){
        include 'module/mod_fin_penerimaan/printdatainput.php';
    }elseif ($_GET['module']=='pryrapp'){
        include 'module/mod_pry_rapp/rekaprincianrapp.php';
    }else{
        ?>
        <HTML>
            <HEAD>
                <title>BELUM ADA REPORT....</title>
                <link rel="shortcut icon" href="images/ptbinakarya.jpg" />
            </HEAD>
        </HTML>
        <?PHP
    }
?>