<?php
session_start();
ob_start();
?>

<?php include '../components/nav.php'?>

<?php       if (isset($_SESSION['selected_menu'])) {

}else{
    $_SESSION['selected_menu'] ="myphotos";
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
                <!-- begin profile -->
                <div class="profile">
                    <div class="profile-header">

                        <!-- BEGIN profile-header-content -->
                        <div class="pb-3 pt-5 pr-5 profile-header-content">
                            <!-- BEGIN profile-header-img -->
                            <div class="profile-header-img">
                                <img class="profile-header-img"
                                    src="http://localhost/image_sharing_site/account_picture.png" alt="">
                            </div>
                            <!-- END profile-header-img -->
                            <!-- BEGIN profile-header-info -->
                            <div class="profile-header-info">
                                <h4 class="m-t-10 m-b-5">Sean Ngu</h4>
                                <p class="m-b-10">UXUI + Frontend Developer</p>
                                <a href="edit_profile.php" class="btn btn-sm btn-info mb-2">Edit Profile</a>
                            </div>
                            <!-- END profile-header-info -->

                            <div class="container notify_upload pt-4 ">
                                <?php
                                        if (isset($_SESSION['upload'])) {
                                            ?>
                                <p class=<?php echo $_SESSION['color']; ?>>
                                    <?php
                                        echo $_SESSION['upload'];
                                            ?>
                                </p>
                                <?php unset($_SESSION['upload']);
                                        }
                                        ?>
                            </div>

                        </div>





                        <div class="container py-4 upfrm">

                            <p> Select Image File to Upload:</p>
                            <form action="" method="POST" enctype="multipart/form-data">

                                <input type="file" class="mb-2" name="file"><br>
                                <label for="cars" class="mb-3">Catagory:</label>
                                <select id="cars" class="mb-3" name="catagory">


                                    <?php
            // Include the database configuration file
            include '../api/dbConfig.php';

            // Get images from the database
            $query = $db->query("SELECT * FROM catagories");

            if ($query->num_rows > 0) {
           
        while ($row = $query->fetch_assoc()) {
        $catagories = $row["catagories"];
        ?>

                                    <option value="<?php echo $catagories ?>">
                                        <?php echo $catagories ?>
                                    </option>

                                    <?php
     
    } }?>

                                </select><br>

                                <input type="submit" name="submit" value="Upload Image">
                            </form>
                            <?php
                            if (isset($_POST['submit'])) {
                            //check if form was submitted

                                include 'upload.php';
                            }
                            ?>
                        </div>

                        <!-- END profile-header-content -->
                        <!-- BEGIN profile-header-tab -->
                        <div>

                            <ui class="nav nav-tabs">

                                <li class="nav-item">
                                    <a class="nav-link
                                    <?php
            if ("myphotos" == $_SESSION['selected_menu']) {
                        echo "active";
                    }
                    ?>
                                " aria-current="page">
                                        <form method="post">
                                            <input type="submit" name="myphotos" class=" submit_btn" value="My Photos">

                                        </form>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link
                                    <?php
            if ("likedphotos" == $_SESSION['selected_menu']) {
                        echo "active";
                    }
                    ?>
                                " aria-current="page">
                                        <form method="post">

                                            <input type="submit" name="likedphotos" class=" submit_btn"
                                                value="Liked Photos">
                                        </form>

                                    </a>
                                </li>

                                <?php
                                    if (isset($_POST["myphotos"])) {
                                    //check if form was submitted
                                                $_SESSION['selected_menu'] = "myphotos";
                                                header('location: http://localhost/image_sharing_site/pages/profile.php');
                                                ob_end_flush();
                                            }
                                            if (isset($_POST["likedphotos"])) {
                                                //check if form was submitted
                                                            $_SESSION['selected_menu'] = "likedphotos";
                                                            header('location: http://localhost/image_sharing_site/pages/profile.php');
                                                            ob_end_flush();
                                                        }
                                            ?>





                                </ul>
                                <!-- END profile-header-tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container big pt-3">

        <?php

            // Include the database configuration file
            include '../api/dbConfig.php';

            // Get images from the database
            if($_SESSION["selected_menu"] == "myphotos"){
            $query = $db->query("SELECT * FROM images where user_id = $user_id ORDER BY uploaded_on DESC ");
            }else{
            $query = $db->query("SELECT * FROM liked_images where user_id = $user_id");
           
            }
            if ($query->num_rows > 0) {
                ?><div class="images_list"><?php

                while ($row = $query->fetch_assoc()) {

            if($_SESSION["selected_menu"] == "myphotos"){
            
                    $imageURL = '../uploads/' . $row["image_name"];

            }else{
               
                    $imageid = $row['image_id'];
                    $query2 = $db->query("SELECT * FROM images where id = $imageid");
                    while ($row2 = $query2->fetch_assoc()) {
                    $imageURL = '../uploads/' . $row2["image_name"];
                    }
            }

                   
                    ?>
            <div class="contain">
                <img class="image" src="<?php echo $imageURL; ?>" alt="" />

                <a id="like" class="like liked"><i class="fa-solid fa-heart"></i></a>





                <a class="down" href="<?php echo $imageURL ?>" download><i class="fa-solid fa-download"></i></a>

                <div class="image_profile">

                    <a href="profile.php">
                        <div class="block">
                            <img src="http://localhost/image_sharing_site/account_picture.png" alt="">
                            <p class="pt-3">uploader name</p>
                        </div>
                    </a>
                </div>
            </div>

            <?php }?>


        </div>
        <?php
    } else {?>
        <p>No image(s) found...</p>
        <?php }?>
    </div>


    <?php include '../components/footer.php'?>