<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

  $error_message="";
  $error_count=0;
  $success_message="";


  if (isset($_POST['add_emp'])) {

    $valid=1;
   
      if(empty($_POST['emp_fname'])){
        $error_message="First name should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['emp_lname'])){
        $error_message="Last name should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['emp_bdate'])){
        $error_message="Birth Date should not be empty";
        $valid=0;
        $error_count++;

      }

      if(empty($_POST['emp_sex'])){
        $error_message="Sex should not be empty";
        $valid=0;
        $error_count++;

      }

      if(empty($_POST['emp_salary'])){
        $error_message="Salary should not be empty";
        $valid=0;
        $error_count++;

      }

      if(empty($_POST['emp_ssn'])){
        $error_message="Social Security Number should not be empty";
        $valid=0;
        $error_count++;

      }

      if(empty($_POST['emp_email'])){
        $error_message="Email ID should not be empty";
        $valid=0;
        $error_count++;
      }


      if($error_count > 0){
        $error_message="So Many Feilds are empty... Fill and try again";
        $valid=0;
        $error_count++;

      }

      if(isset($_FILES['emp_image'])){

        $file_name = $_FILES['emp_image']['name'];
        $file_tmp = $_FILES['emp_image']['tmp_name'];
        $destination="assets/img/avatars/".$file_name;

        move_uploaded_file($file_tmp,$destination);
     
      }

      if($valid==1){

            $statement=$con->prepare("INSERT INTO tbl_employee(emp_fname,emp_lname,emp_bdate,emp_sex,emp_salary,emp_ssn,emp_email_id,emp_address,emp_image,emp_dept_no) VALUES(?,?,?,?,?,?,?,?,?,?)");

            $statement->execute(array($_POST['emp_fname'],$_POST['emp_lname'],$_POST['emp_bdate'],$_POST['emp_sex'],$_POST['emp_salary'],$_POST['emp_ssn'],$_POST['emp_email'],$_POST['emp_address'],$file_name,$_POST['emp_dept_no']));

            if($_POST['emp_dept_no']==8){
              $statement=$con->prepare("INSERT INTO tbl_login(login_user_email,login_user_password,login_status,login_role) VALUES(?,?,?,?)");
              $statement->execute(array($_POST['emp_email'],'81dc9bdb52d04dc20036dbd8313ed055','Active','Delivery'));
              
            }
            
            $success_message = 'Employee has been added successfully....';


      }

  }

?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Add Employee</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="employe-veiw.php" class="btn text-white" >Veiw All</a></button>
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

          <form action="employee-add.php" method="post" enctype="multipart/form-data">

            <div class="each-input-element">
            <label>Upload Image :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="file" name="emp_image" accept="image/*">
            </div>
            </div>
          
            <br><br>

            <div class="each-input-element">
                  <label> Name :</label>
                  <div style="margin-top:-2.5%;margin-left:20%;">
                      <input type="text" name="emp_fname" placeholder="Enter the first name....">
                      <input type="text" name="emp_lname" placeholder="Enter the last name....">  
                  </div>    
            </div>      

            <br><br>
            
            <div class="each-input-element">
            <label>Birth Date :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="date" name="emp_bdate" placeholder="Enter the birth name....">
            </div>    
            </div>
          
            <br><br>
            
            <div class="each-input-element">
            <label>Sex :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <select name="emp_sex">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="T">Others</option>
                  </select>      
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Salary :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="number" name="emp_salary" placeholder="Enter the salary....">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Social Security Number :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="number" name="emp_ssn" placeholder="Enter the salary....">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Email ID :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="email" name="emp_email" placeholder="Enter the email id....">
            </div>
            </div>
            
            <br><br>

            <div class="each-input-element">
            <label>Address :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="text" name="emp_address" placeholder="Enter the address....">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
							<label>Department :</label>
              <div style="margin-top:-2.5%;margin-left:20%;">
								<select name="emp_dept_no">
									<option value="">Select any of the department</option>
									<?php
									$statement = $con->prepare("SELECT * FROM tbl_department ORDER BY dept_id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);
									foreach ($result as $row) {
									?>
										<option value="<?php echo $row['dept_id']; ?>">
											<?php echo $row['dept_name']; ?>
										</option>
									<?php
									}
									?>
								</select>
              </div>
            </div>
            
            <br><br>

              <button type="submit" name="add_emp" style="padding:10px 10px;border-radius:10px;" class="btn btn-success" >Submit</button>

          </form>
        </div>
      </section>

</div>
<?php require_once("footer.php");?>