<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

  $bg_color=array("card mb-4 text-white bg-warning","card mb-4 text-white bg-success","card mb-4 text-white bg-info","card mb-4 text-white bg-primary","card mb-4 text-white bg-danger","card mb-4 text-white bg-secondary","card mb-4 text-white bg-dark");

  if(isset($_POST['select_store'])){
    if(isset($_POST['delivering_emp_ssn'])){
        $emp_ssn = $_POST['delivering_emp_ssn'];
        $store_id=$_POST['select_store'];
        $statement = $con->prepare("UPDATE tbl_store SET delivering_emp_ssn=$emp_ssn WHERE store_id=?");
        $statement->execute(array($store_id));
    }
  }

  if(isset($_POST['delete_store'])){
    $trans_id = $_POST['delete_store']; 
    $list = explode(" ",$trans_id);

    $statement = $con->prepare("DELETE FROM tbl_store WHERE store_id = ?");
    $statement->execute(array($list[0]));

    $statement = $con->prepare("DELETE FROM tbl_login WHERE login_user_email = ?");
    $statement->execute(array($list[1]));

}

?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Stores</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="store-add.php" style="color:white;text-decoration:none;" >Add Store</a></button>
        </div>

    </header>

    <div class="row" style="margin-left:20px;">  
        <div class="col-5">
            <?php
                    $i=0;
                    $statement = $con->prepare("SELECT * FROM tbl_store JOIN tbl_employee on delivering_emp_ssn=emp_ssn");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                    <a href="store_transaction.php?ref_id=<?php echo $row['store_id'];?>" style="text-decoration:none;">  
                        <div class="col-10">      
                            
                            <div class="col-sm-15">
                                <div class="<?php echo $bg_color[$i]; ?>">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-4 fw-semibold">
                                                <?php echo $row['store_name']; ?>
                                            </div>
                                            <div><?php echo $row['emp_fname']." ".$row['emp_lname']; ?>(Delivering-Agent)</span></div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <span class=""><?php echo $row['store_address'];?></span>
                                    </div>
                                </div>
                            </div>

                        </div>   
                    </a>
            <?php
             $i++; 
             if($i==6)
                        $i=0;
             } ?>  
             </a>
         </div>

        <div class="col-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <p class="fs-5"><b>Allort Employes for Stores</b></p> 
                    <select name="delivering_emp_ssn" style="margin-top:-40px;margin-left:23%;position:absolute;" onchange="this.form.submit()">
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
                    <div class="col-6">
                        <table  class="table table-bordered table-hover table-fixed">

                        <thead  style="background-color:rgb(48,60,84);color:white;" >
                            <th>Select Store </th>
                            <th>Store Name</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php 

                                    $statement = $con->prepare("SELECT * FROM tbl_store");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {

                            ?>
                                <tr>
                                    <td><input type="radio" name="select_store" value="<?php echo $row['store_id'];?>"></td>
                                    <td><?php echo $row['store_name'];?></td>
                                    <td>
                                        <b><button type="submit" name="delete_store" value="<?php echo $row['store_id']." ".$row['store_pno']; ?>" class="btn btn-danger" style="border:none;padding:8px 8px;border-radius:10px;color:black;">Delete</button>
                                    </td>
                                </tr>

                            <?php } ?>

                                </tr>

                        </tbody>

                        </table>
                    </div>
<br><br>
                    <table  class="table table-bordered table-hover table-fixed">

                        <thead  style="background-color:rgb(48,60,84);color:white;" >
                            <th>SL NO</th>
                            <th>Employee Name</th>
                        </thead>

                        <?php
                                            $i=0;
                                            $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_dept_no=(SELECT dept_id FROM tbl_department WHERE dept_name='Transportation') group by  emp_ssn having not exists(SELECT * from tbl_store where delivering_emp_ssn=emp_ssn )");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                $i++;
                        ?>

                        <tbody>
                            <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['emp_fname']." ".$row['emp_lname']; ?></td>
                            <tr>
                        </tbody>

                        <?php } ?> 
                    
                    </table>
                </form>
            </div>



    </div>
    
   
</div>


<?php require_once("footer.php");?>