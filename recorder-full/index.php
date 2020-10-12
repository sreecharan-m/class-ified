<!DOCTYPE html>
<html lang="en">
  
  <head>
    <title>Simple Screen Record!</title>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/comlinkjs@3.0.2/umd/comlink.js"></script>
    <script src="script.js" async></script>
    <!-- import the webpage's stylesheet -->
    <link rel="stylesheet" href="style.css">

   <style type="text/css">
      
       #downloadd {

    width: 100vw;
    text-align: center;
    margin-bottom: 5vh;
    }

    button {
    margin: 1em;
    padding: 0.7em;
    background-color: #000;
    color: #00ffff;
    border: none;
    cursor: pointer;
    font-size: 17px;
    }

   </style> 
  
  </head>  
  
  <body>
    
    <header style="display: flex;">
        <img src="../images/logo6.jpg" style="height: 80px; width: 80px; margin-left: 2vw;"> <span style="margin-left: 2vw;"><h2>Class-ified Recorder</h2></span>
    </header>

    <p id="warning">
      Enable chrome://flags/#enable-experimental-web-platform-features
    </p>
    
    <video id="videoElement" autoplay muted></video>
    <br />
    
    <button id="captureBtn" style="margin-left: 3vw;">Capture</button>
    
    <button id="startBtn" disabled style="margin-left: 3vw;">Start Recording</button>
    
    <button id="stopBtn" disabled style="margin-left: 3vw;">Stop Capture</button>
    <br>
    
    <input type="checkbox" id="audioToggle" />
    <label for="audioToggle">Capture Audio from Desktop</label>
    <input type="checkbox" id="micAudioToggle" />
    <label for="micAudioToggle">Capture Audio from Microphone</label>
    
    
    <div id="downloadd">
    <a href="#" style="display: none; margin-left: 10vw; margin-right: 10vw;" id="download">Download</a>
    </div>
  

  </body>
</html>