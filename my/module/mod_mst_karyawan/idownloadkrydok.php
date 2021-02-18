<?php 
//hapusdoktkry
$vdbname=$_SESSION['SSDBNAME'];
$pact="";
if (isset($_GET['act'])) $pact=$_GET['act'];
    
if ($pact=="hapusdoktkry") {
    $piddel=$_GET['id'];
    if (!empty($piddel)) {
        include "config/koneksimysqli.php";
        
        mysqli_query($cnmy, "DELETE FROM $vdbname.t_karyawan_dok WHERE IDURUT='$piddel' LIMIT 1");
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
        echo "data berhasil dihapus. silakan close halaman ini...!!!";
        
        mysqli_close($cnmy);
        exit;
        //header('location:../../media.php?module=karyawan&act=uploadfile&idmenu=7&id='.$piddel);
    }
}else{
    if (isset($_GET['id'])) {
    $filename    = $_GET['id'];

    
    $back_dir = "fileupload/data_karyawan_files/";
    
    $file = $back_dir.$_GET['id'];
    
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            
            exit;
        } 
        else {
            $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
            //header("location:index.php");
        }
    }
}
?>