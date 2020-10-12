<?php

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];
$id = $_SESSION['class_id'];

$n = $_SESSION['test_name'];
$c = $_SESSION['test_code'];
$m = $_SESSION['mark'];
$tm = $_SESSION['total_marks'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sql = "INSERT INTO marks(test_code, class_id, username, name, marks, total_marks) VALUES ('$c', '$id', '$usr', '$name', '$m', '$tm')";

if(mysqli_query($conn,$sql))
{

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Class-ified</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

<style type="text/css">
	
 #fullcontent{

 	width: 100%;
 	height: 100%;
 	font: 23px Open Sans;
 	display: flex;
 	justify-content: center;
 	margin-top: 10vh;
 }
 .aaa {

    border:1px solid black;
    padding: 10px;
 }

 #rs {

 	width: 25vw;
 	height: 25vh;
 	padding: 10px;
 } 

</style>

</head>

<body>



 <div id="fullcontent">
 

   <div>
   	
        <div style="font-size: 32px; text-align: center;">
   	    Test Result
        </div>

         <table id="rs">
         	
         	<tr class="aa">
         		<td class="aaa">Test Name :</td>
         		<td class="aaa"><?php echo $n ?></td>
         	</tr>

         	<tr class="aa">
         		<td class="aaa">Total Marks :</td>
         		<td class="aaa"><?php echo $tm ?></td>
         	</tr>

         	<tr class="aa">
         		<td class="aaa">Marks Obtained :</td>
         		<td class="aaa"><?php echo $m ?></td>
         	</tr>

         </table>

   </div>

 </div>

</body>

</html>