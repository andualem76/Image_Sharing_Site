<?php
session_start();
ob_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = 0; 
}

include '../api/like_api.php';
include '../components/nav.php';
include '../api/dbConfig.php';

if (isset($_SESSION['selected_menu'])) {

}else{
    $_SESSION['selected_menu'] ="myphotos";
}
?>
<div class="container notify_upload pt-4 ">
    <?php
        if (isset($_SESSION['message'])) {
    ?>
    <p class=<?php echo $_SESSION['color']; ?>>
        <?php echo $_SESSION['message']; ?>
    </p>

    <?php unset($_SESSION['message']);
        }
    ?>
</div>
<div class="container">
    <!--  profile and upload section-->
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
                                    src="http://localhost/image_sharing_site/uploads/<?php echo $_SESSION['profile_pic']?>"
                                    alt="">
                            </div>

                            <!-- BEGIN profile-header-info -->
                            <div class="profile-header-info">
                                <h4 class="m-t-10 m-b-5"><?php echo $_SESSION['user_name']?></h4>
                                <p class="m-b-10">Photographer</p>
                                <a href="edit_profile.php" class="btn btn-sm btn-info mb-2">Edit Profile</a>
                                <a href="http://localhost\Image_Sharing_Site\api\logout_api.php"
                                    class="btn btn-sm btn-danger mb-2">Log out</a>

                            </div>


                            <div class="container notify_upload pt-4 ">
                                <?php
                                if (isset($_SESSION['upload'])) {
                                ?>
                                <p class=<?php echo $_SESSION['color']; ?>>
                                    <?php echo $_SESSION['upload']; ?>
                                </p>
                                <?php unset($_SESSION['upload']); } ?>
                            </div>

                        </div>


                        <div class="container py-4 upfrm">

                            <p> Select Image File to Upload:</p>
                            <form action="" method="POST" enctype="multipart/form-data">

                                <input type="file" class="mb-2" name="file"><br>
                                <label for="cars" class="mb-3">Catagory:</label>
                                <select id="cars" class="mb-3" name="catagory">


                                    <?php
                                    // Get images from the database
                                    $query = $db->query("SELECT * FROM catagories");

                                    if ($query->num_rows > 0) {
                                        
                                    while ($row = $query->fetch_assoc()) {
                                    $catagories = $row["catagories"];
                                    ?>
                                    <option value="<?php echo $catagories ?>">
                                        <?php echo $catagories ?>
                                    </option>

                                    <?php } }?>

                                </select><br>
                                <input type="submit" name="submit" value="Upload Image">

                            </form>

                            <?php
                            if (isset($_POST['submit'])) {
                                include 'C:\xampp\htdocs\Image_Sharing_Site\api\upload_api.php';
                            }
                            ?>
                        </div>

                        <!-- myphotos and liked images -->
                        <div>

                            <ul class="nav nav-tabs">
                                <!-- menu section -->
                                <li class="nav-item">
                                    <a class="nav-link <?php if ("myphotos" == $_SESSION['selected_menu']) { echo "active"; } ?>"
                                        aria-current="page">

                                        <form method="post">
                                            <input type="submit" name="myphotos" class=" submit_btn" value="My Photos">

                                        </form>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link <?php if ("likedphotos" == $_SESSION['selected_menu']) { echo "active"; } ?> "
                                        aria-current="page">

                                        <form method="post">

                                            <input type="submit" name="likedphotos" class=" submit_btn"
                                                value="Liked Photos">
                                        </form>

                                    </a>
                                </li>

                                <?php
                                    if (isset($_POST["myphotos"])) {
                                
                                                $_SESSION['selected_menu'] = "myphotos";
                                                header('location: http://localhost/image_sharing_site/pages/profile.php');
                                                ob_end_flush();
                                        }
                                    if (isset($_POST["likedphotos"])) {
                                                
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
                // Get images from the database
        if($_SESSION["selected_menu"] == "myphotos"){
                    $query = $db->query("SELECT * FROM images where user_id = $user_id ORDER BY uploaded_on DESC ");
                }else{
                    $query = $db->query("SELECT * FROM liked_images where user_id = $user_id");
                }
                
        if ($query->num_rows > 0) {
                ?>

        <?php
            if($_SESSION["selected_menu"] == "myphotos"){
                $num = 1;
        ?>
        <div class="container ">
            <div class="mt-5">
                <ul class="list-style-none">
                    <form method="post">
                        <?php
                while ($row = $query->fetch_assoc()) {
                    $image_id = $row['id'];
                    $imageURL = '../uploads/' . $row["image_name"];
                    $catagory = $row['catagory'];
                    $image_name = $row['image_name'];
                    $upload_date = $row['uploaded_on']
                ?>

                        <li class="d-flex no-block card-body justify-content-between">
                            <div class="d-flex no-block">
                                <h1 style="margin-right: 20px"><?php echo $num ?></h1>
                                <img class="admin_image mx-3" src="<?php echo $imageURL?>" alt="">
                                <div> <a href="#" class="m-b-0 font-medium p-0"
                                        data-abc="true"><?php echo $image_name ?></a>
                                    <br><span class="text-muted display-block"><?php echo $catagory ?>
                                    </span><br><span class="text-muted display-block"><?php echo $upload_date ?>
                                    </span>
                                </div>
                            </div>
                            <div class="ml-auto">

                                <a class="btn btn-primary" href="<?php echo $imageURL ?>" download>Download</a>


                                <input type="submit" name="<?php echo $image_id ?>" class="btn btn-danger"
                                    value='Delete'>

                            </div>
                        </li>

                        <?php
                      $num = $num + 1;
                      }
                    ?>
                    </form>



                    <?php
                        if (isset($_POST[$image_id])) {
            
                            $query2 = $db->query("DELETE FROM images WHERE id = $image_id");
                            header('location: http://localhost/image_sharing_site/pages/profile.php');
                            ob_end_flush();
                        }
            
                      
                    ?>
                </ul>
            </div>
        </div>



        <?php


            }else{

                while ($row = $query->fetch_assoc()) {
                
                $user_id_inner =$row["user_id"];
                $image_id = $row['image_id'];
                $query2 = $db->query("SELECT * FROM images where id = $image_id");
                
                while ($row2 = $query2->fetch_assoc()) {
                $imageURL = '../uploads/' . $row2["image_name"];
                }
        
            ?>
        <div class="images_list mt-3">
            <!-- image list -->
            <div class="contain">
                <img class="image" src="<?php echo $imageURL; ?>" alt="" />
                <!-- like button -->
                <a <?php if (userLiked($image_id)): ?> class="like liked" <?php else: ?> class="like not_liked"
                    <?php endif ?> data-id="<?php echo $image_id ?>">
                    <i class="fa-solid fa-heart"> </i>
                </a>

                <span class="no_likes"><?php echo getLikes($image_id)  ?></span>

                <!-- download button -->
                <a class="down" href="<?php echo $imageURL ?>" download><i class="fa-solid fa-download"></i></a>

                <!-- profile section -->
                <div class="image_profile">
                    <?php $query2 = $db->query("SELECT * FROM user where id = $user_id_inner");

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
                                } ?>

                </div>

            </div>



        </div>

        <?php

        }
    }
                
        }else{ ?>

        <p>No image(s) found...</p>

        <?php } ?>


    </div>

</div>

<?php include '../components/footer.php'?>