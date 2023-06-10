<?php 
  require_once("header.php");
  require_once("connection.php");
  connect_db();

  $statement = $con->prepare("SELECT * FROM tbl_website_setting WHERE tbl_id=?");
  $statement->execute(array(1));
  $result = $statement->fetch(PDO::FETCH_ASSOC);


  if(isset($_POST['submit_header_head'])){
      $header_head = $_POST['header_head'];

    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_header_head = ? WHERE tbl_id=?");
    $statement->execute(array($header_head,1));

  }

  if(isset($_POST['submit_header_body'])){
    $header_head = $_POST['header_body'];

  $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_header_body = ? WHERE tbl_id=?");
  $statement->execute(array($header_head,1));

}

if(isset($_POST['submit_footer_head'])){
  $header_head = $_POST['footer_head'];

$statement = $con->prepare("UPDATE tbl_website_setting SET tbl_footer_head = ? WHERE tbl_id=?");
$statement->execute(array($header_head,1));

}

if(isset($_POST['submit_footer_body'])){
$header_head = $_POST['footer_body'];

$statement = $con->prepare("UPDATE tbl_website_setting SET tbl_footer_body = ? WHERE tbl_id=?");
$statement->execute(array($header_head,1));

}


  if(isset($_POST['slider'])){

      $val=$_POST['slider'];
      if($val=='Y'){
        $val=1;
      }else{
        $val=0;
      }
      $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_slider=?  WHERE tbl_id=? ");
      $statement->execute(array($val,1));
  }

  if(isset($_POST['about'])){

    $val=$_POST['about'];
    if($val=='Y'){
      $val=1;
    }else{
      $val=0;
    }
    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_about_us=?  WHERE tbl_id=? ");
    $statement->execute(array($val,1));  
  }

  if(isset($_POST['service'])){

    $val=$_POST['service'];
    if($val=='Y'){
      $val=1;
    }else{
      $val=0;
    }
    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_service=? WHERE tbl_id=?");
    $statement->execute(array($val,1));
  
  }

  if(isset($_POST['features'])){

    $val=$_POST['features'];
    if($val=='Y'){
      $val=1;
    }else{
      $val=0;
    }
    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_features=? WHERE tbl_id=?");
    $statement->execute(array($val,1));
  
  }

  if(isset($_POST['comments'])){

    $val=$_POST['comments'];
    if($val=='Y'){
      $val=1;
    }else{
      $val=0;
    }
    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_comments=? WHERE tbl_id=?");
    $statement->execute(array($val,1));
  
  }

  if(isset($_POST['blogs'])){

    $val=$_POST['blogs'];
    if($val=='Y'){
      $val=1;
    }else{
      $val=0;
    }
    $statement = $con->prepare("UPDATE tbl_website_setting SET tbl_blogs=? WHERE tbl_id=?");
    $statement->execute(array($val,1));
  
  }


?>

        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a class="nav-link" href="index.php"><span>Home</span></a>
              </li>
              <li class="breadcrumb-item active"><span>Website Settings</span></li>
            </ol>
          </nav>
        </div>
      </header>

      
      <div class="container-fluid">
      <form action="website_settings.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <iframe src="../header.php" height=210></iframe>
            <h3 align="center" style="color:rgb(48,60,84);margin-top:50px;margin-bottom:50px;">Header</h3>
                  <div class="col-6">
                    <h4 align="left" style="margin-left:50px;">
                      Header Head
                      <div style="margin-top:-7%;margin-left:65%;">
                                <button type="submit" style="border:none;background-color:rgb(48,60,84);padding:8px 8px;color:white;border-radius: 10px;" name="submit_header_head">Update</button>
                        </div>
                    </h4>
                        <textarea style="margin-left:50px;margin-top:20px;" cols=50% rows=10 name="header_head">
                          <?php echo $result['tbl_header_head'];?>
                        </textarea>


                  </div>
                  <div class="col-4">
                    <h4 align="left" style="margin-left:50px;">Header Body
                        <div style="margin-top:-12%;margin-left:100%;">
                          <input type="submit" style="border:none;background-color:rgb(48,60,84);padding:8px 8px;color:white;border-radius: 10px;" name="submit_header_body" value="Update">
                        </div>
                    </h4>
                        <textarea  style="margin-left:50px;margin-top:20px;" cols=50% rows=10 name="header_body">
                          <?php echo $result['tbl_header_body'];?>
                        </textarea>
                  </div>
                  
          </div>

          <div class="row" style="margin-top:100px;">
            <iframe src="../footer.php" height=500></iframe>
            <h3 align="center" style="color:rgb(48,60,84);margin-top:50px;margin-bottom:50px;">Footer</h3>
                    <div class="col-6">
                        <h4 align="left" style="margin-left:50px;">
                          Footer Head
                          <div style="margin-top:-7%;margin-left:65%;">
                            <input type="submit" style="border:none;background-color:rgb(48,60,84);padding:8px 8px;color:white;border-radius: 10px;" name="submit_footer_head" value="Update">
                          </div>
                        </h4>
                            <textarea  style="margin-left:50px;margin-top:20px;" cols=50% rows=10 name="footer_head">
                            <?php echo $result['tbl_footer_head'];?>
                            </textarea>  
                    </div>

                    <div class="col-4">
                        <h4 align="left" style="margin-left:50px;">
                          Footer Body
                            <div style="margin-top:-12%;margin-left:100%;">
                              <input type="submit" style="border:none;background-color:rgb(48,60,84);padding:8px 8px;color:white;border-radius: 10px;" name="submit_footer_body" value="Update">
                            </div>
                        </h4>
                            <textarea  style="margin-left:50px;margin-top:20px;" cols=50% rows=10 name="footer_body">
                              <?php echo $result['tbl_footer_body'];?>
                            </textarea>
                  </div>
          </div>
      </form>

        <div class="row">
          <h2 align="center" style="margin-top:50px;margin-bottom:50px;">Control of Main Page</h2>
                <table id="example1" class="table table-bordered table-hover table-fixed">
                    <thead>
                      <tr>
                        <th width="50px">Select</th>
                        <th width="30">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <td>Slider</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="slider" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                      <tr>
                        <td>About Us</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="about" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                      <tr>
                        <td>Service</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="service" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                      <tr>
                        <td>Features</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="features" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                      <tr>
                        <td>Comments</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="comments" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                      <tr>
                        <td>Blogs</td>
                        <td>
                        <form action="website_settings.php" method="post" enctype="multipart/form-data">
                          <select name="blogs" onchange="this.form.submit()">
                              <option value=""  >Select Yes/No</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                        </form>
                        </td>
                      </tr>

                    </tbody>
                </table>
        </div>
      </div>

</div>
<?php require_once("footer.php");?>