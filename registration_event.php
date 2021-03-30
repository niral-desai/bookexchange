<?php
    date_default_timezone_set('Asia/Calcutta'); 
    //echo date("Y-m-d H:i:s");

    include 'connection/connection.php';
    connectdb();

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    if($dob!='')
        $newDate = date("Y-m-d", strtotime($dob));
    else
        $newDate='';

    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $zipcode=$_POST['zipcode'];
    $contact=$_POST['contact'];

    $password=$_POST['password'];

    $password_hash=md5($password);

    $sql = "Insert into user(firstname,lastname,email,username,gender,dob,password_hash,address1,address2,zipcode,contact_no,status) values ('".$firstname."','".$lastname."','".$email."','".$username."','".$gender."','".$newDate."','".$password_hash."','".$address1."','".$address2."','".$zipcode."','".$contact."','under_review');";

    $res=query($sql);
    header("Location: login.php");
    die();
?>
