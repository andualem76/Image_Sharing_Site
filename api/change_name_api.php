<?php
session_start();
include "../components/nav.php";
?>
<?php
// Include the database configuration file
include '../api/dbConfig.php';
$statusMsg = '';

$name = $_POST['name'];

if (isset($_POST["submit"])) {
  
    $user_id = $_SESSION['user_id'];
    $insert = $db->query("UPDATE user
    SET name = '$name'
    WHERE id = $user_id;");
    if ($insert) {
        $_SESSION['upload'] = "Name has been updated successfully.";
        $_SESSION['color'] = "notify_upload_green";
        $_SESSION['user_name'] = $name;
        header('location: http://localhost/image_sharing_site/pages/profile.php');
        ob_end_flush();
    } else {
        $_SESSION['upload'] =" File upload failed, please try again.";
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/profile.php');
        ob_end_flush();
        

    }
        
}