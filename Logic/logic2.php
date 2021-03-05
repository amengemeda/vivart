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
                $user= new User($_SESSION['user_id'],$conn);
                $user->addEvent($conn,$event_name,$description,$photo);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'logout':
            $user= new User();
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