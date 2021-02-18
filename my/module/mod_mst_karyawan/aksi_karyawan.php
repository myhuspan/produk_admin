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

if ($module=='karyawan' AND $act=='hapusdokt'){
    $piddel=$_GET['id'];
    if (!empty($piddel)) {
        mysqli_query($cnmy, "DELETE FROM $vdbname.t_karyawan_dok WHERE IDURUT='$piddel' LIMIT 1");
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
        echo "data berhasil dihapus. silakan close halaman ini...!!!";

        mysqli_close($cnmy);

        header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    }
}elseif ($module=='karyawan' AND $act=='hapus'){
    header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
}
elseif ($module=='karyawan' AND $act=='uploadfile'){
    
    $pfile = $_FILES['fileToUpload']['name'];
    
    if (empty($pfile)) {
        echo "File yang diupload kosong...!!!";
        exit;
    }
    
    $pidkaryawan=$_POST['e_id'];
    
    $target_dir = "../../fileupload/data_karyawan_files/";
    
    if (!file_exists($target_dir)) {
        echo "Folder tidak ada...."; exit;
    }
    $newfilename="";
    
    $filename = $_FILES["fileToUpload"]["name"];
    $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
    $file_ext = substr($filename, strripos($filename, '.')); // get file name
    $filesize = $_FILES["fileToUpload"]["size"];
    $allowed_file_types = array('.doc','.docx','.rtf','.pdf','.jpg','.JPG','.jepg','.JPEG','.jpeg','JPEG','.xls','.xlsx','.zip','.rar','7z');
    
    $purutan=0;
    $query = "select max(URUTAN) as URUTAN from $vdbname.t_setup_file";
    $tampil=mysqli_query($cnmy, $query);
    $ketemu= mysqli_num_rows($tampil);
    if ((INT)$ketemu>0) {
        $row= mysqli_fetch_array($tampil);
        $pnurut=$row['URUTAN'];
        if (empty($pnurut)) $pnurut=0;
        $pnurut++;
    }else{
        mysqli_query($cnmy, "INSERT INTO $vdbname.t_setup_file(URUTAN)VALUES('0')");
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    }
            
    if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000)) {
        // Rename file
        $newfilenm = $pnurut."_".md5($file_basename);
        $newfilename = $pnurut."_".md5($file_basename) . $file_ext;
        if (file_exists($target_dir.$newfilename)) {
            echo "File Sudah ada, silakan rename terlebih dahulu<br/>";
            
            mysqli_close($cnmy);
            echo "Tidak ada yang diupload...";
            exit;
            
        }else{
            
            mysqli_query($cnmy, "UPDATE $vdbname.t_setup_file SET URUTAN='$pnurut'");
            $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
            
            
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename);
            
            mysqli_query($cnmy, "INSERT INTO $vdbname.t_karyawan_dok (KARYAWANID, NAMA, NAMA_FILE, F_EXT, USERID)"
                    . "values ('$pidkaryawan', '$file_basename', '$newfilenm', '$file_ext', '$psesikry')");
            $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
            
        }
        
        mysqli_close($cnmy);
        header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    }else{
        mysqli_close($cnmy);
        echo "Tidak ada yang diupload...";
        exit;
    }
    
    
}
elseif ($module=='karyawan'){
    
    $pnama=$_POST['e_nama'];
    $pjekel=$_POST['cb_jkel'];
    $ptempat=$_POST['e_tempat'];
    $ptgllahir=$_POST['e_tgllahir'];
    $palamat=$_POST['e_alamat'];
    $pjabatanid=$_POST['cb_jabatan'];
    $patasanid=$_POST['cb_atasan'];
    $ptglmasuk=$_POST['e_tglmasuk'];
    $ptglkeluar=$_POST['e_tglkeluar'];
    $pstskry=$_POST['e_stskry'];
    
    $ptlahir="";
    if (!empty($ptgllahir)) $ptlahir =  date("Y-m-d", strtotime($ptgllahir));
    $ptmasuk="";
    if (!empty($ptglmasuk)) $ptmasuk =  date("Y-m-d", strtotime($ptglmasuk));
    $ptkeluar="";
    if (!empty($ptglkeluar)) $ptkeluar =  date("Y-m-d", strtotime($ptglkeluar));
    
    if (!empty($pnama)) $pnama = str_replace("'", '', $pnama);
    if (!empty($ptempat)) $ptempat = str_replace("'", '', $ptempat);
    if (!empty($palamat)) $palamat = str_replace("'", '', $palamat);
    if (!empty($pstskry)) $pstskry = str_replace("'", '', $pstskry);
    
    
    $kodenya="";
    if ($act=='input') {
        $sql=  mysqli_query($cnmy, "select MAX(KARYAWANID) as NOURUT from $vdbname.t_karyawan");
        $ketemu=  mysqli_num_rows($sql);
        $awal=10; $urut=1; $kodenya=""; $periode=date('Ymd');
        if ($ketemu>0){
            $o=  mysqli_fetch_array($sql);
            $urut=$o['NOURUT']+1;
            $jml=  strlen($urut);
            $awal=$awal-$jml;
            $kodenya=str_repeat("0", $awal).$urut;
        }else{
            $kodenya=$_POST['e_id'];
        }
    }else{
        $kodenya=$_POST['e_id'];
    }
    
    //echo "ID : $kodenya, $pnama, $ptempat, $ptlahir, $palamat, $pjabatanid, $patasanid, $ptmasuk, $ptkeluar"; exit;
    
    if ($act=='input') {
        mysqli_query($cnmy, "INSERT INTO $vdbname.t_karyawan(KARYAWANID, NAMA) VALUES('$kodenya', '$pnama')");
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
        
        //mysqli_query($cnmy, "UPDATE $vdbname.t_setup SET KARYAWANID='$urut'");
        //$erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    }
    
    $query = "UPDATE $vdbname.t_karyawan SET NAMA='$pnama', "
             . " JABATANID='$pjabatanid', "
             . " TEMPAT='$ptempat', "
             . " TGLLAHIR='$ptlahir', "
             . " ALAMAT1='$palamat', "							 
             . " ATASANID='$patasanid', "							 
             . " TGLMASUK='$ptmasuk', "
             . " TGLKELUAR='$ptkeluar', "
             . " T_STATUS='$pstskry', "
             . " JKEL='$pjekel' WHERE "
            . " KARYAWANID='$kodenya' LIMIT 1"; 
    mysqli_query($cnmy, $query);
    $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    
    $query = "UPDATE $vdbname.t_karyawan SET AKTIF='Y' WHERE KARYAWANID='$kodenya' LIMIT 1";
    if (!empty($ptkeluar)) {
        $query = "UPDATE $vdbname.t_karyawan SET AKTIF='N' WHERE KARYAWANID='$kodenya' LIMIT 1";
    }
    mysqli_query($cnmy, $query); $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; mysqli_close($cnmy); exit; }
    
    mysqli_close($cnmy);
    header('location:../../media.php?module='.$module.'&act='.$idmenu.'&idmenu='.$idmenu);
    
}
?>

