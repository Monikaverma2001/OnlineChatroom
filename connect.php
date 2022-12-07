
<?php

$servername="localhost";
$username="root";
$password="";
$database="feedback";
    $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("connection fail due to ");
    }
    echo "select connection to db";

if(isset($_POST['submit']))
{
  $firstname=$_POST['fname'];
  $lastname=$_POST['lname'];
  $email=$_POST['email'];
  $num=$_POST['phonenumber'];
  $feed=$_POST['feed'];


//database connection
//create database

$sql = "INSERT INTO userdetail (firstname,lastname,email,num,feed) VALUES ('$firstname','$lastname','$email','$num','$feed')";
if (mysqli_query($conn, $sql)) 
{
      echo "New record created successfully";
} else 
{
      echo "Error: " . "<br>" ;
}
mysqli_close($conn);

}

?>