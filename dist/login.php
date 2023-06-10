<?php

require_once("connection.php");
connect_db();
$error_message='';
session_start(); 

if(isset($_POST['form'])) {
        
  if(empty($_POST['email']) || empty($_POST['password'])) {
      $error_message = 'Email and/or Password can not be empty<br>';
  } else {

  
  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);

    $statement = $con->prepare("SELECT * FROM tbl_login WHERE login_user_email=? AND login_status=?");
    $statement->execute(array($email,'Active'));
    $total = $statement->rowCount();    
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);    
      if($total==0) {
          $error_message .= 'Email Address does not match<br>';
      } else {       
          foreach($result as $row) { 
              $row_password = $row['login_user_password'];
          }
      
          if( $row_password != md5($password) ) {
              $error_message .= 'Password does not match<br>';
          } else {       
          
      $_SESSION['user'] = $row;
      if($_SESSION['user']['login_role']=='Admin'){
        header("location: index.php");
      }else{
        if($_SESSION['user']['login_role']=='Store'){
          header("location: store_index.php");
        }else{
          if($_SESSION['user']['login_role']=='Supplier'){
            header("location: supplier_index.php");
          }else{
            if($_SESSION['user']['login_role']=='Delivery'){
              header("location: delivery_index.php");
            }else{
              header("location: stocks.php");
            }
          }
        }
      }
          }
      }
  }

  
}
?>



<html>

<head>
  <link rel="stylesheet" href="css/style_login.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Log in</p>
    <form class="form1" action="login.php" method="POST">
      <input class="un" name="email" type="text" align="center" placeholder="Username">
      <input class="pass" type="password" name="password" align="center" placeholder="Password">
      <input type="submit" class="submit" name="form" align="center" value="Submit">
      <p style="color:red;margin-left:15%;"><?php  if( (isset($error_message)) && ($error_message!='') ) echo $error_message;?></p>
            
                
    </div>
     
</body>

</html>