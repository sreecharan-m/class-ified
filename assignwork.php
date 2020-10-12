<?php 

session_start();

$id= $_GET['id'];
$usr= $_SESSION['username'];
$name= $_SESSION['name'];



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




if(isset($_POST['submit']))
{

    //print_r($_FILES);

	$tit = $_POST['title'];
	$inst = $_POST['instruction'];
	$ta = $_POST['tassign'];
	$dt = $_POST['dt'];
	$file= $_FILES['attach']['name'];
	$target= "uploads/".basename($file);

    $conn=mysqli_connect('localhost','shaun','test1234','dproject');

	$sql = "INSERT INTO assignment(class_id, instructor, instructor_name, type_of_assign, deadline, title, instruction, file_location) VALUES ('$id', '$usr', '$name', '$ta', '$dt', '$tit', '$inst', '$file')";

	if(mysqli_query($conn,$sql))
    {
        //echo "success"; 
        if(move_uploaded_file($_FILES['attach']['tmp_name'], $target))
        {
        	echo "success";
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
               $mail ->Body = "A new work has been assigned for you in your class, kindly visit your class-ified class for attachments if any.
               
               Title of Assignment: $tit

               Instruction: $inst

               Deadline: $dt

               ";

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

    else {

    	echo mysqli_error($conn);
    }

}


?>


<!DOCTYPE html>

<html>

<head>
	<title>Class Away From Class</title>

   <style type="text/css">
   	
     #bottom {

     	display: flex;
     	justify-content: center;
     	margin-top: 3vh;
     }

     .t-elements {

     	padding: 10px;
     	margin-top: 2vh;
     	margin-bottom: 1vh;
     	font:18px Open Sans;
        text-align: center;

     }

     .tde {

     	padding: 10px;
     	font:28px Open Sans;
        text-align: center;
     }

     input {

     	padding: 10px;
     	font:20px Open Sans;
        outline: none;
        border: 1px solid black;
        width: 40vw;
        margin-top: 2vh;
     }

     #attach {
	    width: 0.1px;
	    height: 0.1px;
	    opacity: 0;
	    overflow: hidden;
	    position: absolute;
	    z-index: -1;
     }

     .upload {

     	font: 16px Open Sans;
     	padding: 10px;
     	border: 1px solid black;
     	margin-top: 3vh;
     	border-radius: 3px;
     	background-color: rgba(0,0,0,0.7);
     	color: #ffffff;
        cursor: pointer;
     }
 

   </style>
  

</head>

<?php include('classviewtop.php')?>


<div id="bottom">
        
        <div id="modal" style="position: relative;">
            
           <h3 style="text-align: center; font-size: 30px;">Add Work</h3>

           <form method="POST" enctype="multipart/form-data" action="assignwork.php?id=<?php echo $id ?>">
               
              <table>
                  
                <tr class="t-elements">
                    <td class="tde"><input type="text" name="title" placeholder="Enter the Title" style="text-align: center; border-radius: 10px;"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="instruction" placeholder="instructions" style="text-align: center; height: 15vh; border-radius: 15px; "></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="tassign" placeholder="type of assignment" style="text-align: center; border-radius: 10px;"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="datetime-local" name="dt" placeholder="Deadline" style="text-align: center; border-radius: 10px;"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><label for="attach" class="upload" style="margin-top: 3vh;">Upload your file here</label><input type="file" name="attach" id="attach" style="text-align: center; border-radius: 10px; cursor: pointer;  margin-top: 3vh;"></td>
                </tr>

              </table>

              <div style="display: flex; justify-content: center;">
              <button style="text-align: center; margin-top: 20px; padding: 5px; font-size: 20px; cursor: pointer;" name="submit">Create</button>
              </div>
           </form>

        </div>

    </div>



</body>

</html>