<?php

$conn=mysqli_connect('localhost','shaun','test1234','dproject');

session_start();
$usr= $_SESSION['username'];
$name= $_SESSION['name'];
$type= $_SESSION['type'];

if(isset($_POST['t']))
{
     $note = $_POST['n'];
     $sql = "INSERT INTO notes(username, type, name, note) VALUES ('$usr', '$type', '$name', '$note')";

     if(mysqli_query($conn,$sql))
    {
      
      echo "success";           
    }

    else {
      echo mysqli_error($conn);
    }

}



?>


<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Class-ified</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/shoelace-css/1.0.0-beta16/shoelace.css">
<style type="text/css">
            
        ul {
    list-style: none;
    padding: 0;
}

p {
    color: #444;
}

button:focus {
    outline: 0;
}

.container {
    max-width: 700px;
    margin: 0 auto;
    padding: 20px 50px;
    text-align: center;
}

.container h1 {
    margin-bottom: 20px;
}

.page-description {
    font-size: 1.1rem;
    margin: 0 auto;
}

.tz-link {
    font-size: 1em;
    color: #1da7da;
    text-decoration: none;
}

.no-browser-support {
    display: none;
    font-size: 1.2rem;
    color: #e64427;
    margin-top: 35px;
}

.app {
    margin: 40px auto;
}

#note-textarea {
    margin: 20px 0;
    border: 1.5px solid black;
}

#recording-instructions {
    margin: 15px auto 60px;
}

#notes {
    padding-top: 20px;
}

.note .header {
    font-size: 0.9em;
    color: #888;
    margin-bottom: 10px;
}

.note .delete-note,
.note .listen-note {
    text-decoration: none;
    margin-left: 15px;
}

.note .content {
    margin-bottom: 40px;
}

@media (max-width: 768px) {
    .container {
        padding: 50px 25px;
    }

    button {
        margin-bottom: 10px;
    }

}   


@media (max-width: 1200px) {
    #bsaHolder{ display:none;}
}

hr {

        border: 0;
        clear: both;
        display: block;
        width: 100%;
        height: 3px;
        background-color: #000;
        margin-top: 5vh;
        margin-left: 0px;
}

button {

    background-color: #000;
    color: #00ffff;
    margin-left: 20px;
    margin-right: 20px;
}

</style>

    </head>
    <body>
        <div class="container">

            <div id="top" style="display: flex; align-items: center; justify-content: center;">
            <img src="../images/logo6.jpg" style="height: 80px; width: 80px;"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
            <div style="font-size: 23px; font-weight: 900; font-weight: 900;">Class-ified Notes Maker</div>
            </div>

            <hr>

            <h2 style="margin-top: 20px; font-weight: 500;">Convert your Voice to Notes</h2>
            <p class="page-description">Notes making has been made simple ever before 😊</p>
            <h3 class="no-browser-support">Sorry, Your Browser Doesn't Support the Web Speech API. Try Opening This Demo In Google Chrome.</h3>

            <div class="app"> 
                <h3>Add New Note</h3>
                <div class="input-single">
                    <textarea id="note-textarea" placeholder="Create a new note by typing or using voice recognition." rows="6"></textarea>
                </div>         
                <button id="start-record-btn" title="Start Recording">Start Recognition</button>
                <button id="pause-record-btn" title="Pause Recording">Pause Recognition</button>
                <button id="save-note-btn" title="Save Note">Save Note</button>   
                <p id="recording-instructions">Press the <strong>Start Recognition</strong> button and allow access.</p>
                
                <h3>My Notes</h3>
                <ul id="notes">
                    <li>
                        <p class="no-notes">You don't have any notes.</p>
                    </li>
                </ul>

            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <script type="text/javascript">
            

         try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recognition = new SpeechRecognition();
}
catch(e) {
  console.error(e);
  $('.no-browser-support').show();
  $('.app').hide();
}


var noteTextarea = $('#note-textarea');
var instructions = $('#recording-instructions');
var notesList = $('ul#notes');

var noteContent = '';

var notes = getAllNotes();
renderNotes(notes);


recognition.continuous = true;
 
recognition.onresult = function(event) {

  var current = event.resultIndex;

  var transcript = event.results[current][0].transcript;

  var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);

  if(!mobileRepeatBug) {
    noteContent += transcript;
    noteTextarea.val(noteContent);
  }
};

recognition.onstart = function() { 
  instructions.text('Voice recognition activated. Try speaking into the microphone.');
}

recognition.onspeechend = function() {
  instructions.text('You were quiet for a while so voice recognition turned itself off.');
}

recognition.onerror = function(event) {
  if(event.error == 'no-speech') {
    instructions.text('No speech was detected. Try again.');  
  };
}


$('#start-record-btn').on('click', function(e) {
  if (noteContent.length) {
    noteContent += ' ';
  }
  recognition.start();
});


$('#pause-record-btn').on('click', function(e) {
  recognition.stop();
  instructions.text('Voice recognition paused.');
});

noteTextarea.on('input', function() {
  noteContent = $(this).val();
})

$('#save-note-btn').on('click', function(e) {
  recognition.stop();

  if(!noteContent.length) {
    instructions.text('Could not save empty note. Please add a message to your note.');
  }
  else {
    
    saveNote(new Date().toLocaleString(), noteContent);

      $.ajax({

                        url: 'index.php',
                        method: 'POST',
                        data: {

                          n: noteContent,
                          t: 1
                        },

                        dataType: 'text'
                  });

    noteContent = '';
    renderNotes(getAllNotes());
    noteTextarea.val('');
    instructions.text('Note saved successfully.');
  }
      
})


notesList.on('click', function(e) {
  e.preventDefault();
  var target = $(e.target);

  if(target.hasClass('listen-note')) {
    var content = target.closest('.note').find('.content').text();
    readOutLoud(content);
  }

  // Delete note.
  if(target.hasClass('delete-note')) {
    var dateTime = target.siblings('.date').text();  
    deleteNote(dateTime);
    target.closest('.note').remove();
  }
});


function readOutLoud(message) {
    var speech = new SpeechSynthesisUtterance();

    speech.text = message;
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;
  
    window.speechSynthesis.speak(speech);
}


function renderNotes(notes) {
  var html = '';
  if(notes.length) {
    notes.forEach(function(note) {
      html+= `<li class="note">
        <p class="header">
          <span class="date">${note.date}</span>
          <a href="#" class="listen-note" title="Listen to Note">Listen to Note</a>
          <a href="#" class="delete-note" title="Delete">Delete</a>
        </p>
        <p class="content">${note.content}</p>
      </li>`;    
    });
  }
  else {
    html = '<li><p class="content">You don\'t have any notes yet.</p></li>';
  }
  notesList.html(html);
}


function saveNote(dateTime, content) {
  localStorage.setItem('note-' + dateTime, content);
}


function getAllNotes() {
  var notes = [];
  var key;
  for (var i = 0; i < localStorage.length; i++) {
    key = localStorage.key(i);

    if(key.substring(0,5) == 'note-') {
      notes.push({
        date: key.replace('note-',''),
        content: localStorage.getItem(localStorage.key(i))
      });
    } 
  }
  return notes;
}


function deleteNote(dateTime) {
  localStorage.removeItem('note-' + dateTime); 
}


        </script>

    </body>
</html>