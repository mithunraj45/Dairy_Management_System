<?php

session_start();


if (!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}

require_once("connection.php");
connect_db();

$today=date('Y-m-d');
$success_message="";
$error_message="";
$error_count=0;
$email_id = $_SESSION['user']['login_user_email'];
$today=date('Y-m-d');
$month = date('M');



$statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_email_id = ? ");
$statement->execute(array($email_id));
$result = $statement->fetch(PDO::FETCH_ASSOC);
$emp_fname = $result['emp_fname'];
$emp_lname = $result['emp_lname'];
$emp_ssn = $result['emp_ssn'];


if(isset($_POST['submit_report'])){
    $trans_id = $_POST['submit_report']; 

    $list =explode(" ",$trans_id);
    
    $statement = $con->prepare("UPDATE tbl_supplier_transaction SET mgr_verification = ?,approved = ? WHERE trans_id = ?");
    $statement->execute(array(1,1,$list[0]));

    $statement = $con->prepare("SELECT * FROM tbl_record WHERE record_date = ? ");
    $statement->execute(array($today));
    $count=$statement->rowCount();

    if($count==0){
      $statement = $con->prepare("SELECT * FROM tbl_record ORDER BY record_date DESC");
      $statement->execute();
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $total=$result['total_quantity']+$list[1];


      $statement = $con->prepare("INSERT INTO tbl_record(record_date,record_month,daily_quantity,total_quantity) VALUES('$today','$month',$list[1],$total)");
      $statement->execute();
    }else{
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $total=$result['total_quantity']+$list[1];
      $list[1]=$list[1]+$result['daily_quantity'];
      $statement = $con->prepare("UPDATE tbl_record SET total_quantity = ?, daily_quantity = ? WHERE record_date = ?");
      $statement->execute(array($total,$list[1],$today));
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
            <li class="nav-item"><a class="nav-link" href="supplier_index.php">Dashboard</a></li>
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
                <!-- if breadcrumb is single--><a class="nav-link" href="stocks.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Delivery Agent</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="report.php" class="btn text-white" >Report</a></button>
        </div>
    </header>


    <div class="container-fluid" style="background-color:white;">
        <h2 align="center" style="margin-top:20px;"><?php echo "Welcome back ".$emp_fname." ".$emp_lname; ?></h2>
            <div class="row">
                <form  action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover" style="margin-top:20px;">
                            <thead style="background-color:rgb(48,60,84);color:white;">
                                
                                <th>Sl No</th>
                                <th>Supplier Name</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Action</th>

                            </thead>
                            <?php
                                    $i=0;
                                    $statement = $con->prepare("SELECT * FROM tbl_supplier_transaction JOIN tbl_supplier ON tbl_supplier_transaction.supplier_id=tbl_supplier.supplier_id WHERE mgr_supplier_ssn = ? AND mgr_verification = ?  ");
                                    $statement->execute(array($emp_ssn,0));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    $i++;
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['supplier_name']; ?></td>
                                        <td><?php echo $row['trans_date']; ?></td>
                                        <td><?php echo $row['supplier_qty']; ?></td>
                                        <td>
                                            <b><button type="submit" name="submit_report" value="<?php echo $row['trans_id']." ".$row['supplier_qty']; ?>" class="btn btn-success" style="border:none;padding:8px 8px;border-radius:10px;color:black;">Received</button>
                                        </td>
                                    </tr>      
                                </tbody>
                            <?php } ?>
                    </table>
                </form>    
            </div>
    </div>

</div>


            <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/chart.js/js/chart.min.js"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  
    <script>
    </script>

  </body>
</html>

    

