<?php

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sqla = "SELECT * FROM assignment_marks WHERE username='$usr'";
 $resulta = mysqli_query($conn, $sqla); //result set of rows
 $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

$sqlb = "SELECT * FROM marks WHERE username='$usr'";
$resultb = mysqli_query($conn, $sqlb); //result set of rows
$datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

$sqlq = "SELECT * FROM users WHERE username='$usr'";
$resultq = mysqli_query($conn, $sqlq); //result set of rows
$dataq= mysqli_fetch_all($resultq, MYSQLI_ASSOC);

$uid = $dataq[0]['id'];

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
 	flex-direction: column;
 	align-items: center;
 	justify-content: center;
 	margin-top: 0vh;
 }

 .rws {

 	margin: 0px;
 }

 .cls {

 	width: 200px;
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
        	Performance Analysis &nbsp &nbsp <span style="font:17px Open Sans">(Click on that particular test to get detailed analysis)</span>
        </div>

        <hr>

        <div id="marks">
        	
          <table>
          	
          	<tr class="rws">
          		
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Name of Assignment</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Instructor</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Marks</td>
          	
          	</tr>

          	<?php foreach($dataa as $key){ ?>

            <?php 
 
             $ass_id = $key['ass_id'];             
 
             $sqlc = "SELECT * FROM assignment WHERE id='$ass_id'";
             $resultc = mysqli_query($conn, $sqlc); //result set of rows
             $datac= mysqli_fetch_all($resultc, MYSQLI_ASSOC);
 
             $n = $datac[0]['title'];
             $i = $datac[0]['instructor_name'];

            ?>		

            <tr class="rws">
          		
          		<td class="cls"><?php echo $n; ?></td>
          		<td class="cls"><?php echo $i; ?></td>
          		<td class="cls"><?php echo $key['marks']; ?></td>
          	
          	</tr>

            <?php } ?>

          </table>

          <hr>

          <table style="margin-top: 5vh;">
          	
          	<tr class="rws">
          		
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Name of Test</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Class Name</td>
              <td class="cls" style="font-weight: 900; font-size: 21px;">Subject</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Instructor Name</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Total Marks</td>
          		<td class="cls" style="font-weight: 900; font-size: 21px;">Marks Scored</td>
          	
          	</tr>

          	<?php foreach($datab as $keyb){ ?>

            <?php 
 
             $t_code = $keyb['test_code'];

             $sqld = "SELECT * FROM test WHERE test_code='$t_code'";
             $resultd = mysqli_query($conn, $sqld); //result set of rows
             $datad= mysqli_fetch_all($resultd, MYSQLI_ASSOC);

             $p = $datad[0]['test_name'];
             $q = $datad[0]['total_marks'];

             $n = $datad[0]['class_id'];

             $sqle = "SELECT * FROM class WHERE id='$n'";
             $resulte = mysqli_query($conn, $sqle); //result set of rows
             $datae= mysqli_fetch_all($resulte, MYSQLI_ASSOC); 

             $x = $datae[0]['class_name'];
             $y = $datae[0]['instructor_name'];
             $z = $datae[0]['subject'];

            ?>		

            <tr class="rws">
          		
          		<td class="cls"><a href="test/detailedview.php?code=<?php echo $t_code ?>&id=<?php echo $uid ?>" target="_blank"><?php echo $p; ?></a></td>
          		<td class="cls"><?php echo $x; ?></td>
              <td class="cls"><?php echo $z; ?></td>
          		<td class="cls"><?php echo $y; ?></td>
          		<td class="cls"><?php echo $q; ?></td>
          		<td class="cls"><?php echo $keyb['marks']; ?></td>
          	
          	</tr>

            <?php } ?>

          </table>

        </div>


     </div>


</body>
</html>