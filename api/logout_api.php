<?php
session_start();
//clear all session created
session_destroy();
header('location: http://localhost/image_sharing_site/index.php');
?>