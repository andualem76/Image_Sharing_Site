<?php
session_start();
include "../components/nav.php";
include '../api/dbConfig.php';

$name = $_POST['name'];

if (isset($_POST["submit"])) {
  
    $user_id = $_SESSION['user_id'];

    $insert = $db->query("UPDATE user SET name = '$name' WHERE id = $user_id;");

    if ($insert) {

        $_SESSION['message'] = "Name has been updated successfully.";
        $_SESSION['color'] = "notify_upload_green";
        $_SESSION['user_name'] = $name;
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();

    } else {
        
        $_SESSION['message'] =" File upload failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
        

    }
        
}
?>