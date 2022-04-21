<?php
session_start();
ob_start();
?>
<?php include '../components/nav.php'?>
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

                                <input type="file" name="file">
                                <input type="submit" name="submit">
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
                        <ul class="profile-header-tab nav nav-tabs">
                            <li class="nav-item"><a href="#profile-post" class="nav-link active show"
                                    data-toggle="tab">MY PHOTOS</a></li>
                            <li class="nav-item"><a href="#profile-about" class="nav-link" data-toggle="tab">LIKED
                                    PHOTOS</a>
                            </li>

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
            $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

            if ($query->num_rows > 0) {
                ?><div class="images_list"><?php
            while ($row = $query->fetch_assoc()) {
                    $imageURL = '../uploads/' . $row["image_name"];
                    $likes = $row["no_likes"];
                    ?>
        <div class="contain">
            <img class="image" src="<?php echo $imageURL; ?>" alt="" />
            <?php
            if ($likes > 0) {
                        ?>
            <a id="like" class="like liked"><i class="fa-solid fa-heart"></i></a>
            <?php
            } else {
                        ?>
            <a id="like" class="like"><i class="fa-solid fa-heart"></i>

            </a>
            <?php
            }
                    ?>

            <p class="no_likes"><?php echo $likes ?></p>

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