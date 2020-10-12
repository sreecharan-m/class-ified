<?php

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];


$conn=mysqli_connect('localhost','shaun','test1234','dproject');

if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $_SESSION['class_id']=$id;
	$sql="SELECT * FROM test WHERE class_id='$id'";
	$result = mysqli_query($conn, $sql); //result set of rows
  $data= mysqli_fetch_all($result, MYSQLI_ASSOC);

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Class Away From Class</title>

<style type="text/css">
	
   #ins {

   	margin-top: 5vh;
   	font: 25px Open Sans;
    font-weight: 900;
    margin-left: 10vw;
   }     

   #atds {

   	margin-top: 3vh;
   	font: 20px Open Sans;
   	margin-left: 10vw;
   
   }

   #names {

   	margin-top: 10px;
   	margin-left: 10vw;
   }

   hr {

   	border: 0;
   	clear: both;
   	display: block;
   	width: 90%;
   	height: 3px;
    background-color: #000;
    margin-top: 5vh;
    margin-right: 0px;
   }

   a {

    text-decoration: none;
    color: #000;
   }


</style>

</head>


<div id="ins">
	
The tests scheduled are:

</div>

<hr>

<div id="atds">
	
   <p style="font-weight: 900; font-size: 22px;">Click on the particular test to attempt it</p>

   <?php foreach($data as $key) { ?>

   
    <?php 
    
    ?>

    <div id="names">
    	
      <a href="attempttest.php?code=<?php echo $key['test_code'];?>"> <?php echo $key['test_name'];?> </a>

    </div>
   

   <?php } ?>

</div>


</div>

<body>

</html>