<?php
$servername="localhost";
$username="root";
$password="";
$database="chatroom";

//creating db connection

$conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("connection fail due to ");
    }
    
?>