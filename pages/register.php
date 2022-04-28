<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="http://localhost/image_sharing_site/css/images_style.css" />
    <script src="https://kit.fontawesome.com/28921f4de5.js" crossorigin="anonymous"></script>
</head>

<body>

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
    <section class="vh-100">


        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                            <p class="text-start h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                            <form class="mx-1 mx-md-4" method="POST"
                                action="http://localhost\Image_Sharing_Site\api\register_api.php">

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example1c">Your Name</label>
                                        <input type="text" id="form3Example1c" class="form-control" name="name" />

                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4 ">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example3c">Your Email</label>
                                        <input type="email" id="form3Example3c" class="form-control" name="email" />

                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4 py-3">
                                    <i class="fa-solid fa-cake-candles fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" id="birthday" name="birthday">
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example4c">Password</label>
                                        <input type="password" id="form3Example4c" class="form-control"
                                            name="password" />

                                    </div>
                                </div>




                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                </div>
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <a href="login.php" class="forgot-link float-right text-primary">I have account,
                                        Login</a>
                                </div>
                            </form>


                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                            <img src="../register.png" class="img-fluid" alt="">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>