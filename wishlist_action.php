<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        header("location:login.php");
    }
    else
    {
        include 'connection/connection.php';
        connectdb();
        $action=$_GET['action'];
        $userid=$_SESSION['userid'];
        $itemid=$_GET['id'];
        if($action=='add')
        {
            $sql='insert into Wishlist(item_id,user_id) values('.$itemid.','.$userid.');';
            query($sql);
        }
        else
        {
            $sql='delete from Wishlist where item_id='.$itemid.' and user_id='.$userid.';';
            query($sql);
        }
    }
?>
