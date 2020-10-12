<!DOCTYPE html>
<html>
<head>
	<title>Screen recorder</title>
</head>

<style type="text/css">
	
#vid {

	 width: 96%;
	 max-width: 860px;
	 border: 2px solid black;
	 margin-top: 20px;
}

button {

	padding: 10px;
	margin: 10px;
	border: 2px solid #ffa500;

}

#fullcontent {

	display: flex;
	flex-direction: column;
	width: 100vw;
	height: 100vh;

}

</style>

<body>

 <div id="fullcontent">
 	
 	 <div>
 	 
 	 <div style="display: flex; margin-top: 0px; justify-content: center;">
 	 <div>
 	 <button id="start">Start Capture</button>
     <button id="stop">Stop Capture</button>   
     </div>
     </div>

     <div style="display: flex; justify-content: center;">
     <video id="vid" autoplay></video>
     </div>

     </div>

 </div>


<script type="text/javascript">
	
    
    let a =document.getElementById('vid');

    let b =document.getElementById('start');

    let c =document.getElementById('stop');

    var options = {


       video: {
       	   cursor : 'always'
       },
       audio: true
 
    }

    b.addEventListener("click", function(e){

    	startcapture();
    },false);


    c.addEventListener("click", function(e){

    	stopcapture();
    },false);

    async function startcapture() {

    	  try {

    	  	a.srcObject = await navigator.mediaDevices.getDisplayMedia(options);

    	  }
    	  catch(err) {

    	  	console.error("Error" + err)
    	  }
    }

    function stopcapture() {
 
    	  let tracks = videoElement.srcObject.getTracks();
    	  tracks.forEach(track => track.stop())

    	  a.srcObject=null;
    }
    


</script>


</body>

</html>