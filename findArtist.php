<?php
require "functions.php";
require "DBconnect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/findArtist.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <!--navbar-->
        <div class="div_nav">
            <nav  class="nav">
                <div class="logo">
                    
                   <img id="logo" title="Go Back" src=".idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg" alt="LOGO"> 
                </div>
                
                <form class="search_form" id="search_form" method="get">
                    <div class="search">
                        <button class="button_search" id="button_search" type="button"><i class="fa fa-search" name="search"></i></button>
                        <input id="search_text" class="input" type="text"  placeholder="Search..." name="search">
                    </div>
                </form>
            </nav>
        </div>

        <!--body-->

        <div class="wrapper">
        <div id="search_results" class="body">
            <?php
            $connection= new DBConnect();
            $conn= $connection->getConnection();
            if (isset($_GET["search"])) {
              
                    $search=$_GET["search"];
                    $result=getArtists($conn,$search);
                    if ($result!=null) {
                        foreach ($result as $row) {
                            $full_name= $row['first_name']." ".$row['last_name'];
                            if($row['profile_photo'] == null){
                                $profile_photo_path = "Image/profile_default.png";
                            }else{
                                $profile_photo_path=$row['profile_photo'];
                            }
                            
                            $description=$row['description'];
                            $user_id=$row['user_id'];
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
                    
                                </div>
                            ";
                        }
                    }else {
                        echo "<p> No results found</p>";
                    } 
                    
 
            }

            $connection->closeConnection();
            ?>

        </div>
        <script src="Js/findArtist.js"></script>
    </body>
</html>