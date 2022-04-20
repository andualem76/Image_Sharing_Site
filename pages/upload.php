<?php

// Include the database configuration file
include '../api/dbConfig.php';
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $insert = $db->query("INSERT into images (image_name, uploaded_on) VALUES ('" . $fileName . "', NOW() )");
            if ($insert) {
                $_SESSION['upload'] = "The file " . $fileName . " has been uploaded successfully.";
                header('location: http://localhost/image_sharing_site/pages/profile.php');
                ob_end_flush();
            } else {

                $_SESSION['upload'] = "File upload failed, please try again.";

            }
        } else {

            $_SESSION['upload'] = "Sorry, there was an error uploading your file.";
            header('location: http://localhost/image_sharing_site/profile.php');
        }
    } else {

        $_SESSION['upload'] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        header('location: http://localhost/image_sharing_site/profile.php');
    }
} else {

    $_SESSION['upload'] = 'Please select a file to upload.';
    header('location: http://localhost/image_sharing_site/profile.php');
}