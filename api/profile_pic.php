<?php
session_start();
include "../components/nav.php";
?>
<?php
// Include the database configuration file
include '../api/dbConfig.php';
$statusMsg = '';


// File upload path
$targetDir = "../uploads/";

if (isset($_POST["submit"])) {
    if(empty($_FILES["file"]["name"])){
        $fileName = $_SESSION['profile_pic'];
    }else{
        $fileName = basename($_FILES["file"]["name"]);
    }
    $user_id = $_SESSION['user_id'];
 
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $insert = $db->query("UPDATE user
            SET profile_pic = '$fileName'
            WHERE id = $user_id;");
            if ($insert) {
                $_SESSION['upload'] = "The file " . $fileName . " has been uploaded successfully.";
                $_SESSION['color'] = "notify_upload_green";
                $_SESSION['profile_pic'] = $fileName;
                $_SESSION['user_name'] = $name;
                header('location: http://localhost/image_sharing_site/pages/profile.php');
                ob_end_flush();
            } else {
                $_SESSION['upload'] =" File upload failed, please try again.";
                $_SESSION['color'] = "notify_upload_red";
                header('location: http://localhost/image_sharing_site/pages/profile.php');
                ob_end_flush();
             

            }
        } else {
            $_SESSION['upload'] = "Sorry, there was an error uploading your file.";
            $_SESSION['color'] = "notify_upload_red";
            header('location: http://localhost/image_sharing_site/pages/profile.php');
            ob_end_flush();
           
        }
    } else {
        $_SESSION['upload'] =  'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/profile.php');
        ob_end_flush();
    }
} 