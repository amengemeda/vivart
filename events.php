<?php 
session_start();
require_once "DBconnect.php";
require_once "functions.php";
$dbConnect = new DBconnect();
$conn = $dbConnect->getConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>events</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/landing.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head> 
<style>
img{
    width: 240px;
    height: 205px;
}
.body_div {
    width: 23.33%;
    }
    h1{
        color: #707070;

    }
    div p{
        margin: 0;
        margin-bottom: 4%;
    }
</style>

<body>
    <section>

        <article>
            <div class="body">
            <?php 
            $sql1 = "SELECT * FROM event";
            $sql2 = "SELECT * FROM gig";
            $array = array();
            $allEvents = selectAllData($sql1, $conn, $array);
            $allGigs = selectAllData($sql2, $conn, $array);
            $events_count = count($allEvents);
            $gigs_count = count($allGigs);
            foreach ($allEvents as $event) {
                $event_name = $event["event_name"];
                $description = $event["event_description"];
                $src = $event["event_upload_path"];
                $filePathArray = explode("/",$src);
                $fileType = $filePathArray[0];
                if($fileType == "Image"){
                    $display = "<img 
                        id='img'class='img' src='$src'/>";
                }else if($fileType == "Video"){
                   $display = "<video class='video' width='240px' height='205px' controls>
                        <source src='$src' >
                        Your browser does not support the video tag.
                      </video>";
                }
            ?>  
            
                <div class="body_div">
                    <div>
                        <?php echo $display; ?>
                        
                    </div>
                    <div><h1><?php echo $event_name?></h1> </div>
                    <div>
                        <p><?php echo $description?></p>
                    </div>
                    <div>
                       <button>View</button>
                    </div>

                </div>
            <?php }
            foreach ($allGigs as $gig) {
                $gig_name = $gig["gig_name"];
                $description = $gig["gig_description"];
                $src = $gig["gig_upload_path"];
                $filePathArray = explode("/",$src);
                $fileType = $filePathArray[0];
                if($fileType == "Image"){
                    $display = "<img 
                        id='img'class='img' src='$src'/>";
                }else if($fileType == "Video"){
                   $display = "<video class='video' width='240px' height='205px' controls>
                        <source src='$src' >
                        Your browser does not support the video tag.
                      </video>";
                }
             ?>
                <div class="body_div">
                    <div>
                        <?php echo $display; ?>
                        
                    </div>
                    <div><h1><?php echo $gig_name?></h1> </div>
                    <div>
                        <p><?php echo $description?></p>
                    </div>
                    <div>
                       <button>Apply</button>
                    </div>

                </div>
            <?php } ?>
                
            </div>
            



        </article>
    </section>


    <script> 
        $(document).ready(function () {
        var small={width: "240px",height: "205px"};
        var large={width: "400px",height: "382px"};
        var count=2; 
        $(".img").css(small).on('click',function () { 
            $(this).animate((count==2)?large:small);
            count = 2-count;
        });
    });
        
      </script>
</body>

</html>
