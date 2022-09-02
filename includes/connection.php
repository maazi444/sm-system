<?php
$hostname = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password);

$sql = "CREATE DATABASE IF NOT EXISTS attendance";
mysqli_query($conn, $sql);
$db = "attendance";
mysqli_select_db($conn, $db);

include("create-tables.php");

