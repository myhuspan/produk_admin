<?php
session_start();
$vdbname=$_SESSION['SSDBNAME'];
include "../../config/koneksimysqli.php";

$module=$_GET['module'];
$act=$_GET['act'];
$idmenu=$_GET['idmenu'];


// Hapus employee
if ($module=='employee' AND $act=='hapus'){

}

// Input modul
else{
    
    $cari=mysqli_query($cnmy, "select * from $vdbname.t_users WHERE KARYAWANID   = '$_POST[e_id]'");
    $ketemu=mysqli_num_rows($cari);
    if ($ketemu==0){
        mysqli_query($cnmy, "insert into $vdbname.t_users(KARYAWANID)values('$_POST[e_id]')");
    }
    
    $ssql="UPDATE $vdbname.t_users SET AKHUSUS='N', ID_GROUP = '$_POST[e_ugroup]', LEVEL='$_POST[rb_tipe]' WHERE KARYAWANID   = '$_POST[e_id]'";
    mysqli_query($cnmy, $ssql);

    if (!empty($_POST['e_user'])){
        $ssql="UPDATE $vdbname.t_users SET USERNAME = '$_POST[e_user]' WHERE KARYAWANID   = '$_POST[e_id]'";
        mysqli_query($cnmy, $ssql);
    }

    if (!empty($_POST['e_pass'])){
        include "../../config/library.php";
        include "../../config/encriptpassword.php";
        $pass=  encriptpasswordSSQl($_POST['e_pass'], $tgl_sekarang);
        $ssql="UPDATE $vdbname.t_users SET CREATEDPW=current_date(), PASSWORD = '$pass' WHERE KARYAWANID   = '$_POST[e_id]'";
        mysqli_query($cnmy, $ssql);
    }

    header('location:../../media.php?module='.$module.'&idmenu='.'&idmenu='.$idmenu.'&act=complt');

}
?>
