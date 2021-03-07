<?php
session_start();
require "../DBconnect.php";
require "../functions.php";
require "../Class/artist.php";

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
        default:
            echo "Not executed";
            break;
    }
}else {
    echo "No type";
}


?>