<?php
    
	session_start();
    if(!isset($_SESSION['userid']))
   {
    header("location:/bookexchange/login.php");
   }
   else
   {
    include 'connection.php';
    connectdb();

    $item_id=$_POST['item_id'];
	$url=$_POST['url'];
    
    $sql="delete from item where item_id='".$item_id."';";
    $result = query($sql);
	header('Location:'.$url);
    }

	
	
	
    
    
?>
