<?php 
  require_once("header.php");
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

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Change Password</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="suppliers.php" style="color:white;text-decoration:none;" >Veiw All</a></button>
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