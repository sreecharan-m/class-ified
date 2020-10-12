<?php

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];
$id = $_GET['id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

if(isset($_GET['id']))
{
	 $id=$_GET['id'];
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

   #new {

        margin-top: 5vh;       
        font: 20px Open Sans;
        display: flex;
        justify-content: center;
      }

  #newa {
        text-align: center;
        width: 10vw;
        border: 1px solid black;
        padding: 20px;
        cursor: pointer;
        border-radius: 20px;
      }    


</style>

</head>

<div id="new">
    
    <div id="newa">
    
    <a href="instructor_test_home.php?id=<?php echo $id ?>"> + Assign New </a>
    
    </div>
  
</div>

<div id="ins">
	
The tests scheduled are as follows

</div>

<hr>

<div id="atds">
	
   <p style="font-weight: 900; font-size: 22px;">Click on the particular test to view the marks and analytics</p>

   <?php foreach($data as $key) { ?>

   
    <?php 
    
    ?>

    <div id="names">
    	
      <a href="teststats.php?code=<?php echo $key['test_code'];?>&id=<?php echo $id ?>"> <?php echo $key['test_name'];?> </a>

    </div>
   

   <?php } ?>

</div>


</div>

<body>

</html>