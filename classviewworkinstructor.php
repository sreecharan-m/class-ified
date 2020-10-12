<?php 

session_start();

$id = $_GET['id'];
$usr= $_SESSION['username'];
$type= $_SESSION['type'];


$conn=mysqli_connect('localhost','shaun','test1234','dproject');
$sql= "SELECT * FROM assignment WHERE class_id='$id'";
$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);




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


    </style>
 

</head>

<?php include('classviewtop.php')?>


  <div id="new">
  	
  	<div id="newa">
    
    <a href="assignwork.php?id=<?php echo $id ?>"> + Assign New </a>
    
    </div>
  
  </div>

  <hr>

  <div id="previous">
  	     
      <div style=" margin-left: 2vw; font: 23px Open Sans; font-weight: 900;">
      	Previously Assigned :
      </div>

      <div id="works">
      	 
         <?php foreach($data as $key) { ?>

         <div class="qq">
            
           <div class="qqa">
            <a href="submissionsforinstructor.php?ass_id=<?php echo $key['id']; ?>&id=<?php echo $id ?>"><?php echo $key['title']; ?></a> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp - <span style="font: 15px Open Sans;">Deadline : <?php echo $key['deadline'] ?></span>
           </div>

           <div class="qqb">
            <p>Instruction:</p> <?php echo $key['instruction']; ?>
           </div>

           <div class="qqc">
             Created at : <span><?php echo $key['created_at']; ?></span>&nbsp  &nbsp  &nbsp  &nbsp  &nbsp
             
             <?php if(($key['file_location']) != '') { ?>

              <span style=" padding: 5px; background-color: rgba(0,0,0,0.08); font-weight: 900; "> <a href="uploads/<?php echo $key['file_location']; ?>" target='_blank'>Attached File</a></span>

             <?php } ?> 

           </div>

         </div>
 
         <?php } ?>

      </div>

  </div>



</div>

</body>

</html>