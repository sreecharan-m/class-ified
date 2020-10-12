<!DOCTYPE html>
<html>
<head>
	<title>White Board</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
	<meta charset="utf-8">


<style type="text/css">
	
  body {

    margin: 0px;
    padding: 0px;
    display: flex;
    flex-direction: column;
  }

  #heading {

    text-align: center;
    width: 100%;
    font:25px Open Sans;
    margin-top: 3vh;
  }

  #clear {

    background-color: #000;
    color: #00ffff;
    font: 20px Open Sans;
    padding: 5px 15px 5px 15px;
    cursor: pointer;
  }

</style>

</head>

<body>

    <div id="heading">
        Class-ified White Board &nbsp &nbsp &nbsp &nbsp &nbsp <span style="font-size: 20px;"><button id="clear" onclick="clearScreen();">Clear</button></span>
    </div>

    <canvas id="canvas" style="border: 2px solid black; margin:3vh 10px 0px 10px;"></canvas>

    <script type="text/javascript">
    	

        const canvas= document.getElementById('canvas');
        const ctx= canvas.getContext('2d');

        canvas.width=window.innerWidth;
        canvas.height=window.innerHeight*0.85;

        let d=0;

        function startposition(e){
        	d=1;
        	draw(e);
        }

        function endposition(){
        	d=0;
        	ctx.beginPath();
        }

        canvas.addEventListener("mousedown", startposition);
        canvas.addEventListener("mouseup", endposition);
        canvas.addEventListener("mousemove", draw);

        function draw(e){

        	if(!d){
        		return;
        	}
        	
            //console.log("hai");
            let rect = canvas.getBoundingClientRect(); 
            let x = event.clientX - rect.left; 
            let y = event.clientY - rect.top;

        	ctx.lineWidth=4;
        	ctx.lineCap="round";
        	ctx.lineTo(x,y);
        	ctx.stroke();
        	ctx.beginPath();
        	ctx.moveTo(x,y);

        }

        function clearScreen() {

            console.log('hai');
            ctx.clearRect(0,0,canvas.width,canvas.height);
        }


    </script>

</body>
</html>