<?php 
  require_once("header.php");
  require_once("connection.php");
  $today=date('Y-m-d');
  $bg_color=array("--cui-card-cap-bg:rgb(90,185,193)","--cui-card-cap-bg:rgb(200,220,100)","--cui-card-cap-bg:rgb(60,60,60)","--cui-card-cap-bg:rgb(136,136,136)","--cui-card-cap-bg:rgb(71,122,169)","--cui-card-cap-bg:rgb(48,60,84)");

  connect_db();
  

  if(isset($_POST['status_button'])){
    $report_id = $_POST['status_button'];
    $statement = $con->prepare("UPDATE tbl_report SET report_status = ? WHERE report_id=?");
    $statement->execute(array(1,$report_id));
  }

?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Report</span></li>
            </ol>
          </nav>
        </div>
    </header>

    <div class="container-fluid" style="background-color:white;">
            <div class="row">
                <form  action="" method="post" enctype="multipart/form-data">
                  <h2 align="center" style="margin-top:20px;margin-bottom:20px;">
                    REPORT
                  </h2>
                  <?php
                                    $i=0;
                                    $statement = $con->prepare("SELECT * FROM tbl_report WHERE report_status=?");
                                    $statement->execute(array(0));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    $i++;
                            ?>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4 ">
                            <div class="card mb-4 text-white " style="background-color:rgb(60,75,100)">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        <?php echo $row['report_name'];?> 
                                            <span class="fs-6 fw-normal">(<?php echo $row['report_added'];?>)</span>
                                            <span class="fw-normal fs-6">
                                              <button type="submit" name="status_button" class="btn btn-danger" style="color:White;margin-top:-1%;" value="<?php echo $row['report_id']; ?>" >Veiwed</button></span>
                                    </div>
                                </div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <span class=""><?php echo $row['report_information'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
                
                </form>    
            </div>
    </div>
</div>
<?php require_once("footer.php");?>