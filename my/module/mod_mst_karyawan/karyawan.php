<?PHP
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];
?>
<section class="content-header">
    <?PHP
    $JUDUL="Karyawan";
    if ($myact=="tambahbaru")
        $JUDUL= "Input $JUDUL";
    elseif ($myact=="editdata")
        $JUDUL= "Edit $JUDUL";
    elseif ($myact=="uploadfile")
        $JUDUL= "Upload File Data $JUDUL";
    else
        $JUDUL= "Data $JUDUL";
    
    echo "<h1>$JUDUL<small>&nbsp;</small></h1>";
    ?>
</section>


<!-- Main content -->
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <!--
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            <!--</div>
        </div>
        -->
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
        

<?php
$aksi="module/mod_mst_karyawan/aksi_karyawan.php";
switch($myact){
  // Tampil Menu
  default:
        ?>
        <script type="text/javascript" language="javascript" >

            function RefreshDataTabel() {
                KlikDataTabel();
            }

            $(document).ready(function() {
                KlikDataTabel();
            } );

            function KlikDataTabel() {
                var myurl = window.location;
                var urlku = new URL(myurl);
                var module = urlku.searchParams.get("module");
                var act = urlku.searchParams.get("act");
                var idmenu = urlku.searchParams.get("idmenu");
                
                $("#loading").html("<center><img src='images/loading.gif' width='50px'/></center>");
                $.ajax({
                    type:"post",
                    url:"module/mod_mst_karyawan/viewdatatabel.php?module="+module+"&act="+act+"&idmenu="+idmenu,
                    data:"eket="+module,
                    success:function(data){
                        $("#c-data").html(data);
                        $("#loading").html("");
                    }
                });
            }

        </script>
        
        <div class='col-md-12'>
            <?PHP
            echo "<h2><input class='btn btn-default' type=button value='Tambah Baru' "
                . "onclick=\"window.location.href='?module=$_GET[module]&idmenu=$_GET[idmenu]&act=tambahbaru';\"></h2>";
            ?>
            <div id='loading'></div>
            <div id='c-data'>

            </div>
        </div>
        
        <?PHP
    break;

  case "tambahbaru":
        include "tambah.php";
     break;
 
  case "editdata":
        include "tambah.php";
    break;  
 
  case "uploadfile":
        include "fileupload.php";
    break;  
}
?>

                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->

        <div class="box-footer">
            &nbsp;
        </div>
        
    </div>
    <!-- /.box -->
</section>