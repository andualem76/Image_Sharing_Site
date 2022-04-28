<?php
session_start();
unset($_SESSION['user_id']);

header('location: http://localhost/image_sharing_site/index.php');
?>