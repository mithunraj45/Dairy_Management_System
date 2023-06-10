<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();
  $emp_login=$_SESSION['user']['login_user_email'];
  $today=date('Y-m-d');

  $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_email_id=?");
  $statement->execute(array($emp_login));
  $total_emp = $statement->rowCount();
  
  if($total_emp == 0){

      $emp_mgr_ssn="Admin";

  }else{
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $emp_mgr_ssn = $row['emp_mgr_ssn'];
  }

  $error_message="";
  $error_count=0;
  $success_message="";

  if (isset($_POST['add_emp'])) {

    $valid=1;
   
      if(empty($_POST['store_name'])){
        $error_message="Store name should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['store_address'])){
        $error_message="Store Address should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['store_pno'])){
        $error_message="Store Mobile No should not be empty";
        $valid=0;
        $error_count++;

      }

      if(empty($_POST['required_milk'])){
        $error_message="Quantity of Milk should not be empty";
        $valid=0;
        $error_count++;

      }

      if($error_count > 1){
        $error_message="So Many Feilds are empty... Fill and try again";
        $valid=0;
        $error_count++;

      }

      if($valid==1){

        $statement=$con->prepare("INSERT INTO tbl_store(store_name,store_address,store_pno,delivering_emp_ssn,required_milk,added_mgr_ssn,added_date) VALUES(?,?,?,?,?,?,?)");

        $statement->execute(array($_POST['store_name'],$_POST['store_address'],$_POST['store_pno'],$_POST['delivering_emp_ssn'],$_POST['required_milk'],$emp_mgr_ssn,$today));

        $statement=$con->prepare("INSERT INTO tbl_login(login_user_email,login_user_password,login_status,login_role) VALUES(?,?,?,?)");

        $statement->execute(array($_POST['store_pno'],'81dc9bdb52d04dc20036dbd8313ed055','Active','Store'));
        
        $success_message = 'Store has been added successfully....';


  }


    }

?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Add Store</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="stores.php" style="color:white;text-decoration:none;" >Veiw All</a></button>
        </div>

    </header>

    <section class="add-form" style="margin-left:20px;background-color:white;">
        <div class="form-elements" style="margin-left:20px;margin-top:20px;">  

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

          <form action="store-add.php" method="post" enctype="multipart/form-data">


            <div class="each-input-element">
                  <label> Name :</label>
                  <div style="margin-top:-2.5%;margin-left:20%;">
                      <input type="text" name="store_name" placeholder="Enter the store name....">
                  </div>    
            </div>      

            <br><br>
            
            <div class="each-input-element">
                <label> Address :</label>
                <div style="margin-top:-2.5%;margin-left:20%;">
                    <textarea type="text" name="store_address" placeholder="Enter the store address...." rows=3 cols=25></textarea>
                </div>    
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Phone No :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="number" name="store_pno" placeholder="Enter the store phone no....">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Required Milk :</label>
                <div style="margin-top:-2.5%;margin-left:20%;">
                    <input type="number" name="required_milk" placeholder="Enter the required milk ...."><span style="padding-left:15px;">(in liters)</span>
                </div>
            </div>

            <br><br>

            <div class="each-input-element">
							<label>Delivering Employee :</label>
              <div style="margin-top:-2.5%;margin-left:20%;">
								<select name="delivering_emp_ssn">
									<option value="">Select any of the Employee</option>
									<?php
									$statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_dept_no=(SELECT dept_id FROM tbl_department WHERE dept_name='Transportation');");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);
									foreach ($result as $row) {
									?>
										<option value="<?php echo $row['emp_ssn']; ?>">
											<?php echo $row['emp_fname']." ".$row['emp_lname']; ?>
										</option>
									<?php
									}
									?>
								</select>
              </div>
            </div>
            
            <br><br>

              <button type="submit" name="add_emp" style="padding:10px 10px;border-radius:10px;" class="btn btn-success pull-left" >Submit</button>

          </form>
        </div>
      </section>


</div>
<?php require_once("footer.php");?>