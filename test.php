<?php
require ("DBconnect.php");
require ("functions.php");
require ("Class/artist.php");


$connection= new DBconnect();
$conn= $connection->getConnection();
$artist= new Artist(1,$conn);
 echo ($artist->getFirstName()." FirstName"."<br>");
 echo ($artist->getLastName()." LastName"."<br>");
?>