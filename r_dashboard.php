<?php
session_start();
require "DBconnect.php";
require "functions.php";
require "Class/recruiter.php";
$dbConnect= new DBconnect();
$conn= $dbConnect->getConnection();
$recruiter= new Recruiter($_SESSION['user_id'],$conn);
$first_name = $recruiter->getFirstName();
$last_name = $recruiter->getLastName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/r_dashboard.css" />
    <title>DASHBOARD</title>
</head>

<body id="body">

    <div class="container">

        <nav class="navbar">
            <div class="nav_icon" onclick="toggleSidebar()">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="logo">
                <h1 title="Go Back">vivart</h1>
                
            </div>
            <div class="navbar__left">
               

            </div>

            <div class="navbar__right">
                <p><?php echo $first_name." ".$last_name;?></p>

                <img src=".idea\Pictures\profile.svg" alt="Avatar" class="avatar">


            </div>
        </nav>

        <main>


            <div class="iframe">
                <iframe src="r_landing.php" height="800" width="1110" name="frame"></iframe>
            </div>






        </main>

        <div id="sidebar">
            <div class="sidebar__title">
                
            <!-- <h1>vivart</h1> -->
          
                <i onclick="closeSidebar()" class="fa fa-times" id="sidebarIcon" aria-hidden="true"></i>
            </div>

            <div class="sidebar__menu">

                <div class="sidebar__link">

                <i class="fa fa-home"></i>
                <a href="r_landing.php" target="frame">Home</a>
                </div>
                <div class="sidebar__link">
                
                <i class="fa fa-street-view"></i>
                    <a href="applicants.php" target="frame">Applicants</a>
                </div>
                <div class="sidebar__link">
                    <i class="fa fa-plus"></i>
                    <a href="gig.php" target="frame">Upload Gig</a>
                </div>
                <div class="sidebar__link">
                    <i class="fa fa-plus"></i>
                    <a href="r_uEvents.php" target="frame">Upload Event</a>
                </div>



            </div>
            <div class="logout">
                <i class="fa fa-power-off"></i>
                <button id="logout">Logout</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/r_script.js"></script>
    <script src="js/dash.js"></script>
</body>

</html>