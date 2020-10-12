<?php

session_start();
$usr= $_SESSION['username'];
$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$status = '';

if(isset($_POST['submit']))
{

   $c = $_POST['current'];
   $p = $_POST['password1'];
   $q= $_POST['password2'];

   if($p == $q)
   {

     $sqla = "SELECT * FROM users WHERE username='$usr'";
     $resulta = mysqli_query($conn, $sqla); //result set of rows
     $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);

       if($dataa[0]['password'] == $p)
       {
          $sqlb = "UPDATE users SET password='$p' WHERE username='$usr'";
          if ($conn->query($sqlb) === TRUE) {
                
                $status = "Successfully Updated";

              } else {
                
                 $status = "Updation Failed";
              }
       }

       else {

          $status = "Invalid Credentials";
       }
   }

  else{

     $status = "New passwords didn't Match";
  }

}

?>



<!DOCTYPE html>

<html>

<head>
   <title>Class away from class</title>

    <style type="text/css">
      
    body {

      background-color: #000;
    }

    img {
      max-width: 50vh;
    }

    #fullcontent {

      display: flex;
      flex-direction: row;
      align-items: center;
      height: 100vh;
    }

    #right {

      margin: 0vh 0vw 0vh 5vw;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;


    }

    .entries {

      margin-top: 2vh;
        padding: 5px;
    }

    .id {

      text-align: left;
      margin-top: 1.5vh;
      font-weight: 900;
      font-size: 25px;

    }

    .value {
      margin-top: 1vh;
    }

    input {

      width: 350px;
      height: 20px;
      font-size: 18px;
      padding: 5px;
      text-align: center;
      border: 2px solid #00ffff;
      border-radius: 5px;
    }

    form {

      margin-top: 0px;
    }

    #submit {
      text-align: center;
      margin-top: 8vh;
    }

    #signup {

      padding: 9px 20px 9px 20px;
      font-size: 20px;
        border-radius: 6px;
        color: #00ff7f;
        background-color: #000;
        border: 1.4px solid #fff;
        cursor: pointer;
    }
    
    a{
      text-decoration: none;
    }



    </style>

</head>

<body>
      
        <div id="fullcontent">
         
           <div id="left" style="margin-left: 20vw;">
            
             <div id="logo">
              <img src="images/logo6.jpg">
            </div>

           </div>

           <div id="right">
            
             <div id="formdiv">
             
             <form method="POST" action="login.php">
             



             <div class="entries">
               
               <div class="id">
                  Current Password
               </div>

               <div class="value">
                   
                  <input type="password" name="current" id="username">

               </div>

             </div>


             <div class="entries">
               
               <div class="id">
                New Password
               </div>

               <div class="value">
                   
                  <input type="password" name="password1" id="password">

               </div>

             </div>


             <div class="entries">
               
               <div class="id">
                Confirm New Password
               </div>

               <div class="value">
                   
                  <input type="password" name="password2" id="password">

               </div>

             </div>


             <div id="submit">
               <button id="signup" name="submit">Update</button>
             </div>

                <div class="entries">
               
               <div class="id" style="text-align: center; font-size: 18px; color: #ff0000;">
                  <?php echo "$status"; ?>
               </div>

                </div>
            
            </form>

            </div>
           
           </div> 

        </div>

</body>

</html>