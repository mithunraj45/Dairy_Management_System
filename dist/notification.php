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



  if(isset($_POST['status_button'])){
    $request_id=$_POST['status_button'];
    $statement = $con->prepare("UPDATE tbl_request_from_users SET request_status='Active',request_veiwed_by_mgr='$emp_mgr_ssn',request_veiwed_date_time='$today'   WHERE request_id=?");
    $statement->execute(array($request_id));
  }

  if(isset($_POST['status_button_delete'])){
    $request_id=$_POST['status_button_delete'];
    $statement = $con->prepare("DELETE FROM tbl_request_from_users WHERE request_id=?");
    $statement->execute(array($request_id));
  }

?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Notifications</span></li>
            </ol>
          </nav>
        </div>
    </header>

<form action="notification.php" method="post" enctype="multipart/form-data" style="margin-left:20px;">
  <table>

        <thead>

            <th>

                <?php
                        $statement = $con->prepare("SELECT * FROM tbl_request_from_users  WHERE request_status=?");
                        $statement->execute(array("Inactive"));
                        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $result){
                ?>
                    <div class="row">
                        <div class="col-sm-10 col-lg-11 ">
                            <div class="card mb-4 text-white " style="background-color:rgb(60,75,100)">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        <?php echo $result['request_user_name'];?> 
                                            <span class="fs-6 fw-normal">(<?php echo $result['request_user_address'];?>)</span>
                                            <span class="fw-normal fs-6">
                                              <button type="submit" name="status_button" class="btn btn-danger" style="color:White;margin-top:-1%;" value="<?php echo $result['request_id']; ?>" >Veiwed</button></span>
                                    </div>
                                    <div><?php echo $result['request_user_subject'];?></div>
                                </div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <span class=""><?php echo $result['request_user_message'];?></span>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                                        <?php echo $result['request_user_pno'];?>
                                        <span style="padding-left:50%;"><?php echo $result['request_user_email'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php }?>

            </th>

            <th>
            <?php
                        $statement = $con->prepare("SELECT * FROM tbl_request_from_users  WHERE request_status=?");
                        $statement->execute(array("Active"));
                        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $result){
                ?>
                    <div class="row">
                        <div class="col-sm-10 col-lg-11 ">
                            <div class="card mb-4 text-white " style="background-color:rgb(136,136,136)">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        <?php echo $result['request_user_name'];?> 
                                            <span class="fs-6 fw-normal">(<?php echo $result['request_user_address'];?>)</span>
                                            <span class="fw-normal fs-6">
                                              <button type="submit" name="status_button_delete" class="btn btn-danger" style="color:White;margin-top:-1%;" value="<?php echo $result['request_id']; ?>" >Delete</button></span>
                                    </div>
                                    <div><?php echo $result['request_user_subject'];?></div>
                                </div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <span class=""><?php echo $result['request_user_message'];?></span>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                                        <?php echo $result['request_user_pno'];?>
                                        <span style="padding-left:50%;"><?php echo $result['request_user_email'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php }?>     
            </th>

        </thead>
  </table>

</form>

</div>

<?php require_once("footer.php");?>