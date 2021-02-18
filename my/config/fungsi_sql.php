<?php

function getfield($ssql){
    include "config/koneksimysqli.php";
    $sql=mysqli_query($cnmy, $ssql);
    $ketemu=mysqli_num_rows($sql);
    $z=mysqli_fetch_array($sql);
    if ($ketemu > 0){
        return $z['lcfields'];
    }
    else {
        return '';
    }
}

function getfieldcnmy($ssql){
    include "../../config/koneksimysqli.php";
    $sql=mysqli_query($cnmy, $ssql);
    $ketemu=mysqli_num_rows($sql);
    $z=mysqli_fetch_array($sql);
    if ($ketemu > 0){
        return $z['lcfields'];
    }
    else {
        return '';
    }
}
?>

