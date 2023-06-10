<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();


  if(isset($_POST['delete_supplier'])){
    $supplier_id=$_POST['delete_supplier'];
    $list = explode(" ",$supplier_id);

    $statement = $con->prepare("DELETE FROM tbl_supplier WHERE supplier_id = ?");
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
              <li class="breadcrumb-item active"><span>Suppliers</span></li>
            </ol>
          </nav>
        </div>
        <div style="margin-top:-2.5%;margin-left:88%;">
                <button type="submit" class="btn btn-block" style="color:white;background-color:rgb(60,75,100);" ><a href="supplier-add.php" style="color:white;text-decoration:none;" >Add Supplier</a></button>
        </div>
    </header>

          <div class="card-body row text-center">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table border mb-0">
                        <thead class=" fw-semibold" style="background-color:rgb(48,60,84);color:white;">
                          
                          <tr class="align-middle">
                            <th class="text-center">
                                SL.No
                            </th>
                            <th>Supplier Name</th>
                            <th class="text-center">Mobile No</th>
                            <th>Address</th>
                            <th class="text-center">Managed By</th>
                            <th></th>
                          </tr>
                        </thead>

                        <tbody>

                        <?php 
                                $i=0;
                                $statement = $con->prepare("SELECT * FROM tbl_supplier join tbl_employee on mgr_ssn_supplier=emp_ssn");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                $i++;
                        ?>

                          <tr class="align-middle">
                            
                            <td class="text-center">
                              <div class="avatar avatar-md">
                                <span><?php echo $i; ?></span>
                              </div>
                            </td>

                            <td>
                              <div><?php echo $row['supplier_name']; ?></div>
                              <div class="small text-medium-emphasis">Registered: <?php echo $row['supplier_added_date']; ?></div>
                            </td>

                            <td class="text-center">
                              <?php echo $row['supplier_pno']; ?>
                            </td>

                            <td>
                              <?php echo $row['supplier_address']; ?>
                            </td>

                            <td class="text-center">
                              <?php echo $row['emp_fname']." ".$row['emp_lname']; ?>
                            </td>

                            <td>
                              <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                  </svg>
                                </button>
                                
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="supplier_transaction.php?ref_id=<?php echo $row['supplier_id']; ?>">Transactions</a>
                                  <button type="submit" class="dropdown-item text-danger" name="delete_supplier" value="<?php echo $row['supplier_id']." ".$row['supplier_pno']; ?>">Delete</button>
                                </div>

                              </div>
                            </td>

                          </tr>

                        <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- /.col-->
          <!-- /.row-->
          </div>


</div>
<?php require_once("footer.php");?>