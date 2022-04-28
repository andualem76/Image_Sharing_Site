<?php
session_start();
ob_start();
?>
<?php
include '../api/dbConfig.php';
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$check = "SELECT  * FROM user WHERE email = '$email' ";
$checkresult = mysqli_query($db , $check);
$num = mysqli_num_rows($checkresult);
if($num > 0){

    $_SESSION['success_message'] = "username exists";
    $_SESSION['color'] = "notify_upload_red";
    header('location: http://localhost/image_sharing_site/pages/register.php');

}else{
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
}