<?PHP
$myact="";
if (isset($_GET['act'])) $myact=$_GET['act'];
?>
<section class="content-header">
    <?PHP
    $JUDUL="User";
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
        $aksi="module/mod_tools_users/aksi_users.php";
        switch($_GET['act']){
            default:
                ?>
                <style>
                    .divnone {
                        display: none;
                    }
                    #datatableusr th {
                        font-size: 11px;
                    }
                    #datatableusr td { 
                        font-size: 11px;
                    }
                </style>
                
                <script type="text/javascript" language="javascript" >
                    $(document).ready(function() {
                        var aksi = "module/mod_tools_users/aksi_users.php";
                        var myurl = window.location;
                        var urlku = new URL(myurl);
                        var module = urlku.searchParams.get("module");
                        var idmenu = urlku.searchParams.get("idmenu");
                        var nmun = urlku.searchParams.get("nmun");
                        var dataTable = $('#datatableusr').DataTable( {
                            "processing": true,
                            "serverSide": true,
                            "stateSave": true,
                            "columnDefs": [
                                { "visible": false },
                                { "orderable": false, "targets": 0 },
                                { "orderable": false, "targets": 1 },
                                //{ className: "text-right", "targets": [6] },//right
                                //{ className: "text-nowrap", "targets": [0,1,2,3,4,5,6,7,8] }//nowrap

                            ],
                            "ajax":{
                                url :"module/mod_tools_users/mydata.php?module="+module+"&idmenu="+idmenu+"&nmun="+nmun+"&aksi="+aksi, // json datasource
                                type: "post",  // method  , by default get
                                error: function(){  // error handling
                                    $(".data-grid-error").html("");
                                    $("#datatableusr").append('<tbody class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                    $("#data-grid_processing").css("display","none");
                                    
                                }
                            },
                            "scrollY": 460,
                            "scrollX": true,
                        } );
                    } );
                </script>
                <?PHP
                echo "<div class='col-md-12 col-sm-12 col-xs-12'>";

                    //panel
                    echo "<div class='x_panel'>";
                        //title
                        

                        //isi content
                        echo "<div class='x_content'>";
                            //isi kata-kata
                            /*
                            echo "<p class='text-muted font-13 m-b-30'>";
                            echo "";
                            echo "</p>";
                             *
                             */
                        
                            echo "<table id='datatableusr' class='table table-striped table-bordered'>";
                            echo "<thead><tr><th width='10px'>No</th><th>ID</th><th width='30px'>Username</th><th>Karyawan</th>"
                                    . "<th width='100px'>Tempat</th><th width='100px'>Tgl. Lahir</th>"
                                    . "<th>Jabatan</th><th width='100px'>Group User</th>"
                                    . "<th>Aksi</th>"
                                    . "</tr></thead>";
                            echo "</table>";
                          

                        echo "</div>";//end x_content

                    echo "</div>";//end panel

                echo "</div>";

            break;

            case "tambahbaru":
                
            break;

            case "editdata":
                include "edit_users.php";
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