<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];
?>
<section class="content-header">
    <?PHP
    $JUDUL="Group User";
    if ($myact=="tambahbaru")
        $JUDUL= "Input $JUDUL";
    elseif ($myact=="editdata")
        $JUDUL= "Edit $JUDUL";
    elseif ($myact=="editgroupmenu")
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
$aksi="module/mod_tools_groupuser/aksi_groupuser.php";

switch($myact){
    default:
        echo "<div class='col-md-12'>";
            echo "<h2><input class='btn btn-default' type=button value='Tambah Baru' "
                . "onclick=\"window.location.href='?module=$_GET[module]&idmenu=$_GET[idmenu]&act=tambahbaru';\"></h2>";
            $fgroup="";
            if ($_SESSION['GROUP']<>"1") $fgroup=" AND ID_GROUP<>'1'";
            $tampil = mysqli_query($cnmy, "SELECT * FROM $vdbname.t_groupuser WHERE 1=1 $fgroup order by NAMA_GROUP");
            echo "<table id='datatable' class='table table-striped table-bordered'>";
            echo "<thead>
                    <tr><th>No</th>
                        <th>Nama</th>
                        <th>Group Menu</th>
                        <th>Aksi</th>
                    </tr>
                </thead><tbody>";

            $no=1;
            while ($r=mysqli_fetch_array($tampil)){
                echo "<tr><td>$no</td>
                      <td><a class='btn btn-primary btn-xs' href=?module=groupuser&act=edituser&id=$r[ID_GROUP]&idmenu=$_GET[idmenu]>$r[NAMA_GROUP]</a></td>";
                echo "<td><a class='btn btn-primary btn-xs' href='?module=groupuser&act=editgroupmenu&id=$r[ID_GROUP]&nama=$r[NAMA_GROUP]&idmenu=$_GET[idmenu]' class='btn btn-mini edit'>Lihat dan Edit</a></td>";
                echo "<td>";
                    if ($r['ID_GROUP']=="1" OR $r['ID_GROUP']=="2"){
                    }else{
                        echo " <a class='btn btn-danger btn-xs' href=\"$aksi?module=groupuser&act=hapususer&id=$r[ID_GROUP]&idmenu=$_GET[idmenu]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">hapus</a>";
                    }
                    echo "</td>";
                echo "</tr>";
                $no++;
            }
            echo "</tbody></table>";
        echo "</div>";
    break;
  
    case "tambahbaru":
        ?>
        <div class="col-md-6">
            
            <!-- form start -->
            <form class="form-horizontal" name='form1' method=POST action='<?PHP echo "$aksi?module=groupuser&act=input&idmenu=$_GET[idmenu]"; ?>' onSubmit='return validasi(this)'>
                <div class="box-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type='submit' value='Simpan' class='btn btn-primary'>
                    <input type='button' class='btn btn-info pull-right' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.box-footer -->

            </form>
            
        </div>   
        <?PHP
    break;
    
    case "edituser":
        
        $edit=mysqli_query($cnmy, "SELECT * FROM $vdbname.t_groupuser WHERE ID_GROUP='$_GET[id]'");
        $r=mysqli_fetch_array($edit);
        $pid=$r['ID_GROUP'];
        $pnmgrp=$r['NAMA_GROUP'];
        ?>
        <div class="col-md-6">
            
            <!-- form start -->
            <form class="form-horizontal" name='form1' method=POST action='<?PHP echo "$aksi?module=groupuser&act=update&idmenu=$_GET[idmenu]"; ?>' onSubmit='return validasi(this)'>
                <div class="box-body">
                    <input type=hidden name=id value='<?PHP echo $pid; ?>'>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value='<?PHP echo $pnmgrp; ?>'>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type='submit' class='btn btn-primary' value='Update' class='btn'>
                    <input type='button' class='btn btn-info pull-right' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.box-footer -->

            </form>
            
        </div>   
        <?PHP
    break;

    case "editgroupmenu":
        ?>
        <div class="col-md-12">
            <style>
                table.example_2 {
                    color: #333;
                    font-family: Helvetica, Arial, sans-serif;
                    width: 640px;
                    border-collapse:
                    collapse; border-spacing: 0;
                }

                td, th {
                    border: 1px solid transparent; /* No more visible border */
                    height: 30px;
                    transition: all 0.3s;  /* Simple transition for hover effect */
                }

                th {
                    background: #DFDFDF;  /* Darken header a bit */
                    font-weight: bold;
                }

                td {
                    background: #FAFAFA;
                }

                /* Cells in even rows (2,4,6...) are one color */
                tr:nth-child(even) td { background: #F1F1F1; }

                /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */
                tr:nth-child(odd) td { background: #FEFEFE; }

                tr td:hover.biasa { background: #666; color: #FFF; }
                tr td:hover.left { background: #ccccff; color: #000; }

                tr td.center1, td.center2 { text-align: center; }

                tr td:hover.center1 { background: #666; color: #FFF; text-align: center; }
                tr td:hover.center2 { background: #ccccff; color: #000; text-align: center; }
                /* Hover cell effect! */
            </style>
            
            <form class="form-horizontal"  name='form1' method='POST' enctype='multipart/form-data' action='<?PHP echo "$aksi?module=groupuser&act=updatemenugrop&idgroup=$_GET[id]&nama=$_GET[nama]&idmenu=$_GET[idmenu]"; ?>'>
                <div class="box-footer">
                    <input type='submit' class='btn btn-primary' value='Simpan'>
                    <input type='button' class='btn btn-info pull-right' value='Kembali' onclick=self.history.back()>
                </div>
                
                <?PHP
                $tampil=  mysqli_query($cnmy, "select * from $vdbname.t_menu where PARENT_ID='0' AND PUBLISH='Y' order by URUTAN, JUDUL");
                //echo "<table border='1' id='example_2' cellpadding='0' cellspacing='0' width='100%' class='display'>";
                echo "<table id='datatable2' class='table table-striped table-bordered'>";
                echo "<thead>
                        <tr><th>No</th>
                            <th>Nama Menu</th>
                            <th colspan='2'>Cek</th>
                            <th>Tambah</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead><tbody>";

                $no=1;
                while ($r=mysqli_fetch_array($tampil)){
                        
                    $fhidden="";
                    if ($_SESSION['GROUP']<>"1") {
                        if ($r['ID']=="1") {
                            $fhidden="hidden";
                        }
                    }
                        
                    echo "<tr $fhidden><td>$no</td>";
                    echo "<td class='biasa'><b>Menu $r[JUDUL]</b></td>";

                    $carigrp=mysqli_query($cnmy, "select * from $vdbname.t_groupmenu where id_group='$_GET[id]' and id='$r[ID]'");
                    $adagrp=mysqli_num_rows($carigrp);
                    $adachk="";
                    if ($adagrp>0) $adachk="checked";
                    echo "<td class='center1' width='100'>
                        <input type=checkbox value='$r[ID]' name=tag_km[] class='checkall$r[ID]' onClick='toggleCexBoxHILANG(this)' $adachk></td>
                        <td></td><td><input type=checkbox value='$r[ID]' name=tag_tambah[] class='checkallT$r[ID]' onClick='toggleCexBox(this)'></td>
                    <td><input type=checkbox value='$r[ID]' name=tag_tambah[] class='checkallE$r[ID]' onClick='toggleCexBox(this)'></td>
                    <td><input type=checkbox value='$r[ID]' name=tag_tambah[] class='checkallH$r[ID]' onClick='toggleCexBox(this)'></td>";
                    echo "</tr>";
                    $tampil2=  mysqli_query($cnmy, "select * from $vdbname.t_menu where PARENT_ID='$r[ID]' AND PUBLISH='Y' order by URUTAN, JUDUL");
                    $nsub=0;
                    while ($s=mysqli_fetch_array($tampil2)){
                        $no++;

                        $carigrp=mysqli_query($cnmy, "select * from $vdbname.t_groupmenu where id_group='$_GET[id]' and id='$s[ID]'");
                        $adagrp=mysqli_num_rows($carigrp);
                        $adachk="";
                        $cekT="";$cekE="";$cekH="";
                        $cT="N";$cE="N";$cH="N";
                        $grp=mysqli_fetch_array($carigrp);
                        if ($adagrp>0){

                            $adachk="checked";
                            if ($grp['TAMBAH']=="Y"){ $cekT="checked"; $cT="Y"; }
                            if ($grp['EDIT']=="Y"){ $cekE="checked"; $cE="Y"; }
                            if ($grp['HAPUS']=="Y"){ $cekH="checked"; $cH="Y"; }
                        }
                        
                        if ($nsub==0){
                            $cT="Y";$cE="Y";$cH="Y";
                            if (empty($grp['ID'])) $grp['ID']="0";
                            echo "<tr $fhidden><td>$no</td>";
                            echo "<td>$s[JUDUL]</td>";
                            echo "<td class='center' width='100'>&nbsp;</td><td class='center2'><input type=checkbox class='checkall$r[ID]' value='$s[ID]' name=tag_km[] $adachk></td>
                                <td class='center2'><input type=checkbox class='checkallT$r[ID]' value='$cT' name='arr_tambah$grp[ID]' $cekT></td>
                                <td class='center2'><input type=checkbox class='checkallE$r[ID]' value='$cE' name='arr_edit$grp[ID]' $cekE></td>
                                <td class='center2'><input type=checkbox class='checkallH$r[ID]' value='$cH' name='arr_hapus$grp[ID]' $cekH></td>";
                            echo "</tr>";
                        }else{
                            echo "<tr $fhidden><td>$no</td>";
                            echo "<td>$s[JUDUL]</td>";
                            echo "<td class='center' width='100'>&nbsp;</td><td class='center2'><input type=checkbox class='checkall$r[ID]' value='$s[ID]' name=tag_km[] $adachk></td>
                                <td class='center2'><input type=checkbox class='checkallT$r[ID]' name='arr_tambah$s[ID]' $cekT></td>
                                <td class='center2'><input type=checkbox class='checkallE$r[ID]' name='arr_edit$s[ID]' $cekE></td>
                                <td class='center2'><input type=checkbox class='checkallH$r[ID]' name='arr_hapus$s[ID]' $cekH></td>";
                            echo "</tr>";
                        }

                        $nsub++;
                    }

                    $no++;
                }
                echo "</tbody></table>";
                ?>
                <div class="box-footer">
                    <input type='submit' class='btn btn-primary' value='Simpan'>
                    <input type='button' class='btn btn-info pull-right' value='Kembali' onclick=self.history.back()>
                </div>
            </form>
        </div>
        <?PHP
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

<script type="text/javascript">
    function toggleCexBox(source) {
        var aInputs = document.getElementsByTagName('input');
        for (var i=0;i<aInputs.length;i++) {
            if (aInputs[i] != source && aInputs[i].className == source.className) {
                aInputs[i].checked = source.checked;
            }
        }
    }
</script> 