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
$last_value="";



$statement = $con->prepare("SELECT * FROM tbl_store WHERE store_pno = ? ");
$statement->execute(array($email_id));
$result = $statement->fetch(PDO::FETCH_ASSOC);
$store_id = $result['store_id'];
$store_name = $result['store_name'];
$delivering_emp_ssn = $result['delivering_emp_ssn'];

$statement = $con->prepare("SELECT cost_store FROM tbl_website_setting WHERE tbl_id=1 ");
$statement->execute();
$result4 = $statement->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['submit_report'])){
  $trans_id = $_POST['submit_report']; 
  $statement = $con->prepare("UPDATE tbl_store_transaction SET store_verification = ?,approved = ? WHERE trans_id = ?");
  $statement->execute(array(1,1,$trans_id));
}


if(isset($_POST['sort_date'])){

  $last_value = $_POST['sort_date'];

  $requested_month=$_POST['sort_date'];
  $requested_month_date=$requested_month."-01";
  $end_month=$requested_month."-31";

  $sort_date="  SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE (trans_date BETWEEN '$requested_month_date' AND '$end_month' ) AND store_id=? AND store_verification =? AND delivered_emp_verification =?  AND approved=? ";

}else{
  $sort_date=" SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE store_id=? AND store_verification =? AND delivered_emp_verification =? AND approved=? ";
}

if(isset($_POST['clear'])){

    $last_value = "";

    $sort_date=" SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE store_id=? AND store_verification =? AND delivered_emp_verification =? AND approved=? ";

}


if(isset($_POST['report_store'])){

  $valid=1;
   
  if(empty($_POST['milk_quantity'])){
    $error_message=$error_message."Milk Quantity should not be empty";
    $valid=0;
  }

  if($valid==1){
            $milk_qty=$_POST['milk_quantity'];

            $statement = $con->prepare("INSERT INTO tbl_store_transaction(store_id,deliverd_emp_ssn,milk_quantity,trans_date,store_verification,approved) VALUES(?,?,?,?,?,?) ");
            $statement->execute(array($store_id,$delivering_emp_ssn,$milk_qty,$today,1,0));
            $success_message="Report has been taken...";
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

          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/2.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Account</div>
                </div>

                <a class="dropdown-item" href="change_password_store.php">
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
        <div class="header-divider"></div>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="store_index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Store Information</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="report.php" class="btn text-white" >Report</a></button>
        </div>
    </header>


    <div class="container-fluid" style="background-color:white;">
        <u><h2 align="center" style="margin-top:20px;"><?php echo $store_name; ?></h2></u>
        <style>
              @media print{
                body *{
                  visibility:hidden;
                }

                .print-container, .print-container *{
                  visibility:visible;
                  size:A4;
                  
                }
              }
        </style>

        <div class="row">
            
            <div class="col-5  print-container" style="margin-top:50px;">
            <form action="store_index.php" method="post" enctype="multipart/form-data">
                <h3 align="left">Transaction
                   <span style="padding-left:15%; font-size:22px;">
                    <input type="month" name="sort_date" value="<?php echo $last_value; ?>" onchange="this.form.submit()">
                    <input type="submit" style="background-color:rgb(48,60,84);color:white;border:none;padding:8px 8px;border-radius:10px;" value="Clear" name="clear" onchange="this.form.submit()">
                  </span>
                </h3>
                
            </form>

                <table class="table table-bordered table-hover table-fixed" style="margin-top:20px;">
                    <thead>
                        <tr style="background-color:rgb(48,60,84);color:white;">
                            <th>Sl No</th>
                            <th>Delivered Employee</th>
                            <th>Date</th>
                            <th>Milk Quantity</th>
                        </tr>   
                    </thead>
                    <?php
                            $i=0;
                            $total_cost=0;
                            $statement = $con->prepare($sort_date);
                            $statement->execute(array($store_id,1,1,1));
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                            $i++;
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['emp_fname']." ".$row['emp_lname']; ?></td>
                            <td><?php echo $row['trans_date'];?></td>
                            <td><?php echo $row['milk_quantity']; $total_cost = $total_cost + $row['milk_quantity']*$result4['cost_store']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <button onclick="window.print()" style="background-color:rgb(48,60,84);color:white;border:none;border-radius:10px;margin-left:70%;padding-left:50px;padding-right:50px;padding-top:10px;padding-bottom:10px;">Print</button>
                <h3 style="margin-left:55%;">---------------------<br>Total Cost : <?php echo $total_cost; ?></h3>
            </div>

            <div class="col-5" style="margin-top:58px;margin-left:5%;">
                <form action="store_index.php" method="post" enctype="multipart/form-data">
                  <h3 align="center" >Daily Report</h3>
                    <table class="table table-bordered table-hover table-fixed" style="margin-top:20px;">
                        <thead>
                            <tr style="background-color:rgb(48,60,84);color:white;">
                                <th>Sl No</th>
                                <th>Delivered Employee</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                                    $i=0;
                                    $statement = $con->prepare("SELECT * FROM tbl_store_transaction JOIN tbl_store ON tbl_store_transaction.store_id=tbl_store.store_id JOIN tbl_employee ON tbl_store_transaction.deliverd_emp_ssn = tbl_employee.emp_ssn WHERE tbl_store_transaction.store_id = ? AND store_verification = ?  ");
                                    $statement->execute(array($store_id,0));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['emp_fname']; ?></td>
                                        <td><?php echo $row['trans_date']; ?></td>
                                        <td><?php echo $row['milk_quantity']; ?></td>
                                        <td>
                                            <b><button type="submit" name="submit_report" value="<?php echo $row['trans_id']; ?>" class="btn btn-success" style="border:none;padding:8px 8px;border-radius:10px;color:black;">Delivered</button>
                                        </td>
                                    </tr>     
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
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

    

