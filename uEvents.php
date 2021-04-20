<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Css/craft.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>


<section>

    <article>
        <div class="body">
        <form id="addEvent" action="" method="POST">
        <h1>Event</h1>
        <h2>Add Name</h2>
        <input type="text" id="name" name="event_name"><br><br>
        <h2>Add Photo/Video</h2>
        <input type="file" id="eventPhoto" name="photo">
        <button type="button" id="event_upload_file" >Choose File</button><br><br>
        <h2>Add Description</h2>
        <textarea name="description" id="caption" maxlength="40"></textarea>
        <p class="error" id="eventUpload_error"></p>
        <p class="success" id="eventUpload_success"></p>
        <button type="submit" id="upload" >Upload</button>
        
        </form>
        </div>
        
        
        <div id="svg">
            <div id="svg-1">
                <svg height="105" width="105">
                    <circle cx="50" cy="50" r="50"   />
                  </svg>
                  <br>
                  <br>
                  <svg id="center-2" height="120" width="120">
                    <circle cx="60" cy="60" r="50"  />
                  </svg>
            </div>
            <div id="svg-2">
                <svg id="center" height="100" width="100">
                    <circle cx="30" cy="30" r="20" />
                  </svg>
            </div>
            <div id="svg-3">
                <svg height="100" width="100">
                    <circle cx="50" cy="50" r="40" />
                  </svg>
                  <br>
                  <br>
                  <svg id="center-1" height="100" width="100">
                    <circle cx="50" cy="50" r="40"  />
                  </svg>
            </div>

            
            

        </div>
    </article>
</section>



</body>
<script src="Js/script.js"></script>
<script src="Js/dash.js"></script>
</html>