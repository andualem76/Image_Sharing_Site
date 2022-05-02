<?php
 session_start();
include 'C:\xampp\htdocs\Image_Sharing_Site\api\dbConfig.php';

$username = $_POST['username'];
$password = $_POST['password'];

// check if user credential is correct
$check = "SELECT  * FROM admin WHERE username = '$username' && password = '$password'";
$checkresult = mysqli_query($db , $check);

$result = mysqli_fetch_array($checkresult);
$num = mysqli_num_rows($checkresult);


if($num > 0){
    $_SESSION['admin'] = "admin";
    $_SESSION['color'] = "notify_upload_green";
    $_SESSION['success_message'] = "Welcome Admin";

    header('location: http://localhost/image_sharing_site/admin/index.php');
    $db->close();

}else{
    
    $_SESSION['success_message'] = "Wrong email or password";
    $_SESSION['color'] = "notify_upload_red";

    header('location: http://localhost/image_sharing_site/admin/login.php');
}


?>