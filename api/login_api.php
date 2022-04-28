<?php
session_start();
ob_start();
?>
<?php
include '../api/dbConfig.php';

$email = $_POST['email'];
$password = $_POST['password'];

$check = "SELECT  * FROM user WHERE email = '$email' && password = '$password'";
$checkresult = mysqli_query($db , $check);

$result = mysqli_fetch_array($checkresult);
$num = mysqli_num_rows($checkresult);


if($num > 0){
    $_SESSION['user_id'] = $result['id'];
    $_SESSION['user_name'] = $result['name'];
    $_SESSION['color'] = "notify_upload_green";
    $_SESSION['success_message'] = "welcome " .$result['name'];
    header('location: http://localhost/image_sharing_site/index.php');
    
    $db->close();
}else{

}