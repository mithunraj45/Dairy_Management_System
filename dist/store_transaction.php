<?php 
  ob_start();

  require_once("header.php");
  require_once("connection.php");
  connect_db();

  if(!isset($_REQUEST['ref_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $con->prepare("SELECT * FROM tbl_store WHERE store_id=?");
	$statement->execute(array($_REQUEST['ref_id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}

}

$statement = $con->prepare("SELECT cost_store FROM tbl_website_setting WHERE tbl_id=1 ");
$statement->execute();
$result4 = $statement->fetch(PDO::FETCH_ASSOC);

$latest_value=" ";
$store_id=$_REQUEST['ref_id'];
$statement = $con->prepare("SELECT * FROM tbl_store WHERE store_id = ? ");
$statement->execute(array($store_id));
$result = $statement->fetch(PDO::FETCH_ASSOC);
$store_name = $result['store_name'];

if(isset($_POST['sort_date'])){

  $latest_value =  $_POST['sort_date'];

  $requested_month=$_POST['sort_date'];
  $requested_month_date=$requested_month."-01";
  $end_month=$requested_month."-31";
 
   $sort_date="  SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE (trans_date BETWEEN '$requested_month_date' AND '$end_month' ) AND store_id=? AND store_verification =? AND delivered_emp_verification =?  AND approved=? ";
 
 }else{
   $sort_date=" SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE store_id=? AND store_verification =? AND delivered_emp_verification =? AND approved=? ";
 }

 if(isset($_POST['clear'])){
  $latest_value=" ";
  $sort_date=" SELECT * FROM tbl_store_transaction join tbl_employee on emp_ssn=deliverd_emp_ssn WHERE store_id=? AND store_verification =? AND delivered_emp_verification =?  AND approved=? ";
}

 
  ?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Store Transactions</span></li>
            </ol>
          </nav>
        </div>

        <div style="margin-top:-2.5%;margin-left:90%;">
                <button type="submit" style="border:none;background-color:rgb(48,60,84);font-color:white;border-radius: 10px;"><a href="stores.php" class="btn text-white" >Veiw All</a></button>
        </div>

      </header>



            <h1 align="center" style="margin-top:10px;" class="print-container"><?php  echo $store_name; ?></h1>
            <form action="" method="post" enctype="multipart/form-data">
                <h3 align="left" style="margin-left:50px;" >Transaction
                   <span style="padding-left:50%; font-size:22px;"> 
                      <input type="month" class="print-container" name="sort_date" value="<?php echo $latest_value; ?>" onchange="this.form.submit()">
                      <input type="submit"  style="background-color:rgb(48,60,84);color:white;border:none;padding:8px 8px;border-radius:10px;" value="Clear" name="clear" onchange="this.form.submit()">
                      <button onclick="window.print()" style="background-color:rgb(48,60,84);color:white;border:none;padding:8px 8px;border-radius:10px;">Print</button>
  
                  </span>
                </h3>
                
            </form>

            <style>
              @media print{
                body *{
                  visibility:hidden;
                }

                .print-container, .print-container *{
                  visibility:visible;
                  size:A4;
                  
                }
              }
          </style>


                <table class="table table-bordered table-hover print-container" style="margin-top:20px;">
                    <thead style="background-color:rgb(48,60,84);color:white;">
                        
                            <th>Sl No</th>
                            <th>Delivered Employee</th>
                            <th>Date</th>
                            <th>Milk Quantity</th>
                        
                    </thead>  
                    <?php
                            $i=0;
                            $total_cost=0;
                            $statement = $con->prepare($sort_date);
                            $statement->execute(array($store_id,1,1,1));
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                            $i++;
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['emp_fname']." ".$row['emp_lname']; ?></td>
                            <td><?php echo $row['trans_date'];?></td>
                            <td><?php echo $row['milk_quantity']; $total_cost = $total_cost + $row['milk_quantity']*$result4['cost_store']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <h3 style="margin-left:70%;" >---------------------<br><span class="print-container">Total Cost : <?php echo $total_cost; ?></span></h3>

    </div>
            

</div>
<?php 
ob_end_flush();
require_once("footer.php");
?>