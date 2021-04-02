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
$description=$recruiter->getDescription();
$email=$recruiter->getEmail();
$full_name= $first_name." ".$last_name;
$src=($recruiter->getProfilePicture()=="")? ".idea\Pictures\man.jpeg":$recruiter->getProfilePicture();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>landing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/r_landing.css" type="text/css" rel="stylesheet" />
    <link href="css/editGig.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<style>

</style>

<body>
    <section>

        <article>
            <div class="profile">
                <img id="img" class="img" 
                src="
                    <?php 
                        echo $src;
                    ?>
                    " 
                />
                <div class="profile-1">
                    <div class="profile-2">
                        <h1>
                           <?php
                           echo $full_name;
                           ?> 
                        </h1>
                        <button id="editProfile">Edit Profile</button>
                        <div id="myModal" class="modal">

                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <br>
                                <nav class="navbar">
                                    <div class="logo">
                                        <h1>vivart</h1>
                                    </div>

                                    <div class="navbar__right">
                                        <p>
                                        <?php
                                        echo $full_name;
                                        ?> 
                                        </p>

                                        <img 
                                        src="
                                        <?php 
                                            echo $src;
                                        ?>
                                        " 
                                        alt="Avatar" class="avatar">
                                    </div>
                                </nav>
                                <br>

                                <div class="profile1">
                                    <img id="pic" 
                                    src="
                                        <?php 
                                            echo $src;
                                        ?>
                                        " 
                                    alt="man">
                                    <div class="profile-1">
                                        <div class="profile-2-1">
                                            <h1>
                                            <?php
                                            echo $full_name;
                                            ?> 
                                            </h1>
                                        </div>
                                    </div>


                                </div>
                                <form id="update_profile" method="POST">
                                    <div class="in-content">

                                        <div class="in-content-1">
                                            <h3>First Name</h3>
                                            <input type='text' id='fName' name='first_name' value='<?php echo $first_name;?>'>
                                            <h3>Email</h3>
                                            <input type='text' id='email' name='email' value='<?php echo $email;?>'><br>
                                            <h3>Change Photo</h3>
                                            <input type="file" id="profile_photo" name="profile_photo">
                                            <button type="button" id="profile_photo_upload">Upload
                                                Image</button>
                                            <br><br>
                                            <p class="error" id="profileUpload_error"></p>
                                            <p class="success" id="profileUpload_success"></p>
                                            <br>
                                            <button id="update">Update</button>
                                            
                                            <br>
                                        </div>
                                        <div class="in-content-2">
                                            <h3>Last Name</h3>
                                            <input type='text' id='lName' name='last_name' value='<?php echo $last_name;?>'>
                                            <h3>Description</h3>
                                            <textarea name='description' id='description'><?php echo $description;?></textarea>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <p>
                    <?php echo $description?>
                    </p>
                </div>
                <br>

            </div>


            <br>

            <div class="body">


                <div class="body_div">
                    <div>
                        <img id="img" class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p class="title">Event</p>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <button id='editEvent'>Edit</button>
                    <div id='editModal' class='modal'>

                        <div class='modal-content12'>
                            <span class='closeEvent'>&times;</span>
                            <br>
                            <nav class='navbar12'>
                                <div class='logo'>
                                    <h1>vivart</h1>
                                </div>

                                <div class='navbar__right12'>
                                    <p>John Doe</p>

                                    <img src='.idea\Pictures\profile.svg' alt='Avatar' class='avatar1'>


                                </div>
                            </nav>
                            <br>


                            <form id='eventEdit'>
                                <div class='in-content12'>


                                    <div class='in-content-212'>
                                        <h3>Change Name</h3>
                                        <input type='text' id='event_name' name='event_name'>
                                        <h3>Change Media File</h3>
                                        <input type='file' id='event_file' name='event_file'>
                                        <button type='button' class='file_selector'
                                            onclick='changeEvent()'>Change</button>
                                        <h3>Change Caption</h3>
                                        <textarea type='text' id='event_description'
                                            name='event_description'></textarea>
                                        <input type='text' id='event_id' name='event_id'>
                                        <br>
                                        <p class='error' id='eventEdit_error'></p>
                                        <p class='success' id='eventEdit_success'></p>
                                        <br>
                                        <br>
                                        <div class="btns">
                                            <button id='update1'>Update</button>
                                            <br>
                                            <button type='button' id='event_delete'
                                                onclick='deleteEvent()'>Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>







                <div class="body_div">
                    <div>
                        <img id="img" class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p class="title">Event</p>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button class="editEvent" id="editGig">Edit</button>
                        <div id='gigModal' class='modal'>

                            <div class='modal-content1'>
                                <span class='closeGig'>&times;</span>
                                <br>
                                <nav class='navbar1'>
                                    <div class='logo'>
                                        <h1>vivart</h1>
                                    </div>

                                    <div class='navbar__right1'>
                                        <p>John Doe</p>

                                        <img src='.idea\Pictures\profile.svg' alt='Avatar' class='avatar1'>


                                    </div>
                                </nav>
                                <br>


                                <form id='gigEdit'>
                                    <div class='in-content1'>


                                        <div class='in-content-21'>
                                            <h3>Change Gig Type</h3>
                                            <input type='text' id='gig_type' name='gig_type'>
                                            <h3>Change Media File</h3>
                                            <input type='file' id='gig_file' name='gig_file'>
                                            <button type='button' class='file_selector'>Change</button>
                                            <h3>Change Caption</h3>
                                            <textarea type='text' id='gig_description'
                                                name='craft_description'></textarea>
                                            <br>
                                            <input type='text' id='gig_id' name='gig_id'>
                                            <br>
                                            <p class='error' id='gigEdit_error'></p>
                                            <p class='success' id='gigEdit_success'></p>
                                            <div class="btns">
                                                <button id='updateGig'>Update</button>
                                                <br>
                                                <button type='button' id='gig_delete'
                                                    onclick='craftDelete()'>Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

            </div>






        </article>
    </section>


    <script src="Js/r_landing.js"></script>

</body>

</html>