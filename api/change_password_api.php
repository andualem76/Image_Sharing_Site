<?php
session_start();
include "../components/nav.php";
?>
<?php
// Include the database configuration file
include '../api/dbConfig.php';
$statusMsg = '';

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

if (isset($_POST["submit"])) {
  
    $user_id = $_SESSION['user_id'];
    $check = $db->query("SELECT * from user where password = '$current_password' && id = $user_id");
   
    $num = mysqli_num_rows($check);

if($num>0){
    $insert = $db->query("UPDATE user
    SET password = '$new_password'
    WHERE id = $user_id;");
    if ($insert) {
        $_SESSION['upload'] = "Password has been updated successfully.";
        $_SESSION['color'] = "notify_upload_green";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
    } else {
        $_SESSION['upload'] =" File upload failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
        

    }
}else{
    $_SESSION['upload'] = "incorrect Password";
    $_SESSION['color'] = "notify_upload_red";
    header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
}  
}