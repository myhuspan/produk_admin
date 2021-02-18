<?php

    $pnpidmenu_="";
    $pnpidgroup_="";
    if (isset($_GET['idmenu'])) $pnpidmenu_=$_GET['idmenu'];
    if (isset($_SESSION['GROUP'])) $pnpidgroup_=$_SESSION['GROUP'];
    $query = "SELECT ID from bk_master.t_groupmenu WHERE ID_GROUP='$pnpidgroup_' AND ID='$pnpidmenu_'";
    $nptampil_= mysqli_query($cnmy, $query);
    $ketemupilgrp= mysqli_num_rows($nptampil_);
    if ((DOUBLE)$ketemupilgrp==0) {
        echo "Anda Tidak Berhak Dengan Menu INI...";
        exit;
    }
    
?>

