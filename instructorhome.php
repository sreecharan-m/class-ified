<?php 


session_start();
$usr= $_SESSION['username'];
$name=$_SESSION['name'];
$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sql= "SELECT id,name,username,password,email,type FROM users WHERE username = '$usr'";

$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);
$name=($data[0]['name']);
$type=($data[0]['type']);


if(isset($_POST['submit']))
{

    $status='';
    $errors='';

    $cn = $_POST['classname'];
    $sec= $_POST['section'];
    $sub= $_POST['subject'];
    


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
    $j=0;
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



    while($j==0)
    {
    $md= randomPassword();
    $sqlb= "SELECT id FROM class WHERE meeting_id='$md'"; 
    $resultb = mysqli_query($conn, $sqlb); //result set of rows
    $datab= mysqli_fetch_all($resultb, MYSQLI_ASSOC);

    if(count($datab) == 0)
    {
      $j=1;
    }

    }


    
    $sqla= "INSERT INTO class(code,instructor,instructor_name,class_name,section,subject, meeting_id) VALUES ('$cd','$usr','$name','$cn','$sec','$sub', '$md')";

    if(mysqli_query($conn,$sqla))
    {
            //echo "success";
            $status="Account Successfully Created";
    }
    else
    {
            $errors=mysqli_error($conn);
    }

}
 
 $sqlc= "SELECT id,code, class_name, section, subject FROM class WHERE instructor='$usr'";
 $resultc = mysqli_query($conn, $sqlc); //result set of rows
 $datac= mysqli_fetch_all($resultc, MYSQLI_ASSOC);

?>



<!DOCTYPE html>
<html>

<head>
	
<style type="text/css">


#middle {

 color: #000;
 font:20px Open Sans;
 margin: 20px;
 display: flex;
 flex-direction: column;

}	
#type {

	margin-left: 5vw;
	padding: 1px 8px 5px 8px;
	background-color: #00bfff;
	color: #fff;
	font-weight: 900;
}

#top {

 color: #000;
 font:20px Open Sans;
 margin: 20px;
 display: flex;
 flex-direction: row;
 max-height: 5vh;
 align-items: center;
}

.tde {

    width: 400px;
    height: 50px;
    padding: 8px;
    margin: 3px;
    border: 1px solid black;
    font-size: 38px;
    display: flex;
    align-items: center;

}

.t-elements {
     margin: 2px;
     display: flex;
     justify-content: center;
     align-items: center;
     
}
input {

    border: none;
    outline: none;
    width: 380px;
    font-size: 23px;
    text-align: center;
}

#bottom {
    width: 83vw;
    display: flex;
    justify-content: center;
    
}

#modalclose {

    position: absolute;
    top: 35px;
    right: 50px;
    cursor: pointer;
}

#classlist {

    margin-top: 5vh;
    display: flex;
    flex-wrap: wrap;
}

#classes {

    margin: 20px;
    padding: 17px;
    border: 1px solid black;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#a {

    font:23px Open Sans;
    font-weight: 900;
    cursor: pointer;
}
#b {
    margin-top: 3px;
    font:23px Open Sans;
}

#c {
    margin-top: 3px;
    font:19px Open Sans;
}

#modal {
    display: none;
}

a {
    text-decoration: none;
    color: #000;
}


</style>

</head>


<?php include('templates/leftbar.php'); ?>


<div id="middle">

    <div id="top">
	
         <div>
          Welcome <?php echo "$name"; ?>
         </div>

         <div id="type">
	         <?php echo "$type"; ?>
         </div>

    </div>

    <div id="nexttotop" style="margin-top: 5vh; padding: 20px; display: flex; justify-content: center; width: 80vw; ">
        
         <div id="encloser" style="margin-left: 0vw; border: 1px solid #000; padding: 30px; font-size: 30px;">
            <a><button id="btn" style="font-size: 25px; background-color: #fff; border: none; cursor: pointer; outline: none; "> + Create New Class </button> </a>
         </div>

    </div>

    <div id="bottom">
        
        <div id="modal" style="position: relative;">
            
           <h3 style="text-align: center; font-size: 30px;">Create Class</h3>
           <span id="modalclose">✖</span>

           <form method="POST" action="instructorhome.php">
               
              <table>
                  
                <tr class="t-elements">
                    <td class="tde"><input type="text" name="classname" placeholder="Enter the class name"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="section" placeholder="Section"></td>
                </tr>

                <tr class="t-elements">
                    <td class="tde"><input type="text" name="subject" placeholder="Subject"></td>
                </tr>

              </table>

              <div style="display: flex; justify-content: center;">
              <button style="text-align: center; margin-top: 10px; padding: 5px; font-size: 20px;" name="submit">Create</button>
              </div>
           </form>

        </div>

    </div>


    <div id="classlist">
        
        <?php foreach($datac as $key){ ?>


          <div id="classes">
              
               <div id="a">
                 <a href="http://localhost/projectdelta/classviewdiscussion.php?id=<?php echo htmlspecialchars($key['id'])?>" style="color: #000;" target="_blank"> <?php echo $key['class_name'];?>-<?php echo $key['section']; ?></a>  
               </div>

               <div id="b">
                   <?php echo $key['subject']; ?>
               </div>

               <div id="c">
                 Class Invite Code: <?php echo $key['code'];?>
               </div>

          </div>


        <?php } ?>    

    </div>


</div>



</div>

<script type="text/javascript">
    
   var a = document.getElementById('btn');
   var b= document.getElementById('bottom');
   var c= document.getElementById('modalclose');
   var e= document.getElementById('nexttotop');
   var f=document.getElementById('modal');
   let d=0;

   a.addEventListener("click", function(){

    //b.style.visibility='visible';
    f.style.display='block';
    d=1;
    e.style.visibility='hidden';

   });

   c.addEventListener("click", function(){

    //b.style.visibility='hidden';
    f.style.display='none';
    d=0;
    e.style.visibility='visible';

  });




</script>



</body>

</html>