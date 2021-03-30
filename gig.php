<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Gig</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/r_gig.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

<body>


<section>

    <article>
        <div class="body">
        <form id="r_addGig" action="" method="POST">
        <h1>Gig</h1>
        <h2>Add Gig</h2>
        <input type="file" id="gig_file" name="gig_file" accept="audio/* video/* image/*">
        <button type="button" id="gig_upload_file">Choose File</button><br><br>
        <h2>Enter Gig Type/Name</h2>
        <input type="text" name="gig_name" id="gig_name">
        <br>
        <h2>Add Description</h2>
        <textarea name="description" id="caption" ></textarea>
        <p class="error" id="gigUpload_error"></p>
        <p class="success" id="gigUpload_success"></p>
        <button type="submit"id="upload">Upload</button>
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
<script src="Js/r_script.js"></script>
<script src="Js/dash.js"></script>


</body>
</html>