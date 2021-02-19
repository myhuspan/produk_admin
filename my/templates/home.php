<?PHP
    $pmodule="";
    if (isset($_GET['module'])) $pmodule=$_GET['module'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?PHP
    if ($pmodule=="groupuser"){
        include 'module/mod_tools_groupuser/groupuser.php';
    }elseif ($pmodule=='menuutama'){
        include 'module/mod_tools_menu/menu.php';
    }elseif ($pmodule=='submenu'){
        include 'module/mod_tools_submenu/submenu.php';
    }elseif ($pmodule=='user'){
        include 'module/mod_tools_users/users.php';
        
        
    }elseif ($pmodule=='karyawan'){
        include 'module/mod_mst_karyawan/karyawan.php';
    }elseif ($pmodule=='mstprofile'){
        include 'module/mod_mst_profile/tambah_profile.php';
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
