<?php

    $servername = "database-1.cofj5augd608.ap-northeast-1.rds.amazonaws.com";
    // $servername = "localhost";
    $name = "root";
    $password1 = "qwertyuiop";
    $port = 3306;


    $conn = new mysqli($servername, $name, $password1, "userdata", $port);


    if($conn->connect_error){
        echo "not connected";
        // echo $conn->connect_error;
        die("connection failed".$conn->connect_error);
    }
    else{
        echo "connected";
    }


    

?>