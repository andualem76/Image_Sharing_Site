<?php
session_start();
ob_start();

include '../api/dbConfig.php';

$email = $_POST['email'];
$password = $_POST['password'];

// check if user credential is correct
$check = "SELECT  * FROM user WHERE email = '$email' && password = '$password'";
$checkresult = mysqli_query($db , $check);

$result = mysqli_fetch_array($checkresult);
$num = mysqli_num_rows($checkresult);


if($num > 0){

    $_SESSION['user_id'] = $result['id'];
    $_SESSION['user_name'] = $result['name'];
    $_SESSION['user_email'] = $result['email'];
    $_SESSION['profile_pic'] = $result['profile_pic'];

    $_SESSION['color'] = "notify_upload_green";
    $_SESSION['success_message'] = "Welcome " .$result['name'];

    header('location: http://localhost/image_sharing_site/index.php');
    $db->close();

}else{
    
    $_SESSION['success_message'] = "Wrong email or password";
    $_SESSION['color'] = "notify_upload_red";

    header('location: http://localhost/image_sharing_site/pages/login.php');
}