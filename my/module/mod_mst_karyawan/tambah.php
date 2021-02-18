<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$aksi="module/mod_mst_karyawan/aksi_karyawan.php";

$hari_ini = date("Y-m-d");
$tgl_pertama = date('01 F Y', strtotime('-2 month', strtotime($hari_ini)));
$tgl_akhir = date('t F Y', strtotime($hari_ini));
    
$pmodule=$_GET['module'];
$pidmenu=$_GET['idmenu'];
$pact=$_GET['act'];

$pkodeid="";
$pnama="";
$pjekel="";
$ptempat="";
$ptgllahir="";
$palamat1="";
$palamat2="";
$pjabatanid="";
$patasanid="";
$ptglmasuk="";
$ptglkeluar="";
$pstatuskry="";

$act="input";
if ($pact=="editdata"){
    $act="update";
    
    $pkodeid=$_GET['id'];
    $query = "select * from $vdbname.t_karyawan WHERE KARYAWANID='$pkodeid'";
    $tampil= mysqli_query($cnmy, $query);
    $r= mysqli_fetch_array($tampil);
    
    $pnama=$r['NAMA'];
    $pjekel=$r['JKEL'];
    $ptempat=$r['TEMPAT'];
    $pstatuskry=$r['T_STATUS'];
    
    if (!empty($r['TGLLAHIR']) AND $r['TGLLAHIR']<>"0000-00-00") $ptgllahir=date('d F Y', strtotime($r['TGLLAHIR']));
    $palamat1=$r['ALAMAT1'];
    $palamat2=$r['ALAMAT2'];
    $pjabatanid=$r['JABATANID'];
    $patasanid=$r['ATASANID'];
    if (!empty($r['TGLMASUK']) AND $r['TGLMASUK']<>"0000-00-00") $ptglmasuk=date('d F Y', strtotime($r['TGLMASUK']));
    if (!empty($r['TGLKELUAR']) AND $r['TGLKELUAR']<>"0000-00-00") $ptglkeluar=date('d F Y', strtotime($r['TGLKELUAR']));

}
?>
<div class='col-md-6'>

    <!-- form start -->
    <form class="form-horizontal" id='form1' name='form1' method=POST action='<?PHP echo "$aksi?module=$pmodule&act=$act&idmenu=$pidmenu"; ?>' enctype='multipart/form-data'>
        <div class="box-body">
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="e_id" name="e_id" placeholder="ID" Readonly value="<?PHP echo $pkodeid; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="e_nama" name="e_nama" placeholder="Nama" required onkeyup="this.value = this.value.toUpperCase();" value="<?PHP echo $pnama; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Jenis Kelamin</label>
                <div class="col-sm-8">
                    <select class="form-control" id="cb_jkel" name="cb_jkel">
                        <option value="">--Pilihan--</option>
                        <?PHP
                        if ($pjekel=="L") {
                        ?>
                            <option value="L" selected>Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        <?PHP
                        }elseif ($pjekel=="P") {
                        ?>
                            <option value="L">Laki-Laki</option>
                            <option value="P" selected>Perempuan</option>
                        <?PHP
                        }else{
                        ?>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        <?PHP
                        }
                        ?>
                    </select>
                        
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Tempat Lahir</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="e_tempat" name="e_tempat" placeholder="Tempat Lahir" onkeyup="this.value = this.value.toUpperCase();" value="<?PHP echo $ptempat; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Tgl. Lahir</label>
                <div class="col-sm-8">
                    
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" id='e_tgllahir' name='e_tgllahir' autocomplete='off' value="<?PHP echo $ptgllahir; ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="e_alamat" name="e_alamat" placeholder="Alamat" value="<?PHP echo $palamat1; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Jabatan</label>
                <div class="col-sm-8">
                    <select class="form-control" id="cb_jabatan" name="cb_jabatan">
                        <option value="">--Pilihan--</option>
                        <?PHP
                        $query = "select * from $vdbname.t_jabatan order by JABATANID";
                        $tampil= mysqli_query($cnmy, $query);
                        while ($a= mysqli_fetch_array($tampil)) {
                            $pjbtid=$a['JABATANID'];
                            $pnamajbt=$a['NAMA'];
                            if ($pjbtid==$pjabatanid)
                                echo "<option value='$pjbtid' selected>$pjbtid - $pnamajbt</option>";
                            else
                                echo "<option value='$pjbtid'>$pjbtid - $pnamajbt</option>";
                        }
                        ?>
                    </select>
                        
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Atasan</label>
                <div class="col-sm-8">
                    <select class="form-control" id="cb_atasan" name="cb_atasan">
                        <option value="">--Pilihan--</option>
                        <?PHP
                        $query = "select * from $vdbname.t_karyawan order by NAMA";
                        $tampil= mysqli_query($cnmy, $query);
                        while ($a= mysqli_fetch_array($tampil)) {
                            $patsid=$a['KARYAWANID'];
                            $pnamaats=$a['NAMA'];
                            if ($patsid==$patasanid)
                                echo "<option value='$patsid' selected>$pnamaats</option>";
                            else
                                echo "<option value='$patsid'>$pnamaats</option>";
                            
                        }
                        ?>
                    </select>
                        
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Tgl. Masuk</label>
                <div class="col-sm-8">
                    
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" id='e_tglmasuk' name='e_tglmasuk' autocomplete='off' value="<?PHP echo $ptglmasuk; ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Tgl. Keluar</label>
                <div class="col-sm-8">
                    
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" id='e_tglkeluar' name='e_tglkeluar' autocomplete='off' value="<?PHP echo $ptglkeluar; ?>">
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Status Karyawan</label>
                <div class="col-sm-8">
                    <input list="tstatuskry" id="e_stskry" name="e_stskry" class='form-control col-md-7 col-xs-12' value="<?PHP echo $pstatuskry; ?>">
                    <datalist id="tstatuskry">
                    <?PHP
                        $query = "select distinct T_STATUS as T_STATUS from $vdbname.t_karyawan order by T_STATUS";
                        $tampild= mysqli_query($cnmy, $query);
                        while ($rt= mysqli_fetch_array($tampild)) {
                            $nstatus=$rt['T_STATUS'];
                            
                            echo "<option value='$nstatus'>";
                        }
                    ?>

                    </datalist>
                </div>
            </div>
            

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type='button' class='btn btn-success' onclick='disp_confirm("Simpan ?", "<?PHP echo $act; ?>")'>Simpan</button>
            <input type='button' class='btn btn-default pull-right' value='Kembali' onclick=self.history.back()>
        </div>
        <!-- /.box-footer -->

    </form>

</div>

<script type="text/javascript">
    $(function() {
        $('#e_tgllahir, #e_tglmasuk, #e_tglkeluar').datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            dateFormat: 'dd MM yy',
            onSelect: function(dateStr) {
                
            } 
        });
    });
    
    
    function disp_confirm(pText_, ket)  {

        var enama =document.getElementById('e_nama').value;
        if (enama==""){
            alert("nama masih kosong....");
            return 0;
        }

        ok_ = 1;
        if (ok_) {
            var r=confirm(pText_)
            if (r==true) {
                //document.write("You pressed OK!")
                var myurl = window.location;
                var urlku = new URL(myurl);
                var module = urlku.searchParams.get("module");
                var idmenu = urlku.searchParams.get("idmenu");
                
                document.getElementById("form1").action = "module/mod_mst_karyawan/aksi_karyawan.php?module="+module+"&act="+ket+"&idmenu="+idmenu;
                document.getElementById("form1").submit();
                return 1;
            }
        } else {
            //document.write("You pressed Cancel!")
            return 0;
        }
    }
</script>