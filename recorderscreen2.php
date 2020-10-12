<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediaCapture and Streams API</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="main.css">

    <link rel="stylesheet" href="main.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

<style type="text/css">
    
video {
  width: 640px;
  height: 480px;
}

button {
  margin: 1em;
  padding: 0.7em;
  background-color: #000;
  color: #00ffff;
  border: none;
  cursor: pointer;
}

#download {

    width: 100vw;
    text-align: center;
    margin-bottom: 5vh;
}

a {
    text-decoration: none;
    padding: 5px 15px 5px 15px;
    background-color: #000;
    color: #00ffff;
    font-size: 22px;
}

#vid2 {

    margin-left: 5vw;
}

body {

    font :16px Open Sans;
}

</style>


</head>
<body>
    <header style="display: flex;">
        <img src="images/logo6.jpg" style="height: 80px; width: 80px; margin-left: 2vw;"> <span style="margin-left: 2vw;"><h2>Class-ified Recorder</h2></span>
    </header>
    <main>
        <p style="margin-left: 2vw;">Use the <b style="font-size: 19px;">Start</b> button to begin the recording and when you want to finish the recording click <b style="font-size: 19px;">Stop</b> after that you would be able to see a download button through which you can save to your system. <b style="font-size: 19px;">Check</b> your recorded video with the nearby video player.<b style="font-size: 19px;">Make sure to select the audio permission also while enabling the browser to record</b></p>
               
        
        <video controls style="margin-left: 5vw;"></video>
        
        <video id="vid2" controls></video>

        <p><button id="btnStart" style="margin-left: 5vw;">START RECORDING</button>
        <button id="btnStop" style="margin-left: 5vw;">STOP RECORDING</button></p>

        <div id="download">
        <a href="#" style="display: none; margin-left: 10vw; margin-right: 10vw;" id="downloadd">Download</a>
        </div>
        
    </main>    
    <script>

        const download = document.getElementById('downloadd');
        
        let constraintObj = { 
            audio:{
              echoCancellation: true,
              noiseSuppression: true,
              sampleRate: 44100
            } , 
            video: { 
                cursor: 'always',  
            } 
        }; 
        // facingMode: {exact: "user"}
        // facingMode: "environment"
        
        //handle older browsers that might implement getUserMedia in some way
        if (navigator.mediaDevices === undefined) {
            navigator.mediaDevices = {};
            navigator.mediaDevices.getDisplayMedia = function(constraintObj) {
                let getDisplayMedia = navigator.webkitGetDisplayMedia || navigator.mozGetDisplayMedia;
                if (!getDisplayMedia) {
                    return Promise.reject(new Error('getDisplayMedia is not implemented in this browser'));
                }
                return new Promise(function(resolve, reject) {
                    getDisplayMedia.call(navigator, constraintObj, resolve, reject);
                });
            }
        }else{
            navigator.mediaDevices.enumerateDevices()
            .then(devices => {
                devices.forEach(device=>{
                    console.log(device.kind.toUpperCase(), device.label);
                    //, device.deviceId
                })
            })
            .catch(err=>{
                console.log(err.name, err.message);
            })
        }

        navigator.mediaDevices.getDisplayMedia(constraintObj)
        .then(function(mediaStreamObj) {
            //connect the media stream to the first video element
            let video = document.querySelector('video');
            if ("srcObject" in video) {
                video.srcObject = mediaStreamObj;
            } else {
                //old version
                video.src = window.URL.createObjectURL(mediaStreamObj);
            }
            
            video.onloadedmetadata = function(ev) {
                //show in the video element what is being captured by the webcam
                //video.play();
            };
            
            //add listeners for saving video/audio
            let start = document.getElementById('btnStart');
            let stop = document.getElementById('btnStop');
            let vidSave = document.getElementById('vid2');
            let mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = [];
            
            /*start.addEventListener('click', (ev)=>{
                mediaRecorder.start();
                console.log(mediaRecorder.state);
            })*/

            mediaRecorder.start();
            
            stop.addEventListener('click', (ev)=>{
                mediaRecorder.stop();
                console.log(mediaRecorder.state);
            });
            mediaRecorder.ondataavailable = function(ev) {
                chunks.push(ev.data);
            }
            mediaRecorder.onstop = (ev)=>{
                let blob = new Blob(chunks, { 'type' : 'video/mp4;' });
                chunks = [];
                let videoURL = window.URL.createObjectURL(blob);
                vidSave.src = videoURL;

                download.href = videoURL;
                download.download = 'test.mp4';
                download.style.display = 'block';
            }
        })
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });
        
    </script>
</body>
</html>