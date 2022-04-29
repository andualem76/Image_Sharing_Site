<?php
session_start();

include "../components/nav.php";
include '../api/dbConfig.php';

// File upload path
$targetDir = "../uploads/";

//check if file is not empty
if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {

    $user_id = $_SESSION['user_id'];
    
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    //give extension of file type
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    if (in_array($fileType, $allowTypes)) {

        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

            // Insert image file name into database
            $insert = $db->query("UPDATE user SET profile_pic = '$fileName' WHERE id = $user_id;");

            if ($insert) {
                $_SESSION['message'] = "The Image has been uploaded successfully.";
                $_SESSION['color'] = "notify_upload_green";
                $_SESSION['profile_pic'] = $fileName;

                header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
                ob_end_flush();
            } else {
                $_SESSION['message'] =" Image upload failed, please try again.";
                $_SESSION['color'] = "notify_upload_red";

                header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
                ob_end_flush();
             
            }
        } else {

            $_SESSION['message'] = "Sorry, there was an error uploading your image.";
            $_SESSION['color'] = "notify_upload_red";
            header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
            ob_end_flush();
           
        }
    } else {

        $_SESSION['message'] =  'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        $_SESSION['color'] = "notify_upload_red";
        header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
        ob_end_flush();

    }
} else {

    $_SESSION['message'] = 'Please select a image to upload.';
    $_SESSION['color'] = "notify_upload_red";
    header('location: http://localhost/image_sharing_site/pages/edit_profile.php');
    ob_end_flush();

}