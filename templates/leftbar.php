
<head>
	<title>Class away from class</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>


    <style type="text/css">
    	
      body {

      	margin: 0px;
      }

      #left {

      	display: flex;
      	flex-direction: column;
      	justify-content: center;
      	width: 15vw;
      	margin: 0px;
      	background-color: #000;
      	color: #00ffff;
      	height: 100vh;
      	align-items: center;
      	padding: 20px;
      }

      #fullcontent {

      	display: flex;
      	flex-direction: row;
      }


      #la {

      	display: flex;
      	flex-direction: column;
      	justify-content: center;
      }

      .lb {
      	margin-top: 3.3vh;
      	margin-bottom: 3.3vh;

      	font: 19px Open Sans;

      }

      a{
      	text-decoration: none;
      	color: #00ffff;
      }

    </style>


</head>


<body>

       <div id="fullcontent">

       <div id="left">
       	 
            <div id="la">
            	
              <div class="lb">
                <a href="recorderredirect.php">Recorder</a>
              </div>
              <div class="lb">
              	<a href="chat/chathome.php" target="_blank">Chat</a>
              </div>
              <div class="lb">
                <a href="#">Classes</a>
              </div>
              <div class="lb">
              	<a href="logout.php">Logout</a>
              </div>
              <div class="lb">
              	<a href="updateprofile.php" target="_blank">Update Profile</a>  
              </div>

              <div class="lb">
                <a href="speechtext/index.php" href="_blank">Note Taker</a>  
              </div>

              <div class="lb">
                <a href="speechtext/notes.php" href="_blank">My Notes</a>  
              </div>

              <?php 
                  
              if($type == 'instructor'){ goto y;}

              ?>

               <div class="lb">
                <a href="myperformance.php?id=<?php echo $id ?>">My Performance</a>  
              </div>

              <?php 

              y:

               $m=0;
              ?>

            </div>
 
       </div>       




