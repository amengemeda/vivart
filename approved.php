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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" href="Css/approved.css" />
    <title>Approved Applicants</title>
</head>
<body>
    <table class="approvedTable">
        <tr>
            <th>Gig</th>
            <th>Email</th>
            <th>Full Name</th>
        </tr>
        <?php
        foreach($gigsUploaded as $gig){
            $gigId=$gig['gig_id'];
            $gigName=$gig['gig_name'];
            $approvedArtists=$recruiter->getApprovedArtists($conn,$gigId);
            foreach($approvedArtists as $approvedArtist){
                $artistId=$approvedArtist['user_id'];
                $artistFullName= $approvedArtist['first_name']." ".$approvedArtist['last_name'];
                $artistEmail= $approvedArtist['email'];
            ?>
             <tr>
                <td><?php echo $gigName;?></td>
                <td class="email"><?php echo $artistEmail;?></td>
                <td  class="name" title="See profile" onclick="showProfile(<?php echo $artistId;?>)"><?php echo $artistFullName;?></td>
            </tr>
            <?php    
            }
        }
        ?>
    
    </table>
    
</body>
<script>
    function showProfile(artistId){
        location.href="artistProfile.php?profile_id="+artistId;
    }
</script>
</html>