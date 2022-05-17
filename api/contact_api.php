<?php
session_start();
include "dbConfig.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
echo $message;

if (isset($_POST["submit"])) {
    //delete user from database
    
    $insert = $db->query("INSERT INTO contact (name,email,message) VALUES('$name','$email','$message')");
 
    if ($insert) {

        $_SESSION['success_message'] = "message has been sent successfully.";
        $_SESSION['color'] = "notify_upload_green";

        header('location: http://localhost/image_sharing_site/pages/contact.php');
        ob_end_flush();

    } else {

        $_SESSION['success_message'] =" process failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/contact.php');
        ob_end_flush();
        
    }
        
}
?>