<?php
session_start();
if (empty($_SESSION['IDCARD']) AND empty($_SESSION['NAMALENGKAP'])){
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../index.php><b>LOGIN</b></a></center>";
}else{
    include "config/koneksimysqli.php";
    include "config/fungsi_sql.php";
    include "templates/template.php";
}
?>