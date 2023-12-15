<?php 
$serverName = "db";
$dbUsername = "test";
$dbPass = "pass";
$dbName = "app_db";

$conn = new mysqli($serverName, $dbUsername, $dbPass, $dbName);
if($conn->connect_error){
    die("Connection failed". $conn->connect_error);
}
