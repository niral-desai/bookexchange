<?php
    session_start();
    include 'connection/connection.php';
    connectdb();

    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select user_id, password_hash,status from User where email='".$email."' or username='".$email."';";
    $result = query($sql);
    if($result->num_rows == 0)
    {
        echo "No user found.";
    }
    else
    {
        $row = $result->fetch_assoc();
        $hash=$row['password_hash'];
        $status=$row['status'];
        $newhash=md5($password);
        if($newhash==$hash && $email != 'admin')
        {
            if($status=='active')
            {
                $_SESSION['userid']=$row['user_id'];
                header("Location: user_profile.php");
            }
            else
            {
                include "header.php";
                echo '<div class="container" style="margin-top:100px;"><h3>Your account has not been activated by website administrator. Please wait a while.</h3></div>';
                include "footer.php";
            }

        }
		else if($newhash == $hash && $email='admin' && $password='admin'){
			$_SESSION['userid']=$row['user_id'];
            header("Location: /bookexchange/Admin/index.php");
		}
        else
            echo '<?php include "header.php";?><h3>Wrong password.</h3><?php include "footer.php";>';
    }
?>
