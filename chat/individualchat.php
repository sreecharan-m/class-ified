<?php

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$id = $_GET['id'];
$sqlb="SELECT * FROM users WHERE id='$id'";
$resultb = mysqli_query($conn, $sqlb); //result set of rows
$datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

$otherusr= $datab[0]['username'];
$othername = $datab[0]['name'];


if(isset($_POST['submit']))

{
    $q = $_POST['newmsg'];
    $sqld = "INSERT INTO chat(s_username,s_name,r_username,r_name,msg) VALUES ('$usr','$name','$otherusr','$othername','$q')";
    if(mysqli_query($conn,$sqld))
    {
            //echo "success";        
    }
    else {
    	echo mysqli_error($conn);
    } 
}


$sqlc= "SELECT * FROM chat WHERE (s_username='$usr' AND r_username='$otherusr') OR (s_username='$otherusr' AND r_username='$usr') ORDER BY msg_time ASC";
$resultc = mysqli_query($conn, $sqlc); //result set of rows
$datac= mysqli_fetch_all($resultc, MYSQLI_ASSOC);



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
        height: 100vh;
        position: relative;
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

    #chats {

        margin: 3vh 1vw 0vh 1vw;
    	font: 20px Open Sans;
    	overflow-y: auto;
    	display: flex;
    	flex-direction: column;
    	color: #ffffff;
    	width: 72vw;
    	margin-bottom: 3vh;
    	max-height: 78vh;

    }

    .msgl {

    	
    	padding: 10px;
        text-align: left;
        margin-top: 2vh;
        border: 1px solid #00ffff;
        max-width: 25vw;
        border-radius: 10px;
    }

    .msgr {

    	
    	padding: 10px;
    	text-align: right;
    	margin-right: 5vw;
    	margin-top: 2vh;
    	border: 1px solid #00ffff;
    	margin-left: 40vw;
    	border-radius: 10px;
    	
    }

    #comment
   {

   	text-align: center;
   	display: flex;
   	flex-direction: row;
   	justify-content: center;
   }


   #kkk {

   	display: flex;
   	flex-direction: row;
   	justify-content: center;
   }


    #input {
   	text-align: center;

   }


   #sendmsg {

   	position: absolute;
   	bottom: 3vh;
   	display: flex;
   	justify-content: center;
   	left: 20vw;

   }

   #cc {

   	border: 1px solid black;
   	border-radius: 25px;
   	width: 35vw;
   	height: 5vh;
   	text-align: center;
   	outline: none;
   	font:17px Open Sans;
   }


  </style>


</head>

<?php include('template/leftofchat.php') ?>


<div id="right">
 	
     <div id="top">
     	<span style="margin-left: 5vw;"><?php echo $othername; ?></span>
     </div>

    <div id="chats">

    <?php foreach($datac as $key) { ?>

    <?php

     if($key['s_username'] == $otherusr)

     {
           goto second;
     }

     ?>

     <div class="msgr">
     	<?php echo $key['msg']; ?>
     </div>     

     <?php continue; ?>

     <?php

      second:
       
      $k=1; 
     
     ?>

     <div class="msgl">
     	<?php echo $key['msg']; ?>
     </div>

    <?php } ?>

    </div>

    <div id="sendmsg">
    	

    <div id="comment">
	
        <form method="POST" action="individualchat.php?id=<?php echo $id ?>">
  
        <div id="kkk">
        <div id="input">
  
  	       <input type="text" name="newmsg" id="cc" placeholder="chat here">
 
        </div>

        <div id="send" style="margin-left: 20px; margin-top: 4px;">	
   
          <button name="submit" style="cursor: pointer;"> <img src="images/sendlogo2.jpg" style="width: 25px; height: 25px; border-radius: 4px;"> </button>  

        </div>

       </div>

       </form>

    </div>


   </div>   

</div>


</div>


<script type="text/javascript">
	
 var a =document.getElementById('chats');
 a.scrollTop = a.scrollHeight;

</script>

</body>

</html>