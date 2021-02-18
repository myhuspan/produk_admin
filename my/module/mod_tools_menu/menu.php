<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];
?>
<section class="content-header">
    <?PHP
    $JUDUL="Menu";
    if ($myact=="tambahbaru")
        $JUDUL= "Input $JUDUL";
    elseif ($myact=="editdata")
        $JUDUL= "Edit $JUDUL";
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
$aksi="module/mod_tools_menu/aksi_menu.php";
switch($myact){
  // Tampil Menu
  default:
      echo "<div class='col-md-12'>";
            echo "<h2><input class='btn btn-default' type=button value='Tambah Baru' "
                . "onclick=\"window.location.href='?module=$_GET[module]&idmenu=$_GET[idmenu]&act=tambahbaru';\"></h2>";
            
            echo "
                  *) Apabila PUBLISH = Y, maka Menu ditampilkan di halaman pengunjung. <br />
                  **) Apabila AKTIF = Y, maka Menu ditampilkan di halaman administrator pada daftar menu yang berada di bagian kanan.</div>
                  <table id='datatable' class='table table-striped table-bordered' width='100%'>
                  <thead><tr>
                  <th>Urutan</td>
                  <th>nama menu</td>
                  <th>link</td>
                  <th>publish</td>
                  <th>urutan</td>
                  <th>aksi</td>
                  </tr></thead><tbody>";
            $tampil=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_menu where parent_id = 0 ORDER BY urutan");
            while ($r=mysqli_fetch_array($tampil)){
              echo "<tr><td>$r[URUTAN]</td>
                    <td>$r[JUDUL]</td>
                    <td><a href=$r[URL]>$r[URL]</a></td>
                    <td>$r[PUBLISH]</td>
                    <td>$r[URUTAN]</td>
                    <td width='150'><a class='btn btn-primary' href=?module=menuutama&act=editmenu&id=$r[ID]>Edit</a> &nbsp;
                    <a class='btn btn-danger btn-sm' href=\"$aksi?module=$_GET[module]&act=hapus&id=$r[ID]&idmenu=$_GET[idmenu]\"
                                    onClick=\"return confirm('Apakah Anda benar-benar akan menghapusnya?')\">Hapus</a>";

               echo "</td></tr>";
            }
            echo "</tbody></table>";


        echo "</div>";
    break;

  case "tambahbaru":
        echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
            //panel
            echo "<div class='x_panel'>";

                echo "<form method=POST action='$aksi?module=menuutama&act=input'>
                      <table width='100%'>
                      <tr><td>Nama Menu</td> <td> : </td><td><input type=text class='form-control' name='nama_menu'></td></tr>
                      <tr><td>Link</td>       <td> : </td><td><input type=text class='form-control' name='link'></td></tr>
                      <tr><td>Publish</td>    <td> : </td><td><input type='radio' name='publish' id='radio1' value='Y' checked><label for='radio1'>Y</label>
                                                     <input type='radio' name='publish' id='radio2' value='N'><label for='radio2'>N</label></td></tr>
                      <tr><td colspan=3><input type=submit class='btn btn-primary' value=Simpan>
                                        <input type=button class='btn btn-primary' value=Batal onclick=self.history.back()></td></tr>
                      </table></form>";
    
            echo "</div>";//end panel

        echo "</div>";
     break;
 
  case "editmenu":
        echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
            //panel
            echo "<div class='x_panel'>";

                $edit = mysqli_query($cnmy, "SELECT * FROM $vdbname.t_menu WHERE id='$_GET[id]'");
                $r    = mysqli_fetch_array($edit);

                

                echo "<form method=POST action=$aksi?module=menuutama&act=update>
                      <input type=hidden name=id value='$r[ID]'>
                      <table width='100%'>

                      <tr><td>Nama Menu</td>     <td> : </td><td><input type=text class='form-control' name='nama_menu' value='$r[JUDUL]'></td></tr>
                      <tr><td>Link</td>     <td> : </td><td><input type=text class='form-control' name='link' value='$r[URL]'></td></tr>";
                if ($r['PUBLISH']=='Y'){
                  echo "<tr><td>Publish</td> <td> : </td><td><input type=radio name='publish' id='radio1' value='Y' checked><label for='radio1'>Y</label>
                                                    <input type=radio name='publish' id='radio2' value='N'><label for='radio2'>N</label></td></tr>";
                }
                else{
                  echo "<tr><td>Publish</td> <td> : </td><td><input type=radio name='publish' id='radio1' value='Y'><label for='radio1'>Y</label>
                                                    <input type=radio name='publish' id='radio2' value='N' checked><label for='radio2'>N</label></td></tr>";
                }
                echo "<tr><td>Urutan</td>       <td> : </td><td><input type=text class='form-control' name='urutan' value='$r[URUTAN]'></td></tr>
                      <tr><td colspan=3><input type=submit class='btn btn-primary' value=Update>
                                        <input type=button class='btn btn-primary' value=Batal onclick=self.history.back()></td></tr>
                      </table></form>";

            echo "</div>";//end panel

        echo "</div>";

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