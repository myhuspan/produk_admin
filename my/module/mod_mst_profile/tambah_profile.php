<?PHP
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];

$pmodule=$_GET['module'];
$pidmenu=$_GET['idmenu'];
?>
<section class="content-header">
    <?PHP
    echo "<h1>PROFILE<small>&nbsp;</small></h1>";
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
$aksi="module/mod_mst_profile/aksi_profile.php";
switch($myact){
  // Tampil Menu
  default:
        ?>
        <script type="text/javascript" language="javascript" >

        </script>
        
        
        <?PHP
        $pkodeid="";
        $nact="update";
        
        $query = "select * from $vdbname.t_profile LIMIT 1";
        $tampil= mysqli_query($cnmy, $query);
        $prs= mysqli_fetch_array($tampil);
        $pkodeid=$prs['id'];
        $pnama=$prs['nama_pt'];
        $palamat=$prs['alamat_pt'];
        $pnowo=$prs['npwp'];
        $ptelp=$prs['telp'];
        $php=$prs['nohp'];
        $pfax=$prs['fax'];
        $pemail=$prs['email'];
        $paboutus=$prs['about_us'];
        $pcopyr=$prs['copy_r'];
        $pgambar1=$prs['gambar1'];
        $pgambar2=$prs['gambar2'];
        
    
        ?>
        
        
        <div class='col-md-12'>
            
            <div class='col-md-6'>
                
                
                <form class="form-horizontal" id='form1' name='form1' method=POST 
                      action='<?PHP echo "$aksi?module=$pmodule&act=$nact&idmenu=$pidmenu"; ?>' enctype='multipart/form-data'>
                
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
                                <input type="text" class="form-control" id="e_nama" name="e_nama" placeholder="Nama" required onkeyup="this.value = this.value.toUpperCase();" value="<?PHP echo $pnama; ?>" maxlength="100">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="e_alamat" name="e_alamat" placeholder="Alamat" required value="<?PHP echo $palamat; ?>" maxlength="100">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">NPWP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="e_npwp" name="e_npwp" placeholder="NPWP" required value="<?PHP echo $pnowo; ?>" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Telp.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="e_telp" name="e_telp" placeholder="Telepon" required value="<?PHP echo $ptelp; ?>" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Hp.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="e_hp" name="e_hp" placeholder="No Handphone" required value="<?PHP echo $php; ?>" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Fax.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="e_fax" name="e_fax" placeholder="FAX" required value="<?PHP echo $pfax; ?>" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="e_email" name="e_email" placeholder="Email" required value="<?PHP echo $pemail; ?>" maxlength="100">
                            </div>
                        </div>
                        
                        
                        <div  class="form-group">
                            <label for="" class="col-sm-3 control-label">About Us</label>
                            <div class="col-sm-8">
                                <textarea class='form-control' id='e_aboutus' name='e_aboutus' rows='3' placeholder='About Us'><?PHP echo $paboutus; ?></textarea>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Copy Right</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ecopyr" name="ecopyr" placeholder="@2020" required value="<?PHP echo $pcopyr; ?>" maxlength="100">
                            </div>
                        </div>
                        
                        <div hidden><textarea id="e_imgconv" name="e_imgconv"></textarea></div>

                        <div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for=''>Foto <span class='required'></span></label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <div class="checkbox">
                                    <input type='file' name='image1' id='image' onchange="loadImageFile();" accept='image/jpeg,image/JPG,,image/JPEG;capture=camera'/>
                                    <br/><img id="upload-Preview" height="100px"/> <b>Preview</b>
                                </div>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for=''>&nbsp; <span class='required'></span></label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <div class="checkbox">
                                    <?PHP
                                    if (!empty($pgambar1)) {
                                        echo "<img src='img/i_profile/$pgambar1' height='100px'>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-footer">
                            <?PHP
                            echo "<button type='button' class='btn btn-success' onclick=\"disp_confirm('Simpan ?', '$nact')\">Simpan</button>";
                            ?>
                        </div>
                        
                        
                    </div>
                
                </form>
                
                
            </div>
            
            
        </div>
        
        
        <script>
            var fileReader = new FileReader();
            var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

            fileReader.onload = function (event) {
                var image = new Image();

                image.onload=function(){
                    //document.getElementById("original-Img").src=image.src;
                    var canvas=document.createElement("canvas");
                    var context=canvas.getContext("2d");
                    canvas.width=image.width/4;
                    canvas.height=image.height/4;
                    context.drawImage(image,
                        0,
                        0,
                        image.width,
                        image.height,
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );
                    document.getElementById("upload-Preview").src = canvas.toDataURL();
                    document.getElementById("e_imgconv").value = canvas.toDataURL();
                }
                image.src=event.target.result;
            };

            var loadImageFile = function () {
                var uploadImage = document.getElementById("image");

                //check and retuns the length of uploded file.
                if (uploadImage.files.length === 0) { 
                    return; 
                }

                //Is Used for validate a valid file.
                var uploadFile = document.getElementById("image").files[0];
                if (!filterType.test(uploadFile.type)) {
                    alert("Please select a valid image."); 
                    return;
                }
                fileReader.readAsDataURL(uploadFile);
            }
            
            
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

                        document.getElementById("form1").action = "module/mod_mst_profile/aksi_profile.php?module="+module+"&act="+ket+"&idmenu="+idmenu;
                        document.getElementById("form1").submit();
                        return 1;
                    }
                } else {
                    //document.write("You pressed Cancel!")
                    return 0;
                }
            }
        </script>
        
        
        <link href="css/inputselectbox.css" rel="stylesheet" type="text/css" />
        <style>
            .form-group, .input-group, .control-label {
                margin-bottom:3px;
            }
            .control-label {
                font-size:12px;
            }
            input[type=text] {
                box-sizing: border-box;
                color:#000;
                font-size:12px;
                height: 30px;
            }
            select.soflow {
                font-size:12px;
                height: 30px;
            }
            .disabledDiv {
                pointer-events: none;
                opacity: 0.4;
            }
            .btn-primary {
                width:50px;
                height:30px;
                margin-right: 50px;
            }
        </style>
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