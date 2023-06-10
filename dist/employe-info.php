<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

    if(!isset($_REQUEST['ref_id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_ssn=?");
        $statement->execute(array($_REQUEST['ref_id']));
        $total = $statement->rowCount();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }
?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Employee Infomation</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="employe-veiw.php" class="btn text-white" >Veiw All</a></button>
        </div>
    </header>



    <div class="container-fluid">
                <?php
                    $statement = $con->prepare("SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id WHERE emp_ssn=?");
                    $statement->execute(array($_REQUEST['ref_id']));
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    ?>
	            <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan=2><img src="../dist//assets/img/avatars/<?php echo $row['emp_image']; ?>" style="width:200px;border-radius:50%;"></td>
                    </tr>
                    
                    <tr>
                        <td>Name </td>
                        <td><?php echo $row['emp_fname']." ".$row['emp_lname'];?></td>
                    </tr>
                    
                    <tr>
                        <td>Birth Date </td>
                        <td><?php echo $row['emp_bdate'];?></td>
                    </tr>
                    
                    <tr>
                        <td>Gender </td>
                        <td><?php echo $row['emp_sex']?></td>
                    </tr>
                    
                    <tr>
                        <td>Salary </td>
                        <td><?php echo $row['emp_salary']?></td>
                    </tr>
                    
                    <tr>
                        <td>Social Security Number </td>
                        <td><?php echo $row['emp_ssn']?></td>
                    </tr>
                    
                    <tr>
                        <td>Email ID</td>
                        <td><?php echo $row['emp_email_id']?></td>
                    </tr>
                    
                    <tr>
                        <td>Address</td>
                        <td><?php echo $row['emp_address']?></td>
                    </tr>
                    
                    <tr>
                        <td>Department Name</td>
                        <td><?php echo $row['dept_name']?></td>
                    </tr>

                    <tr>
                        <td>Manager Name</td>
                        <td>
                            <?php
                            $dept_mgr_ssn=$row['dept_mgr_ssn'];
                            $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_ssn=$dept_mgr_ssn");
                            $statement->execute();
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                            echo $row['emp_fname']." ".$row['emp_lname'];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Joined Date</td>
                        <td><?php echo $row['emp_joined_date'];?>
                    </tr>
                </table>
    </div>

    <div>
        <button type="submit" class="btn btn-success" style="margin-left:20px;padding:15px 15px;"><a href="employee-edit.php?ref_id=<?php echo $_REQUEST['ref_id'];?>" style="text-decoration:none;" class="text-white">Edit</a></button>
        <button type="submit" class="btn btn-danger" style="margin-left:20px;padding:15px 15px;"><a href="employee-delete.php?ref_id=<?php echo $_REQUEST['ref_id'];?>" style="text-decoration:none;" class="text-white">Delete</a></button>
    </div>
</div>
<?php require_once("footer.php");?>