<?php 
session_start();
ob_start();

if (isset($_SESSION['user_id'])) {
    //set our user id globally to all pages 
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = 0; 
    }

include 'C:\xampp\htdocs\Image_Sharing_Site\api\dbConfig.php';


if (isset($_SESSION['admin'])) {

}else{
    header('location: http://localhost/image_sharing_site/admin/login.php');
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
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/contact.css" />
    <!-- icons from fontawesome -->
    <script src="https://kit.fontawesome.com/28921f4de5.js" crossorigin="anonymous"></script>

</head>


<body>


    <!-- navigation section -->
    <nav class="navbar navbar-expand-md bg-light navbar-light">

        <div class="container">
            <a href="http://localhost/image_sharing_site/index.php" class="navbar-brand">
                <i class="fa-brands fa-slideshare navbar_logo"> </i>
            </a>

            <!-- menu toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- menus -->
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav">
                    <li class="navbar-items">
                        <a href="http://localhost/image_sharing_site/admin/index.php" class="nav-link">catagories</a>
                    </li>
                    <li class="navbar-items">
                        <a href="http://localhost/image_sharing_site/admin/images.php" class="nav-link">images</a>
                    </li>
                    <li class="navbar-items">
                        <a href="http://localhost/image_sharing_site/admin/users.php" class="nav-link">users</a>
                    </li>
                </ul>
            </div>
            <!-- account picture based on user login or not -->
            <label for="admin" style="margin-right: 10px;  color: red;">ADMIN </label>
            <a id="admin" href="">
                <img class="user_profile" src="http://localhost/image_sharing_site/images/admin.jpg" alt="" />
            </a>

        </div>

    </nav>

    <div class="container notify_upload pt-4 ">

        <?php
            if (isset($_SESSION['success_message'])) {
            ?>
        <p class=<?php echo $_SESSION['color']; ?>>
            <?php echo $_SESSION['success_message']; ?>
        </p>
        <?php unset($_SESSION['success_message']);
            }
            ?>

    </div>

    <div class="container">
        <form method='post' class='col-6 pt-5'>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="username" type="username" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            <div class="form-group pt-3">
                <label for="exampleInputPassword1">Discription</label>
                <input name="discription" type="text" class="form-control" id="exampleInputPassword1">
            </div>

            <button name="submit" type="submit" class="mt-3 btn btn-primary">Add Catagory</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $discription = $_POST['discription'];
                
                $INSERT = "INSERT INTO catagories (catagories, discription) VALUES('$username', '$discription')";
                mysqli_query($db, $INSERT);
                header('location: http://localhost/image_sharing_site/admin/index.php');
                ob_end_flush();
            }
            ?>

    </div>



    <div class="container pt-5">

        <ul class="list-style-none">



            <?php
                        // Get catagories from the database
                        $query = $db->query("SELECT * FROM catagories");
                
                        if ($query->num_rows > 0) {
                        $num = 1;
                        while ($row = $query->fetch_assoc()) {
                            $name = $row['catagories'];
                            $discription = $row['discription'];
                ?>

            <form method="post">
                <li class="d-flex no-block card-body justify-content-between">
                    <div class="d-flex no-block">
                        <h1 style="margin-right: 20px"><?php echo $num ?></h1>
                        <div>
                            <p class="mb-0 font-medium p-0" data-abc="true"><?php echo $name ?></p>
                            <br><span class="text-muted display-block"><?php echo $discription ?>
                            </span>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <div class="text-right">
                            <input type="submit" name="<?php echo $name ?>" class="btn btn-danger" value='Delete'>
                        </div>
                    </div>
                </li>
            </form>
            <?php
            if (isset($_POST[$name])) {
                $query2 = $db->query("DELETE FROM catagories WHERE catagories = '$name'");      
            
                header('location: http://localhost/image_sharing_site/admin/index.php');
                ob_end_flush();
            }
            ?>

            <?php $num = $num + 1;} }?>


        </ul>
    </div>








    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="text-muted">© 2022 CSE, Department</span>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.6.0.js"
                integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

            <script src="http://localhost/image_sharing_site/javascript/main.js"></script>
</body>

</html>