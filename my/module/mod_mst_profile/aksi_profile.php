<?php

session_start();
$vdbname=$_SESSION['SSDBNAME'];
$psesikry="";
if (isset($_SESSION['IDCARD'])) $psesikry=$_SESSION['IDCARD'];
if (empty($psesikry)) { echo "ANDA HARUS LOGIN ULANG...!!!"; exit; }



include "../../config/koneksimysqli.php";

$module=$_GET['module'];
$act=$_GET['act'];
$idmenu=$_GET['idmenu'];

if ($module=='mstprofile' AND $act=='update'){
    
    $pkodenya=$_POST['e_id'];
    $pnama=$_POST['e_nama'];
    $palamat=$_POST['e_alamat'];
    $pnpwp=$_POST['e_npwp'];
    $ptelp=$_POST['e_telp'];
    $php=$_POST['e_hp'];
    $pfax=$_POST['e_fax'];
    $pemail=$_POST['e_email'];
    $paboutus=$_POST['e_aboutus'];
    $pcopyright=$_POST['ecopyr'];
    
    if (!empty($pnama)) $pnama = str_replace("'", '', $pnama);
    if (!empty($palamat)) $palamat = str_replace("'", '', $palamat);
    if (!empty($pnpwp)) $pnpwp = str_replace("'", '', $pnpwp);
    if (!empty($ptelp)) $ptelp = str_replace("'", '', $ptelp);
    if (!empty($php)) $php = str_replace("'", '', $php);
    if (!empty($pfax)) $pfax = str_replace("'", '', $pfax);
    if (!empty($pemail)) $pemail = str_replace("'", '', $pemail);
    if (!empty($pcopyright)) $pcopyright = str_replace("'", '', $pcopyright);
    
    $newfilename="";
    $pgambarnya=$_POST['e_imgconv'];
    if (!empty($pgambarnya)) {
        $file_name = $_FILES['image1']['name'];
        $file_tmp_name = $_FILES['image1']['tmp_name'];
        $file_target = '../../img/i_profile/';
        $file_size = $_FILES['image1']['size'];
        $f_type=$_FILES['image1']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $extensions= array("jpeg","jpg");
        
        $insertgambar1=true;
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
           $insertgambar1=false;
        }
        //echo "$file_ext"; exit;
        if ($insertgambar1 == true) {
            list($width, $height) = getimagesize($file_tmp_name);
            // Resize
            $ratio = $width/$height;
            if($ratio > 1) {
                $new_width = 300;
                $new_height = 400/$ratio;
            }
            else {
                $new_width = 300*$ratio;
                $new_height = 400;
            }

            // Rename file
            $temp = explode('.', $file_name);
            $newfilename = 'img_profile01.'.end($temp);
            
            // Upload image
            if(move_uploaded_file($file_tmp_name , $file_target.$newfilename)) {
                $src = imagecreatefromstring(file_get_contents($file_target.$newfilename));
                $dst = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagedestroy($src);
                imagepng($dst, $file_target.$newfilename);
                imagedestroy($dst);
            }
            
            
        }
    }
    
    
    
    $query = "UPDATE $vdbname.t_profile SET nama_pt='$pnama', "
             . " alamat_pt='$palamat', "
             . " npwp='$pnpwp', "
             . " telp='$ptelp', "
             . " nohp='$php', "							 
             . " fax='$pfax', "							 
             . " email='$pemail', "
             . " about_us='$paboutus', "
             . " copy_r='$pcopyright' WHERE "
            . " id='$pkodenya' LIMIT 1"; 
    mysqli_query($cnmy, $query);
    $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    
    if (!empty($newfilename)) {
        $query = "UPDATE $vdbname.t_profile SET gambar1='$newfilename' WHERE "
                . " id='$pkodenya' LIMIT 1"; 
        mysqli_query($cnmy, $query);
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    }
        
}

    mysqli_close($cnmy);
    header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    
?>
