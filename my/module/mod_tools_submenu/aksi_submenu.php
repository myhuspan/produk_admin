<?php
session_start();
$vdbname=$_SESSION['SSDBNAME'];
include "../../config/koneksimysqli.php";

$module=$_GET['module'];
$act=$_GET['act'];
$idmenu=$_GET['idmenu'];

// Hapus submenu
if ($module=='submenu' AND $act=='hapus'){
  mysqli_query($cnmy, "DELETE FROM $vdbname.t_menu WHERE ID='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}

// Input submenu
elseif ($module=='submenu' AND $act=='input'){
  // Cari angka URUTAN terakhir
  $u=mysqli_query($cnmy, "SELECT urutan FROM $vdbname.t_menu where PARENT_ID <> '0' and PARENT_ID='$_POST[menu]' ORDER by URUTAN DESC");
  $d=mysqli_fetch_array($u);
  $urutan=$d[URUTAN]+1;
  
  // Input data submenu
  mysqli_query($cnmy, "INSERT INTO $vdbname.t_menu(JUDUL,
                                 URL,
                                 PUBLISH,
                                 URUTAN, PARENT_ID) 
	                       VALUES('$_POST[nama_menu]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$urutan', '$_POST[menu]')");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}

// Update submenu
elseif ($module=='submenu' AND $act=='update'){
  mysqli_query($cnmy, "UPDATE $vdbname.t_menu SET JUDUL = '$_POST[nama_menu]',
                                URL       = '$_POST[link]',
                                PUBLISH    = '$_POST[publish]',
                                URUTAN     = '$_POST[urutan]', PARENT_ID='$_POST[menu]', M_KHUSUS='$_POST[mkhusus]'
                          WHERE ID   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}
?>
