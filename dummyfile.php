     
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////chat dummies////////////////////////////////////////////////////////////////////////////


     <div class="msgl">
     	hai idiot, hai nonsense, Click on the recent chats to view the messages that you have received, you can use the find option to search and start conversing
     </div>

     <div class="msgr">
     	hai nonsense
     </div>

     <div class="msgr">
     	hai nonsense
     </div>

     <div class="msgr">
     	hai nonsense
     </div>

     <div class="msgl">
     	hai idiot
     </div>

     <div class="msgr">
     	hai nonsense, Click on the recent chats to view the messages that you have received, you can use the find option to search and start conversing
     </div>

     <div class="msgl">
     	hai idiot hai nonsense, Click on the recent chats to view the messages that you have received, you can use the find option to search and start conversing
     </div>




     <?php echo '<div class="msgl">
          hai idiot
     </div>'; ?>


     <?php echo $key[\'msg\']; ?>



     ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////Test dummies////////////////////////////////////////////////////////////////////////////




<?php

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];
$id = $_SESSION['class_id'];
$testcode=$_SESSION['test_code'];

$sql = "SELECT * FROM test WHERE test_code='$testcode'";
$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);

$nq = $data[0]['no_of_qns'];

$_SESSION['click'] = $_SESSION['click']+1;

if($_SESSION['click'] > $nq)
{
     //echo ' <script> alert(\'All the qns of the test has been successfully added and attendees can take it up in their login\'); </script>';

     header('location: instructor_test_home.php?id=' . $id);
}

if(isset($_POST['submit']))
{

   $q=$_POST['q'];
   $a=$_POST['a'];
   $b=$_POST['b'];
   $c=$_POST['c'];
   $d=$_POST['d'];
   $ans=$_POST['ans'];
   $m=$_POST['m'];

   $sqla= "INSERT INTO questions(test_code, class_id, instructor_username, question, option_a, option_b, option_c, option_d, answer, mark) VALUES ('$testcode', '$id', '$usr', '$q', '$a', '$b', '$c', '$d', '$ans', '$m')";

   if(mysqli_query($conn,$sqla))
   {
        //echo ' <script> alert(\'Question successfully added\'); </script>';
   }
} 

?>


<!DOCTYPE html>
<html>

<head>
     <title>Class Away From Class</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>


  <style type="text/css">
     
    #top {

        width: 100vw;
        margin-top: 5vh;
        font:23px Open Sans;
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

  </style>

</head>

<body>

        <div id="fullcontent">
          
           <div id="top">
               Add all the <?php echo $nq ?> questions with options and the correct answer one by one with the help of next button
           </div>


         <div id="middle">
          
          <div id="title">
               <?php echo "Question:" . $_SESSION['click']; ?>
          </div>

          <div id="details">
               

            <form method="POST" action="addqns.php?id=<?php echo $id ?>">
               
              <table>
                  
                <tr class="t-elements">
                    <td class="tde"><input type="text" name="q" placeholder="Enter the Question"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="a" placeholder="Option : A"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="b" placeholder="Option : B"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="c" placeholder="Option : C"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="d" placeholder="Option : D"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="ans" placeholder="Answer(should be same as one of the option)"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="number" name="m" placeholder="Mark of this question"></td>
                </tr>

              </table>

              <div style="display: flex; justify-content: center;">
              <button style="text-align: center; margin-top: 10px; padding: 5px; font-size: 20px; margin-top: 5vh; cursor: pointer;" name="submit">Next</button>
              </div>
           </form>


          </div>

      </div>


        </div>

</body>

</html>





function shuffle_assoc($list) { 
  //if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) { 
    $random[$key] = $list[$key]; 
  }
  return $random; 
}



<span style=" padding: 10px; background-color: rgba(0,0,0,0.08); font-weight: 900; font: 20px Open Sans; border-radius: 2px;"><a href="">TURN IN</a></span>


                    <td><button style="text-align: center; margin-top: 7px; padding: 5px; font-size: 20px; cursor: pointer; margin-left: 2vw;" name="submit">Submit</button></td>