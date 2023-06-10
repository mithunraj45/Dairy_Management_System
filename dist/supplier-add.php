<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();
  $emp_login=$_SESSION['user']['login_user_email'];
  $today=date('Y-m-d');

  $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_ssn=(SELECT dept_mgr_ssn FROM tbl_department WHERE dept_name='stocks')");
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  $emp_mgr_ssn=$result['emp_ssn'];

  $error_message="";
  $error_count=0;
  $success_message="";

  if (isset($_POST['add_emp'])) {

    $valid=1;
   
      if(empty($_POST['supplier_name'])){
        $error_message="supplier name should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['supplier_address'])){
        $error_message="supplier Address should not be empty";
        $error_count++;
        $valid=0;
      }

      if(empty($_POST['supplier_pno'])){
        $error_message="supplier Mobile No should not be empty";
        $valid=0;
        $error_count++;

      }

      if($valid==1){

        $statement=$con->prepare("INSERT INTO tbl_supplier(supplier_name,supplier_address,supplier_pno,mgr_ssn_supplier,supplier_added_date) VALUES(?,?,?,?,?)");
        $statement->execute(array($_POST['supplier_name'],$_POST['supplier_address'],$_POST['supplier_pno'],$emp_mgr_ssn,$today));
  
        $statement=$con->prepare("INSERT INTO tbl_login(login_user_email,login_user_password,login_status,login_role) VALUES(?,?,?,?)");
        $statement->execute(array($_POST['supplier_pno'],'81dc9bdb52d04dc20036dbd8313ed055','Active','Supplier'));
        
        $success_message = 'supplier has been added successfully....';


  }


    }

?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Add supplier</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="suppliers.php" style="color:white;text-decoration:none;" >Veiw All</a></button>
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

          <form action="supplier-add.php" method="post" enctype="multipart/form-data">


            <div class="each-input-element">
                  <label> Name :</label>
                  <div style="margin-top:-2.5%;margin-left:20%;">
                      <input type="text" name="supplier_name" placeholder="Enter the supplier name....">
                  </div>    
            </div>      

            <br><br>
            
            <div class="each-input-element">
                <label> Address :</label>
                <div style="margin-top:-2.5%;margin-left:20%;">
                    <textarea type="text" name="supplier_address" placeholder="Enter the supplier address...." rows=3 cols=25></textarea>
                </div>    
            </div>

            <br><br>

            <div class="each-input-element">
            <label>Phone No :</label>
            <div style="margin-top:-2.5%;margin-left:20%;">
                  <input type="number" name="supplier_pno" placeholder="Enter the supplier phone no....">
            </div>
            </div>

            <br><br>

            <div class="each-input-element">
							<label>Managed By :</label>
              <div style="margin-top:-2.5%;margin-left:20%;">

									<?php
									$statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_ssn=(SELECT dept_mgr_ssn FROM tbl_department WHERE dept_name='stocks')");
									$statement->execute();
									$result = $statement->fetch(PDO::FETCH_ASSOC);
									?>
				        <input type="varchar" placeholder="<?php echo $result['emp_fname']." ".$result['emp_lname']; ?>" readonly>

              </div>
            </div>
            
            <br><br>

              <button type="submit" name="add_emp" style="padding:10px 10px;border-radius:10px;" class="btn btn-success pull-left" >Submit</button>

          </form>
        </div>
      </section>


</div>
<?php require_once("footer.php");?>