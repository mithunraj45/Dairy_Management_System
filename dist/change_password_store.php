<?php 

session_start();


if (!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}

  require_once("connection.php");
  connect_db();

  $error_message="";
  $success_message="";

  $email_id = $_SESSION['user']['login_user_email'];


  if(isset($_POST['update_pass'])){

    $email = $_POST['email'];
    $current = $_POST['current_pass'];
    $new = $_POST['new_pass'];
    $reenter = $_POST['reenter_pass'];

    $statement = $con->prepare("SELECT * FROM tbl_login WHERE login_user_email = ? ");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $db_pass = $result['login_user_password'];


    $modified_current  = md5($current);

    if($modified_current == $db_pass){

        if($new == $reenter){
            $modified_new = md5($new);
            $statement = $con->prepare("UPDATE tbl_login SET login_user_password = ? WHERE login_user_email = ? ");
            $statement->execute(array($modified_new,$email));

            $success_message="Password has been updated...";
        }else{
            $error_message = "New Password And Re-entered Password does not matches... ";
        }

    }else{
        $error_message="Password does not match with database";
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
            <li class="nav-item"><a class="nav-link" href="store_index.php " align="left">Dashboard</a></li>
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
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                  </svg> Change Password
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

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="store_index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Change Password</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="store_index.php" style="color:white;text-decoration:none;" >Go Back</a></button>
        </div>

    </header>

    <section class="add-form" style="margin-left:20px;background-color:white;">
        <div class="form-elements" style="margin-left:20px;margin-top:20px;"> 
            <form action="" method="post" enctype="multipart/form-data">


                <div class="each-input-element">
                    <label> Name :</label>
                    <div style="margin-top:-2.5%;margin-left:20%;">
                        <input type="text" name="email" value="<?php echo $email_id; ?>" readonly>
                    </div>    
                </div>      

                <br><br>

                <div class="each-input-element">
                    <label> Current Password :</label>
                    <div style="margin-top:-2.5%;margin-left:20%;">
                        <input type="text" name="current_pass" placeholder="Enter the store phone no....">
                    </div>    
                </div>

                <br><br>

                <div class="each-input-element">
                <label> New Password :</label>
                    <div style="margin-top:-2.5%;margin-left:20%;">
                        <input type="password" name="new_pass" placeholder="Enter the store phone no....">
                    </div>
                </div>

                <br><br>

                <div class="each-input-element">
                    <label>Re-enter New Password :</label>
                    <div style="margin-top:-2.5%;margin-left:20%;">
                        <input type="password" name="reenter_pass" placeholder="Enter the store phone no....">
                    </div>
                </div>

                <br><br>

                <button type="submit" value="<?php echo $email_id; ?>" name="update_pass" style="padding:10px 10px;border-radius:10px;" class="btn btn-success pull-left" >UPDATE</button>



            
            </form>

        </div>

    </section>

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