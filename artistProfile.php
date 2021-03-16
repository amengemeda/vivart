<?php
require "functions.php";
require "DBconnect.php";
require "Class/artist.php";
$user_id;
if (isset($_GET['profile_id'])) {
    $user_id=$_GET['profile_id'];
}else {
    echo "<script>alert('Select an artist first');</script>";
    header("Location: findArtist.php?search=all");
}
$connection= new DBConnect();
$conn= $connection->getConnection();
$artist= new Artist($user_id,$conn);
$description= $artist->getDescription();
$full_name= $artist->getFirstName()." ".$artist->getLastName();
$profile_picture=$artist->getProfilePicture();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>landing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/landing.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head> 
<style>

</style>

<body>
    <section>

        <article>
            <div class="profile">
                <img src="<?php echo $profile_picture;?>" alt="man">
                <div class="profile-1">
                    <div class="profile-2">
                    <h1><?php echo $full_name;?></h1>
                    
                    </div>

                                 
                     <p><?php echo $description;?></p>
                </div>
                <br>
                 
            </div>
           



            <div class="body">
                <?php
              
                
                    $craftResult=getCraftsUploaded($conn,$user_id);
                  foreach ($craftResult as $row) {
                    $craftId=$row['art_id'];
                    $crafttType=$row['art_type'];
                    $crafttCaption=$row['art_caption'];
                    $craftUploadPath=$row['art_path'];
                    $filePathArray=explode("/",$craftUploadPath);
                    $fileType=$filePathArray[0];
                    echo "               
                    <div class='body_div'>
                    <div>";
                   if ($fileType=="Image") {
                       echo "<img 
                       id='img' class='img' src='$craftUploadPath' /> ";
                   }elseif ($fileType=="Audio") {
                       echo "<audio class='Audio' width='240px' height='205px' controls>
                       <source src='$craftUploadPath' type='audio/ogg'>
                       </audio>";
                   }elseif ($fileType=="Video"){
                       echo"
                       <video class='video' width='240px' height='205px' controls>
                       <source src='$craftUploadPath' >
                       Your browser does not support the video tag.
                     </video>
                     ";
                   }
                   echo " 
                   </div>
                   <div>
                       <p class='description'>$crafttCaption</p>
                   </div>
                   <div>";
                  }
                
                $connection->closeConnection();
                ?>
                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div>

                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                   

                </div>
                <div class="body_div">
                    <div>
                        <img class="img" id="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                   

                </div>
                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                   

                </div>
                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div>
                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                   

                </div>
                
            </div>
            



        </article>
    </section>


    <script> 
        $(document).ready(function () {
        var small={width: "240px",height: "205px"};
        var large={width: "400px",height: "382px"};
        var count=2; 
        $("#img").css(small).on('click',function () { 
            $(this).animate((count==2)?large:small);
            count = 2-count;
        });
    });

      </script>
      
</body>

</html>