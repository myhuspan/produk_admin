<?php
    ini_set("memory_limit","5000M");
    ini_set('max_execution_time', 0);
    session_start();
    $vdbname=$_SESSION['SSDBNAME'];
include "../../config/koneksimysqli.php";
include "../../config/fungsi_sql.php";
/// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
    0 =>'KARYAWANID',
    1 =>'KARYAWANID',
    2 => 'USERNAME',
    3=> 'NAMA',
    4=> 'TEMPAT',
    5=> 'TGLLAHIR',
    6=> 'nama_jabatan'
);

// getting total number records without any search
$query = "select a.USERNAME, b.KARYAWANID, b.NAMA, b.JABATANID, c.NAMA NAMA_JABATAN, b.TEMPAT, 
        DATE_FORMAT(b.TGLLAHIR,'%d %M %Y') as TGLLAHIR
        , c.LEVELPOSISI, a.ID_GROUP from $vdbname.t_karyawan b 
        LEFT JOIN $vdbname.t_users a on a.KARYAWANID=b.KARYAWANID 
        LEFT JOIN $vdbname.t_jabatan c on b.JABATANID=c.JABATANID";

$sql = "SELECT KARYAWANID, USERNAME, NAMA, JABATANID, NAMA_JABATAN, TEMPAT, DATE_FORMAT(TGLLAHIR,'%d %M %Y') as  TGLLAHIR, LEVELPOSISI ";
$sql.=" FROM ($query) as TBL  ";//$vdbname.v_karyawan_user
$query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql.=" WHERE 1=1 ";
if ($_SESSION['GROUP']<>"1") {
    $sql.=" AND KARYAWANID<>'0000000000' ";
}
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql.=" AND ( KARYAWANID LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR NAMA LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR NAMA_JABATAN LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR DATE_FORMAT(TGLLAHIR,'%d %M %Y') LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR TEMPAT LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($cnmy, $sql) or die("mydata.php: get data");


$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();

    $nestedData[] = $no;

    $nestedData[] = $row["KARYAWANID"];
    $nestedData[] = $row["USERNAME"];
    $nestedData[] = $row["NAMA"];
    $nestedData[] = $row["TEMPAT"];
    $nestedData[] = $row["TGLLAHIR"];
    
    $tolstp="";
    $nestedData[] = "<a href='#' data-toggle=\"tooltip\" data-placement=\"top\" title=".$tolstp.">".$row["NAMA_JABATAN"]."</a>";//<small>(".$row["LEVELPOSISI"].")</small>
    
    $idgrpuser = getfieldcnmy("select IFNULL(ID_GROUP,'') as lcfields from $vdbname.t_users where KARYAWANID='$row[KARYAWANID]'");
    $grpuser = getfieldcnmy("select IFNULL(NAMA_GROUP,'') as lcfields from $vdbname.t_groupuser where ID_GROUP='$idgrpuser'");
    $nestedData[] = $grpuser;
    $nestedData[] = "<a class='btn btn-success btn-xs' href='?module=$_GET[module]&act=editdata&idmenu=$_GET[idmenu]&nmun=$_GET[nmun]&id=$row[KARYAWANID]'>Edit</a>
    ";


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
