<?php

session_start();
$usr= $_SESSION['username'];
$name=$_SESSION['name'];
$conn=mysqli_connect('localhost','shaun','test1234','dproject');
$id= $_GET['id'];



require 'PHPMailer-master/src/PHPMailer.php';
               require 'PHPMailer-master/src/Exception.php';
               require 'PHPMailer-master/src/SMTP.php';
               //C:\xampp\htdocs\task3\PHPMailer-master\src
               $mail = new PHPMailer\PHPMailer\PHPMailer(true);
               $mail ->isSMTP();
               $mail ->SMTPAuth = true;
               $mail ->SMTPSecure = 'ssl';
               //$mail->SMTPSecure = 'tls';
               //$mail ->Host = 'smtp.gmail.com';
               $mail ->Host = gethostbyname('ssl://smtp.gmail.com');
               $mail ->Port='465';
               $mail ->isHTML();




$sqla="SELECT instructor FROM class WHERE id='$id'";
$resulta = mysqli_query($conn, $sqla); //result set of rows
$dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

$inst = $dataa[0]['instructor'];

if(isset($_POST['submit']))
{

	  $file= $_FILES['attach']['name'];
    $target= "uploads/".basename($file);

    $msg = $_POST['classcomment'];
    $sql= "INSERT INTO discussion(username, name, class_id, instructor_username, message, attachment) VALUES ('$usr', '$name', '$id', '$inst', '$msg', '$file')";

    if(mysqli_query($conn,$sql))
    {
         if(move_uploaded_file($_FILES['attach']['tmp_name'], $target))
         {
          //'<script> alert(\'successfully posted\') </script>';
          
          } 
        
          $sqlq = "SELECT * FROM attendee_classes WHERE class_id = '$id'";
          $resultq = mysqli_query($conn, $sqlq); //result set of rows
          $dataq= mysqli_fetch_all($resultq, MYSQLI_ASSOC);
          
          foreach($dataq as $key)
          {
            
          $u = $key['username'];
          $sqlw = "SELECT * FROM users WHERE username = '$u'";
          $resultw = mysqli_query($conn, $sqlw); //result set of rows
          $dataw= mysqli_fetch_all($resultw, MYSQLI_ASSOC);

          $m = $dataw[0]['email'];

          if($m != '')
          {


               date_default_timezone_set('Etc/UTC');

               


               $mail ->Username = "msjh0512backup@gmail.com";
               $mail ->Password= '511200112';
               $mail ->SetFrom("msjh0512backup@gmail.com");
               $mail ->FromName = "Class-ified";
 
               $mail ->addAddress($m);

               //$mail ->isHTML(true);
               $mail ->Subject = "New Discussion";
               $mail ->Body = "A new discussion has been initiated in your class, The message thats been posted is $msg. kindly visit your class-ified class for attachments if any";

               if(! $mail ->Send())
               {
                 echo "error--".$mail ->ErrorInfo;
               }
               else
               {
                 //echo "success";
               }

            }

          }         
    }

}

$sqlb="SELECT * FROM discussion WHERE class_id='$id' ORDER BY time desc";
$resultb = mysqli_query($conn, $sqlb); //result set of rows
$datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

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

   	margin-top: 10px;
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

<?php include('classviewtop.php'); ?>


<div id="comment">
	
  <form method="POST" enctype="multipart/form-data" action="classviewdiscussion.php?id=<?php echo $id ?>">
  
  <div id="kkk">
  <div id="input">
  
  	<input type="text" name="classcomment" id="cc" placeholder="share a public comment with your class">
 
  </div>

  <div style="margin-top: 1.75vh; margin-left: 1vw; margin-right: 1vw;">
    
    <label for="attach" class="upload" style="margin-top: 3vh; "><span style=" padding: 5px 2vw 5px 2vw; background-color: rgba(0,0,0,0.08); font-weight: 900; font: 18px Open Sans; border-radius: 5px; cursor: pointer;">Attach file</span></label><input type="file" name="attach" id="attach" style="text-align: center; border-radius: 10px; cursor: pointer;  margin-top: 3vh;">

  </div>

  <div id="send" style="margin-left: 20px; margin-top: 0px;">	
   
   <button name="submit"> <img src="images/sendlogo2.jpg" style="width: 42px; height: 42px;"> </button>  

  </div>

 </div>

  </form>

</div>

<hr>


<div id="previous">
	

     <div id="posts">
     	
        <?php foreach($datab as $key) { ?>

         <div class="details">
         Posted By : <?php echo $key['name']; ?>, At: <?php echo $key['time']; ?>
         </div>

         <div class="qwe">
         	
            <?php echo $key['message']; ?>

         </div>

         <div style="margin-top: 5px; margin-bottom: 5vw;">
           
           <?php if(($key['attachment']) != '') {  ?>

              <p style=" padding: 5px; background-color: rgba(0,0,0,0.08); font-weight: 900;"> <a href="uploads/<?php echo $key['attachment']; ?>" target='_blank'>File attached</a></p>

           <?php } ?>

         </div>

        <?php } ?>	

     </div>


</div>


</div>

<body>

</body>
</html>