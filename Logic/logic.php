<?php
require "../DBconnect.php";
require "../functions.php";
require "../Class/artist.php";
if(isset($_POST['type'])){
    $type=$_POST['type'];
    switch ($type) {
        case 'login':
            $user = new User();
            $email = $_POST["email"];
            $password = $_POST["password"];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($email) && !empty($password)){
                echo $user->login($email, $password, $conn);
            }
            else{
                echo "Ensure all fields are completed";
            }
            $dbConnect->closeConnection();
            break;
        case 'register':
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $conf_Password=$_POST['conf_password'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($first_name)&&!empty($last_name)&&!empty($email)&&!empty($password)&&!empty($conf_Password)){
                if ($conf_Password==$password) {
                    if (checkEmail($conn,$email)) {
                        echo "This email already exists";
                    }else {
                        $user= new User();
                        $user->setFirstName($first_name);
                        $user->setLastName($last_name);
                        $user->setEmail($email);
                        $user->setPassword($password);
                        $user->setUserType("Artist");
                        $user->register($conn);
                    }
                }else{
                    echo "Password mismatch";
                }
            }else {
                echo "All fields are required";
            }
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