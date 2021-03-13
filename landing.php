<?php
session_start();
require "DBconnect.php";
require "functions.php";
require "Class/artist.php";
$dbConnect= new DBconnect();
$conn= $dbConnect->getConnection();
$artist= new Artist($_SESSION['user_id'],$conn);
$first_name = $artist->getFirstName();
$last_name = $artist->getLastName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>landing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/landing.css" type="text/css" rel="stylesheet" />
    <link href="css/editCraft.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head> 
<style>

</style>

<body>
    <section>

        <article>
            <div class="profile">
                <img src="
                <?php 
                $src=($artist->getProfilePicture()=="")? ".idea\Pictures\man.jpeg":$artist->getProfilePicture();
                echo $src;
                ?>
                " alt="man">
                <div class="profile-1">
                    <div class="profile-2">
                    <h1><?php echo $first_name." ".$last_name;?></h1>
                    <button id="editProfile">Edit Profile</button> 
                    <div id="myModal" class="modal">

                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <br>
                            <nav class="navbar">
                                <div class="logo">
                                    <img id="logo" src=".idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg" alt="logo">
                                </div>
                
                                <div class="navbar__right">
                                    <p><?php echo $first_name." ".$last_name;?></p>
                
                                    <img src="
                                    <?php 
                                        $src=($artist->getProfilePicture()=="")? ".idea\Pictures\man.jpeg":$artist->getProfilePicture();
                                        echo $src;
                                    ?>
                                    " alt="Avatar" class="avatar">
                
                
                                </div>
                            </nav>
                            <br>
                            
                                <div class="profile1">
                                    <img id="pic" src="
                                    <?php 
                                    $src=($artist->getProfilePicture()=="")? ".idea\Pictures\man.jpeg":$artist->getProfilePicture();
                                    echo $src;
                                     ?>
                                     " alt="man">
                                    <div class="profile-1">
                                        <div class="profile-2-1">
                                            <h1><?php echo $first_name." ".$last_name;?></h1>
                                        </div>
                                    </div>
                
                
                                </div>
                            <form  id="update_profile" method="POST">
                                <div class="in-content">
                
                                    <div class="in-content-1">
                                        <?php
                                        
                                        $full_name=$first_name." ".$last_name;
                                        $email=$artist->getEmail();
                                        $description=$artist->getDescription();
                                        echo "<h3>First Name</h3>
                                        <input type='text' id='fName' name='first_name' value='$first_name'>
                                        <h3>Email</h3>
                                        <input type='text' id='email' name='email' value='$email'>
                                        <h3>Description</h3>
                                        <textarea name='description' id='description'>$description</textarea>"
                                        ?>
                                       
                                        
                                    </div>
                                    <div class="in-content-2">
                                        
                                        <?php
                                        $talent=$artist->getTalent();
                                        echo "
                                        <h3>Last Name</h3>
                                        <input type='text' id='lName' name='last_name' value='$last_name'>
                                        <h3>Talent</h3>
                                        <input type='text' id='talent' name='talent' value='$talent'>";
                                        ?>
                                        <h3>Change Photo</h3>
                                        <input type="file" id="profile_photo" name="profile_photo">
                                        
                                        <button type="button" id="profile_photo_upload" >Upload Image</button><br><br>
                        
                                        <br>
                                        <p class="error" id="profileUpload_error"></p>
                                        <p class="success" id="profileUpload_success"></p>
                                        <br>
                                        <button id="update">Update</button>
                                    </div>
                                </div>
                            </form>
                
                        </div>
                    </div>
                    </div>              
                     <p><?php echo $artist->getDescription()?></p>
                </div>
                <br>
                 
            </div>
           



            <div class="body">
            <?php
            $eventResult=$artist->getEventsUploaded($conn);
            $craftResult=$artist->getCraftsUploaded($conn);
            $eventsCount=count($eventResult);
            $craftsCount=count($craftResult);
            
            // echo $eventsCount;
            // echo "<pre>";
            // print_r($eventResult);
            // echo "</pre>";
            // echo "<pre>";
            // print_r($craftResult);
            // echo "</pre>";
            // print_r($craftResult);
            $counter= ($eventsCount>$craftsCount)? $eventsCount : $craftsCount;
           
            for ($i=0; $i <$counter ; $i++) { 
                if(isset($eventResult[$i])){
                    $event=$eventResult[$i];
                    $eventId=$event['event_id'];
                    $eventName=$event['event_name'];
                    $eventDescription=$event['event_description'];
                    $eventUploadPath=$event['event_upload_path'];
                    $filePathArray=explode("/",$eventUploadPath);
                    $fileType=$filePathArray[0];
                    // $extension=explode(".",$eventUploadPath);
                    // $fileType=is_image($eventUploadPath)?"Image":"Video";
                    echo "               
                     <div class='body_div'>
                    <div>";
                    if ($fileType=="Image") {
                        echo "<img 
                        id='img' class='img' src='$eventUploadPath' /> ";
                    }elseif ($fileType=="Audio") {
                        echo "<audio class='Audio' width='240px' height='205px' controls>
                        <source src='$eventUploadPath' type='audio/ogg'>
                        </audio>";
                    }elseif ($fileType=="Video") {
                        echo"
                        <video class='video' width='240px' height='205px' controls>
                        <source src='$eventUploadPath' >
                        Your browser does not support the video tag.
                      </video>
                      ";
                    }
                      echo "  
                    </div>
                    <div>
                        <p class='title'>Event</p>
                        <p class='event_name'>$eventName</p>
                        <p class='description'>$eventDescription</p>
                    </div>
                    <div>
                        <button id='editEvent' onclick='editEvent($eventId)'>Edit</button>
                         <div id='editModal' class='modal'>
                        
                            <div class='modal-content12'>
                                <span class='closeEvent'>&times;</span>
                                <br>
                                <nav class='navbar12'>
                                    <div class='logo'>
                                        <img id='logo' src='.idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg' alt='logo'>
                                    </div>
                        
                                    <div class='navbar__right12'>
                                        <p>John Doe</p>
                        
                                        <img src='.idea\Pictures\profile.svg' alt='Avatar' class='avatar1'>
                        
                        
                                    </div>
                                </nav>
                                <br>
                        
                        
                                <form id='eventEdit'>
                                    <div class='in-content12'>
                        
                        
                                        <div class='in-content-212'>
                                            <h3>Change Name</h3>
                                            <input type='text' id='event_name' name='event_name'>
                                            <h3>Change Photo</h3>
                                            <input type='file' id='event_file' name='event_file'>
                                            <button type='button' class='file_selector' onclick='changeEvent()'>Change</button>
                                            <h3>Change Caption</h3>
                                            <input type='text' id='event_description' name='event_description'>
                                            <input type='text' id='event_id' name='event_id'>
                                            <br>
                                            <p class='error' id='eventEdit_error'></p>
                                            <p class='success' id='eventEdit_success'></p>
                                            <br>
                                            <br>
                                            <button id='update'>Update</button>
                                            <br>
                                            <button type='button' id='event_delete' onclick='deleteEvent()'>Delete</button>
                                        </div>
                                    </div>
                                </form>
                        
                            </div>
                        </div>
                        
                    </div>
                </div>";
                }
                if(isset($craftResult[$i])){
                    $craft=$craftResult[$i];
                    $craftId=$craft['art_id'];
                    $crafttType=$craft['art_type'];
                    $crafttCaption=$craft['art_caption'];
                    $craftUploadPath=$craft['art_path'];
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
                        <p class='title'>Craft</p>
                        <p class='craft_type'>$crafttType</p>
                        <p class='description'>$crafttCaption</p>
                    </div>
                    <div>
                        <button id='editCraft' onclick= editCraft($craftId)>Edit</button>
                        <div id='craftModal' class='modal'>
                        
                            <div class='modal-content1'>
                                <span class='closeCraft'>&times;</span>
                                <br>
                                <nav class='navbar1'>
                                    <div class='logo'>
                                        <img id='logo' src='.idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg' alt='logo'>
                                    </div>
                        
                                    <div class='navbar__right1'>
                                        <p>John Doe</p>
                        
                                        <img src='.idea\Pictures\profile.svg' alt='Avatar' class='avatar1'>
                        
                        
                                    </div>
                                </nav>
                                <br>
                        
                        
                                <form id='craftEdit'>
                                    <div class='in-content1'>
                        
                        
                                        <div class='in-content-21'>
                                            <h3>Change Craft Type</h3>
                                            <input type='text' id='craft_type' name='craft_type'>
                                            <h3>Change Photo</h3>
                                            <input type='file' id='craft_file' name='craft_file'>
                                            <button type='button' class='file_selector' onclick='changeCraft()'>Change</button>
                                            <h3>Change Caption</h3>
                                            <input type='text' id='craft_description' name='craft_description'>
                                            <br>
                                            <input type='text' id='craft_id' name='craft_id'>
                                            <br>
                                            <p class='error' id='craftEdit_error'></p>
                                            <p class='success' id='craftEdit_success'></p>
                                            <button id='update'>Update</button>
                                            <br>
                                            <button type='button' id='craft_delete' onclick='craftDelete()'>Delete</button>
                                        </div>
                                    </div>
                                </form>
                        
                            </div>
                        </div>
                        
                    </div>

                </div>";
                }
            }
            
            ?>


               
                <div class="body_div">
                    <div>
                        <img 
                        id="img" class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p class="title">Event</p>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button class="editEvent" id="editCraft">Edit</button>
                        
                    </div>

                </div>
                
            </div>
            



        </article>
    </section>


    <script src="Js/landing.js"></script>
      
</body>

</html>