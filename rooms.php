<?php
//get parameters
$roomname=$_GET['roomname'];

//connecting to the database
include 'db_connect.php';


//execute sql to check wheather room exits or not
$sql="SELECT * FROM `rooms` WHERE roomname= '$roomname'";
$result=mysqli_query($conn,$sql);
if($result)
{
    //check if room exits
    if(mysqli_num_rows($result)==0)
    {
        $msg="your room is not exits try creating a new one";
        echo "<script type='text/javascript'>alert('$msg');window.location='frontend.php';</script>";
    }
    else{
        echo "lets chat now";
    }
}
else{
    echo "ERROR : ".mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<style>
#body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  color:#f1f1f1;
  border : .5px solid white;
  background-color: none;
  padding: 10px 10px;
  margin: 10px 0;
}

.darker {
 
  background-color: #ddd;
}

.container::after {
 
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
p{
  background:none;
    height: 20px;
    color:#f1f1f1;
}
.anyClass{
    height: 350px;
    overflow-y: scroll;
}
</style>
<link rel="stylesheet" href="frontend.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <div>
<div id="navigation">
            <ul>
                <li><img src="photos/logo.png" alt="logo"height="30" width="30"></li>
                <li style="margin:auto 20%;">myanonymouschatroom.com</li>
                <li><a href="frontend.php">home</a></li>
                <li><a href="about.html">about us</a></li>
                <li><a href="contact.html">privacy</a></li>
                <li><a href="feedback.php">feedback</a></li>

            </ul>
            <hr>
</div><br><br><br>

        <div id="body">
        <br><br><br>
<h2>Chat Messages -<?php echo $roomname; ?></h2>

<div class="container" >

<div class="anyClass" style="background-image:url('photos/chatback.webp');height:600px;" >
  <p ></p>
  <span class="time-right">11:00</span>
  </div>
</div>


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="add message" style="width:70%"><br><br>

<button type="button" class="btn btn-primary btn-sm" name="submitmsg" id="submitmsg">send</button><br><br><br><br><br>

</div>

<!-- Footer -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" 
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
 integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
//check for every new msg and display
setInterval(runFunction ,1000);
function runFunction()
{
  $.post("htcont.php",{room:'<?php  echo $roomname ?>'},
  function(data,status)
  {
    document.getElementsByClassName('anyClass')[0].innerHTML=data;
  }
  )


}


// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keyup", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});


  //if user submit the form
 


  $("#submitmsg").click(function(){
    var clientmsg=$("#usermsg").val();
  $.post("postmsg.php", {text:clientmsg,room:'<?php echo $roomname?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>' },
  function(data,status)
  {
    document.getElementsByClassName('anyClass')[0].innerHTML=data;
  });
  $("#usermsg").val("");
  return false;
  
});


</script>

</body>
</html>
