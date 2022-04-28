<?php
session_start();
include "../components/nav.php";
?>
<?php
// Include the database configuration file
include '../api/dbConfig.php';
$statusMsg = '';


if (isset($_POST["submit"])) {
  
    $user_id = $_SESSION['user_id'];
    $insert = $db->query("DELETE FROM user WHERE id = $user_id;");
    if ($insert) {
        $_SESSION['upload'] = "User has been Deleted successfully.";
        $_SESSION['color'] = "notify_upload_green";
        session_destroy();
        header('location: http://localhost/image_sharing_site/index.php');
        ob_end_flush();
    } else {
        $_SESSION['upload'] =" Delete failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();
        

    }
        
}