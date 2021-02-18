<!--
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="active treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href=#"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
            </span>
        </a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
</ul>
-->

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
<?PHP
$vdbname=$_SESSION['SSDBNAME'];
$igru=$_SESSION['GROUP'];
$mobilebuka=$_SESSION['MOBILE'];

$query = "select a.ID id, a.ID_GROUP id_group,
	b.JUDUL AS judul,
	b.URL AS url,
	b.PUBLISH AS publish,
	b.URUTAN AS urutan,
	b.GAMBAR AS gambar,
	b.PARENT_ID AS parent_id,
	b.M_KHUSUS AS m_khusus,
	b.URUTAN urutan
        from $vdbname.t_groupmenu a
        LEFT JOIN $vdbname.t_menu b on a.ID=b.ID
        WHERE b.PUBLISH='Y' AND b.PARENT_ID='0' AND a.ID_GROUP='$igru'
        ORDER BY b.URUTAN, b.ID
        ";
//$query = "select * from $vdbname.v_groupmenu where id_group='$_SESSION[GROUP]' and publish='Y' and parent_id='0' order by urutan, id";
$tampil=mysqli_query($cnmy, $query);
$ketemu=mysqli_num_rows($tampil);
if ($ketemu>0){
    while ($row= mysqli_fetch_array($tampil)) {
        $pidmenu=$row['id'];
        $pnmmenu=$row['judul'];
        $pgambar=$row['gambar'];
        if (empty($pgambar)) $pgambar="fa fa-pie-chart";
        echo "<li class='treeview'>";
        
            echo "<a href='#'>";
            echo "<i class='$pgambar'></i><span>$pnmmenu</span>";
            echo "<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>";
            echo "</a>";
        
            $query3 = "select a.ID id, a.ID_GROUP id_group,
                    b.JUDUL AS judul,
                    b.URL AS url,
                    b.PUBLISH AS publish,
                    b.URUTAN AS urutan,
                    b.GAMBAR AS gambar,
                    b.PARENT_ID AS parent_id,
                    b.M_KHUSUS AS m_khusus,
                    b.URUTAN urutan, b.M_KHUSUS m_khusus
                    from $vdbname.t_groupmenu a
                    LEFT JOIN $vdbname.t_menu b on a.ID=b.ID
                    WHERE b.PUBLISH='Y' AND a.ID_GROUP='$igru' AND b.PARENT_ID='$pidmenu'  
                    ORDER BY b.URUTAN, b.ID
                    ";

            $submenu=mysqli_query($cnmy, $query3);
            $ketemu2=mysqli_num_rows($submenu);
            if ($ketemu2>0){
                echo "<ul class='treeview-menu'>";
                while ($s= mysqli_fetch_array($submenu)) {
                    $pjudul=$s['judul'];
                    $purl=$s['url'];
                    $pparentid=$s['parent_id'];
                    $pidsub=$s['id'];
                    
                    $pgambarsub=$s['gambar'];
                    if (empty($pgambarsub)) $pgambarsub="fa fa-circle-o";
                    
                    echo "<li>";
                        echo "<a href='$purl&idmenu=$pidsub&act=$pparentid'>";
                            echo "<i class='$pgambarsub'></i>$pjudul";
                        echo "</a>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            
        echo "</li>";
        
    }
}

?>
</ul>