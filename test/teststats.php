<?php

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];
$code = $_GET['code'];
$class_id = $_GET['id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sqlp = "SELECT * FROM marks WHERE test_code='$code'";

$resultp = mysqli_query($conn, $sqlp); //result set of rows
$datap= mysqli_fetch_all($resultp, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Class-ified Test</title>

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
        	Test Analytics &nbsp &nbsp <span style="font:17px Open Sans">(Click on that attendee to get detailed analysis)</span>
        </div>

        <hr>

        <div id="marks">
        	
          <table>
          	
          	<tr class="rws">
          		
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Name</td>
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Marks</td>
          	
          	</tr>

          	<?php foreach($datap as $key){ ?>

            <?php 
            $i = $key['username'];
            $sqlq = "SELECT * FROM users WHERE username='$i'";
            $resultq = mysqli_query($conn, $sqlq); //result set of rows
            $dataq= mysqli_fetch_all($resultq, MYSQLI_ASSOC);

            $user_id = $dataq[0]['id'];
            ?>		

            <tr class="rws">
          		
          		<td class="cls"><a href="detailedview.php?code=<?php echo $code ?>&id=<?php echo $user_id ?>" target="_blank"><?php echo $key['name']; ?></a></td>
          		<td class="cls"><?php echo $key['marks']; ?></td>
          	
          	</tr>

            <?php } ?>

          </table>

        </div>


     </div>

</body>

</html>