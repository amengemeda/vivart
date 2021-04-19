<?php
session_start();
require "DBconnect.php";
require "functions.php";
require "Class/artist.php";
$dbConnect= new DBconnect();
$conn= $dbConnect->getConnection();
$artist= new Artist($_SESSION['user_id'],$conn);
$gigsApplied= $artist->getGigsApplied($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/applications.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <title>Applications</title>
</head>

<body>
    <?php if($gigsApplied){ ?>
    <table class="applicationsTable">
        <tr>
            <th>Event</th>
            <th>Description</th>
            <th>Status</th>            
            <th>Remarks</th>
        </tr>
        <?php
            foreach ($gigsApplied as $gig) {
                if($gig['status'] == "Accepted"){
                    echo "<tr><td>".$gig['gig_name']."</td><td>".$gig['gig_description']."</td>
                        <td class='accepted'><input type='text' class='greenAccepted' value='Accepted'></td>
                        <td>Congrats! your application is accepted. The recruiter will
                            communicate you through your email address!</td></tr>";
                }else if($gig['status'] == "Pending"){
                    echo "<tr><td>".$gig['gig_name']."</td><td>".$gig['gig_description']."</td>
                        <td class='pending'> <input type='text' value='Pending' class='greyPending'></td>
                        <td>Not yet available</td></tr>";
                }else{
                    echo "<tr><td>".$gig['gig_name']."</td><td>".$gig['gig_description']."</td>
                        <td class='rejected'> <input type='text' value='Rejected' class='redRejected'></td>
                        <td>Unfortunately your application isn't accepted! But don't worry the platform has
                            other gig applications, so don't limit yourself</td></tr>";
                }
               
            }
            echo "</table>";
        }else{
            echo "<center><h4>You have not applied to any gigs yet</h4></center>";
        }
        ?>

       <!--  <tr>
            <td>Music Event Extravaganza</td>
            <td class="accepted"><input type="text" class="greenAccepted" value="Accepted"></td>
            <td>Congrats! your application is accepted. The recruiter will
                communicate you through your email address!</td>
        </tr>
        <tr>
            <td>Open Mic</td>
            <td class="pending"> <input type="text" value="Pending" class="greyPending"></td>
            <td>Not yet available</td>
        </tr>
        <tr>
            <td>Garden View Art</td>
            <td class="rejected"> <input type="text" value="Rejected" class="redRejected"></td>
            <td>Unfortunately your application isn't accepted! But don't worry the platform has
                other gig applications, so don't limit yourself</td>
        </tr>
 -->
    
</body>

</html>
