<?php
session_start();
$vdbname=$_SESSION['SSDBNAME'];
include "../../config/koneksimysqli.php";

$module=$_GET['module'];
$act=$_GET['act'];
$idmenu=$_GET['idmenu'];

// Input user
if ($module=='groupuser' AND $act=='input'){
    if (!empty($_POST['nama'])) {
        mysqli_query($cnmy, "INSERT INTO $vdbname.t_groupuser(NAMA_GROUP)
                                   VALUES('$_POST[nama]')");
        header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    }
}
// Update user
elseif ($module=='groupuser' AND $act=='update'){
    if (!empty($_POST['nama'])) {
        mysqli_query($cnmy, "UPDATE $vdbname.t_groupuser SET NAMA_GROUP    = '$_POST[nama]'
                               WHERE ID_GROUP      = '$_POST[id]'");
        header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    }
}elseif ($module=='groupuser' AND $act=='hapususer'){
    if ($_SESSION['LEVELUSER']=="admin") {
        mysqli_query($cnmy, "delete from $vdbname.t_groupuser where ID_GROUP='$_GET[id]'");
    }
    header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}

// Edit Group Menu
elseif ($module=='groupuser' AND $act=='updatemenugrop'){

    $tag_id = $_POST['tag_km'];
    mysqli_query($cnmy, "delete from $vdbname.t_groupmenu where ID_GROUP='$_GET[idgroup]'");

    
    for ($k=0;$k<=count($tag_id);$k++) {
        if (!empty($tag_id[$k])){
            /*
            $cTambah="Y";$cEdit="Y";$cHapus="Y";
            
            $cTa=$_POST['arr_tambah'.$tag_id[$k]];
            $cEa=$_POST['arr_edit'.$tag_id[$k]];
            $cHa=$_POST['arr_hapus'.$tag_id[$k]];

            if (empty ($cTa)) $cTambah="N";
            if (empty ($cEa)) $cEdit="N";
            if (empty ($cHa)) $cHapus="N";
             * 
             */

             $cTambah="N";$cEdit="N";$cHapus="N";
            //echo "$_GET[idgroup], $tag_id[$k], $cTambah, $cEdit, $cHapus<br/>";
            mysqli_query($cnmy, "INSERT INTO $vdbname.t_groupmenu(ID_GROUP, ID, TAMBAH, EDIT, HAPUS)VALUES('$_GET[idgroup]', '$tag_id[$k]', '$cTambah', '$cEdit', '$cHapus')");
        }
    }
    $act="editgroupmenu";
    $gid=$_GET['idgroup'];
    $namaa=$_GET['nama'];
    header('location:../../media.php?module='.$module.'&act='.$idmenu.'&id='.$gid.'&nama='.$namaa.'&idmenu='.$idmenu);

}
?>
