<?PHP
    $_SESSION['DBNAME0']="dbtemp";
    $_SESSION['DBNAME1']="bk_master";
    $_SESSION['DBNAME2']="bk_master";
    $_SESSION['DBNAME3']="bk_master";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?PHP
    if ($_GET['module']=="groupuser"){
        include 'module/mod_tools_groupuser/groupuser.php';
    }elseif ($_GET['module']=='menuutama'){
        include 'module/mod_tools_menu/menu.php';
    }elseif ($_GET['module']=='submenu'){
        include 'module/mod_tools_submenu/submenu.php';
    }elseif ($_GET['module']=='user'){
        include 'module/mod_tools_users/users.php';
    }elseif ($_GET['module']=='uploaddatatransaksi'){
        include 'module/mod_tools_uploaddatatrs/uploaddatatrs.php';
    }elseif ($_GET['module']=='uploaddatatransaksiproses'){
        include 'module/mod_tools_uploaddatatrs/hasil_uploadtrans.php';
        
        
    }elseif ($_GET['module']=='karyawan'){
        include 'module/mod_mst_karyawan/karyawan.php';
    }elseif ($_GET['module']=='mstdivisi'){
        include 'module/mod_mst_divisi/divisi.php';
    }elseif ($_GET['module']=='mstdatabank'){
        include 'module/mod_mst_dtbank/dtbank.php';
    }elseif ($_GET['module']=='mstkdjenis'){
        include 'module/mod_mst_kodejenis/kodejenis.php';
        
    }elseif ($_GET['module']=='coalevel1'){
        include 'module/mod_akn_coalevel1/coalevel1.php';
    }elseif ($_GET['module']=='coalevel2'){
        include 'module/mod_akn_coalevel2/coalevel2.php';
    }elseif ($_GET['module']=='coalevel3'){
        include 'module/mod_akn_coalevel3/coalevel3.php';
    }elseif ($_GET['module']=='coalevel4'){
        include 'module/mod_akn_coalevel4/coalevel4.php';
        
    }elseif ($_GET['module']=='acttransaksijurnal'){
        include 'module/mod_act_transaksijurnal/transaksijurnal.php';
        
    }elseif ($_GET['module']=='finpenerimaan'){
        include 'module/mod_fin_penerimaan/penerimaan.php';
    }elseif ($_GET['module']=='finpengeluaran'){
        include 'module/mod_fin_pengeluaran/pengeluaran.php';
        
    }elseif ($_GET['module']=='prytransaksiproyek'){
        include 'module/mod_pry_transaksiproyek/transaksiproyek.php';
    }elseif ($_GET['module']=='pryapvtrsproyek'){
        include 'module/mod_pry_apvtranspryk/apvtranspryk.php';
    }elseif ($_GET['module']=='prykdivisi'){
        include 'module/mod_pry_divisipryk/divisipryk.php';
    }elseif ($_GET['module']=='prydataproyekmaster'){
        include 'module/mod_pry_masterproyek/masterproyek.php';
    }elseif ($_GET['module']=='pryrapp'){
        include 'module/mod_pry_rapp/rapp.php';
        
    }elseif ($_GET['module']=='rpttransaskijurnal'){
        include 'module/mod_rpt_laptransaskijurnal/laptransaskijurnal.php';
    }elseif ($_GET['module']=='rptbukubesar'){
        include 'module/mod_rpt_lapbukubesar/lapbukubesar.php';
    }elseif ($_GET['module']=='rptrugilaba'){
        include 'module/mod_rpt_laprugilaba/laprugilaba.php';
    }elseif ($_GET['module']=='rptneraca'){
        include 'module/mod_rpt_lapneraca/lapneraca.php';
    }elseif ($_GET['module']=='rptekuitas'){
        include 'module/mod_rpt_lapekuitas/lapekuitas.php';
    }elseif ($_GET['module']=='rptrinciancf'){
        include 'module/mod_rpt_laptransaskidetailcf/laptransaskidetailcf.php';
    }elseif ($_GET['module']=='rptdatacoa'){
        include 'module/mod_rpt_lapdatacoa/lapdatacoa.php';
    }elseif ($_GET['module']=='rptlapproyek'){
        include 'module/mod_rpt_lapdatapoyek/lapdatapoyek.php';
        
    }elseif ($_GET['module']=='prospostingtrsjurnal'){
        include 'module/mod_prs_prospostingtrsjurnal/prospostingtrsjurnal.php';
    }elseif ($_GET['module']=='prosclosingtrsjurnal'){
        include 'module/mod_prs_prosclstrsjurnal/prosclstrsjurnal.php';
    }elseif ($_GET['module']=='prosclosingcf'){
        include 'module/mod_prs_prosclstrscf/prosclstrscf.php';
        
    }elseif ($_GET['module']=='mapingrl'){
        include 'module/mod_tools_mapingrl/mapingrl.php';
    }elseif ($_GET['module']=='mapingneraca'){
        include 'module/mod_tools_mapingneraca/mapingneraca.php';
    }elseif ($_GET['module']=='pilihtahunfiskal'){
        include 'module/mod_tools_pilihtf/pilihtf.php';
    }elseif ($_GET['module']=='xx'){

    }else{
        include 'del_session.php';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Dashboard <small>Control panel</small> </h1>
            <ol class="breadcrumb"> <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> <li class="active">Dashboard</li></ol>
        </section>

        <!-- Main content -->
        <section class="content">

        </section>
        <!-- /.content -->
        <?PHP
    }
    ?>

</div>
<!-- /.content-wrapper -->
<!--
<html>
    <head>
        <title>nama judul</title>
    </head>
    <body>
        <ul>
            <li><a href="?module=home">Home</a></li>
            <li><a href="?module=produk">Product</a></li>
            <li><a href="?module=profile">Profile</a></li>
        </ul>
    </body>
        
</html>
-->
