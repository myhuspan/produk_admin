<?php
session_start();
$vdbname=$_SESSION['SSDBNAME'];
include "../../config/koneksimysqli.php";

$module=$_GET['module'];
$act=$_GET['act'];
$idmenu=$_GET['idmenu'];

// Hapus menu
if ($module=='menuutama' AND $act=='hapus'){
  mysqli_query($cnmy, "DELETE FROM $vdbname.t_menu WHERE ID='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}

// Input modul
elseif ($module=='menuutama' AND $act=='input'){
  // Cari angka urutan terakhir
  $u=mysqli_query($cnmy, "SELECT URUTAN FROM $vdbname.t_menu where PARENT_ID='0' ORDER by URUTAN DESC");
  $d=mysqli_fetch_array($u);
  $urutan=$d[urutan]+1;
  
  // Input data menu
  mysqli_query($cnmy, "INSERT INTO $vdbname.t_menu(JUDUL,
                                 URL,
                                 PUBLISH,
                                 URUTAN)
	                       VALUES('$_POST[nama_menu]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$urutan')");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}

// Update modul
elseif ($module=='menuutama' AND $act=='update'){
  
  mysqli_query($cnmy, "UPDATE $vdbname.t_menu SET JUDUL = '$_POST[nama_menu]',
                                URL       = '$_POST[link]',
                                PUBLISH    = '$_POST[publish]',
                                URUTAN     = '$_POST[urutan]'
                          WHERE ID   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}
?>
