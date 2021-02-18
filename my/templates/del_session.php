<?php
    error_reporting(0);
    $files = glob('images/temp_ttd_img/*.png'); //get all file names
    foreach($files as $file){
        if(is_file($file))
        unlink($file); //delete file
    }
    error_reporting(-1);
    
    
    //penjualan
    $_SESSION['FJUALTGL1']="";
    $_SESSION['FJUALTGL2']="";
    
    //pesanan
    $_SESSION['FPESANTGL1']="";
    $_SESSION['FPESANTGL2']="";
    
    //proses pesanan
    $_SESSION['FPPESANTGL1']="";
    $_SESSION['FPPESANTGL2']="";

?>

