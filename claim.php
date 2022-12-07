<?php
//getting value of post parameters


$room=$_POST['room'];
//checking  string size

if(strlen($room)>20 or strlen($room)<2){
    echo "inside if<br>";
    $msg="please choose a name between 2 - 20 charachters";
    echo "<script type='text/javascript'>alert('$msg');window.location='frontend.html';</script>";

}
//check wheather room name is alpha numeric


else if(!ctype_alnum($room))
{
    echo "inside if else<br>";
    $msg="please choose a aphanumeric rrom name";
    echo "<script type='text/javascript'>alert('$msg');window.location='frontend.html';</script>";
}
else{
    //connecting to database

    include 'db_connect.php';
}

//check if room already exist
$sql="SELECT * FROM `rooms` WHERE roomname= '$room'";
$result=mysqli_query($conn,$sql);
if($result)
{
    if(mysqli_num_rows($result)>0)
    {
        $msg="please choose a different room this room is already claimed";
        echo "<script type='text/javascript'>alert('$msg');window.location='frontend.html';</script>";
    }
    else{
        $sql="INSERT INTO `rooms` (`roomname`, `stime`) VALUES ( '$room', current_timestamp());";
        if(mysqli_query($conn,$sql))
        {
            $msg="your room is ready and you can chat now ";
            echo "<script type='text/javascript'>alert('$msg');window.location='rooms.php?roomname=$room';</script>";

        }
    }
}
else{
    echo "error : ". mysqli_error($conn);
}


?>