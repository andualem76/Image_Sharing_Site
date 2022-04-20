<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/28921f4de5.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="upfrm">
        <?php
        if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <p> Select Image File to Upload:</p>
        <form action="" method="POST" enctype="multipart/form-data">

            <input type="file" name="file">
            <input type="submit" name="submit">
        </form>
        <?php
            if(isset($_POST['submit']))
                { 
                    //check if form was submitted
                    include('upload.php');
                }       
?>
        <h2>Uploaded image</h2>
        <div class="big">

            <?php
// Include the database configuration file
include 'dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    ?><div class="images_list"><?php
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
        $liked = $row["status"];
?>
                <div class="contain">
                    <img class="image" src="<?php echo $imageURL; ?>" alt="" />
                    <?php
                    if($liked == 1){
                        ?>
                    <a id="like" class="like liked"><i class="fa-solid fa-heart"></i></a>
                    <?php
                    }else{
                        ?>
                    <a id="like" class="like"><i class="fa-solid fa-heart"></i>

                    </a>
                    <?php
                    }
                    ?>
                    <p class="no_likes">0</p>

                    <a class="down" href="<?php echo $imageURL?>" download><i class="fa-solid fa-download"></i></a>

                    <div class="image_profile">
                        <div class="block">
                            <img src="index2.jpg" alt="">
                            <p>uploader name</p>
                        </div>
                    </div>
                </div>

                <?php }?>
            </div>
            <?php
}else{ ?>
            <p>No image(s) found...</p>
            <?php } ?>
        </div>
</body>

</html>