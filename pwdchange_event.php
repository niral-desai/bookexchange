<?php 
session_start();
include 'connection/connection.php';
connectdb();


$password_hash=md5($_POST['new']);
$oldpass = md5($_POST['old']);

$sql="update User set password_hash = '".$password_hash."' where user_id='".$_SESSION['userid']."' and password_hash='".$oldpass."'";
$result = query($sql);
if(mysqli_affected_rows($db)>0){
header("Location: user_profile.php?message=Password change successfully.");
}
else{
header("Location: user_profile.php?message=Sorry.!!Old password doesnt match!!");
}
 ?>}
