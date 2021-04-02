<?php
session_start();
require "../DBconnect.php";
require "../functions.php";
require "../Class/artist.php";
require "../Class/event.php";
require "../Class/craft.php";
if(isset($_POST['type'])){
    $type=$_POST['type'];
    switch ($type) {
        case 'addEvent':
            $event_name=$_POST['event_name'];
            $photo=$_FILES['photo'];
            $description=$_POST['description'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($event_name)&&!empty($photo['name'])&&!empty($description)){
                $user= new Artist($_SESSION['user_id'],$conn);
                $user->addEvent($conn,$event_name,$description,$photo);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'addCraft':
            $art_type = $_POST['art_type'];
            $craft_file = $_FILES['photo'];
            $caption = $_POST['caption'];
            $dbConnect = new DBconnect();
            $conn = $dbConnect->getConnection();
            if(!empty($art_type) && !empty($craft_file) && !empty($caption)){
                $artist = new Artist($_SESSION['user_id'], $conn);
                $artist->addCraft($conn, $art_type, $caption, $craft_file);
            }else{
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'updateProfile':
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $profile_photo=$_FILES['profile_photo'];
            $description=$_POST['description'];
            $talent=$_POST['talent'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($first_name)&&!empty($description)&&!empty($last_name)&&!empty($email)&&!empty($talent)){
                if(empty($profile_photo['name'])){
                    $profile_photo=null;
                }
                $user= new Artist();
                $user->setFirstName($first_name);
                $user->setLastName($last_name);
                $user->setEmail($email);
                $user->setTalent($talent);
                $user->setDescription($description);
                $user->updateProfile($conn,$profile_photo,$_SESSION['user_id']);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'logout':
            $user = new User();
            $user->logout();
            echo "logged out";
            break;
        case 'getEventData':
            $event_id=$_POST['event_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $eventArray = array
            (
            'event_name' => $event->getEventName(),
            'event_description' => $event->getEventDescription(),
            'event_upload_path' => $event->getEventUploadPath()
             ); 
             echo (json_encode($eventArray));
             $dbConnect->closeConnection();
             break;
        case 'getCraftData':
            $craft_id=$_POST['craft_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $craft= new Craft($conn,$craft_id);
            $craftArray = array
            (
            'craft_type' => $craft->getCraftType(),
            'craft_description' => $craft->getCraftDescription(),
            'craft_upload_path' => $craft->getCraftUploadPath()
             ); 
             echo (json_encode($craftArray));
             $dbConnect->closeConnection();
            break;
        case 'updateEvent':
            $event_id=$_POST['event_id'];
            $event_name=$_POST['event_name'];
            $event_description=$_POST['event_description'];
            $event_file=$_FILES['event_file'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $event->setEventName($event_name);
            $event->setEventDescription($event_description);
            $event->updateEvent($conn,$event_file);
            $dbConnect->closeConnection();
            break;
        case 'updateCraft':
            $craft_id=$_POST['craft_id'];
            $craft_type=$_POST['craft_type'];
            $craft_description=$_POST['craft_description'];
            $craft_file=$_FILES['craft_file'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $craft= new Craft($conn,$craft_id);
            $craft->setCraftType($craft_type);
            $craft->setCraftDescription($craft_description);
            $craft->updateCraft($conn,$craft_file);
            $dbConnect->closeConnection();
            break;
        case 'deleteCraft':
            $craft_id=$_POST['craft_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $craft= new Craft($conn,$craft_id);
            $craft->deleteCraft($conn);
            $dbConnect->closeConnection();
            break;
        case 'deleteEvent':
            $event_id=$_POST['event_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $event->deleteEvent($conn);
            $dbConnect->closeConnection();
            break;
        case 'search':
            $dbConnect = new DBconnect();
            $conn = $dbConnect->getConnection();
            $search = $_POST['search'];
            $results = getGigsEvents($conn, $search);
            if($search != ""){                
                if($results == null){
                    echo "No results found";
                }else{
                    foreach ($results as $result) {
                    if(isset($result["gig_name"])){
                        $name = $result["gig_name"];
                        $description = $result["gig_description"];
                        $upload_path = $result["gig_upload_path"];
                        $button = "Apply";
                    }else{
                        $name = $result["event_name"];
                        $description = $result["event_description"];
                        $upload_path = $result["event_upload_path"];
                        $button = "View"; 
                        
                        }
                    echo"
                        <div class='body_div'>
                            <div>
                                <img id='img' class='img' src='$upload_path'/>
                            </div>
                            <div>
                                <h1>$name</h1>
                            </div>
                            <div>
                                <p>$description</p>
                            </div>
                            <div>
                                <button>$button</button>
                            </div>

                        </div>";
                    }
                }
            }else{
                foreach ($results as $result) {
                    if(isset($result["gig_name"])){
                        $name = $result["gig_name"];
                        $description = $result["gig_description"];
                        $upload_path = $result["gig_upload_path"];
                        $button = "Apply";
                    }else{
                        $name = $result["event_name"];
                        $description = $result["event_description"];
                        $upload_path = $result["event_upload_path"];
                        $button = "View"; 
                        
                    }
                    echo"
                        <div class='body_div'>
                            <div>
                                <img id='img' class='img' src='$upload_path'/>
                            </div>
                            <div>
                                <h1>$name</h1>
                            </div>
                            <div>
                                <p>$description</p>
                            </div>
                            <div>
                                <button>$button</button>
                            </div>

                        </div>";
                }
            }
            break;
        case 'artist_search':
            $dbConnect = new DBconnect();
            $conn = $dbConnect->getConnection();
            $search = $_POST['search'];
            $results = getArtists($conn, $search);
            if($search != ""){                
                if($results == null){
                    echo "No results found";
                }else{
                    foreach ($results as $result) {
                        $full_name= $result['first_name']." ".$result['last_name'];
                        if($result['profile_photo'] == null){
                            $profile_photo_path = "Image/profile_default.png";
                        }else{
                            $profile_photo_path=$result['profile_photo'];
                        }
                        $description=$result['description'];
                        $user_id=$result['user_id'];
                        echo "
                        <div class='profile' onclick='checkProfile($user_id)'>
                        <div class='profile_img'>
                            <img class='img' src='$profile_photo_path' alt='Profile_photo'>
                        </div>
                        <div class='profile_content'>
                            <span class='profile_name'>
                                <p>$full_name</p>
                            </span>
                            <span class='profile_info'>
                                <p>$description</p>
                            </span>
                        </div>
        
                    </div>";

                        
                        }
                    }
                }
            break;
        default:
            echo "Not executed";
            break;
    }
}else {
    echo "No type";
}


?>