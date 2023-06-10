<?php 
  require_once("header.php");
  require_once("connection.php");
  $today=date('Y-m-d');
  $bg_color=array("--cui-card-cap-bg:rgb(90,185,193)","--cui-card-cap-bg:rgb(200,220,100)","--cui-card-cap-bg:rgb(60,60,60)","--cui-card-cap-bg:rgb(136,136,136)","--cui-card-cap-bg:rgb(71,122,169)","--cui-card-cap-bg:rgb(48,60,84)");

  connect_db();


  if(isset($_POST['checkbox_info'])){
        if(isset($_POST['add_emp_dept_no'])){
            $dept_no=$_POST['add_emp_dept_no'];
            foreach($_POST['checkbox_info'] as $checkboxValue){
                $statement = $con->prepare("UPDATE tbl_employee SET emp_dept_no=$dept_no WHERE emp_ssn=?");
                $statement->execute(array($checkboxValue));
            }
        }
    }

if(isset($_POST['chng_mgr_ssn'])){    
    if(isset($_POST['chng_dept_mgr_ssn'])){
        $dept_mgr_ssn=$_POST['chng_dept_mgr_ssn'];
        $dept_id=$_POST['chng_mgr_ssn'];
        $statement = $con->prepare("UPDATE tbl_department SET dept_mgr_ssn=$dept_mgr_ssn,dept_mgr_date='$today' WHERE dept_id=?");
        $statement->execute(array($dept_id));
    }
}

?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Department</span></li>
            </ol>
          </nav>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
        <?php
                      $i=0; 
                    $statement = $con->prepare("SELECT * FROM tbl_department JOIN tbl_employee on dept_mgr_ssn=emp_ssn");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                      
                        $dept_mgr_date=date_create($row['dept_mgr_date']);
                        $today=date_create(date('Y-m-d'));
                        $Difference= date_diff($today,$dept_mgr_date);
                        ?>
            <div class="col-4">        

                        
                            <div class="card mb-4" style="<?php echo $bg_color[$i];?>">
                                <div class="card-header position-relative d-flex justify-content-center align-items-center" style="color:white;">
                                    <svg class="icon icon-3xl text-white my-4">
                                        <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-framer"></use>
                                    </svg>
                                    <h4><?php echo $row['dept_name'];?></h4>
                                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                                        <canvas id="social-box-chart-1" height="90"></canvas>
                                    </div>
                                </div>
                                <div class="card-body row text-center">
                                        <div class="col">
                                            <div class="fs-5 fw-semibold"><?php echo $row['emp_fname']." ".$row['emp_lname'];?></div>
                                            <div class="text-uppercase text-medium-emphasis small fw-semibold">
                                                <?php 
                                                        if($Difference->format('%y')==0 && $Difference->format('%m')==0)
                                                            if($Difference->format('%d')==0)
                                                                echo $Difference->format('Since Today');
                                                            else    
                                                                echo $Difference->format('Since %d Days');
                                                        else 
                                                            if($Difference->format('%y')==0 && $Difference->format('m')!=0)
                                                                echo $Difference->format(' Since %m Months ');
                                                            else    
                                                                echo $Difference->format(' Since %y Years %m Months ')
                       
                                                   ?>
                                            </div>

                                        </div>
                                        <div class="vr"></div>
                                        <div class="col">
                                            <div class="fs-5 fw-semibold">
                                                <?php
                                                        $dept_id=$row['dept_id'];
                                                        $statement = $con->prepare("SELECT COUNT(emp_ssn) as total_count FROM tbl_employee WHERE emp_dept_no=?");
                                                        $statement->execute(array($dept_id));
                                                        $row1 = $statement->fetch(PDO::FETCH_ASSOC);
                                                        echo $row1['total_count'];
                                                ?>
                                            </div>
                                            <div class="text-uppercase text-medium-emphasis small fw-semibold">Total Employess</div>
                                        </div>
                                </div>
                            </div>
            </div>
            <?php $i++; }?>


            <div class="col-8">
            <br><br>
            <form action="department.php" method="post" enctype="multipart/form-data">

                <p class="fs-5"><b>Change Manager</b>   
                                             
                                <select name="chng_dept_mgr_ssn" onchange="this.form.submit()" style="margin-left:30%;margin-top:-20px;">
                                    <option value="">Select any one of the Emplopyee</option>
                                    <?php
                                    $statement = $con->prepare("SELECT * FROM tbl_employee WHERE NOT EXISTS(SELECT * FROM tbl_department WHERE dept_mgr_ssn=emp_ssn)");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['emp_ssn']; ?>">
                                        <?php echo $row['emp_fname']." ".$row['emp_lname']; ?>
                                    </option>
                                    <?php } ?>
                                </select></p> 
                        <table id="example1" class="table table-bordered table-hover table-fixed">
                                <thead  style="background-color:rgb(48,60,84);color:white;" >
                                        <tr>
                                            <th width="50px">Select</th>
                                            <th width="30">SL.No</th>
                                            <th width="50px">Department Name</th>
                                            <th width="20px">Manager Name</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $statement = $con->prepare("SELECT * FROM tbl_department JOIN tbl_employee on dept_mgr_ssn=emp_ssn");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            $i=1;
                                            foreach ($result as $row) {?>
                                                <tr>
                                                    <td><input type="radio" name="chng_mgr_ssn" value="<?php echo $row['dept_id'];?>'"></td>

                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row['dept_name']; ?> </td>

                                                    <td><?php echo $row['emp_fname']." ".$row['emp_lname']; ?></td>

                                    <?php $i++; }?>                
                                </tbody>
                        </table>

 <br><br>
                </form> 
            </div>   
        </div>

    </div>


<?php require_once("footer.php");?>