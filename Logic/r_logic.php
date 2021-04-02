<?php
session_start();
require "../DBconnect.php";
require "../functions.php";
require "../Class/recruiter.php";
require "../Class/event.php";
require "../Class/craft.php";
if(isset($_POST['type'])){
    $type=$_POST['type'];
    switch ($type) {
        case 'r_addEvent':
            $event_name=$_POST['event_name'];
            $photo=$_FILES['event_file'];
            $description=$_POST['description'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($event_name)&&!empty($photo['name'])&&!empty($description)){
                $user= new Recruiter($_SESSION['user_id'],$conn);
                $user->addEvent($conn,$event_name,$description,$photo);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'r_addGig':
            $gig_name = $_POST['gig_name'];
            $gig_file = $_FILES['gig_file'];
            $description = $_POST['description'];
            $dbConnect = new DBconnect();
            $conn = $dbConnect->getConnection();
            if(!empty($gig_name) && !empty($gig_file) && !empty($description)){
                $recruiter = new Recruiter($_SESSION['user_id'], $conn);
                $recruiter->addGig($conn, $gig_name, $description, $gig_file);
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
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($first_name)&&!empty($description)&&!empty($last_name)&&!empty($email)){
                if(empty($profile_photo['name'])){
                    $profile_photo=null;
                }
                $user= new Recruiter();
                $user->setFirstName($first_name);
                $user->setLastName($last_name);
                $user->setEmail($email);
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
        case 'getGigData':
            $gig_id=$_POST['gig_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $gig= new Gig($conn,$gig_id);
            $gigArray = array
            (
            'gig_type' => $gig->getGigType(),
            'gig_description' => $gig->getGigDescription(),
            'gig_upload_path' => $gig->getGigUploadPath()
             ); 
             echo (json_encode($gigArray));
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
        default:
            echo "Not executed";
            break;
    }
}else {
    echo "No type";
}


?>