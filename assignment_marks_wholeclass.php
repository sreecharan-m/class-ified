<?php

session_start();

$usr= $_SESSION['username'];
$type= $_SESSION['type'];
$idd = $_GET['ass_id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sqla = "SELECT * FROM assignment_marks WHERE ass_id='$idd'";
$resulta = mysqli_query($conn, $sqla); //result set of rows
$dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html>
<head>
	<title>Class-ified</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

<style type="text/css">
	
 body {

 	margin:0px;
 	padding: 0px;

 }

 #fullcontent {

 	width: 100vw;
 	height: 100vh;
 	display: flex;
 	flex-direction: column;
 }

 #heading {

 	font: 25px Open Sans;
 	width: 100%;
 	text-align: center;
 	margin-top: 5vh;
 	font-weight: 900;
 }

 hr {

   border: 0;
   clear: both;
   display: block;
   width: 100%;
   height: 3px;
   background-color: #000;
   margin-top: 5vh;
   margin-left: 0px;
 
 }

 #marks {

 	width: 100%;
 	height: 100%;
 	display: flex;
 	justify-content: center;
 	margin-top: 5vh;
 }

 .rws {

 	margin: 0px;
 }

 .cls {

 	width: 300px;
 	font: 18px Open Sans;
 	border: 2px solid black;
 	padding: 10px;
 }

 a {

 	text-decoration: none;
 	color: #000;
 }

</style>

</head>

<body>

     <div id="fullcontent">
     	
        <div id="heading">
        	Assignment Marks Of Attendees
        </div>

        <hr>

        <div id="marks">
        	
          <table>
          	
          	<tr class="rws">
          		
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Name</td>
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Marks</td>
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Mark Assigned At</td>

          	
          	</tr>

          	<?php foreach($dataa as $key){ ?>

            <tr class="rws">
          		
          		<td class="cls"><?php echo $key['name']; ?></td>
          		<td class="cls"><?php echo $key['marks']; ?></td>
          	    <td class="cls"><?php echo $key['time']; ?></td>

          	</tr>

            <?php } ?>

          </table>

        </div>


     </div>

</body>

</html>