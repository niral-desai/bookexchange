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

    $user_id=$_POST['user_id'];
	$url=$_POST['url'];
    
    $sql="delete from user where user_id='".$user_id."';";
    $result = query($sql);
	header('Location:'.$url);
    
    }

	
	
	
	
	
	
    
?>
