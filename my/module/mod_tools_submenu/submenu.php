<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];
?>
<section class="content-header">
    <?PHP
    $JUDUL="Sub Menu";
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
$aksi="module/mod_tools_submenu/aksi_submenu.php";
switch($myact){
  // Tampil Sub Menu
  default:
        ?>
        <script>
            $(document).ready(function() {
                //alert(etgl1);
                var dataTable = $('#datatablemenu').DataTable( {
                    "stateSave": true,
                    "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                    "displayLength": 10,
                    "scrollY": 460,
                    "scrollX": true
                } );
                $('div.dataTables_filter input', dataTable.table().container()).focus();
            } );
        </script>
        <style>
            .divnone {
                display: none;
            }
        </style>
        <?PHP
        echo "<div class='col-md-12'>";
            //panel
            echo "<div class='x_panel'>";

                echo "<input type=button class='btn btn-default' value='Tambah Menu' onclick=\"window.location.href='?module=submenu&act=tambah&idmenu=$_GET[idmenu]';\" ><br /><br />
                      <div id=paging>
                      *) Apabila PUBLISH = Y, maka Sub Menu ditampilkan di halaman pengunjung. <br />
                      **) Apabila AKTIF = Y, maka Sub Menu ditampilkan di halaman administrator pada daftar menu yang berada di bagian kanan.</div>
                      <table id='datatablemenu' class='table nowrap table-striped table-bordered' width='100%'>
                      <thead><tr>
                      <th>Menu</td>
                      <th>Urutan</td>
                      <th>Nama Modul</td>
                      <th>link</td>
                      <th>Publish</td>
                      <th>Aksi</td>
                      </tr></thead><tbody>";
                $tampil=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_menu where parent_id <> 0 ORDER BY urutan, id");
                while ($r=mysqli_fetch_array($tampil)){
                    $menu=  getfield("select JUDUL as lcfields from $vdbname.t_menu where ID='$r[PARENT_ID]'");
                  echo "<tr><td>$menu</td>
                        <td>$r[URUTAN]</td>
                        <td>$r[JUDUL]</td>
                        <td><a href='$r[URL]&idmenu=$r[ID]&act=$menu'>$r[URL]</a></td>
                        <td>$r[PUBLISH]</td>
                        <td width='150'><a class='btn btn-primary btn-xs' href=?module=submenu&act=editmenu&id=$r[ID]&idmenu=$_GET[idmenu]>Edit</a> &nbsp;
                        <a class='btn btn-danger btn-xs' href=\"$aksi?module=$_GET[module]&act=hapus&id=$r[ID]&idmenu=$_GET[idmenu]\"
                                        onClick=\"return confirm('Apakah Anda benar-benar akan menghapusnya?')\" title='delete-$r[JUDUL]'>Hapus</a>";

                   echo "</td></tr>";
                }
                echo "</tbody></table>";
                
            echo "</div>";//end panel

        echo "</div>";
        
    break;

  case "tambah":
        echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
            //panel
            echo "<div class='x_panel'>";

                echo "<form method=POST action='$aksi?module=submenu&act=input&idmenu=$_GET[idmenu]'>
                      <table width='100%'>
                    <tr><td>Menu</td>  <td> : </td><td>
                      <select class='form-control' name='menu'>
                        <option value=0 selected>- Pilih Menu -</option>";
                        $tampil=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_menu where parent_id='0' ORDER BY urutan, judul");
                        while($r=mysqli_fetch_array($tampil)){
                          echo "<option value=$r[ID]>$r[JUDUL]</option>";
                        }
                echo "</select></td></tr>
                      <tr><td>Nama Menu</td> <td> : </td><td><input type=text class='form-control' name='nama_menu'></td></tr>
                      <tr><td>Link</td>       <td> : </td><td><input type=text class='form-control' name='link'></td></tr>
                      <tr><td>Publish</td>    <td> : </td><td><input type=radio name='publish' id='radio1' value='Y' checked><label for='radio1'>Y</label>
                                                     <input type=radio name='publish' id='radio2' value='N'><label for='radio2'>N</label></td></tr>
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
                echo "<form method=POST action=$aksi?module=submenu&act=update&idmenu=$_GET[idmenu]>
                      <input type=hidden name=id value='$r[ID]'>
                      <table width='100%'>

                      <tr><td>Menu</td>  <td> : </td><td><select class='form-control' name='menu'>";

                      $tampil=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_menu where parent_id='0' ORDER BY urutan, judul");
                      if ($r['ID']==0){
                        echo "<option value=0 selected>- Pilih Menu -</option>";
                      }

                      while($w=mysqli_fetch_array($tampil)){
                        if ($r['PARENT_ID']==$w['ID']){
                          echo "<option value=$w[ID] selected>$w[JUDUL]</option>";
                        }
                        else{
                          echo "<option value=$w[ID]>$w[JUDUL]</option>";
                        }
                      }
                echo "</select></td></tr>

                      <tr><td>Nama Menu</td>     <td> : </td><td><input type=text class='form-control' name='nama_menu' value='$r[JUDUL]'></td></tr>
                      <tr><td>Link</td>     <td> : </td><td><input type=text class='form-control' name='link' size=30 value='$r[URL]'></td></tr>";
                if ($r['PUBLISH']=='Y'){
                  echo "<tr><td>Publish</td> <td> : </td><td><input type=radio name='publish' id='radio1' value='Y' checked><label for='radio1'>Y</label>
                                                    <input type=radio name='publish' id='radio2' value='N'><label for='radio2'>N</label></td></tr>";
                }
                else{
                  echo "<tr><td>Publish</td> <td> : </td><td><input type=radio name='publish' id='radio1' value='Y'><label for='radio1'>Y</label>
                                                    <input type=radio name='publish' id='radio2' value='N' checked><label for='radio2'>N</label></td></tr>";
                }

                if ($r['M_KHUSUS']=='Y'){
                  echo "<tr><td>Menu Khusus</td> <td> : </td><td><input type=radio name='mkhusus' id='mkhusus1' value='Y' checked><label for='radio1'>Y</label>
                                                    <input type=radio name='mkhusus' id='mkhusus2' value='N'><label for='radio2'>N</label></td></tr>";
                }
                else{
                  echo "<tr><td>Menu Khusus</td> <td> : </td><td><input type=radio name='mkhusus' id='mkhusus1' value='Y'><label for='radio1'>Y</label>
                                                    <input type=radio name='mkhusus' id='mkhusus2' value='N' checked><label for='radio2'>N</label></td></tr>";
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