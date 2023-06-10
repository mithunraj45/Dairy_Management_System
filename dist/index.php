<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

  $today=date('Y-m-d');

  $statement = $con->prepare("SELECT COUNT(emp_ssn) AS total_emp FROM tbl_employee");
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  
  $statement = $con->prepare("SELECT COUNT(store_id) AS total_store FROM tbl_store");
  $statement->execute();
  $result1 = $statement->fetch(PDO::FETCH_ASSOC);

  $statement = $con->prepare("SELECT COUNT(supplier_id) AS total_supplier FROM tbl_supplier");
  $statement->execute();
  $result2 = $statement->fetch(PDO::FETCH_ASSOC);

  $statement = $con->prepare("SELECT daily_quantity FROM tbl_record WHERE record_date='$today' ");
  $statement->execute();
  $result3 = $statement->fetch(PDO::FETCH_ASSOC);

  $statement = $con->prepare("SELECT cost_store,cost_supplier FROM tbl_website_setting WHERE tbl_id=1 ");
  $statement->execute();
  $result4 = $statement->fetch(PDO::FETCH_ASSOC);


  if(isset($_POST['cost_supplier'])){

    $cost=$_POST['cost_supplier'];

    $statement = $con->prepare("UPDATE  tbl_website_setting  SET cost_supplier=$cost WHERE tbl_id=1 ");
    $statement->execute();

  }

  if(isset($_POST['cost_store'])){

    $cost=$_POST['cost_store'];

    $statement = $con->prepare("UPDATE  tbl_website_setting  SET cost_store=$cost WHERE tbl_id=1 ");
    $statement->execute();

  }

?>
  
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
      </header>

      <div class="row">
      <form action="" method="post">
          <div class="col-sm-5" style="margin-left:3%">
                <label>Supplier Cost:
                  <input type="text" value="<?php if(isset($_POST['cost_supplier']))  echo $_POST['cost_supplier'];  else echo $result4['cost_supplier']; ?>" name="cost_supplier" onchange="this.form.submit()">
                </label>
          </div>
          <br><br>
          <div class="col" style="margin-top:-7.1%;margin-left:72%;">
                <label>Store   Cost:
                  <input type="text" value="<?php if(isset($_POST['cost_store']))  echo $_POST['cost_store'];  else echo $result4['cost_store']; ?>" name="cost_store"  onchange="this.form.submit()">
                </label>
          </div>
      </form>
      </div>
<br>

      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">
            <div class="col-sm-6 col-lg-4">
              <div class="card mb-1 text-white " style="background-color:rgb(48,60,84);">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">
                        Total no of Employees
                    </div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <span class=  ""><?php echo $result['total_emp']; ?></span>
                  <button type="submit"  style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="employe-veiw.php" class="btn btn-danger text-white" >Veiw</a></button>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-4">
              <div class="card mb-1 text-white " style="background-color:rgb(48,60,84);">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">
                        Total no of Stores
                    </div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <span class=  ""><?php echo $result1['total_store']; ?></span>
                  <button type="submit"  style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="stores.php" class="btn btn-danger text-white" >Veiw</a></button>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-4">
              <div class="card mb-1 text-white "style="background-color:rgb(48,60,84);">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">
                        Total no of Suppliers
                    </div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <span class=  ""><?php echo $result2['total_supplier']; ?></span>
                  <button type="submit"  style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="suppliers.php" class="btn btn-danger text-white" >Veiw</a></button>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>

          <table id="example1" class="table table-bordered table-hover table-fixed">
                                <thead  style="background-color:rgb(48,60,84);color:white;" >
                                <br><br>
                                        <tr>
                                            <th width="30">SL.No</th>
                                            <th width="50px">Store Name</th>
                                            <th width="20px">Quantity</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $statement = $con->prepare("SELECT * FROM tbl_store_transaction JOIN tbl_store on tbl_store_transaction.store_id=tbl_store.store_id WHERE trans_date = '$today'");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            $i=1;
                                            foreach ($result as $row) {?>
                                                <tr>

                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row['store_name']; ?> </td>

                                                    <td><?php echo $row['milk_quantity']; ?></td>

                                    <?php $i++; }?>                
                                </tbody>
          </table>
      </div>

<?php require_once("footer.php");?>