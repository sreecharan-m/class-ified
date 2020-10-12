<?php 

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];
$code = $_GET['code'];
$user_id = $_GET['id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sqlp = "SELECT * FROM users WHERE id='$user_id'";

$resultp = mysqli_query($conn, $sqlp); //result set of rows
$datap= mysqli_fetch_all($resultp, MYSQLI_ASSOC);

$username_cand = $datap[0]['username'];
$cand_name = $datap[0]['name'];

$sqlq = "SELECT * FROM answers WHERE test_code='$code' AND username='$username_cand'";
$resultq = mysqli_query($conn, $sqlq); //result set of rows
$dataq= mysqli_fetch_all($resultq, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html>
<head>
	<title>Class-ified</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

<style type="text/css">
	
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

 #responses {

    margin-top: 8vh;
 	width: 100%;
 	display: flex;
 	align-items: center;
 	flex-direction: column;
 	justify-content: center;
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

</style>

</head>

<body>

     <div id="fullcontent">
     	
        <div id="heading">
        	Individual test report of &nbsp <?php echo $cand_name ?>
        </div>

        <hr>

        <div id="responses">
        	
          <table>
          	
          	<tr class="rws">
          		
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Question</td>
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Correct Ans</td>
          		<td class="cls" style="font-weight: 900; font-size: 25px;">Choosen Ans</td>
          	
          	</tr>

          	<?php foreach($dataq as $keyq) { ?>

           <?php 
            
            $qid = $keyq['question_id'];  
            $sqla = "SELECT * FROM questions WHERE id='$qid'";

            $resulta = mysqli_query($conn, $sqla); //result set of rows
            $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);  

           ?>

           <tr class="rws">
          		
          		<td class="cls"><?php echo $dataa[0]['question']; ?></td>
          		<td class="cls"><?php echo $dataa[0]['answer']; ?></td>
          		<td class="cls"><?php echo $keyq['answer']; ?></td>
          	
          	</tr>

          	<?php } ?>

          </table>

        </div>

     </div>

</body>

</html>