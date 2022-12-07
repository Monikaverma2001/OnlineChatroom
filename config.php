<?php
    $server="localhost";
    $username="root";
    $password="";
    $db="feedback";
    $con=mysqli_connect($server,$username,$password,$db);
    if(!$con){
        die("connection fail due to ".mysqli_connect_error());
    }
    echo "select connection to db";

?>