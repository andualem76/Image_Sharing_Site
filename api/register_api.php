<?php
session_start();
ob_start();
?>
<?php
include '../api/dbConfig.php';
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($username) || !empty($email) || !empty($password)) {

    if (mysqli_connect_error()) {
        die();
    } else {
        $INSERT = "INSERT INTO user (name,email,password) VALUES(?,?,?)";
        $stmt = $db->prepare($INSERT);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        $_SESSION['success_message'] = "You have successfully registered " . $username;
        header('location: http://localhost/image_sharing_site/index.php');
        $stmt->close();
        $db->close();
    }
} else {
    echo 'All fields required';
    die();
}