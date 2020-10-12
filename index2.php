<!DOCTYPE html>
<html>

<head>
   	  
  <title>Class Away From Class</title>

  <style type="text/css">
  	
  body {

  	margin: 0px;
  }
  #fullcontent {

  	display: flex;
  	flex-direction: column;
  }

  #top {

  	width: 100vw;
  	max-height: 100vh;
  	background-color: #000;
  	display: flex;
  	flex-direction: row;

  }

  #middle {

  	width: 100vw;
  	height: 90vh;
  	background-image: url("images/back6.jpg");
  	background-size: cover;
  	display: flex;
  	flex-direction: row;
  	

  }
  #heading{

  	font-size: 30px;
  	margin-top: 1.25vw;
  	margin-left: 2vw;
  	color: 66fcf1;
  	-webkit-text-stroke-width: 0.8px; 
    -webkit-text-stroke-color: #fff;
    font-weight: 500;

  }
 
 #logo
 {
 	margin-left: 6vw;

 }
  
  img {

  	max-height: 100vh;
  }
  .links
  {
  	text-decoration: none;
  	margin: 2vw;
  	padding: 8px;
  	border:1px solid white;
  	color: #00ff7f;
  	font-size: 20px;
  	border-radius: 5px;
  }

  #nav {

  	margin-top: 2.5vw;
  	margin-left: 2vw;
  	display: flex;
  	flex-direction: column;
  }

  .links:hover {

  	border: 3px solid #00ff7f;
  	color: #fff;
  }

  #redirect {

  	margin-top: 2vh;
  	
  }

  a {

  	text-decoration: none;
  	color: #000;
  }

  #instructor{

    margin-top: 20vh;
    padding: 30px;
  	border: 4px solid #00ffff;
  	font-size: 26px;
  	height: 2vh;
  	display: flex;
  	align-items: center;
  	justify-content: center;
  	border-radius: 15px;
  	background-color: #ff3333;
  	font-family: Arial,Helvetica,sans-serif;
  }

  #attendee {

    margin-top: 10vh;
    padding: 30px;
  	border: 4px solid #00ffff;
  	font-size: 26px;
  	height: 2vh;
  	display: flex;
  	align-items: center;
  	justify-content: center;
  	border-radius: 15px;
  	background-color:#ff99ff;
  	font-family: Arial,Helvetica,sans-serif;
  }
  #welcome {

  	margin-top: 15vh;
  	font-size: 26px;
  	color: #fff;
  	font-family: Arial,Helvetica,sans-serif;
  	max-width: 35vw;
  }

  #midleft {

    display: flex;
    flex-direction: column;

  }
  #midright {

  	display: flex;
  	flex-direction: column;
  }

  .info {

  	margin: 10vh 5vw 5vh 5vw;
  	padding: 60px;
  	font-size: 21px;
  	font-family: Arial,Helvetica,sans-serif;
  	background: rgb(0,0,0,0.85);
	box-shadow: 5px 5px 3px rgb(0,255,255,0.5);
	color: #fff;
  }

  #bottom {

  	width: 100vw;
  	height: 35vh;
  	background-color: #fff;
  	display: flex;
  	flex-direction: row;
  	align-items: center;
  	justify-content: center;
  	font-size: 15px;
  	color: #000;
  }

  #bottomtop {

  	display: flex;
  	flex-direction: row;
  	width: 100vw;
  	height: 80vh;
  	align-items: center;
  	justify-content: center;
  	background-color: rgb(255,229,204,0.6);
  }
  #leftquote {

      margin-left: 5vw;
      font-family: Arial,Helvetica,sans-serif;
      font-size: 37px;
  }
  #rightquote {

      margin-left: 5vw;
      font-family: Arial,Helvetica,sans-serif;
      font-size: 37px;
  }

  #bottombottom {

  	width: 100vw;
  	height: 50vh;
  	display: flex;
  	flex-direction: row;
  	justify-content: center;
  	align-items: center;
  	background-color: #e0e0e0;

  }

  .steps {

  	
  	color: #000;
  	padding: 30px;
  	font-size: 17px;
  	border: 3px solid black;
  	margin-left: 1.5vw;
  	margin-right: 1.5vw;
  }
  #kkk {

    font-family: Arial,Helvetica,sans-serif;
    font-size: 70px;
    margin: 0vh 0vw 0vh 0vw;
    padding: 6vh 0vw 4vh 2vw;
    background-color: #e0e0e0;
  }
  #end {
  	text-align: center;
  	margin-top: 0vh;
  	background-color: #e0e0e0;
  }

  </style>

</head>

<body>

  
  <div id="fullcontent">
    	
        <div id="top">
    	
         <div id="logo">
         	<img src="images/logo.png">
         </div>

         <div id="heading">
         	
            
         </div>

         <div id="nav">
         	
         	<div>
         	<nav>
         		
         		<a href="#" class="links">ABOUT</a>
         		<a href="#" class="links">CONTACT</a>
         		<a href="login.php" class="links">LOGIN</a>
         	</nav>
            </div>

            <div id="welcome">
            	
              You Are One Click From Entering The Class...

            </div>


            <div id="redirect">

                 <div id="instructor">

                     <a href="signup.php?id=<?php echo"instructor" ?>">As Instructor</a>
                 	
                 </div>
                 
                 <div id="attendee">
                 	
                    <a href="signup.php?id=<?php echo"attendee" ?>" style="color: #000;">As Attendee</a>

                 </div>
            	
            </div>

         </div>

        </div>

        <div id="middle">
    	
          <div id="midleft">
          	
            <div class="info">
            	
                  Record lectures with the help of integrated recorder, whiteboard and Notes makker.Share any File With the class.

            </div>

            <div class="info">
            	
                  
                  Real time chat and video conferencing with members across the board to aid doubt clarification and peer discussion.

            </div>

          </div>

          <div id="midright">

          	<div class="info">
          		  
                  Participate in online group discussions, allot Assignments and conduct test online with auto-correction and grading.

          	</div>

          	<div class="info">
          		
                  Integrated Digital Wellbeing tool across the browser for personal monitoring and avoiding distractions.

          	</div>
          	
          </div>

        </div>

        <div id="bottomtop">

        	<div id="leftquote">
        		" Online learning is not the next big thing, it is the now big thing...”
        	</div>

        	<div id="rightquote">
        		“The most important principle for designing lively eLearning is to see eLearning design not as information design but as designing an experience....”
        	</div>
        	
        </div>

        <div id="kkk">
        	How It Works?...
        </div>


        <div id="bottombottom">
        	
          <div class="steps">
          	If You Are A Instructor Sign Up With the required details and create a account. Create as many classes as you wish and share the code of the specific class that will be given with the students. Attendees need to sign up and create their account, upon which they can enter their class with the code.
          </div>

          <div class="steps">
          	After The class has been made instructor can record lecture capturing both the screen with inbuilt whiteboard and his/her image. The lectures are saved in the instructor's profile which can be shared to any class, making the whole idea of online lecture simple without relying on live online sessions which get hit by poor connectivity. 
          </div>

          <div class="steps">
          	 The instructor can conduct tests of both subjective and objective patters with option for auto-correction and grading. With the inbuild note maker attendees can take note and save it for a particular lecture. The feature of allotting assignments with deadline make the things easy for the instructor
          </div>

          <div class="steps">
          	 With the inbuilt realtime chat and video call, peer discussion and doubt clarification is made easier than never before. We strongly believe in the importance of discipline that class room environment offers, so we have integrated a digital wellbeing tool to make sure that the attendees never get distracted in their goal to excellence.
          </div>

        </div>
        <div id="bottom">
    	
          <div id="address">

          	Contact Address:<br><br>
          	Agate Hostel<br><br>
            Nit Trichurppalli<br><br>
            Thuvakudi<br><br>
            Trichy
          	
          </div>

          <div id="Contact" style="margin-left: 30vw;">

          	Phone Number: <br><br>
          	6380747893<br><br>
          	Mail Address :<br><br>
          	msecenitt@gmail.com
          	
          </div>


        </div>
        <div id="end">
        	Made With 💖 By Sree Charan
        </div>


  </div>

</body>

</html>