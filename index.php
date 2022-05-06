<?php
session_start();
ob_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = 0; 
}

include 'api/like_api.php';
include 'components/nav.php';
include 'api/dbConfig.php';
?>

<div class="container catagories">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link disabled">Catagories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page"
                href="http://localhost/image_sharing_site/index.php">Collections</a>
        </li>
        <?php

            // Get images from the database
            $query = $db->query("SELECT * FROM catagories");
            if ($query->num_rows > 0) {

            while ($row = $query->fetch_assoc()) {
                $catagories = $row["catagories"];
                $discription = $row["discription"];
        ?>

        <li class="nav-item">
            <a class="nav-link" aria-current="page">
                <form method="post">
                    <input type="submit" name="<?php echo $catagories ?>" class=" submit_btn"
                        value=<?php echo $catagories ?>>
                </form>
                <?php
            if (isset($_POST[$catagories])) {
                        
                $_SESSION['catagory'] = $catagories;
                $_SESSION['discription'] = $discription;
                header('location: http://localhost/image_sharing_site/pages/catagories.php');
                ob_end_flush();
            }
            ?>
            </a>
        </li>

        <?php }?>

        <?php
        } else {
            
        }?>

    </ul>
</div>

<!-- success message -->
<div class="container notify_upload pt-4 ">
    <?php
        if (isset($_SESSION['success_message'])) {
    ?>
    <p class=<?php echo $_SESSION['color']; ?>>
        <?php
    echo $_SESSION['success_message'];
    ?>
    </p>
    <?php unset($_SESSION['success_message']);
        }
    ?>
</div>

<!-- home image -->
<div class="container home-contain">
    <?php
        // Get images from the database
        $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $imageURL = 'uploads/' . $row["image_name"];
    ?>

    <img class="img-fluid home_image" src="<?php echo $imageURL; ?>" alt="" />

    <?php
        break;
        } } else { ?>

    <img class="img-fluid home_image" src="uploads/Home.jpg" alt="" />
    <?php } ?>

    <!-- intro title -->
    <div class="container title">
        <h1>Image Sharing</h1>
        <h2>Download any image</h2>
        <div class="mt-3 search_contain">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search any image"
                    aria-describedby="button-addon2" />
                <button class="btn btn-success" type="button" id="button-addon2">
                    Search
                </button>
            </div>
        </div>
    </div>

</div>


<div class="py-5 container">
    <h2>Browse Uploaded image</h2>
</div>

<div class=" container big">

    <?php
        // Get images from the database
        $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
        if ($query->num_rows > 0) {
    ?>

    <div class="images_list">
        <?php
        while ($row = $query->fetch_assoc()) {

                $imageURL = 'uploads/' . $row["image_name"];
                $image_id = $row["id"];
                $user_id_inner =$row["user_id"];
        ?>

        <div class="contain">

            <img class="image new" src="<?php echo $imageURL; ?>" alt="" />

            <!-- like button -->
            <?php if(isset($_SESSION['user_id'])){ ?>

            <a <?php if (userLiked($image_id)): ?> class="like liked" <?php else: ?> class="like not_liked"
                <?php endif ?> data-id="<?php echo $image_id ?>">
                <i class="fa-solid fa-heart"> </i>
            </a>

            <span class="no_likes"><?php echo getLikes($image_id)  ?></span>

            <?php } 
            else{ 
            ?>
            <a class="like not-liked" data-id="<?php echo $image_id ?>">
                <i class="fa-solid fa-heart">

                </i>
            </a>

            <span class="no_likes"><?php echo getLikes($image_id)  ?></span>
            <?php
                }
            ?>


            <!-- download button -->
            <a class="down" href="<?php echo $imageURL ?>" download><i class="fa-solid fa-download"></i></a>

            <!-- image profile -->
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
                            $_SESSION["show_profile_id"] = $row2["id"];
                            $_SESSION["show_profile_pic"]=$row2["profile_pic"];
                            $_SESSION["show_user_name"]=$row2["name"];
                            header('location: http://localhost/image_sharing_site/pages/users_profile.php');
                    }
                    else{
                        header('location: http://localhost/image_sharing_site/pages/profile.php');
                    }
                    }
                    }
                ?>

            </div>

        </div>

        <?php }?>
    </div>

    <?php
            } else {
        ?>
    <p>No image(s) found...</p>

    <?php }?>
</div>


<?php include 'components/footer.php'?>