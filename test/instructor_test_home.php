<?php 
session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];
$id = $_GET['id'];
$type=$_SESSION['type'];
$status='';

$conn=mysqli_connect('localhost','shaun','test1234','dproject');
if(isset($_POST['submit']))
{
   

  function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
    }

   $i=0;


    while($i==0)
    {
    $cd= randomPassword();
    $sqlb= "SELECT id FROM class WHERE code='$cd'"; 
    $resultb = mysqli_query($conn, $sqlb); //result set of rows
    $datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

    if(count($datab) == 0)
    {
      $i=1;
    }

    }


   $testname= $_POST['testname'];
   $noq= $_POST['noq'];
   $time= $_POST['time'];
   $tm= $_POST['tm'];
   //$s=1;

   $sql = "INSERT INTO test(test_name, test_code, class_id, instructor_username, no_of_qns, time_of_test, total_marks) VALUES ('$testname', '$cd', '$id', '$usr', '$noq', '$time', '$tm')";
  

   if(mysqli_query($conn,$sql))
    {

            $_SESSION['test_code']=$cd;
            $_SESSION['click']=1;
            $_SESSION['class_id']=$id;
            $status='test successfully added continue to add questions';
           
    }

    else {
    	echo mysqli_error($conn);
    }

   } 

//echo "hai6";
?>

<!DOCTYPE html>
<html>

<head>
	<title>Class Away From Class</title>

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

     #top {

     	font:25px Open Sans;
     	margin-top: 3vh;
     	margin-left: 10px;
     }

     hr {

       	border: 0;
       	clear: both;
       	display: block;
       	width: 90%;
       	height: 3px;
        background-color: #000;
        margin-top: 5vh;
        margin-left: 0px;
      }

     #title {

     	font:23px Open Sans;
     	text-align: center;
     	margin-top: 4vh;
     } 

      .tde {

    width: 400px;
    height: 35px;
    margin: 10px;
    font-size: 38px;
    display: flex;
    justify-content: center;

}

.t-elements {
     margin: 2px;
     display: flex;
     justify-content: center;
     align-items: center;
     
}

   #details {

    margin-top: 2vh;
   	width: 100vw;
   	display: flex;
   	justify-content: center;
   }

   input {

    width: 400px;
   	height: 30px;
    padding: 8px;
    margin: 3px;
   }

   a {

   	text-decoration: none;
   	color: #000;
   }


   </style>

</head>


<body>

   <div id="fullcontent">
   	
      <div id="top">
      	Welcome <?php echo $name ?>

      	<hr>

        <p style="margin-top: 3vh; margin-left: 25px; font:18px Open Sans;">Create a comprehensive test the way you want by providing qns with 4 option and the answer</p>
        
        <p style="margin-top: 3vh; margin-left: 25px; font:18px Open Sans; margin-right: 10vw;">Attendees would be shown the questions in random order and they can answer only one question at a time and cant move back and forth between questions to make sure the test happens in a fair manner</p>

      </div>


      <div id="middle">
      	
          <div id="title">
          	Create test
          </div>

          <div id="details">
          	

            <form method="POST" action="instructor_test_home.php?id=<?php echo $id; ?>">
               
              <table>
                  
                <tr class="t-elements">
                    <td class="tde"><input type="text" name="testname" placeholder="Enter the test name"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="noq" placeholder="no of questions"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="time" placeholder="Time of test in minutes"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="tm" placeholder="Total marks of the test"></td>
                </tr>

              </table>

              <div style="display: flex; justify-content: center;">
              <button style="text-align: center; margin-top: 10px; padding: 5px; font-size: 20px; margin-top: 5vh; cursor: pointer;" name="submit">Create</button>
              </div>
           </form>


          </div>


          <div style="display: flex; justify-content: center;">
            <a href="testqns.php"> <button style="text-align: center; margin-top: 10px; padding: 0px; font-size: 20px; margin-top: 5vh; cursor: pointer; border: none;" name="submit"><?php echo $status; ?></button> </a>
          </div>

      </div>

   </div>

</body>

</html>


