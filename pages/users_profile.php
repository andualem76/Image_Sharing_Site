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


$user_profile_id = $_SESSION["show_profile_id"];
$user_profile_email = $_SESSION["show_user_email"]
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

                            <!-- BEGIN profile-header-info -->
                            <div class="profile-header-info">
                                <h4 class="m-t-10 m-b-5"><?php echo $_SESSION['show_user_name']?></h4>
                                <p class="m-b-10">photographer</p>

                                <form action="mailto:<?php echo $user_profile_email ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <input type="submit" class="btn btn-sm btn-info mb-2" value="Contact">

                                </form>
                            </div>

                        </div>
                        <!-- BEGIN profile-header-tab -->

                        <div class="catagories">
                            <ul class="nav nav-tabs">
                                <!-- menu list -->
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page">

                                        <form method="post">
                                            <input type="submit" name="myphotos" class=" submit_btn" value="Photos">
                                        </form>
                                    </a>
                                </li>

                            </ul>
                            <!-- END profile-header-tab -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container big mt-5">

        <?php

        $query = $db->query("SELECT * FROM images where user_id = $user_profile_id ORDER BY uploaded_on DESC ");
           
        if ($query->num_rows > 0) { 
        
        ?>

        <div class="images_list">

            <?php
                while ($row = $query->fetch_assoc()) {
                    
                    $user_id_inner =$row["user_id"];
                    $imageURL = '../uploads/' . $row["image_name"];
                    $image_id = $row["id"];
                    
                ?>

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

                <div class="image_profile">

                    <?php 
                    $query2 = $db->query("SELECT * FROM user where id = $user_id_inner");
                    while($row2 = $query2->fetch_assoc()){ 
                    ?>
                    <!-- user profile  -->

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


                </div>
            </div>

            <?php }} ?>

        </div>



        <?php
            } else {
        ?>
        <p>No image(s) found...</p>
        <?php }?>

        <div class="image_popup">
            <i class="fa-solid fa-x"></i>
            <img src="../uploads\bernd-dittrich-fIP7BUW91cc-unsplash.jpg" alt="">

        </div>
    </div>


    <?php include '../components/footer.php'?>