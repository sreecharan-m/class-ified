<?php

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];

$sqla = "SELECT * FROM notes WHERE username='$usr'";

$resulta = mysqli_query($conn, $sqla); //result set of rows
$dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Class Away From Class</title>

<style type="text/css">
	
   #comment
   {

   	margin-top: 10vh;
   	text-align: center;
   	display: flex;
   	flex-direction: row;
   	justify-content: center;
   }

   #cc {

   	border: 1px solid black;
   	border-radius: 25px;
   	width: 40vw;
   	height: 6vh;
   	text-align: center;
   }

   #input {
   	text-align: center;

   }

   input {
   	outline: none;
   	font-size: 15px;
   }

   #kkk {

   	display: flex;
   	flex-direction: row;
   	justify-content: center;
   }

   button {

   	outline: none;
    border: none;
    background-color: #ffffff;
    cursor: pointer;
   }

    hr {

   	border: 0;
   	clear: both;
   	display: block;
   	width: 100%;
   	height: 1.5px;
    background-color: #000;
    margin-top: 5vh;
    margin-left: 0px;
   }

   #previous {

   	margin-top: 5vh;
   	padding: 10px;
   }

   #posts {

   	display: flex;
   	align-items: center;
   	flex-direction: column;
   }

   .qwe {

   	border: 1px solid black;
   	border-radius: 10px;
   	padding: 20px;
   	width: 70vw;
   	font:16px Open Sans;
   	margin-top: 0vh;
   	margin-bottom: 5vh;
    
   }

   .details {

    margin-left: 0px;
   	margin-top: 10px;
   }

   #attach {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
     }

    a{

      text-decoration: none;
      color: #000;
    } 


</style>

</head>


<div id="previous">
	

     <div id="posts">
     	
        <?php foreach($dataa as $key) { ?>

         <div class="details">
         Taken At : <?php echo $key['time']; ?>
         </div>

         <div class="qwe">
         	
            <?php echo $key['note']; ?>

         </div>        

        <?php } ?>	

     </div>


</div>


</div>

<body>

</body>
</html>