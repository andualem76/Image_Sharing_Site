<?php
session_start();
ob_start();
?>
<?php include '../components/nav.php'?>

<div class="container catagories">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link disabled">Catagories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="http://localhost/image_sharing_site/index.php">Collections</a>
        </li>
        <?php
// Include the database configuration file
include '../api/dbConfig.php';

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
            <?php
if ($catagories == $_SESSION['catagory']) {
            echo "active";
        }
        ?>
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


<div class="container">
    <div class=" text-start pt-4 col-5 ">
        <h1><?php echo $_SESSION['catagory'] ?></h1>
        <p>Let’s celebrate the magic of Mother Earth — with images of everything our planet has to offer, from stunning
            seascapes, starry skies, and everything in between. </p>
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