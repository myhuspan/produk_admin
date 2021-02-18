<?php
date_default_timezone_set('Asia/Jakarta');

session_start();
$_SESSION['FOLDERGL']="my";
include "$_SESSION[FOLDERGL]/config/koneksimysqli.php";

$vdbname="pl";
$p_username   = $_POST['t_email'];
$p_pass       = $_POST['t_pass'];

$masukpass=0;
$ketemuuser=0;
$ketemumysql=0;

$fromuser=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_users WHERE USERNAME='$p_username'");
$erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; exit; }
$ketemuuser=mysqli_num_rows($fromuser);
if ($ketemuuser>0) {
    
    $ketemuuser=0;
    $rx=mysqli_fetch_array($fromuser);
    $idkaryawan=$rx['KARYAWANID'];
    if (!empty($rx['PASSWORD'])){
        include "$_SESSION[FOLDERGL]/config/encriptpassword.php";
        $tglnya=$rx['CREATEDPW'];

        $thn=substr($tglnya,0,4);
        $bln=substr($tglnya,5,2);
        $tgl=substr($tglnya,8,2);
        $tanggal=$thn.$bln.$tgl;

        $n_password   = encriptpasswordSSQl($p_pass, $tanggal);
        $masukpass=1;
    }
    
    if ($masukpass==1){
        $masukpass=0;
        $fromuser=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_users WHERE USERNAME='$p_username' and PASSWORD='$n_password'");
        $erropesan = mysqli_error($cnmy); if (!empty($erropesan)) { echo $erropesan; exit; }
        $ketemuuser=mysqli_num_rows($fromuser);
        if ($ketemuuser>0) {
            $zz=mysqli_fetch_array($fromuser);
            $masukpass=1;
        }
    }
    
    $n_username=$idkaryawan;

    
    
if ($masukpass==1){
    include "timeout.php";

$sql=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_karyawan WHERE KARYAWANID=$n_username AND AKTIF<>'N'");
$ketemumysql=mysqli_num_rows($sql);

if ($ketemumysql>0) {
    $r=mysqli_fetch_array($sql);

    //dari user
    $_SESSION['GROUP']=$zz['ID_GROUP'];
    $_SESSION['LEVELUSER']=$zz['LEVEL'];
    //end dari user
    
    
    
    $_SESSION['SSDBNAME'] = $vdbname;
    $_SESSION['NAMAPT'] = "PT. ";
    $_SESSION['EMAIL']=$p_username;
    $_SESSION['IDCARD']=$r['KARYAWANID'];
    $_SESSION['USERID']=(int)$r['KARYAWANID'];
    $_SESSION['USERNAME']=(int)$r['KARYAWANID'];
    $_SESSION['NAMALENGKAP']=$r['NAMA'];
    
    $_SESSION['KDBRANCH']=$r['KDBRANCH'];
    $_SESSION['KDCAB']=$r['KDCAB'];
    
    $periodemasuk="2019-04-25";
    if (!empty($r['TGLMASUK']) OR $r['TGLMASUK']<>"0000-00-00") $periodemasuk= date("d-m-Y", strtotime($r['TGLMASUK']));
    $_SESSION['MEMBERSEJAK']=$periodemasuk;
    $_SESSION['DIVISI']=$r['DIVISI'];
    if (empty($_SESSION['DIVISI'])) $_SESSION['DIVISI']="HO";
    $_SESSION['JABATANID'] = $r['JABATANID'];
    
    $_SESSION['ATASANID']=$r['ATASANID'];
    $t = mysqli_fetch_array(mysqli_query($cnmy, "select nama from $vdbname.t_karyawan where KARYAWANID='$_SESSION[ATASANID]'"));
    if (!empty($t['NAMA'])) $_SESSION['NAMAATASAN']=$t['NAMA'];
    
    $carijabatan = mysqli_query($cnmy, "select JABATANID, NAMA, RANK, LEVELPOSISI, ID_GROUP from $vdbname.t_jabatan WHERE JABATANID='$_SESSION[JABATANID]'");
    $jb = mysqli_fetch_array($carijabatan);
    $_SESSION['JABATANNM']=$jb['NAMA'];
    $_SESSION['JABATANRANK']=(int)$jb['RANK'];
    $_SESSION['LVLPOSISI']=$jb['LEVELPOSISI'];
    if (empty($_SESSION['LVLPOSISI'])) $_SESSION['LVLPOSISI']="HO1";
    
    if (empty($_SESSION['GROUP'])) {
        $_SESSION['GROUP']=$jb['ID_GROUP'];
    }

    
    $carithnfis = mysqli_query($cnmy, "select TAHUNFISKAL from $vdbname.t_tahunfiskal WHERE IFNULL(PILIH,'')='Y'");
    $tf = mysqli_fetch_array($carithnfis);
    $_SESSION['TAHUNFISKAL']=$tf['TAHUNFISKAL'];
    if (empty($_SESSION['TAHUNFISKAL'])) $_SESSION['TAHUNFISKAL']=date("Y");
    
    
    
    include "$_SESSION[FOLDERGL]/config/mobile.php";
    if(mobile_device_detect(true,true,true,true,false,false)){
        $_SESSION['MOBILE']="Y";
    }else{
        $_SESSION['MOBILE']="N";
    }
    

    timer();

    $sid_lama = session_id();
    session_regenerate_id();
    $sid_baru = session_id();
    $_SESSION['IDSESI']=$sid_baru;

    mysqli_query($cnmy, "insert into $vdbname.t_users_log (KARYAWANID, SESSION_ID, AKTIF)values('$_SESSION[IDCARD]', '$sid_baru', 'Y')");
    mysqli_query($cnmy, "UPDATE $vdbname.t_users SET ID_SESSION='$sid_baru', ONLINE='Y' WHERE (KARYAWANID='$n_username' or USERNAME='$n_username')");
    mysqli_close($cnmy);
    header('location:'.$_SESSION['FOLDERGL'].'/media.php?module=home&users='.$sid_baru);

}else{
    mysqli_close($cnmy);
    echo "<script>alert('user atau password anda tidak terdaftar'); window.location = 'index.php'</script>";
}


}else{
    mysqli_close($cnmy);
    echo "<script>alert('user atau password anda tidak terdaftar'); window.location = 'index.php'</script>";
}
    


}else{
    mysqli_close($cnmy);
    echo "<script>alert('user atau password anda tidak terdaftar'); window.location = 'index.php'</script>";
}

?>