<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}

require_once("connection.php");
connect_db();

$today=date('Y-m-d');


$statement = $con->prepare("SELECT * FROM tbl_record ORDER BY record_date desc ");
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

$val = $result['total_quantity'];

$statement = $con->prepare("SELECT * FROM tbl_record WHERE record_date='$today' ");
$statement->execute();
$total = $statement->rowCount();

if($total!=0){

  $result2 = $statement->fetch(PDO::FETCH_ASSOC);

}
else
  $result2['daily_quantity']=0;


?>

<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
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
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <span class="nav-icon">Dairy Management System</span>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
          <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
            </svg> 
           Dashboard
          </a>
        </li>

        <li class="nav-group">
          <a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg> 
            Employee
          </a>

          <ul class="nav-group-items">

            <li class="nav-item">
              <a class="nav-link" href="employee-add.php">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                </svg> 
                <span class="nav-icon"></span> Add Employes
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="employe-veiw.php">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-spreadsheet"></use>
                </svg> 
                <span class="nav-icon"></span> View Employes
              </a>
            </li>
          </ul>
        </li>


        
        <li class="nav-item"><a class="nav-link" href="department.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
            </svg> Department</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="notification.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
            </svg> Request</a>
        </li>


        <li class="nav-item"><a class="nav-link" href="stores.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-spa"></use>
            </svg> Stores</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="suppliers.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
            </svg> Suppliers</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="report_status.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-note-add"></use>
            </svg> Report</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="accounts.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg> Accounts</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="website_settings.php">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
            </svg> Website Settings</a>
        </li>

      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>

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
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="report_status.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
            <li class="nav-item" style="padding-right:15px;padding-left:10px;"><a class="nav-link" style="background-color:rgb(60,75,100);border-radius:10px;color:white;padding-left:15px;padding-right:15px;">Total<?php echo "  :  ".$result['total_quantity']; ?></a></li>
            <li class="nav-item"><a class="nav-link" style="background-color:rgb(60,75,100);border-radius:10px;color:white;padding-left:15px;padding-right:15px;">Today<?php echo "  :  ".$result2['daily_quantity']; ?></a></li>
            
            <li class="nav-item">
                <a class="nav-link" style="color:red;">
                    <?php 

                        if($val<100){
                          echo "Total Quantity of milk is less than 100";
                        }
                    
                    ?>    
                </a>
            </li>


          </ul>
          <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="department.php">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="stores.php">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-spa"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="suppliers.php">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
                </svg></a></li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Account</div>
                </div>

                <a class="dropdown-item" href="change_password.php">
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

    

