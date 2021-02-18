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

$act="uploadfile";

$pkodeid=$_GET['id'];
$query = "select * from $vdbname.t_karyawan WHERE KARYAWANID='$pkodeid'";
$tampil= mysqli_query($cnmy, $query);
$r= mysqli_fetch_array($tampil);

$pnama=$r['NAMA'];

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
                    <input type="text" class="form-control" id="e_nama" name="e_nama" placeholder="Nama" required onkeyup="this.value = this.value.toUpperCase();" value="<?PHP echo $pnama; ?>" Readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">File</label>
                <div class="col-sm-8">
                    <input type="file" id="txtnmfile" name="fileToUpload" id="fileToUpload" ><!--accept=".zip"-->
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
    
    <div>
        <table id='datatablekry' class='table table-striped table-bordered' width='100%'>
            <thead>
                <tr>
                    <th width='7px'>No</th>
                    <th width='70px'>&nbsp;</th>
                    <th width='40px'>ID</th>
                    <th width='80px'>Nama File</th>
                    <th width='40px'>Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?PHP
                $no=1;
                $query = "select * from $vdbname.t_karyawan_dok WHERE karyawanid='$pkodeid'";
                $tampilkan=mysqli_query($cnmy, $query);
                while ($nkr= mysqli_fetch_array($tampilkan)) {
                    $pidfile=$nkr['IDURUT'];
                    $pnmasli=$nkr['NAMA'];
                    $pnmfile=$nkr['NAMA_FILE'];
                    $pjenis=$nkr['F_EXT'];
                    
                    $fname=$pnmfile."".$pjenis;
                    
                    //$phapusdok= "<a class='btn btn-danger btn-xs' href='downloadfile.php?module=$_GET[module]&act=hapusdoktkry&idmenu=$_GET[idmenu]&id=$fname' target='_blank'>Hapus</a>";
                    $phapusdok = "<input type='button' value='Hapus' class='btn btn-danger btn-xs' onClick=\"ProsesData('Hapus...?', 'hapusdokt', '$pidfile')\">";
                    $pdownloadfile= "<a class='btn btn-info btn-xs' href='downloadfile.php?module=$_GET[module]&act=downloadfile&idmenu=$_GET[idmenu]&id=$fname' target='_blank'>Download</a>";
                    
                    echo "<tr>";
                    echo "<td nowrap>$no</td>";
                    echo "<td nowrap>$pdownloadfile &nbsp; &nbsp; $phapusdok</td>";
                    echo "<td nowrap>$pidfile</td>";
                    echo "<td nowrap>$pnmasli</td>";
                    echo "<td nowrap>$pjenis</td>";
                    echo "</tr>";
                    $no++;
                }
                
                ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    
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
            
    function ProsesData(pText_, ket, iid)  {

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
                
                document.getElementById("form1").action = "module/mod_mst_karyawan/aksi_karyawan.php?module="+module+"&act="+ket+"&idmenu="+idmenu+"&id="+iid;
                document.getElementById("form1").submit();
                return 1;
            }
        } else {
            //document.write("You pressed Cancel!")
            return 0;
        }
    } 
</script>