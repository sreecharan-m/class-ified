<?php 

$status='';
$errors='';
$type=$_GET['id'];

if(isset($_POST['submit']))
{
      $conn=mysqli_connect('localhost','shaun','test1234','dproject');
      $usr=$_POST['username'];
      $pwd=$_POST['password'];
      $name=$_POST['name'];
      $email=$_POST['email'];

      
        if($type=='instructor') 
        $sql="INSERT INTO users(name,username,password,email,type) VALUES('$name','$usr','$pwd','$email','instructor')";
      
        else if($type == 'attendee')
        $sql="INSERT INTO users(name,username,password,email,type) VALUES('$name','$usr','$pwd','$email','attendee')";	
      

      if(mysqli_query($conn,$sql))
      {
            //echo "success";
            $status="Account Successfully Created";
      }
      else
      {
            $errors=mysqli_error($conn);
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
    	max-width: 100vh;
    }

    #fullcontent {

    	display: flex;
    	flex-direction: row;
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
        	
           <div id="left">
           	
             <div id="logo">
          	  <img src="images/logo.png">
            </div>

           </div>

           <div id="right">
           	
             <div id="formdiv">
             
             <form method="POST" action="signup.php?id=<?php echo "$type"; ?>">
             
             <div class="entries">
             	
             	<div class="id">
             		Name
             	</div>

             	<div class="value">
             		 
             		<input type="text" name="name" id="name">

             	</div>

             </div>


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
             		 
             		<input type="text" name="password" id="password">

             	</div>

             </div>


 
             <div class="entries">
             	
             	<div class="id">
             		Email
             	</div>

             	<div class="value">
             		 
             		<input type="email" name="email" id="email">

             	</div>

             </div>


             <div id="submit">
             	<button id="signup" name="submit">Enter Class</button>
             </div>

                <div class="entries">
             	
             	<div class="id">
             		<?php echo "$status"; ?>
             	</div>

                </div>
            
            </form>

            </div>
           
           </div> 

        </div>

</body>

</html>


