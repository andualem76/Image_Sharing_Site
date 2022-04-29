<?php
session_start();
ob_start();

include '../api/dbConfig.php';

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$profile_pic = "account_picture.png"; //default image for every user

$check = "SELECT  * FROM user WHERE email = '$email' ";
$checkresult = mysqli_query($db , $check);
$num = mysqli_num_rows($checkresult);

if($num > 0){

    $_SESSION['success_message'] = "User exists, try different email";
    $_SESSION['color'] = "notify_upload_red";
    header('location: http://localhost/image_sharing_site/pages/register.php');

}else{
    if (!empty($username) || !empty($email) || !empty($password)) {

        if (mysqli_connect_error()) {
            die();
        } else {

            $INSERT = "INSERT INTO user (name,email,password,profile_pic) VALUES('$username', '$email', '$password','$profile_pic')";
            mysqli_query($db, $INSERT);
    
            $_SESSION['success_message'] = "You have successfully registered " . $username. " Please login";
            $_SESSION['color'] = "notify_upload_green";

            header('location: http://localhost/image_sharing_site/pages/login.php');
            $stmt->close();
            $db->close();
            
        }
    } else {
        echo 'All fields required';
        die();
    }
}