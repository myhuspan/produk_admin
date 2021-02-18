<?PHP
    ini_set("memory_limit","10G");
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LOGIN</title>
    <link rel="shortcut icon" href="images/ptbinakarya.jpg" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    

    

    
    
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    
    
    <!-- style date time picker datetimepicker -->
    <link href="datetime/css/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        
  <!-- bootstrap datepicker 
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">-->
    
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    
    
     
</HEAD>

<BODY class="hold-transition skin-blue sidebar-mini">
    
    
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="?module=home" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>&nbsp;</b>&nbsp;</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>&nbsp;</span>

            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>



        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">


            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="dist/img/logogbr.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?PHP echo $_SESSION['NAMALENGKAP']; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> <a href="logout.php">Logout</a></a>
                    </div>
                </div>

                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->



                <!-- sidebar menu: : style can be found in sidebar.less -->

                <?PHP include 'menu.php'; ?>

            </section>
            <!-- /.sidebar -->
        </aside>



        <?PHP include 'home.php'; ?>


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b></b>
            </div>
            <strong>Copyright &copy; 2020 <a href="#">&nbsp;</a>.</strong> &nbsp;
        </footer>


    </div>
    <!-- ./wrapper -->

    

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->

    <!-- jquery.inputmask -->
    <script src="js/inputmask.js"></script>
    <script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- END jquery.inputmask -->  
    
    
    <!-- bootstrap-daterangepicker -->
    <script type='text/javascript' src='datetime/js/jquery-ui.min.js'></script>
    <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        
        
    <!-- bootstrap datepicker
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    </script> -->
    
    <script>
        $('#cbln01, #cbln02, #cbln03, #cbln04, #cbln05').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true,
            format: 'MMMM YYYY'
        });
        
        $('#tgl01, #tgl02, #tgl03, #tgl04, #tgl05, #tgl06, #tgl07, #tgl08, #tgl09, #tgl10').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true,
            format: 'DD MMMM YYYY'
        });

        $('#thn01, #thn02, #thn03, #thn04, #thn05').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true,
            format: 'YYYY'
        });

        $('#mytgl01, #mytgl02, #mytgl03, #mytgl04, #mytgl05').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true,
            format: 'DD/MM/YYYY'
        });
            
            
    </script>
</BODY>
</HTML>
