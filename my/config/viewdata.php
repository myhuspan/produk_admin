<?PHP
    ini_set("memory_limit","10G");
    ini_set('max_execution_time', 0);
?>

<?PHP
    session_start();
    include "../config/koneksimysqli.php";
    $dbname1=$_SESSION['DBNAME1'];
?>
<!--
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
-->
    
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    
<script>
    $(document).ready(function() {
        var dataTable = $('#datatablemodal').DataTable( {
            fixedHeader: false,
            "stateSave": false,
            "ordering": false,
            "order": [[ 1, "asc" ]],
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "displayLength": 10,
            "columnDefs": [
                { "visible": false },
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 1 },
                //{ className: "text-right", "targets": [6] },//right
                { className: "text-nowrap", "targets": [0,1,2,3] }//nowrap

            ],
            "language": {
                "zeroRecords": "Lihat Page di bawah!!! Jika ada Page, Pilih Page 1...!!! Jika tidak ada Page, maka data KOSONG..."
            }/*,
            rowReorder: {
                selector: 'td:nth-child(5)'
            },
            responsive: true*/
        } );
        $('div.dataTables_filter input', dataTable.table().container()).focus();
    } );
    
</script>

<style>
    .divnone {
        display: none;
    }
    #datatablemodal th {
        font-size: 13px;
    }
    #datatablemodal td { 
        font-size: 13px;
    }
    .imgzoom:hover {
        -ms-transform: scale(3.5); /* IE 9 */
        -webkit-transform: scale(3.5); /* Safari 3-8 */
        transform: scale(3.5);
        
    }
</style>

    <div class='modal-dialog modal-lg'>
        <!-- Modal content-->
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Pilih Data</h4>
            </div>

            <div class='modal-body'>
                <?PHP
                if ($_GET['module']=="viewdataakuncf"){
                    $pudata1=$_POST['udata'];
                    $pudata2=$_POST['udata2'];
                    
                    ?>
                    <div style='overflow-x:auto;'>
                        <table id='datatablemodal' class='table table-striped table-bordered' width='100%'>
                            <thead>
                                <tr>
                                    <th width='10px'>No</th>
                                    <th width='80px'>ID</th>
                                    <th width='40px'>NAMA</th>
                                    <th width='60px'></th>
                                </tr>
                            </thead>
                            <tbody class='gridview-error'>
                                <?PHP
                                $no=1;
                                $tampil = mysqli_query($cnmy, "SELECT ID_CF, NAMA_CF FROM "
                                        . " $dbname1.t_cf_a order by ID_CF");
                                while ($r=mysqli_fetch_array($tampil)){
                                    $pidcf=$r['ID_CF'];
                                    $pnmcf=$r['NAMA_CF'];
                                    $pnmkdcf=$pidcf." - ".$pnmcf;
                                    $pnmkdcf=$pnmcf;
                                    echo "<tr scope='row'>";
                                    echo "<td nowrap>$no</td>";
                                    echo "<td nowrap><a data-dismiss='modal' href='#' onClick=\"getDataModalCF('$pudata1', '$pudata2',  '$pidcf', '$pnmkdcf')\">$pidcf</a></td>";
                                    echo "<td nowrap>$pnmcf</td>";
                                    echo "<td nowrap></td>";
                                    echo "</tr>";
                                    
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?PHP
                    
                }elseif ($_GET['module']=="viewdataakuncoa4"){
                    $pudata1=$_POST['udata'];
                    $pudata2=$_POST['udata2'];
                    $pudata3=$_POST['udata3'];
                    ?>
                    <div style='overflow-x:auto;'>
                        <table id='datatablemodal' class='table table-striped table-bordered' width='100%'>
                            <thead>
                                <tr>
                                    <th width='10px'>No</th>
                                    <th width='80px'>COA3</th>
                                    <th width='40px'>COA4</th>
                                    <th width='60px'>COA Nama 4</th>
                                    <th width='60px'>Tipe</th>
                                </tr>
                            </thead>
                            <tbody class='gridview-error'>
                                <?PHP
                                $no=1;
                                $tampil = mysqli_query($cnmy, "SELECT COA1, NAMA1, COA2, NAMA2, COA3, NAMA3, COA4, NAMA4, COA_TIPE FROM "
                                        . " $dbname1.v_coa4 order by COA4");
                                while ($r=mysqli_fetch_array($tampil)){
                                    $pcoa3=$r['COA3'];
                                    $pnmcoa3=$r['NAMA3'];
                                    $pcoa4=$r['COA4'];
                                    $pnmcoa4=$r['NAMA4'];
                                    $pcoatipe=$r['COA_TIPE'];
                                    
                                    echo "<tr scope='row'>";
                                    echo "<td nowrap>$no</td>";
                                    echo "<td nowrap>$pcoa3 - $pnmcoa3</td>";
                                    echo "<td nowrap><a data-dismiss='modal' href='#' onClick=\"getDataModalAkun4('$pudata1', '$pudata2', '$pudata3',  '$pcoa4', '$pnmcoa4', '0')\">$pcoa4</a></td>";
                                    echo "<td nowrap>$pnmcoa4</td>";
                                    echo "<td nowrap>$pcoatipe</td>";
                                    echo "</tr>";
                                    
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?PHP
                    
                    
                }elseif ($_GET['module']=="viewdataakundetailcoa4"){
                    $pudata1=$_POST['udata'];
                    $pudata2=$_POST['udata2'];
                    $pudata3=$_POST['udata3'];
                    ?>
                    <div style='overflow-x:auto;'>
                        <table id='datatablemodal' class='table table-striped table-bordered' width='100%'>
                            <thead>
                                <tr>
                                    <th width='10px'>No</th>
                                    <th width='80px'>COA3</th>
                                    <th width='40px'>COA4</th>
                                    <th width='60px'>COA Nama 4</th>
                                    <th width='60px'>Tipe</th>
                                </tr>
                            </thead>
                            <tbody class='gridview-error'>
                                <?PHP
                                $no=1;
                                $tampil = mysqli_query($cnmy, "SELECT COA1, NAMA1, COA2, NAMA2, COA3, NAMA3, COA4, NAMA4, COA_TIPE FROM "
                                        . " $dbname1.v_coa4 order by COA4");
                                while ($r=mysqli_fetch_array($tampil)){
                                    $pcoa3=$r['COA3'];
                                    $pnmcoa3=$r['NAMA3'];
                                    $pcoa4=$r['COA4'];
                                    $pnmcoa4=$r['NAMA4'];
                                    $pcoatipe=$r['COA_TIPE'];
                                    
                                    echo "<tr scope='row'>";
                                    echo "<td nowrap>$no</td>";
                                    echo "<td nowrap>$pcoa3 - $pnmcoa3</td>";
                                    echo "<td nowrap><a data-dismiss='modal' href='#' onClick=\"getDataModalDetailAkun4('$pudata1', '$pudata2', '$pudata3',  '$pcoa4', '$pnmcoa4', '0')\">$pcoa4</a></td>";
                                    echo "<td nowrap>$pnmcoa4</td>";
                                    echo "<td nowrap>$pcoatipe</td>";
                                    echo "</tr>";
                                    
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?PHP
                }elseif ($_GET['module']=="viewdataakunproyek"){
                    $pudata1=$_POST['udata'];
                    $pudata2=$_POST['udata2'];
                    $pudata3=$_POST['udata3'];
                    ?>
                    <div style='overflow-x:auto;'>
                        <table id='datatablemodal' class='table table-striped table-bordered' width='100%'>
                            <thead>
                                <tr>
                                    <th width='10px'>No</th>
                                    <th width='80px'>Akun</th>
                                    <th width='40px'>Jenis</th>
                                    <th width='60px'>Divisi</th>
                                    <th width='60px'>Komposisi</th>
                                </tr>
                            </thead>
                            <tbody class='gridview-error'>
                                <?PHP
                                $no=1;
                                $tampil = mysqli_query($cnmy, "SELECT KDPROYEK, NAMA_PROYEK, KDJENIS, NAMA_JENIS, "
                                        . " KDDIVISI, NAMA_DIVISI, KOMPOSISI, PEMBERI_KERJA, PROYEK_ATAS, AKTIF FROM "
                                        . " $dbname1.v_proyek order by KDPROYEK");
                                while ($r=mysqli_fetch_array($tampil)){
                                    $pkdproyek=$r['KDPROYEK'];
                                    $pnmproyek=$r['NAMA_PROYEK'];
                                    $pnmjenis=$r['NAMA_JENIS'];
                                    $pnmdivisi=$r['NAMA_DIVISI'];
                                    $pkomposisi=$r['KOMPOSISI'];
                                    
                                    echo "<tr scope='row'>";
                                    echo "<td nowrap>$no</td>";
                                    echo "<td nowrap><a data-dismiss='modal' href='#' onClick=\"getDataModalAkunProyek('$pudata1', '$pudata2', '$pudata3',  '$pkdproyek', '$pnmproyek', '0')\">$pkdproyek - $pnmproyek</a></td>";
                                    echo "<td nowrap>$pnmjenis</td>";
                                    echo "<td nowrap>$pnmdivisi</td>";
                                    echo "<td nowrap>$pkomposisi</td>";
                                    echo "</tr>";
                                    
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?PHP
                }elseif ($_GET['module']=="XXX"){
                }elseif ($_GET['module']=="XXX"){
                }elseif ($_GET['module']=="XXX"){
                }else{
                }
                ?>
            </div>

            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>