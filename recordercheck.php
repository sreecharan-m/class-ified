<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediaCapture and Streams API</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="main.css">

</head>
<body>
    <header>
        <h1>MediaCapture, MediaRecorder and Streams API</h1>
    </header>
    <main>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit molestiae itaque facere totam saepe tempore esse temporibus, quae reprehenderit aliquid iusto ea laborum, iure eligendi odio exercitationem sapiente illum quos.</p>
        
        <p><button id="btnStart">START RECORDING</button><br/>
        <button id="btnStop">STOP RECORDING</button></p>
        
        <video controls></video>
        
        <video id="vid2" controls></video>
        
        <!-- could save to canvas and do image manipulation and saving too -->
    </main> 


    <script src="https://www.webrtc-experiment.com/MultiStreamsMixer.js"></script>


    <script>
        
        let constraintObj = { 
            
            video: { 
                cursor: 'always',  
            } 
        }; 
        // width: 1280, height: 720  -- preference only
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
        .then(function(displayStream) {
            //connect the media stream to the first video element
            let video = document.querySelector('video');
            
            /*if ("srcObject" in video) {
                video.srcObject = mediaStreamObj;
            } else {
                //old version
                video.src = window.URL.createObjectURL(mediaStreamObj);
            }*/



            let videoTrack = displayStream.getVideoTracks();

            navigator.mediaDevices.getUserMedia({
                        audio: true
                    }).then((audioStream) => {
                        let audioTrack = audioStream.getAudioTracks();
                        console.log("hai");
              });


            const MultiStreamsMixer = require('multistreamsmixer');
            //import MultiStreamsMixer from 'multistreamsmixer';        

            const mixer = new MultiStreamsMixer([audioTrack, videoTrack]);

            //let stream = new MediaRecorder([videoTrack, audioTrack]);
            const stream = new MediaRecorder(mixer.getMixedStream());
            

            let mediaStreamObj = stream;
            video.srcObject = mediaStreamObj;
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
            }
        })
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });
        
        /*********************************
        getUserMedia returns a Promise
        resolve - returns a MediaStream Object
        reject returns one of the following errors
        AbortError - generic unknown cause
        NotAllowedError (SecurityError) - user rejected permissions
        NotFoundError - missing media track
        NotReadableError - user permissions given but hardware/OS error
        OverconstrainedError - constraint video settings preventing
        TypeError - audio: false, video: false
        *********************************/
    </script>

      
</body>
</html>