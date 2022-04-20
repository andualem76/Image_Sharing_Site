<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "practice";


$db = new mysqli($dbHost, $dbUsername,$dbPassword,$dbName);
if($db -> connect_error){
    die("Connection Failed: " . $db -> connect_error);
}

?>