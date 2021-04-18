<?php
session_start();
require "DBconnect.php";
require "functions.php";
require "Class/recruiter.php";
$dbConnect= new DBconnect();
$conn= $dbConnect->getConnection();
$recruiter= new Recruiter($_SESSION['user_id'],$conn);
$gigsUploaded= $recruiter->getGigsUploaded($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/applicants.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>


    <!--body-->

    <div class="wrapper">
        <form class="search_form" id="search_form" method="get">
            <div class="search">
                <button class="button_search" id="button_search" type="button"><i class="fa fa-search"
                        name="search"></i></button>
                <input id="search_text" class="inputSearch" type="text" placeholder="Search..." name="search">
            </div>
        </form>
        <?php
        $counter=0;
        foreach ($gigsUploaded as $gig) {
            $gigId=$gig["gig_id"];
            $gigName=$gig["gig_name"];
            // $gigDescription=$gig["gig_description"];
            // $gigUploadPath=$gig["gig_upload_path"];
            // <?php echo 'dropdown'.$gigId;
        ?>
        <div class="eventDiv">
            <button onclick="dropdown(<?php echo $gigId;?>)" class="eventName"><?php echo $gigName;?><i class="fa fa-angle-right" id="<?php echo 'fa-angle-right'.$gigId;?>"></i></button>
            <?php
            $sql="SELECT user.user_id ,user.first_name, user.last_name, user.description, user.profile_photo FROM gig_application NATURAL JOIN user WHERE gig_application.status=? AND gig_application.gig_id=?";
            $array=array("Pending",$gigId);
            $result=selectAllData($sql,$conn,$array);
            foreach($result as $applicant){
                $applicantId=$applicant["user_id"];
                $applicantFullName= $applicant['first_name']." ".$applicant['last_name'];
                $applicantPrfilePicture= $applicant["profile_photo"];
                $applicantDescription= $applicant["description"];
            ?>
            <div id="<?php echo 'artistDropdown'.$gigId;?>" class="artistDropdown-content" onclick="artistProfile(<?php echo $applicantId;?>)">
                <div class="profile">
                    <div class="profile_img">
                        <img class="img" src="<?php echo $applicantPrfilePicture;?>" alt="">
                    </div>
                    <div class="profile_content">
                        <span class="profile_name">
                            <p><?php echo $applicantFullName;?></p>
                        </span>
                        <span class="profile_info">
                            <p><?php echo $applicantDescription;?></p>
                        </span>
                    </div>
                    <form id="approveForm" action="">
                        <button class="approval" type="button" onclick="approve(<?php echo $applicantId.','.$gigId; ?>)">Approve</button>
                        <button class="decline" type="button" onclick="decline(<?php echo $applicantId.','.$gigId; ?>)">Decline</button>
                    </form>
                </div>
            </div>

            <?php 
            }
            ?>
            
            
        </div>
        <?php
         $counter++;    
        }
        ?>
        


        <!-- <div class="profile">
            <div class="profile_img">
                <img class="img" src=".idea\Pictures\man.jpeg" alt="">
            </div>
            <div class="profile_content">
                <span class="profile_name">
                    <p>John Doe</p>
                </span>
                <span class="profile_info">
                    <p>A young and enthusiastic kenyan-born musician with the biggest passion for photos</p>
                </span>
            </div>
            <form id="approveForm" action="">
                <button class="approval">Approve</button>
            </form>
        </div>



        <div class="profile">
            <div class="profile_img">

                <img class="img" src=".idea\Pictures\man.jpeg" alt="">

            </div>
            <div class="profile_content">
                <span class="profile_name">
                    <p>John Doe</p>
                </span>
                <span class="profile_info">
                    <p>A young and enthusiastic kenyan-born musician with the biggest passion for photos</p>
                </span>

            </div>
            <form id="approveForm" action="">
                <button class="approval">Approve</button>
            </form>
        </div>




        <div class="profile">
            <div class="profile_img">
                <img class="img" src=".idea\Pictures\man.jpeg" alt="">
            </div>
            <div class="profile_content">
                <span class="profile_name">
                    <p>John Doe</p>
                </span>
                <span class="profile_info">
                    <p>A young and enthusiastic kenyan-born musician with the biggest passion for photos</p>
                </span>
            </div>
            <form id="approveForm" action="">
                <button class="approval">Approve</button>
            </form>
        </div> -->
    </div>
    <script src="Js/applicants.js"></script>
</body>

</html>