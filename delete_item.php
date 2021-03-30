<?php
    include 'connection/connection.php';
    connectdb();
    $sql='Update item set post_status="unavailable" where item_id='.$_POST['itemid'];
    $res=query($sql);
    echo $res;
?>
