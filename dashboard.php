<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
  <link rel="stylesheet" href="Css/dashboard.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>DASHBOARD</title>
</head>

<body id="body">

  <div class="container">

    <nav class="navbar">
      <div class="nav_icon" onclick="toggleSidebar()">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </div>
      <div class="logo">
        <img id="logo" src=".idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg" alt="logo">
      </div>
      <div class="navbar__left">
        <form class="search_form" action="">
          <div class="search">
              <button class="button_search" type="submit"><i class="fa fa-search" name="search"></i></button>
              <input class="input" type="search"  placeholder="Search...">
          </div>
      </form>

      </div>

      <div class="navbar__right">
        <p>John Doe</p>

        <img src=".idea\Pictures\profile.svg" alt="Avatar" class="avatar">

        
      </div>
    </nav>
    
    <main>


      <div class="iframe">
        <iframe src="landing.html" height="800" width="1110" name="frame"></iframe>
      </div>






    </main>

    <div id="sidebar">
      <div class="sidebar__title">
        <div class="sidebar__img">

        </div>
        <i onclick="closeSidebar()" class="fa fa-times" id="sidebarIcon" aria-hidden="true"></i>
      </div>

      <div class="sidebar__menu">
        <div class="sidebar__link ">
          <i class="fa fa-home"></i>
          <a id="myPage" href="landing.html" target="frame">My Page</a>
        </div>

        <div class="sidebar__link">
          <i class="fa fa-briefcase"></i>
          <a href="events.html" target="frame">Events/Gigs</a>
        </div>
        <div class="sidebar__link">
          <i class="fa fa-plus"></i>
          <a href="craft.php" target="frame">Upload Craft</a>
        </div>
        <div class="sidebar__link">
          <i class="fa fa-plus"></i>
          <a href="uEvents.php" target="frame">Upload Event</a>
        </div>



      </div>
      <div class="logout">
        <i class="fa fa-power-off"></i>
        <button id="logout">Logout</button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="Js/script.js"></script>
  <script src="Js/dash.js"></script>
</body>

</html>