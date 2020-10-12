<?php 


session_start();
$usr= $_SESSION['username'];
$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sql= "SELECT id,name,username,password,email,type FROM users WHERE username = '$usr'";

$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);
$name=($data[0]['name']);
$type=($data[0]['type']);

?>



<!DOCTYPE html>
<html>

<head>
	
<style type="text/css">


#middle {

 color: #000;
 font:20px Open Sans;
 margin: 20px;
 display: flex;
 flex-direction: column;

}	
#type {

	margin-left: 5vw;
	padding: 1px 8px 5px 8px;
	background-color: #00bfff;
	color: #fff;
	font-weight: 900;
}

#top {

 color: #000;
 font:20px Open Sans;
 margin: 20px;
 display: flex;
 flex-direction: row;
}
        

</style>

</head>


<?php include('templates/leftbar.php'); ?>


<div id="middle">

    <div id="top">
	
         <div>
          Welcome <?php echo "$name"; ?>
         </div>

         <div id="type">
	         <?php echo "$type"; ?>
         </div>

    </div>

</div>



</div>



</body>

</html>