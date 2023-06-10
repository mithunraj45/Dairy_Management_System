<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

  $ref_id=$_REQUEST['ref_id'];
  $error_count=0;
  $error_message="";
  $success_message="";
  $last_image="";

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

      if(empty($_POST['emp_email'])){
        $file_name=$last_image;
      }

      if($error_count >= 2){
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

            $statement=$con->prepare("UPDATE tbl_employee SET emp_fname=?,emp_lname=?,emp_bdate=?,emp_sex=?,emp_salary=?,emp_ssn=?,emp_email_id=?,emp_address=?,emp_image=?,emp_dept_no=? WHERE emp_ssn=$ref_id");

            $statement->execute(array($_POST['emp_fname'],$_POST['emp_lname'],$_POST['emp_bdate'],$_POST['emp_sex'],$_POST['emp_salary'],$_POST['emp_ssn'],$_POST['emp_email'],$_POST['emp_address'],$file_name,$_POST['emp_dept_no']));
            
            $success_message = 'Employee has been updated successfully....';

      }

  }

?>
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
                <?php
                    $statement = $con->prepare("SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id WHERE emp_ssn=?");
                    $statement->execute(array($_REQUEST['ref_id']));
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    ?>

          <form action="" method="post" enctype="multipart/form-data">

            <div class="each-input-element">
                <label>Upload Image :</label>
                <div style="margin-top:-2.5%;margin-left:20%;">
                    <input type="file" name="emp_image" accept="image/*"> 
                </div>
                <img src="../dist//assets/img/avatars/<?php echo $row['emp_image']; ?>" style="width:75px;margin-top:-40px;position:absolute;margin-left:33%;border-radius:50%">
                <?php $last_image=$row['emp_image'];?>

            </div>
          
            <br><br>

            <div class="each-input-element">
                  <label> Name :</label>
                  <div style="margin-top:-2.5%;margin-left:20%;">
                      <input type="text" name="emp_fname" value="<?php echo $row['emp_fname'];?>" >
                      <input type="text" name="emp_lname" value="<?php echo $row['emp_lname'];?>">  
                  </div>    
            </div>      

            <br><br>
            
            <div class="each-input-element">
            <label>Birth Date :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="date" name="emp_bdate" value="<?php echo $row['emp_bdate'];?>">
            </div>    
            </div>
          
            <br><br>
            
            <div class="each-input-element">
            <label>Sex :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <select name="emp_sex" value="<?php echo $row['emp_sex'];?>">
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
                  <input type="number" name="emp_salary" value="<?php echo $row['emp_salary'];?>">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Social Security Number :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="number" name="emp_ssn" value="<?php echo $row['emp_ssn'];?>">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Email ID :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="email" name="emp_email" value="<?php echo $row['emp_email_id'];?>">
            </div>
            </div>
            
            <br><br>

            <div class="each-input-element">
            <label>Address :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="text" name="emp_address" value="<?php echo $row['emp_address'];?>">
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

              <button type="submit" name="add_emp" style="padding:10px 10px;border-radius:10px;" class="btn btn-success pull-left" >Submit</button>

          </form>
        </div>
      </section>

</div>
<?php require_once("footer.php");?>