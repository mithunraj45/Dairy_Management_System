<?php


ob_start();
require_once('header.php');
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
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}

    $statement = $con->prepare("SELECT * FROM tbl_employee WHERE emp_ssn=?");
    $statement->execute(array($_REQUEST['ref_id']));
    $row = $statement->fetch(PDO::FETCH_ASSOC);							
        $p_featured_photo = $row['emp_image'];
        unlink('assets/img/avatars/'.$p_featured_photo);

	if($row['emp_dept_no']==8){
		$statement = $con->prepare("DELETE FROM tbl_login WHERE login_user_email = ?");
		$statement->execute(array($row['emp_email']));
	}	

    $statement = $con->prepare("DELETE FROM tbl_employee WHERE emp_ssn=?");
    $statement->execute(array($_REQUEST['ref_id']));

    header('location: employe-veiw.php');


}

ob_end_flush();
?>