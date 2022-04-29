<?php

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "image_sharing";

//connect to database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//check if their is connect error
if ($db->connect_error) {
    die("Connection Failed: " . $db->connect_error);
}