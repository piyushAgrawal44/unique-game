<?php
    date_default_timezone_set('Asia/Kolkata');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "the_game_321";
   
    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
   
    // Die if connection was not successful
   
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
?>