<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "attendance";
    $conn = mysqli_connect($hostname, $username, $password);
    mysqli_select_db($conn, $db);
    if(!$conn){
        die("Connection is not successful");
    }
?>