<?php
session_start();

include "../components/nav.php";
include '../api/dbConfig.php';


$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

if (isset($_POST["submit"])) {
  
    //check if the current password is valid
    $user_id = $_SESSION['user_id'];
    $check = $db->query("SELECT * from user where password = '$current_password' && id = $user_id");
   
    $num = mysqli_num_rows($check);

if($num>0){
    //insert new password to database
    $insert = $db->query("UPDATE user SET password = '$new_password' WHERE id = $user_id;");

    if ($insert) {

        $_SESSION['message'] = "Password has been updated successfully.";
        $_SESSION['color'] = "notify_upload_green";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();

    } else {

        $_SESSION['message'] ="Password change failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
        
    }
}else{

    $_SESSION['message'] = "Incorrect Password";
    $_SESSION['color'] = "notify_upload_red";
    header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
} 
 
}