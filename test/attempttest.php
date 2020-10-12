<?php

session_start();
$usr=$_SESSION['username'];
$name=$_SESSION['name'];
$id = $_SESSION['class_id'];

$status='';

$conn=mysqli_connect('localhost','shaun','test1234','dproject');


function shuffle_assoc($list) { 
  //if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array();
  $i = 0; 
  foreach ($keys as $key) { 
    $random[$key] = $list[$i];
    $i++; 
  }
  return $random; 
}

   /*function shuffle_assoc(&$array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;
    }*/




/*function myshuffle($arr)
{
    // extract the array keys
    $keys = [];
    foreach ($arr as $key => $value) {
        $keys[] = $key;
    }

    // shuffle the keys    
    for ($i = count($keys) - 1; $i >= 1; --$i) {
        $r = mt_rand(0, $i);
        if ($r != $i) {
            $tmp = $keys[$i];
            $keys[$i] = $keys[$r];
            $keys[$r] = $tmp;
        }
    }

    // reconstitute
    $result = [];
    foreach ($keys as $key) {
        $result[$key] = $arr[$key];
    }

    return $result;
}*/






//$datashuf= shuffle_assoc($data);

   $testcode=$_GET['code'];
   $_SESSION['test_code'] = $testcode;
  
   $sql = "SELECT * FROM questions WHERE test_code='$testcode'";
   $result = mysqli_query($conn, $sql); //result set of rows
   $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
   $nq= count($data);

   $sqla = "SELECT * FROM test WHERE test_code='$testcode'";
   $resulta = mysqli_query($conn, $sqla); //result set of rows
   $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);
   $timeoftest = $dataa[0]['time_of_test'];
   $_SESSION['test_name']=$dataa[0]['test_name'];
   $_SESSION['total_marks']= $dataa[0]['total_marks'];


if(!isset($_SESSION['time']))
{
   $_SESSION['time'] = time();
   $_SESSION['click'] = 0;
   $_SESSION['mark'] = 0;

   $datashuf= shuffle_assoc($data);
   //$datashuf = myshuffle($data);
   //$datashuf=array();
   //$datashuf= shuffle($data);
   //print_r($data);
   //echo "hai";
   //echo "hai";
   //print_r($datashuf);
   $_SESSION['q'] = $datashuf;
}


$datashuf = $_SESSION['q'];

$now = time();
$timeSince = $now - $_SESSION['time'];
$min = $timeSince/60;

if($min >= $timeoftest)
{
   unset($_SESSION['time']);
   header('location: testresult.php');
}


$y = $_SESSION['click']; 

if(isset($_POST['submit']))
{

   $ans=$_POST['userans'];
   $correct = $datashuf[$y]['answer'];
   $qi = $datashuf[$y]['id'];


   $sqla= "INSERT INTO answers(test_code, class_id, username, question_id, answer) VALUES ('$testcode', '$id', '$usr', '$qi', '$ans')";

    if(mysqli_query($conn,$sqla))
    {
         //echo ' <script> alert(\'Question successfully answered\'); </script>';
        $_SESSION['click'] = $_SESSION['click']+1;
        if($ans == $correct)
        {
          $_SESSION['mark'] = $_SESSION['mark'] + $datashuf[$y]['mark'];
        }
    }


    if($_SESSION['click']+1 > $nq)
    {
     //echo ' <script> alert(\'All the qns of the test has been successfully added and attendees can take it up in their login\'); </script>';

     unset($_SESSION['time']);
     header('location: testresult.php');
    }

    $y = $_SESSION['click'];
    //print_r($_SESSION['mark']);
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

          font:20px Open Sans;
          text-align: center;
          margin-top: 4vh;
     } 

      .tde {

    height: 21px;
    margin: 10px;
    font-size: 22px;
    text-align: left;
    display: flex;
    align-items: center;

}

.t-elements {
     margin: 2px;
     
}

   #details {

    margin-top: 2vh;
     width: 100vw;
     display: flex;
     justify-content: center;
   }

   input {

     height: 30px;
    padding: 8px;
    margin: 3px;
   }

  </style>

</head>

<body>

        <div id="fullcontent">
          
           <div id="top">
               Time allotted of test (in seconds): <?php echo $timeoftest*60; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Time elapsed: <span id="run"></span>
           </div>


         <div id="middle">
          
          <div id="title">
               &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="font:14px Open Sans">Mark :<?php echo $datashuf[$y]['mark'];?></span>
          </div>

          <?php

            $change = array();
            $change[0] = $datashuf[$y]['option_a'];
            $change[1] = $datashuf[$y]['option_b'];
            $change[2] = $datashuf[$y]['option_c'];
            $change[3] = $datashuf[$y]['option_d'];

            shuffle($change);

          ?>

          <div id="details">
               

            <form method="POST" action="attempttest.php?code=<?php echo $testcode; ?>">
               
              <table style="display: flex; justify-content: center;">
                  
                <tr class="t-elements">
                    <td class="tde">Question : <?php echo $_SESSION['click']+1; ?> &nbsp <?php echo $datashuf[$y]['question'] . '?'; ?></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input required type="radio" name="userans" value="<?php echo $change[0];?>"><?php echo $change[0]; ?></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input required type="radio" name="userans" value="<?php echo $change[1];?>"><?php echo $change[1]; ?></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input required type="radio" name="userans" value="<?php echo $change[2];?>"><?php echo $change[2]; ?></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input required type="radio" name="userans" value="<?php echo $change[3];?>"><?php echo $change[3]; ?></td>
                </tr>


              </table>

              <div style="display: flex; justify-content: center;">
              <button style="text-align: center; margin-top: 10px; padding: 5px; font-size: 20px; margin-top: 5vh; cursor: pointer;" name="submit">Next</button>
              </div>
           </form>

          </div>

      </div>

   </div>


   <script type="text/javascript">
     
    
        var a = document.getElementById('run');

        var t = '<?php echo $timeSince; ?>';
        var tt= '<?php echo $timeoftest; ?>' * 60;

        var timerId = setInterval(function(){

                a.innerHTML = t;
                t++;

           if(t > tt)
           {
              alert('Time Over');
              location.reload();
           }

        },1000);


   </script>

</body>

</html>