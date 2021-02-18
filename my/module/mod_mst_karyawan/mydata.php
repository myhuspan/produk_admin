<?php
    ini_set("memory_limit","5000M");
    ini_set('max_execution_time', 0);
    
    session_start();
    include "../../config/koneksimysqli.php";

    $vdbname=$_SESSION['SSDBNAME'];
    /// storing  request (ie, get/post) global array to a variable  
    $requestData= $_REQUEST;

    $columns = array( 
    // datatable column index  => database column name
        0 =>'KARYAWANID',
        1 =>'KARYAWANID',
        2 => 'KARYAWANID',
        3=> 'NAMA',
        4=> 'TEMPAT',
        5=> 'TGLLAHIR',
        6=> 'NAMA_ATASAN',
        7=> 'NAMA_JABATAN',
        8=> 'T_STATUS',
        9=> 'AKTIF'
    );

    $query = "select a.KARYAWANID, a.NAMA, a.JABATANID, b.NAMA NAMA_JABATAN, a.TEMPAT, 
        DATE_FORMAT(a.TGLLAHIR,'%d %M %Y') as TGLLAHIR, a.ATASANID, c.NAMA NAMA_ATASAN, a.AKTIF, a.T_STATUS   
        , b.LEVELPOSISI from $vdbname.t_karyawan a 
        LEFT JOIN $vdbname.t_jabatan b on a.JABATANID=b.JABATANID
        LEFT JOIN $vdbname.t_karyawan c on a.ATASANID=c.KARYAWANID";
    
    $sql = "SELECT * ";
    $sql.=" FROM ($query) as TBL  ";//$vdbname.v_karyawan_user
    $query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

    $sql.=" WHERE 1=1 AND KARYAWANID <> '0000000000' ";
    if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql.=" AND ( KARYAWANID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR NAMA LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR NAMA_JABATAN LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR NAMA_ATASAN LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR T_STATUS LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR DATE_FORMAT(TGLLAHIR,'%d %M %Y') LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR TEMPAT LIKE '%".$requestData['search']['value']."%' )";
    }
    $query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
    $query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");
    
    
    $aksi="module/mod_mst_karyawan/aksi_karyawan.php";
    
    $data = array();
    $no=1;
    while( $row=mysqli_fetch_array($query) ) {  // preparing an array
        $nestedData=array();
        
        $pkodeid = $row["KARYAWANID"];
        $pnama = $row["NAMA"];
        $ptempat = $row["TEMPAT"];
        $ptgllahir = $row["TGLLAHIR"];
        $pnmatasan = $row["NAMA_ATASAN"];
        $pnmjabatan = $row["NAMA_JABATAN"];
        $paktif = $row["AKTIF"];
        $pstskry = $row["T_STATUS"];
        
        $pedit= "<a class='btn btn-success btn-xs' href='?module=$_GET[module]&act=editdata&idmenu=$_GET[idmenu]&id=$pkodeid'>Edit</a>";
        $phapus = "<a class='btn btn-danger btn-xs' href=\"$aksi?module=$_GET[module]&act=hapus&idmenu=$_GET[idmenu]&id=$pkodeid\"
                    onClick=\"return confirm('Apakah Anda benar-benar akan menghapusnya?')\">Hapus</a>";
        
        $pupload= "<a class='btn btn-info btn-xs' href='?module=$_GET[module]&act=uploadfile&idmenu=$_GET[idmenu]&id=$pkodeid'>Dokumen</a>";
        
        $phapus="";
        $nestedData[] = $no;
        
        $nestedData[] = "$pedit &nbsp; &nbsp; $phapus &nbsp; &nbsp; $pupload";
        $nestedData[] = $pkodeid;
        $nestedData[] = $pnama;
        $nestedData[] = $ptempat;
        $nestedData[] = $ptgllahir;
        $nestedData[] = $pnmatasan;
        $nestedData[] = $pnmjabatan;
        $nestedData[] = $pstskry;
        $nestedData[] = $paktif;

        $data[] = $nestedData;
        $no=$no+1;
    }



    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal"    => intval( $totalData ),  // total number of records
        "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format
?>