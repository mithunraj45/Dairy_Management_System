<?php 
  require_once("connection.php");
  $today=date('Y-m-d');
  $bg_color=array("--cui-card-cap-bg:rgb(90,185,193)","--cui-card-cap-bg:rgb(200,220,100)","--cui-card-cap-bg:rgb(60,60,60)","--cui-card-cap-bg:rgb(136,136,136)","--cui-card-cap-bg:rgb(71,122,169)","--cui-card-cap-bg:rgb(48,60,84)");

  connect_db();

  $error_message="";
  $success_message="";

  if (isset($_POST['submit_report'])) {
    $valid=1;

    if(empty($_POST['reporter_name'])){
      $valid=0;
      $error_message = "Name cannot be empty...";
    }
    
    if(empty($_POST['reporter_information'])){
      $valid=0;
      $error_message = "Information cannot be empty... ";
    }

    if($valid==1){
      $statement=$con->prepare("INSERT INTO tbl_report(report_name,report_information,report_added,report_status) VALUES(?,?,?,?)");

      $statement->execute(array($_POST['reporter_name'],$_POST['reporter_information'],$today,0));

      $success_message = "Your response has been recorded......";
    }

  }


?>

<!DOCTYPE html>

<!-- Breadcrumb-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Dairy Management System</title>
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style-add.css">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">

    <!-- Main styles for this application-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">


    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="css/examples.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
    <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg></a>
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="store_index.php">Dashboard</a></li>
          </ul>
          <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg></a></li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Account</div>
                </div>

                <a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg> Profile
                </a>

                <a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                  </svg> Settings
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="logout.php">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg> Logout
                </a>
                
              </div>
            </li>
          </ul>
        </div>
        <div class="header-divider"></div>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Report</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="store_index.php" class="btn text-white" >Back</a></button>
        </div>

    </header>
    
    <div style="margin-left:100px;margin-top:20px;">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 align="center" style="margin-top:20px;margin-bottom:20px;">
                    REPORT
            </h2>
              <div class="each-input-element">
                    <label> Name :</label>
                    <div style="margin-top:-2.5%;margin-left:20%;">
                        <input type="text" name="reporter_name" placeholder="Enter your name....">
                    </div>    
              </div>      

              <br><br>

              <div class="each-input-element">
                  <label> Information :</label>
                  <div style="margin-top:-2.5%;margin-left:20%;">
                      <textarea type="text" name="reporter_information" placeholder="Enter the information...." rows=5 cols=23></textarea>
                  </div>    
              </div>

              <br>

                <button type="submit" name="submit_report" style="padding:10px 10px;border-radius:10px;" class="btn btn-success pull-left" >Submit</button>

        </form>
    </div>
          <?php if ($error_message) : ?>
          <div class="callout callout-danger">

            <p>
              <?php echo $error_message; ?>
            </p>
          </div>
        <?php endif; ?>

        <?php if ($success_message) : ?>
          <div class="callout callout-success">

            <p><?php echo $success_message; ?></p>
          </div>
        <?php endif; ?>
    
  
</div>
<?php require_once("footer.php");?>