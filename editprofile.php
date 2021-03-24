<?php 
session_start();
include 'connection/connection.php';
connectdb();

$name=$_POST['id'];
$val=$_POST['value'];
$sql="update User set ".$name." = '".$val."' where user_id='".$_SESSION['userid']."' ;";
 $result = query($sql);
 
 echo $val;

 ?>