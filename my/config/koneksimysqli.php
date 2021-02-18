<?php

    /* Database connection start */
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    //hilangkan
    /*
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    //end hilangkan */
    
    $cnmy = mysqli_connect($servername, $username, $password) or die("Connection failed: " . mysqli_connect_error());

?>