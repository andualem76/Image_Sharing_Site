<?php
session_start();
ob_start();
?>
<?php include 'components/nav.php'?>

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
// Include the database configuration file
include 'api/dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM catagories");

if ($query->num_rows > 0) {
    ?>


        <?php
while ($row = $query->fetch_assoc()) {
        $catagories = $row["catagories"];
        ?>

        <li class="nav-item">
            <a class="nav-link
            
            " aria-current="page">
                <form method="post">
                    <input type="submit" name="<?php echo $catagories ?>" class=" submit_btn"
                        value=<?php echo $catagories ?>>
                </form>
                <?php
if (isset($_POST[$catagories])) {
//check if form was submitted
            $_SESSION['catagory'] = $catagories;
            header('location: http://localhost/image_sharing_site/pages/catagories.php');
            ob_end_flush();
        }
        ?>
            </a>

        </li>

        <?php }?>

        <?php
} else {}?>


    </ul>
</div>


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


<div class="container home-contain">
    <?php
// Include the database configuration file
include 'api/dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $imageURL = 'uploads/' . $row["image_name"];
        $likes = $row["no_likes"];?>
    <img class="img-fluid home_image" src="<?php echo $imageURL; ?>" alt="" />
    <?php
break;
    }?><?php
} else {?>
    <img class="img-fluid home_image" src="uploads/Home.jpg" alt="" />
    <?php }?>
    <div class="container title">
        <h1>Unslash</h1>
        <h2>Download any image</h2>
        <div class="search_contain">
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
// Include the database configuration file
include 'api/dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if ($query->num_rows > 0) {
    ?><div class="images_list"><?php
while ($row = $query->fetch_assoc()) {
        $imageURL = 'uploads/' . $row["image_name"];
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

                <a href="pages/profile.php">
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


<?php include 'components/footer.php'?>