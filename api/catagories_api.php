<?php
session_start();
?>
<?php
$_SESSION['catagory'] = $catagories;
print_r($_SESSION['catagory']);