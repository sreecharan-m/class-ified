<?php

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

$sql="SELECT * FROM chat WHERE s_username='$usr' OR r_username='$usr' ORDER BY msg_time DESC";
$result = mysqli_query($conn, $sql); //result set of rows
$data= mysqli_fetch_all($result, MYSQLI_ASSOC);

$ns=array();


?>


<head>
	<title>Class away from class</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>


    <style type="text/css">
    	
      body {

        background-color: #000;
      	margin: 0px;
      }

      #left {

      	display: flex;
      	flex-direction: column;
      	width: 25vw;
      	margin: 0px;
      	background-color: #000;
      	color: #00ffff;
      	border-right: 1.5px solid #ffffff;
      	padding: 20px;
      	overflow-x: hidden;
      	overflow-y: auto;
      	height: 94vh;
      }

      #fullcontent {

      	display: flex;
      	flex-direction: row;
      }


      #la {

      	display: flex;
      	flex-direction: column;
      }

      .lb {
      	margin-top: 1vh;
      	margin-bottom: 1vh;
        height: 5vh;
        padding: 10px;
      	font: 21px Open Sans;
      	text-align: right;
      	border: 1px solid #ffffff;
      	display: flex;
      	align-items: center;
      	border-radius: 4px;
      	cursor: pointer;
      	font-weight: 900;

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
       	 
        <!-- <div id="find" style="margin-top: 2vh; margin-bottom: 3vh; text-align: center; font: 20px Open Sans; padding: 10px;"><a href="search.php">Search</a></div>-->
            <div id="la">
            	
                <?php $j=0; ?>

                <?php foreach($data as $key) { $r=0; ?>                    

                   <?php 
                      
                   if($key['s_username'] == $usr)
                   {
                   	 $n = $key['r_name'];
                   	 $s = $key['r_username'];
                     $sqla="SELECT * FROM users WHERE username='$s'";
                     $resulta = mysqli_query($conn, $sqla); //result set of rows
                     $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);
                     $idd= $dataa[0]['id'];
                   }

                   else {

                   	 $n = $key['s_name'];
                     $s = $key['s_username'];
                   	 $sqla="SELECT * FROM users WHERE username='$s'";
                     $resulta = mysqli_query($conn, $sqla); //result set of rows
                     $dataa= mysqli_fetch_all($resulta, MYSQLI_ASSOC);
                     $idd= $dataa[0]['id'];
                   }

  
                   if($j == 0)                 
                   {
                   	 $ns[$j]=$n;
                   	 $j++;
                   }
                   else
                   {
                   	 for ($i=0; $i< $j; $i++) { 
                   	 	
                   	 	if($ns[$i] == $n)
                   	 	{
                   	 		$r=1;
                   	 	}
                   	 }

                   	 if($r==0)
                   	 {
                   	 	$ns[$j]=$n;
                   	 	$j++;
                   	 }
                   }

                    if ($r==1) {
                    	continue;
                    }
                   
                   ?>
                   
                   <div class="lb">
                       <a href="individualchat.php?id=<?php echo $idd ?>"><?php echo $n ?></a>                      
                   </div>

                <?php $r=0; } 

                ?>

            </div>
 
       </div> 
         

