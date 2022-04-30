<?php include '../components/nav.php'?>
<div class="container d-flex justify-content-center">
    <div class="row mt-5 py-3 mb-3 mx-2">
        <!--col-->
        <div class="col-6">
            <h2 class="form-title">Contact us</h2>
            <p class="justify text-muted">Have an enquiry or would like to give us feedback?<br>Fill out the form below
                to contact our team.</p>
            <form>
                <div class="form-group pt-2 pl-1"> <label for="exampleInputName">Your name</label> <input type="text"
                        class="form-control mb-3" id="exampleInputName"> </div>
                <div class="form-group pl-1"> <label for="exampleInputEmail1">Your email address</label> <input
                        type="email" class="form-control mb-3" id="exampleInputEmail1"> </div>
                <div class="form-group pl-1"> <label for="exampleFormControlTextarea1">Your message</label> <textarea
                        class="form-control mb-3" id="exampleFormControlTextarea1" rows="5"></textarea> </div>
                <div class="row">
                    <div class="col-md-3 offset-md-9"><button type="submit" class="btn btn-success w-100">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <!--col-->
        <div class="col-6 img_contact "> <img class="w-100"
                src="http://localhost\Image_Sharing_Site\images\contact2.jpg" alt="IMG">
        </div>



    </div>
    <!--row-->
</div>
<?php include '../components/footer.php'?>