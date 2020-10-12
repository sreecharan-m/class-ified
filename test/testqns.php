<?php

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];
$id = $_SESSION['class_id'];
$testcode=$_SESSION['test_code'];

$status='';

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sql = "SELECT * FROM test WHERE test_code='$testcode'";
$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);

$nq = $data[0]['no_of_qns'];

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
        $_SESSION['click'] = $_SESSION['click']+1;
        echo ' <script> alert(\'Question successfully added\'); </script>';
   }


   if($_SESSION['click'] > $nq)
  {
     echo ' <script> alert(\'All the qns of the test has been successfully added and attendees can take it up in their login\'); </script>';

     $status='test is ready to be taken up....click here to go back';
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
               

            <form method="POST" action="testqns.php?id=<?php echo $id ?>">
               
              <table>
                  
                <tr class="t-elements">
                    <td class="tde"><input type="text" name="q" placeholder="Enter the Question"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="a" placeholder="Option : A"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="b" placeholder="Option : B"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="c" placeholder="Option : C"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="d" placeholder="Option : D"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="ans" placeholder="Answer(should be same as one of the option)"></td>
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

      <div style="display: flex; justify-content: center;">
            <a href="redirect.php"> <button style="text-align: center; margin-top: 10px; padding: 0px; font-size: 20px; margin-top: 5vh; cursor: pointer; border: none;" name="submit"><?php echo $status; ?></button> </a>
      </div>


   </div>

</body>

</html>