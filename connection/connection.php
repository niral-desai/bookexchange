<?php
$db =null;

function connectdb()
{
	global $db;
	 $db = new mysqli('database-1.c23saagmlxov.us-east-1.rds.amazonaws.com', 'bookexchange', 'bookexchange', 'bookexchange-aws');
	 if (!$db) {
    	error_log("Connection failed: " . mysqli_connect_error());
    	die();
	}
 }

 function query($sql_query)
 {
 	global $db;
 	$res=$db->query($sql_query);
 	if(!$res){
 		error_log("Query Error: ".$db->error);
 	}
 	return $res;
 }



 ?>
