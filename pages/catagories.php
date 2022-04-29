<?php

session_start();
ob_start();
 
if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
} else{
    $user_id = 0; 
      }

include '../api/like_api.php';
include '../components/nav.php';
include '../api/dbConfig.php';

?>

<!-- catagories menu items -->
<div class="container catagories">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link disabled">Catagories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="http://localhost/image_sharing_site/index.php">
                <p class="m-0 text-success">Collections</p>
            </a>
        </li>
        <?php
            //get catagories from database
            $query = $db->query("SELECT * FROM catagories");
            
                while ($row = $query->fetch_assoc()) {
                    $catagories = $row["catagories"];
                    $discription = $row["discription"];
        ?>

        <!-- generated catagory list from database -->
        <li class="nav-item">
            <a class="nav-link <?php if ($catagories == $_SESSION['catagory']) { echo "active"; } ?>"
                aria-current="page">

                <form method="post">
                    <input type="submit" name="<?php echo $catagories ?>" class="submit_btn"
                        value=<?php echo $catagories ?>>
                </form>

                <?php
                if (isset($_POST[$catagories])) {
                //check if form was submitted
                    $_SESSION['catagory'] = $catagories;
                    $_SESSION['discription'] = $discription;
                    header('location: http://localhost/image_sharing_site/pages/catagories.php');
                    ob_end_flush();
                }
                ?>
            </a>
        </li>
        <?php } ?>

    </ul>
</div>

<!-- title and discription -->
<div class="container">
    <div class=" text-start pt-4 col-5 ">
        <h1><?php echo $_SESSION['catagory']; ?></h1>
        <p><?php echo $_SESSION['discription']; ?></p>
    </div>
</div>



<!-- view images -->
<div class="container big mt-5">

    <?php
        $catagory = $_SESSION['catagory'];

        // Get images from the database
        $query = $db->query("SELECT * FROM images WHERE catagory='$catagory' ORDER BY uploaded_on DESC");

        if ($query->num_rows > 0) {
    ?>
    <div class="images_list">
        <?php
        while ($row = $query->fetch_assoc()) {
            // set image url id and user id of image uploader
                $imageURL = '../uploads/' . $row["image_name"];
                $image_id = $row["id"];
                $user_id_inner =$row["user_id"];
        ?>

        <div class="contain">

            <!-- image to be displayed -->
            <img class="image" src="<?php echo $imageURL; ?>" alt="" />

            <!-- check if any user logged in or not -->
            <?php if(isset($_SESSION['user_id'])){ ?>

            <!-- chechk if user liked image or not -->
            <a <?php if (userLiked($image_id)): ?> class="like liked" <?php else: ?> class="like not_liked"
                <?php endif ?> data-id="<?php echo $image_id ?>">
                <i class="fa-solid fa-heart"></i>
            </a>
            <!-- like counter -->
            <span class="no_likes"><?php echo getLikes($image_id)  ?></span>

            <?php } else { ?>

            <a class="like not-liked" data-id="<?php echo $image_id ?>">
                <i class="fa-solid fa-heart"></i>
            </a>
            <!-- like counter -->
            <span class="no_likes"><?php echo getLikes($image_id)  ?></span>

            <?php } ?>

            <!-- download button -->
            <a class="down" href="<?php echo $imageURL ?>" download><i class="fa-solid fa-download"></i></a>

            <!-- user profile on image -->
            <div class="image_profile">
                <?php 
                $query2 = $db->query("SELECT * FROM user where id = $user_id_inner");

                while($row2 = $query2->fetch_assoc()){ 
                ?>
                <form action="" method="POST">
                    <!-- remove styles from button -->
                    <button style="
                            background: none;
                            color: inherit;
                            border: none;
                            padding: 0;
                            font: inherit;
                            cursor: pointer;
                            outline: inherit;
                                " name="<?php echo $row2["name"];?>">

                        <div class="block">
                            <img src="http://localhost/image_sharing_site/uploads/<?php echo $row2["profile_pic"];?>"
                                alt="">
                            <p class="pt-3"><?php echo $row2["name"];?></p>
                        </div>

                    </button>

                </form>
                <?php
                // check if user click user profile
                    if (isset($_POST[$row2["name"]])) {
                        // check if you are owner of that profile
                        if($_SESSION['user_id'] != $row2["id"]){
                           
                            $_SESSION["show_profile_id"] = $row2["id"];
                            $_SESSION["show_profile_pic"]=$row2["profile_pic"];
                            $_SESSION["show_user_name"]=$row2["name"];
                            header('location: http://localhost/image_sharing_site/pages/users_profile.php');
                        } else {

                            header('location: http://localhost/image_sharing_site/pages/profile.php');
                        }
                    }
                }
                ?>

            </div>

        </div>

        <?php } ?>
    </div>

    <?php
        } else { ?>
    <p>No image(s) found...</p>

    <?php }?>

</div>




<?php include '../components/footer.php'?>