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
    
    $sql="update user SET status = 'active' where user_id='".$user_id."';";
    $result = query($sql);
	header('Location:'.$url);

    }

	

    
    
?>
