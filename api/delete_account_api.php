<?php
session_start();

include "../components/nav.php";
include '../api/dbConfig.php';


if (isset($_POST["submit"])) {
    //delete user from database
    $user_id = $_SESSION['user_id'];
    $insert = $db->query("DELETE FROM user WHERE id = $user_id;");

    if ($insert) {

        $_SESSION['message'] = "User has been Deleted successfully.";
        $_SESSION['color'] = "notify_upload_green";

        //destroy all sessions and logout
        session_destroy();
        header('location: http://localhost/image_sharing_site/index.php');
        ob_end_flush();

    } else {

        $_SESSION['message'] =" Delete failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
        
    }
        
}