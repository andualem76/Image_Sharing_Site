<?php
session_start();
include "../components/nav.php"?>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="profile-header-img mt-5"
                    src="http://localhost/image_sharing_site/uploads/<?php echo $_SESSION['profile_pic']?>"><span
                    class=" mt-2 font-weight-bold"><?php echo $_SESSION["user_name"]?></span><span
                    class="text-black-50"><?php echo $_SESSION["user_email"]?></span><span>
                </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="http://localhost\Image_Sharing_Site\api\change_name_api.php" method="POST"
                    enctype="multipart/form-data">

                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label><input type="text" name='name'
                                class="form-control" placeholder="<?php echo $_SESSION["user_name"]?>" value=""></div>
                    </div>

                    <div class="mt-2 text-end"><input type="submit" class="btn btn-success" name="submit"
                            value="Change Name">
                    </div>
                </form>
                <form action="http://localhost\Image_Sharing_Site\api\profile_pic.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="row mt-3">

                        <p> Change profile picture:</p>

                        <input type="file" class="mb-2" name="file">

                        <div class="mt-2 text-end"><input type="submit" class="btn btn-success" name="submit"
                                value="Update Profile Picture">
                        </div>

                    </div>
                </form>
                <form action="profile_pic.php" method="POST" enctype="multipart/form-data">

                    <div class="row mt-3">
                        <div>
                            <div class="col-md-6"><label class="labels">Current password</label><input type="text"
                                    class="form-control" placeholder="Current password" value=""></div>


                            <div class="col-md-6"><label class="labels">New Password</label><input type="text"
                                    class="form-control" placeholder="New Password" value=""></div>
                        </div>

                        <div class="mt-1 text-end"><input type="submit" class="btn btn-warning " name="submit"
                                value="Change Password">
                        </div>
                    </div>
                </form>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-5 text-start"><input type="submit" class="btn btn-danger " name="submit"
                            value="Delete account">
                    </div>

                    <label class="mt-3">Can not revert this</label>



                </form>



            </div>

        </div>
    </div>
</div>
</div>
<?php include "../components/footer.php"?>