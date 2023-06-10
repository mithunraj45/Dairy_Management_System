<?php

require_once("connection.php");
connect_db();

$statement = $con->prepare("SELECT * FROM tbl_website_setting WHERE tbl_id=?");
$statement->execute(array(1));
$result = $statement->fetch(PDO::FETCH_ASSOC);

$header_head = $result['tbl_header_head'];
$header_body =  $result['tbl_header_body'];

$header_head = preg_replace('/(<pre>)/i ',' ',$header_head);
$header_body = preg_replace('/(<pre>)/i ',' ',$header_body);

// $header_head = preg_replace(' <pre> ',' ',$header_head);
// $header_body = preg_replace(' <pre>',' ',$header_body);

echo $header_head;
 echo $header_body;



?>

