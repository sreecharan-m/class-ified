<?php 

$id= $_GET['id'];
$type= $_SESSION['type'];

?>

<head>
	<title>Class Away From Class</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

<style type="text/css">

  #fullcontent {

  	display: flex;
  	flex-direction: column;
  }	

  body {
  	margin: 0px;
  }

  #top {

  	display: flex;
  	flex-direction: row;
  	align-items: center;
  	height: 7vh;
  	background-color: #000;
  	color: #00ffff;
  	width: 100vw;
  	padding-top: 5px;
  	padding-bottom: 5px; 
  }

  .tba {

  	margin-left: 2vw;
  	margin-right: 2vw;
  	font: 20px Open Sans;
  }

 a {

 	text-decoration: none;
 }

</style>

</head>

<body>

  <div id="fullcontent">
  	
      <div id="top">
      	
        <div id="ta" style="margin-left: 1vw;">
        	
        </div>

        <div id="tb" style="margin-left: 30vw; display: flex;">
        	
          <div class="tba">
          	<a href="classviewdiscussion.php?id=<?php echo $id ?>" style="color: #00ffff;">Discussion</a>
          </div>

          <div class="tba">
          	<a href="classviewwork.php?id=<?php echo $id ?>" style="color: #00ffff;">Work</a>
          </div>

          <div class="tba">
          	<a href="classviewpeople.php?id=<?php echo $id ?>" style="color: #00ffff;">People</a>
          </div>

          <div class="tba">
            <a href="test/redirect.php?id=<?php echo $id ?>" style="color: #00ffff;" target='_blank'>Test</a>
          </div>
 
        </div>

      </div>
