<?php
session_start();
ob_start();
?>

<?php include '../components/nav.php'?>
<?php include '../api/like_api.php'?>
<?php       if (isset($_SESSION['selected_menu'])) {

}else{
    $_SESSION['selected_menu'] ="myphotos";
}
$user_id = $_SESSION["show_profile_id"];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
                <!-- begin profile -->
                <div class="profile">
                    <div class="profile-header">

                        <!-- BEGIN profile-header-content -->
                        <div class="mb-5 pb-5 pt-5 pr-5 profile-header-content">
                            <!-- BEGIN profile-header-img -->
                            <div class="profile-header-img">
                                <img class="profile-header-img"
                                    src="http://localhost/image_sharing_site/uploads/<?php echo $_SESSION['show_profile_pic']?>"
                                    alt="">
                            </div>
                            <!-- END profile-header-img -->
                            <!-- BEGIN profile-header-info -->
                            <div class="profile-header-info">
                                <h4 class="m-t-10 m-b-5"><?php echo $_SESSION['show_user_name']?></h4>
                                <p class="m-b-10">UXUI + Frontend Developer</p>
                                <a href="edit_profile.php" class="btn btn-sm btn-info mb-2">contact</a>


                            </div>
                            <!-- END profile-header-info -->



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
                    $user_id =$row["user_id"];
            if($_SESSION["selected_menu"] == "myphotos"){
            
                    $imageURL = '../uploads/' . $row["image_name"];
                    $image_id = $row["id"];
                    

            }else{
               
                    $imageid = $row['image_id'];
                    $query2 = $db->query("SELECT * FROM images where id = $imageid");
                    while ($row2 = $query2->fetch_assoc()) {
                    $imageURL = '../uploads/' . $row2["image_name"];
                    $image_id = $row2["image_id"];
                    }
            }

                   
                    ?>
            <div class="contain">
                <img class="image" src="<?php echo $imageURL; ?>" alt="" />


                <a <?php if (userLiked($image_id)): ?> class="like liked" <?php else: ?> class="like not_liked"
                    <?php endif ?> data-id="<?php echo $image_id ?>">
                    <i class="fa-solid fa-heart">

                    </i>
                </a>

                <span class="no_likes"><?php echo getLikes($image_id)  ?></span>




                <a class="down" href="<?php echo $imageURL ?>" download><i class="fa-solid fa-download"></i></a>

                <div class="image_profile">
                    <?php $query2 = $db->query("SELECT * FROM user where id = $user_id");

                while($row2 = $query2->fetch_assoc()){ ?>
                    <form action="" method="POST">

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
                            if (isset($_POST[$row2["name"]])) {
                                if($_SESSION['user_id'] != $row2["id"]){
                            //check if form was submitted
                            $_SESSION["show_profile_id"] = $row2["id"];
                                $_SESSION["show_profile_pic"]=$row2["profile_pic"];
                                $_SESSION["show_user_name"]=$row2["name"];
                                header('location: http://localhost/image_sharing_site/pages/users_profile.php');
                            }
                        else{
                            header('location: http://localhost/image_sharing_site/pages/profile.php');
                        }
                    }
                            ?>
                    <?php } ?>

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