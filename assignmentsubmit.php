<?php 

session_start();

$status='';

$id = $_GET['id'];
$usr= $_SESSION['username'];
$type= $_SESSION['type'];
$name = $_SESSION['name'];
$c = $_SESSION['class_id'];

$conn=mysqli_connect('localhost','shaun','test1234','dproject');
$sql= "SELECT * FROM assignment WHERE id='$id'";
$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);


if(isset($_POST['submit']))
{

    //print_r($_FILES);
  $file= $_FILES['attach']['name'];
  $target= "uploads/".basename($file);
  $p= $_POST['pcomment'];

  $sql = "INSERT INTO submissions(username, name,class_id, assignment_id, private_comment, file_location) VALUES ('$usr', '$name', '$c', '$id', '$p', '$file')";

  if(mysqli_query($conn,$sql))
    {
        //echo "success"; 
        if(move_uploaded_file($_FILES['attach']['tmp_name'], $target))
        {
          $status = "successfully submitted";
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
	<title>Class Away From class</title>


    <style type="text/css">
    	
      #new {

      	margin-top: 5vh;       
        font: 20px Open Sans;
        display: flex;
        justify-content: center;
      }

      a {

      	text-decoration: none;
      	outline: none;
      	color: #000;
      }
      
      #newa {
      	text-align: center;
      	width: 10vw;
      	border: 1px solid black;
      	padding: 20px;
      	cursor: pointer;
      	border-radius: 20px;
      }

      hr {

   	border: 0;
   	clear: both;
   	display: block;
   	width: 100%;
   	height: 1px;
    background-color: #000;
    margin-top: 5vh;
   }

   #previous {

    margin-top: 3vh;
   }

   .qq {

    margin-top: 3vh;
    padding: 20px;
    width: 75vw; 
    background-color: rgba(0,0,0,0.08);
    border-radius: 20px;
   }

   #works {

    display: flex;
    align-items: center;
    flex-direction: column;
   }

   .qqa {
    
    font: 23px Open Sans;
    font-weight: 900;

   }

   .qqb {

    margin-top: 3vh;
    font: 18px Open Sans;
   }

   .qqc {

    margin-top: 3vh;
    font: 15px Open Sans;
    text-align: left;
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

     #cc {

      border: 1px solid black;
      border-radius: 25px;
      width: 30vw;
      height: 4vh;
      text-align: center;
     }

     #attach {
	    width: 0.1px;
	    height: 0.1px;
	    opacity: 0;
	    overflow: hidden;
	    position: absolute;
	    z-index: -1;
     }


    </style>



</head>

<?php include('classviewtop.php')?>


  <hr>

  <div id="previous">
  	     
      <div style=" margin-left: 2vw; font: 23px Open Sans; font-weight: 900;">
      	Assigned :
      </div>

      <div id="works">
      	 
         <?php foreach($data as $key) { ?>

         <div class="qq">
            
           <div class="qqa">
            <?php echo $key['title']; ?> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp - <span style="font: 15px Open Sans;">Deadline : <?php echo $key['deadline'] ?></span>
           </div>

           <div class="qqc">
             Created at : <span><?php echo $key['created_at']; ?></span>&nbsp  &nbsp  &nbsp  &nbsp  &nbsp 

              <span style=" padding: 5px; background-color: rgba(0,0,0,0.08); font-weight: 900;"> <a href="uploads/<?php echo $key['file_location']; ?>" target='_blank'>File attached by instructor</a></span>
  
            &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Turn in to attach your file and then submit      
           </div>

           <form method="POST" enctype="multipart/form-data" action="assignmentsubmit.php?id=<?php echo $id ?>">
                  
            <table style="margin-top: 10px; display: flex; justify-content: center;">   
              <tr class="t-elements">
                    <td class="tde"><label for="attach" class="upload" style="margin-top: 3vh; "><span style=" padding: 5px 2vw 5px 2vw; background-color: rgba(0,0,0,0.08); font-weight: 900; font: 18px Open Sans; border-radius: 5px; cursor: pointer;">TURN IN</span></label><input type="file" name="attach" id="attach" style="text-align: center; border-radius: 10px; cursor: pointer;  margin-top: 3vh;">
                    </td>
                    
                    <td><input type="text" name="pcomment" id="cc" placeholder="private comment to instructor" style="outline: none;"></td>
                    
              </tr>  
                  
            </table>

            <button style="text-align: center; margin-top: 20px; padding: 5px; font-size: 20px; cursor: pointer; margin-left: 2vw; text-align: center; width: 100%; border: none; background-color: inherit;" name="submit">Submit</button>
           
           </form>

           <div id="status" style="width: 100%; text-align: center; font: 15px Open Sans; margin-top: 2vh;">
             <?php echo $status; ?>
           </div>	

         </div>
 
         <?php } ?>

      </div>

  </div>

</div>

</body>

</html>