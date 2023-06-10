<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();
    $latest_value=" ";

  if(isset($_POST['emp_dept_no'])){
    $dept_no=$_POST['emp_dept_no'];
    if($_POST['emp_dept_no']=='999')
        $filter="SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id";
    else
        $filter="SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id WHERE emp_dept_no=$dept_no";
  }else{
    if(isset($_POST['search_emp'])){
        $name=$_POST['search_emp'];
        $latest_value=$name;
        $filter="SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id WHERE emp_fname LIKE '$name%' OR emp_lname LIKE '$name%'  "; 
            
      }else{
        $filter="SELECT * FROM tbl_employee join tbl_department on emp_dept_no=dept_id ";    
     }
  }
  if(isset($_POST['checkbox_info'])){
      if(isset($_POST['add_emp_dept_no'])){
         $dept_no=$_POST['add_emp_dept_no'];
        foreach($_POST['checkbox_info'] as $checkboxValue){
            $statement = $con->prepare("UPDATE tbl_employee SET emp_dept_no=$dept_no WHERE emp_ssn=?");
            $statement->execute(array($checkboxValue));
        }
    }
  }



?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Veiw Employe</span></li>
            </ol>
          </nav>
        </div>
        
        <div style="margin-top:-2.5%;margin-left:78%;margin-right:10%;">
            <form action="" method="post" enctype="multipart/form-data">
                <select name="emp_dept_no" onchange="this.form.submit()">
                          <option value="">Select any of the Departments</option>
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
                              <option value="999">All Departments</option>

                </select>
            </form>
        </div>
      </header>

      <div style="margin-left:20px;padding-bottom:20px;">
        <form action="employe-veiw.php" method="post" enctype="multipart/form-data">
                    <label>Add To :</label>
                    <select name="add_emp_dept_no" onchange="this.form.submit()">
                        <option value="">Select any of the Departments</option>
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
                    <input type="search" name="search_emp" value="<?php if(isset($_POST['search_emp'])) echo $latest_value; ?>"placeholder="Search Employees..." onchange="this.form.submit()" style="margin-left:50%;"/>
    </div>


        <div class="container-fluid">
	            <table id="example1" class="table table-bordered table-hover table-fixed">
		    				<thead  style="background-color:rgb(48,60,84);color:white;" >
			    				<tr>
                                    <th width="10">Select</th>							
					    			<th width="30">SL.No</th>
						    		<th width="150px">Employe Name</th>
							    	<th width="20px">Department</th>
								    <th width="50px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $statement = $con->prepare($filter);
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    $i=1;
                                    foreach ($result as $row) {?>
                                        <tr>
                                            <td><input type="checkbox" name="checkbox_info[]" value="<?php echo $row['emp_ssn'];?>"></td>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <table>
                                                    <b><tr><?php echo $row['emp_fname']." ".$row['emp_lname']; ?></tr></b>
                                                    <th><img src="../dist//assets/img/avatars/<?php echo $row['emp_image']; ?>" style="width:100px;height:100px"></th>
                                                </table>    
                                            </td>
                                            <td><?php echo $row['dept_name']; ?></td>
                                            <td>

                                            <table>
                                                <tr>
                                                    <th style="padding-right:10px;">
                                                            <button type="submit" style="border:none;" ><a href="employe-info.php?ref_id=<?php echo $row['emp_ssn'];?>" class="btn  btn-info" >Veiw</a></button>
                                                    </th>
                                                    <th style="padding-right:10px;">
                                                            <button type="submit" style="border:none;"><a href="employee-edit.php?ref_id=<?php echo $row['emp_ssn'];?>" class="btn btn-success" >Edit</a></button>
                                                    </th>
                                                    <th style="padding-right:10px;">
                                                            <button type="submit" style="border:none;"><a href="employee-delete.php?ref_id=<?php echo $row['emp_ssn'];?>" class="btn btn-danger" >Delete</a></button>
                                                    </th>
                                                </tr>	
                                            </table>

                                            </td>
                                            <?php $i++; ?>
                                        </tr>
                                <?php }?>
                               

                            </tbody>
                 </table>
             </form>
        </div>

  </div>
<?php require_once("footer.php");?>