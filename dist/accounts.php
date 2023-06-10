<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();


  if(isset($_POST['deactivate'])){
    $val=$_POST['deactivate'];
    $statement = $con->prepare("UPDATE tbl_login SET login_status = ? WHERE login_id = ? ");
    $statement->execute(array("Inactive",$val));
  }

  if(isset($_POST['activate'])){
    $val=$_POST['activate'];
    $statement = $con->prepare("UPDATE tbl_login SET login_status = ? WHERE login_id = ? ");
    $statement->execute(array("Active",$val));
  }

  if(isset($_POST['multiplt_delete'])){
    if(isset($_POST['delete_mul'])){
      foreach($_POST['multiplt_delete'] as $checkboxValue){
          $statement = $con->prepare("DELETE FROM tbl_login WHERE login_id = ? ");
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
              <li class="breadcrumb-item active"><span>Accounts</span></li>
            </ol>
          </nav>
        </div>

    </header>

    <div class="container-fluid" style="background-color:white;">
            <div class="row">
                <form  action="" method="post" enctype="multipart/form-data">
                    <h2 align="left" style="margin-top:20px;">
                        Account Login
                        <input type="submit" name="delete_mul" class="btn btn-danger" style="margin-left:70%;" value="Delete">
                    </h2>
                      <table class="table table-bordered table-hover" style="margin-top:20px;">
                              <thead style="background-color:rgb(48,60,84);color:white;">
                                  <th>Select</th>
                                  <th>Sl No</th>
                                  <th>Type</th>
                                  <th>Email</th>
                                  <th>Action</th>

                              </thead>
                              <?php
                                      $i=0;
                                      $statement = $con->prepare("SELECT * FROM tbl_login WHERE login_id != ? ");
                                      $statement->execute(array(2));
                                      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                      foreach ($result as $row) {
                                      $i++;
                                ?>
                              <tbody>
                                <tr>
                                    <td><input type="checkbox" name="multiplt_delete[]" value="<?php echo $row['login_id']; ?>"></td>
                                    <td><?php  echo $i; ?></td>
                                    <td><?php echo $row['login_role']; ?></td>
                                    <td><?php echo $row['login_user_email']; ?></td>
                                    <td>
                                        <?php if($row['login_status']=="Active"){?>
                                            <button type="submit" name="deactivate" value="<?php echo $row['login_id'];?>" class="btn btn-danger" style="border:none;padding:8px 8px;border-radius:10px;color:black;">Deactivate</button>

                                        <?php }else{ ?>

                                            <button type="submit" name="activate" value="<?php echo $row['login_id'];?>" class="btn btn-success" style="border:none;padding:8px 8px;border-radius:10px;color:black;">Activate</button>

                                        <?php } ?>
                                    </td>
                                </tr>
                              </tbody>
                              <?php } ?> 
                    </table>
                </form>
            </div>
    </div>



</div>
<?php require_once("footer.php");?>