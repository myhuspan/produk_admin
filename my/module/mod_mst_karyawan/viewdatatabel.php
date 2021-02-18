<?PHP
    session_start();
?>

<script>
    $(document).ready(function() {
        var myurl = window.location;
        var urlku = new URL(myurl);
        var module = urlku.searchParams.get("module");
        var act = urlku.searchParams.get("act");
        var idmenu = urlku.searchParams.get("idmenu");
        
        //alert(etgl1);
        var dataTable = $('#datatablekry').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 50, 100, 10000000], [10, 50, 100, "All"]],
            "displayLength": 10,
            "columnDefs": [
                { "visible": false },
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 1 },
                //{ className: "text-right", "targets": [6] },//right
                { className: "text-nowrap", "targets": [0,1,2,3,4,5,6,7,8] }//nowrap

            ],
            "language": {
                "zeroRecords": "Lihat Page di bawah!!! Jika ada Page, Pilih Page 1...!!! Jika tidak ada Page, maka data KOSONG..."
            },
            "scrollY": 460,
            "scrollX": true,

            "ajax":{
                url :"module/mod_mst_karyawan/mydata.php?module="+module+"&idmenu="+idmenu+"&act="+act, // json datasource
                type: "post",  // method  , by default get
                data:"uket="+module,
                error: function(){  // error handling
                    $(".data-grid-error").html("");
                    $("#datatable").append('<tbody class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#data-grid_processing").css("display","none");
                    
                }
            }
        } );
        $('div.dataTables_filter input', dataTable.table().container()).focus();
    } );
    
</script>

<style>
    .divnone {
        display: none;
    }
    #datatablekry th {
        font-size: 13px;
    }
    #datatablekry td { 
        font-size: 13px;
    }
    .imgzoom:hover {
        -ms-transform: scale(3.5); /* IE 9 */
        -webkit-transform: scale(3.5); /* Safari 3-8 */
        transform: scale(3.5);
        
    }
</style>

<table id='datatablekry' class='table table-striped table-bordered' width='100%'>
    <thead>
        <tr>
            <th width='7px'>No</th>
            <th width='70px'>&nbsp;</th>
            <th width='40px'>ID</th>
            <th width='80px'>Nama</th>
            <th width='40px'>Tempat</th>
            <th width='40px'>Tgl. Lahir</th>
            <th width='50px'>Atasan</th>
            <th width='50px'>Jabatan</th>
            <th width='10px'>Status</th>
            <th width='10px'>Aktif</th>
        </tr>
    </thead>
</table>