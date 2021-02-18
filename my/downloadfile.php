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
  
    
    if ($_GET['module']=='karyawan'){
        include 'module/mod_mst_karyawan/idownloadkrydok.php';
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