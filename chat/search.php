<?php

session_start();
$usr = $_SESSION['username'];
$name=$_SESSION['name'];
$conn=mysqli_connect('localhost','shaun','test1234','dproject');
$type = $_SESSION['type'];

if(isset($_POST['submit']))
{
	
  $s = $_POST['user_search'];
  $sql = "SELECT * FROM users WHERE name LIKE '%$s%'";
  $result = mysqli_query($conn, $sql);
  $data= mysqli_fetch_all($result, MYSQLI_ASSOC);

  $classes = array();
  $i=0;
  $j=0;
  $needed = array();
  if($type == 'instructor')
  {

      $sqla = "SELECT * FROM class WHERE instructor='$usr'";
      $resulta = mysqli_query($conn, $sqla);
      $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

      foreach($dataa as $keya)
      {
         $classes[$i] = $keya['id'];
      }

      foreach($data as $key)
      {
         $temp = $key['username'];
         $sqlb = "SELECT * FROM attendee_classes WHERE username='$temp'";
         $resultb = mysqli_query($conn, $sqlb);
         $datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);
      

        foreach($datab as $keyb)
        {
         if(in_array($keyb['class_id'], $classes))
         {
            $needed[$j] = $keyb['username'];
            $j++;
            break;
         }
        }
      } 
  }

  else if ($type == 'attendee')
  {
     
      $sqla = "SELECT * FROM attendee_classes WHERE username='$usr'";
      $resulta = mysqli_query($conn, $sqla);
      $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

      foreach($dataa as $keya)
      {
         $classes[$i] = $keya['id'];
      }

      foreach($data as $key)
      {
         $temp = $key['username'];
         $sqlb = "SELECT * FROM attendee_classes WHERE username='$temp'";
         $resultb = mysqli_query($conn, $sqlb);
         $datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);
      

        foreach($datab as $keyb)
        {
         if(in_array($keyb['class_id'], $classes))
         {
            $needed[$j] = $keyb['username'];
            $j++;
            break;
         }
        }
      }      

  }

}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Chat</title>

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

	#search {

		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	#cc {

		width: 300px;
		height: 35px;
		padding: 10px;
		font-size: 22px;
		margin-top: 5vh;
		outline: none;
		padding: 5px;
	}

	#submit {

		font-size: 18px;
		background-color: #000;
		color: #00ffff;
		padding: 10px 20px 10px 20px;
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

   #results {

   	display: flex;
   	flex-direction: column;
   	margin-left: 10vw;
   	margin-top: 5vh;
   }

   .names {

   	font: 20px Open Sans;
   	margin-top: 2vh;
   }

</style>

</head>

<body>

   <div id="fullcontent">
   	
      <div id="search">

          <div style="margin-top: 10vh; font: 27px Open Sans;">Search To Start Chat</div>

          <div>
          
          <form method="POST" action="search.php">
          	
          	<input type="text" name="user_search" id="cc" placeholder="Search">

           <div style="text-align: center; margin-top: 5vh;">
          	<button id="submit" name="submit">Search</button>
           </div>
          </form>
       	
       	</div>
      
      </div>

     <hr>

     <div id="results">
     	
         <?php if(isset($needed)) {?>

         <?php foreach($needed as $nd){ ?>

         <?php

          $sqld = "SELECT * FROM users WHERE username = '$nd'";
          $resultd = mysqli_query($conn, $sqld);
          $datad= mysqli_fetch_all($resultd, MYSQLI_ASSOC);
 
         ?>

         <div class="names"><a href="individualchat.php?id=<?php echo $datad[0]['id'] ?>"><?php echo $datad[0]['name'] ?></a></div>

         <?php } ?> 

       <?php } ?>

     </div>


   </div>

</body>

</html>