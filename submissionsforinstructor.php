<?php

session_start();

$id = $_GET['id'];
$usr= $_SESSION['username'];
$type= $_SESSION['type'];
$idd = $_GET['ass_id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sqla="SELECT username FROM attendee_classes WHERE class_id='$id'";
$resulta = mysqli_query($conn, $sqla); //result set of rows
$dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);


$sqlb= "SELECT * FROM submissions WHERE assignment_id='$idd'"; 
$resultb = mysqli_query($conn, $sqlb); //result set of rows
$datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

if(isset($_POST['submit']))
{
   $u = $_POST['u'];
   $n = $_POST['n'];
   $ass_mark = $_POST['ass_mark'];

   $sqlq = "INSERT INTO assignment_marks(class_id, ass_id, username, name, marks) VALUES ('$id', '$idd', '$u', '$n', '$ass_mark')";

   if(mysqli_query($conn,$sqlq))
    {
        //echo "success";             
    }

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Class Away From Class</title>

<style type="text/css">
	
   #ins {

   	margin-top: 5vh;
   	font: 18px Open Sans;
    margin-left: 10vw;
   }     

   #atds {

   	margin-top: 3vh;
   	font: 20px Open Sans;
   	margin-left: 10vw;
   
   }

   #names {

   	margin-top: 10px;
   	margin-left: 10vw;
   }

   hr {

   	border: 0;
   	clear: both;
   	display: block;
   	width: 90%;
   	height: 3px;
    background-color: #000;
    margin-top: 5vh;
    margin-right: 0px;
   }

   .subs {

   	margin-top: 2vh;
   	margin-bottom: 2vh;
   	margin-left: 10px;
   	margin-right: 10px;
   	background-color: rgba(0,0,0,0.075);
   	width: 75%;
   	border-radius: 20px;
   	padding: 10px;
    font:17px Open Sans;
   }

   a {

     text-decoration: none;
     color: #000;
   }

   #cc {

      border: 1px solid black;
      border-radius: 25px;
      width: 15vw;
      height: 4vh;
      text-align: center;
     }

</style>

</head>

<?php include('classviewtop.php'); ?>


<div id="ins">
	
   <p style=" padding: 5px; background-color: rgba(0,0,0,0.08); font-weight: 900; width: 120px; margin-left: 35vw; margin-top: 0vh; margin-bottom: 5vh; "> <a href="assignment_marks_wholeclass.php?ass_id=<?php echo $idd ?>" target='_blank'>Mark Report</a></p>

   <p style="font-weight: 900; font-size: 25px;">Attendees who have submitted : </p>  

  <?php foreach($datab as $keya) {?>
  <div class="subs">
  
  <?php echo $keya['name'];?> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp - <?php echo $keya['time'];?>
  <p>Private comment to you :&nbsp  &nbsp <?php echo $keya['private_comment']; ?></p>

  <p style=" padding: 5px; background-color: rgba(0,0,0,0.08); font-weight: 900; width: 120px; margin-left: 2vw; "> <a href="uploads/<?php echo $keya['file_location']; ?>" target='_blank'>Attached File</a></p>

  <form method="POST" action="submissionsforinstructor.php?ass_id=<?php echo $idd ?>&id=<?php echo $id ?>">
                  
            <table style="margin-top: 10px; display: flex; justify-content: center;">   
              <tr class="t-elements">
                    
                    <td><input type="number" name="ass_mark" id="cc" placeholder="Assign Mark" style="outline: none;"></td>
                     
                    <input type="hidden" name="u" value="<?php echo $keya['username'] ?>">
                    <input type="hidden" name="n" value="<?php echo $keya['name'] ?>"> 
              </tr>  
                  
            </table>

            <button style="text-align: center; margin-top: 20px; padding: 5px; font-size: 20px; cursor: pointer; margin-left: 0vw; text-align: center; width: 100%; border: none; background-color: inherit;" name="submit">Submit</button>
           
  </form>
  
  </div>
  <?php }?>

</div>

<hr>

<div id="atds">
	
   <p style="font-weight: 900; font-size: 22px;">List of all Attendees:</p>

   <?php foreach($dataa as $key) { ?>

   
    <?php 
    
    $xy= $key['username'];

    $sqlb= "SELECT name FROM users WHERE username='$xy'";
    $resultb = mysqli_query($conn, $sqlb); //result set of rows
    $datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);
    
    ?>

    <div id="names">
    	
       <?php echo $datab[0]['name']; ?>

    </div>
   

   <?php } ?>

</div>


</div>

<body>

</html>