<?php 

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

?>

<!DOCTYPE html>
<html>

<head>
	<title>Class Away From Class</title>


  <style type="text/css">
  	
    #right {

    	display: flex;
        flex-direction: column;
        width: 74vw;
    }

    #top {

        margin-top: 5px;
    	height: 7.5vh;
    	border-bottom: 1.5px solid #ffffff;
    	border-radius: 5px;
    	color: #ffffff;
    	display: flex;
    	align-items: center;
    	font: 22px Open Sans;

    }

    #next {

        margin: 0vh 5vw 0vh 5vw;
    	display: flex;
    	justify-content: center;
    	align-items: center;
    	font: 25px Open Sans;
    	color: rgb(255,255,255,0.45);
    	height: 80vh;
    }

  </style>

</head>

<?php include('template/leftofchat.php')?>


 <div id="right">
 	
     <div id="top">
     	<span style="margin-left: 5vw;"><?php echo $name; ?></span>
     </div>

     <div id="next">
     	<span>Click on the recent chats to view the messages that you have received,<br> you can Start a new chat by just clicking on the particular person in the people section of each class</span>
     </div>

 </div>

</div>
</body>


</html>

