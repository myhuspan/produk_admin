<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$edit=mysqli_query($cnmy, "SELECT a.KARYAWANID, a.NAMA, b.USERNAME, b.ID_GROUP, b.LEVEL, "
        . " b.LEVEL, b.ONLINE, b.CREATEDPW, b.PASSWORD, b.KEYPASS, b.AKHUSUS "
        . " FROM $vdbname.t_karyawan a LEFT JOIN "
        . " $vdbname.t_users b on a.KARYAWANID=b.KARYAWANID "
        . " WHERE a.KARYAWANID='$_GET[id]'");
$r=mysqli_fetch_array($edit);
$pidgrdlog=$_SESSION['GROUP'];
if (empty($r['USERNAME'])){
?>
<script> window.onload = function() { document.getElementById("e_user").focus(); } </script>
<?PHP }else{ ?>
<script> window.onload = function() { document.getElementById("e_pass").focus(); } </script>
<?PHP } ?>
<!-- Modal -->
<div class='modal fade' id='myModal' role='dialog'></div>


<div class="">

    <!--row-->
    <div class="row">

        <?php
                echo "<form method='POST' action='$aksi?module=$_GET[module]&act=update&idmenu=$_GET[idmenu]&id=$_GET[id]' id='demo-form2' name='form1' data-parsley-validate class='form-horizontal form-label-left'>
                    <input type='hidden' name='id' value='$r[KARYAWANID]'>";

                echo "<div class='col-md-12 col-sm-12 col-xs-12'>";

                    //panel
                    echo "<div class='x_panel'>";


                        //isi content
                        echo "<div class='x_content'>";

                        //title
                        echo "<div class='col-md-12 col-sm-12 col-xs-12'>
                            <h2><input type='button' value='Kembali' onclick='self.history.back()' class='btn btn-default'>";
                        echo "&nbsp; <button class='btn btn-primary' type='reset'>Reset</button>
                            <button type='submit' class='btn btn-success'>Simpan</button>";
                        echo "</h2><div class='clearfix'></div></div>";

                            //isi kata-kata
                            /*
                            echo "<p class='text-muted font-13 m-b-30'>";
                            echo "";
                            echo "</p>";
                             *
                             */


                        echo "<div class='form-group'>";
                        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_klpkode'>Id Karyawan <span class='required'> </span></label>";
                        echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                            <input type='text' id='e_id' name='e_id' required='required' class='form-control col-md-7 col-xs-12' value='$r[KARYAWANID]' readonly>
                            </div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_ket'>Nama <span class='required'> </span></label>";
                        echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                            <input type='text' id='e_nama' name='e_nama' required='required' class='form-control col-md-7 col-xs-12' value='$r[NAMA]' disabled='disabled'>
                            </div>";
                        echo "</div>";

                        $ro="";
                        if (!empty($r['USERNAME'])){
                            //$ro="Readonly";
                        }
                        $usernn=(int)$_GET['id'];
                        if (!empty($r['USERNAME'])) $usernn=$r['USERNAME'];
                        
                        $passD="";
                        //if ((int)$usernn==(int)$r['KARYAWANID']) $passD=$r['pin'];
                        
                        echo "<div class='form-group'>";
                        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_ket'>Username <span class='required'>*</span></label>";
                        echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                            <input type='text' id='e_user' name='e_user' required='required' class='form-control col-md-7 col-xs-12' value='$usernn' $ro>
                            </div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_ket'>Password <span class='required'> </span></label>";
                        echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                            <input type='text' id='e_pass' name='e_pass' class='form-control col-md-7 col-xs-12' value='$passD'>
                            </div>";
                        echo "</div>";

                        $hilangkan="hidden";
                        if ($_SESSION['LEVELUSER']=="admin") $hilangkan="";
                        if ($_SESSION['GROUP']=="2") $hilangkan="";
                        
                        echo "<div $hilangkan>";
                            echo "<div class='form-group'>";
                                echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_genre'>Group User <span class='required'>*</span></label>";
                                echo "<div class='col-md-6 col-sm-6 col-xs-12'>";
                                echo "<select class='form-control' id='e_ugroup' name='e_ugroup'>";
                                    
                                    if ($pidgrdlog=="1"){
                                        $tampil=mysqli_query($cnmy, "SELECT ID_GROUP, NAMA_GROUP FROM $vdbname.t_groupuser order by NAMA_GROUP");
                                    }else{
                                        $tampil=mysqli_query($cnmy, "SELECT ID_GROUP, NAMA_GROUP FROM $vdbname.t_groupuser WHERE ID_GROUP<>'1' order by NAMA_GROUP");
                                    }
                                    echo "<option value='' selected></option>";
                                    while($t=mysqli_fetch_array($tampil)){
                                        if ($r['ID_GROUP']==$t['ID_GROUP'])
                                            echo "<option value='$t[ID_GROUP]' selected>$t[NAMA_GROUP]</option>";
                                        else
                                            echo "<option value='$t[ID_GROUP]'>$t[NAMA_GROUP]</option>";
                                    }
                                echo "</select>";
                                echo "</div>";
                            echo "</div>";

                            $ltype1=""; $ltype2="";;
                            if ($r['LEVEL']=="admin")
                                $ltype1="checked";
                            elseif ($r['LEVEL']=="guest")
                                $ltype2="checked";

                            echo "<div class='form-group'>";
                            echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_ket'>Tipe <span class='required'>*</span></label>";
                            echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                                    <div class='btn-group' data-toggle='buttons'>
                                        <input type='radio' class='flat' name='rb_tipe' id='rb_tipe1' value='admin' $ltype1> Admin 
                                        <input type='radio' class='flat' name='rb_tipe' id='rb_tipe2' value='guest' $ltype2> Guest 
                                    </div>
                                </div>";
                            echo "</div>";
                            
                            $lkhusus1=""; $lkhusus2="";;
                            if ($r['AKHUSUS']=="Y")
                                $lkhusus1="checked";
                            elseif ($r['AKHUSUS']=="N")
                                $lkhusus2="checked";
                            
                            echo "<div hidden class='form-group'>";
                            echo "<label class='control-label col-md-3 col-sm-3 col-xs-12' for='e_ket'>Admin Khusus <span class='required'></span></label>";
                            echo "<div class='col-md-6 col-sm-6 col-xs-12'>
                                    <div class='btn-group' data-toggle='buttons'>
                                        <label class='btn btn-default'><input type='radio' class='flat' name='rb_khusus' id='rb_khusus1' value='Y' $lkhusus1> Yes </label>
                                        <label class='btn btn-default'><input type='radio' class='flat' name='rb_khusus' id='rb_khusus2' value='N' $lkhusus2> No </label>
                                    </div>
                                </div>";
                            echo "</div>";
                            

                        echo "</div>";//$hilangkan
                        
                        echo "</div>";//end x_content

                    echo "</div>";//end panel

                echo "</div>";

                echo "</form>";

        ?>

    </div>
    <!--end row-->
</div>
