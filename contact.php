<?php 

    date_default_timezone_set("Asia/Calcutta");

    require_once("header.php");
    connect_db();
    $error_message="";
    $error_count=0;
    $success_message="";
    $request_date = date('Y-m-d');
    $request_time = date('h:i:s');
    $request_date_time = $request_date ." ".$request_time;


    if(isset($_POST['contact-form-submit'])){
        $valid=1;
   
        if(empty($_POST['request_user_name'])){
          $error_message="Name should not be empty";
          $error_count++;
          $valid=0;
        }

        if(empty($_POST['request_user_email'])){
            $error_message="Email should not be empty";
            $error_count++;
            $valid=0;
        }

        if(empty($_POST['request_user_pno'])){
            $error_message="Mobile No should not be empty";
            $error_count++;
            $valid=0;
        }

        if(empty($_POST['request_user_address'])){
            $error_message="Address should not be empty";
            $error_count++;
            $valid=0;
        }

        if(empty($_POST['request_user_subject'])){
            $error_message="Subject should not be empty";
            $error_count++;
            $valid=0;
        }
        if(empty($_POST['request_user_message'])){
            $error_message="Message should not be empty";
            $error_count++;
            $valid=0;
        }

        if($valid==1){

            $statement=$con->prepare("INSERT INTO tbl_request_from_users(request_user_name,request_user_email,request_user_pno,request_user_address,request_user_subject,request_user_message,request_date_time,request_status) VALUES(?,?,?,?,?,?,?,?)");

            $statement->execute(array($_POST['request_user_name'],$_POST['request_user_email'],$_POST['request_user_pno'],$_POST['request_user_address'],$_POST['request_user_subject'],$_POST['request_user_message'],$request_date_time,"Inactive"));
            
            $success_message = 'Your Response has been recorded ......';

        }

    }
  
?>


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5" style="background:url(img/2.jpg);">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Contact Us</h1>
                    <a href="" class="text-white btn py-md-3 px-md-5 me-3" style="background-color:rgb(48,60,84);">Home</a>
                    <a href="" class="btn btn-secondary py-md-3 px-md-5">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase">Contact Us</h6>
                <h1 class="display-5">Please Feel Free To Contact Us</h1>
            </div>
            <div class="row g-0">
                <div class="col-lg-7">
                    <div class="h-100 p-5" style="background-color:rgb(48,60,84);">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-3">

                                <div class="col-6">
                                    <input type="text" name="request_user_name" class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;">
                                </div>

                                <div class="col-6">
                                    <input type="email" name="request_user_email" class="form-control bg-light border-0 px-4" placeholder="Your Email" style="height: 55px;">
                                </div> 
                                
                                <div class="col-6">
                                    <input type="text" name="request_user_pno" class="form-control bg-light border-0 px-4" placeholder="Your Mobile No" style="height: 55px;">
                                </div>

                                <div class="col-6">
                                    <input type="text" name="request_user_address" class="form-control bg-light border-0 px-4" placeholder="Your Address" style="height: 55px;">
                                </div>

                                <div class="col-12">
                                    <input type="text" name="request_user_subject" class="form-control bg-light border-0 px-4" placeholder="Subject" style="height: 55px;">
                                </div>

                                <div class="col-12">
                                    <textarea name="request_user_message" class="form-control bg-light border-0 px-4 py-3" rows="2" placeholder="Message"></textarea>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" name="contact-form-submit" type="submit">Send Message</button>
                                </div>
                                    <?php if ($error_message) : ?>
                                        <div class="text-white fs-4 " >

                                            <p>
                                            <?php echo $error_message; ?>
                                            </p>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ($success_message) : ?>
                                        <div class="text-white fs-4 " >

                                            <p><?php echo $success_message; ?></p>
                                        </div>
                                    <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 bg-dairy">
                    <div class="bg-secondary h-100 p-5">
                        <h2 class="text-white mb-4">Get In Touch</h2>
                        <div class="d-flex mb-4">
                            <div class=" rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;background-color:rgb(48,60,84);">
                                <i class="bi bi-geo-alt fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Our Office</h5>
                                <span class="text-white">123 Street, New York, USA</span>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;background-color:rgb(48,60,84);">
                                <i class="bi bi-envelope-open fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Email Us</h5>
                                <span class="text-white">info@example.com</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;background-color:rgb(48,60,84);">
                                <i class="bi bi-phone-vibrate fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Call Us</h5>
                                <span class="text-white">+012 345 6789</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <?php require_once("footer.php");?>
