<?php 

if (isset($_SESSION['user_id'])) {
    
$user_id = $_SESSION['user_id'];

                    }else{
                        $user_id = 0; 
                    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Sharing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/nav_styles.css" />
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/images_style.css" />
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/profile.css" />
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/edit_profile.css" />
    <script src="https://kit.fontawesome.com/28921f4de5.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <a href="http://localhost/image_sharing_site/index.php" class="navbar-brand"><i
                    class="fa-brands fa-slideshare navbar_logo"></i></a>
            <div class="search-input">
                <form class="d-flex">
                    <input class="form-control me-lg-1" type="search" placeholder="Search" aria-label="Search" />

                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="navbar-items">
                        <a href="" class="nav-link">Home</a>
                    </li>
                    <li class="navbar-items">
                        <a href="pages/login.php" class="nav-link">About</a>
                    </li>
                    <li class="navbar-items">
                        <a href="" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
            <?php
            if (isset($_SESSION['user_id'])){
                ?>
            <a href="http://localhost/image_sharing_site/pages/profile.php"><img class="user_profile"
                    src="http://localhost/image_sharing_site/account_picture.png" alt="" /></a>
            <?php
            }else{
                ?>
            <a href="http://localhost/image_sharing_site/pages/login.php"><button type="button"
                    class="btn btn-outline-success">LOGIN</button></a>
            <?php
            }
            ?>


        </div>
    </nav>