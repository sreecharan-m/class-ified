<?php

$status='';
$errors='';
if(isset($_POST['submit']))
{
      $conn=mysqli_connect('localhost','shaun','test1234','dproject');
      $usr=$_POST['username'];
      $pwd=$_POST['password'];

      if(!$conn)
      {
            echo "connection error";
      }

      $sql= "SELECT id,type,name,username,password,email FROM users WHERE username = '$usr'";
      //$sqla="CREATE TABLE '$usr'(no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(255) NOT NULL,dt DATE,venue VARCHAR,ti TIME,addnote VARCHAR(255))";

      $result = mysqli_query($conn, $sql); //result set of rows
      $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      $name=($data[0]['name']);
      $type=($data[0]['type']);
      
      if($data[0]['password'] == $pwd)
      {
            session_start();
            $_SESSION['username']=$_POST['username'];
            $_SESSION['name']= $name;
            $_SESSION['type']= $type;

            
            if($data[0]['type'] == "instructor")
            {
              header('location: instructorhome.php');
            }

            else {

               header('location: attendeehome.php');
            }
      }

      else
      {
            $errors=mysqli_error($conn);
            $status="Incorrect credentials";
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
                  Username
               </div>

               <div class="value">
                   
                  <input type="text" name="username" id="username">

               </div>

             </div>


             <div class="entries">
               
               <div class="id">
                  Password
               </div>

               <div class="value">
                   
                  <input type="password" name="password" id="password">

               </div>

             </div>


             <div id="submit">
               <button id="signup" name="submit">Enter Class</button>
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