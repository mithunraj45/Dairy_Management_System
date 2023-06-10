<?php 

require_once("connection.php");
connect_db();


$statement = $con->prepare("SELECT * FROM tbl_record ORDER BY record_date DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
PRINT_r($result);


?>