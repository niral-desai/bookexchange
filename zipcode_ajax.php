<?php
    include 'connection/connection.php';
    connectdb();
    $zipcode=$_GET['zipcode'];
    $sql="select city_id from Zipcode where zipcode='".$zipcode."';";
    $result=query($sql);
    if($result->num_rows==0)
    {
        echo 'NILL';
    }
    else
    {
        $row=$result->fetch_assoc();
        $city_id=$row['city_id'];
        $sql="select city_name,state_id from City where city_id='".$city_id."';";
        $result=query($sql);
        $row=$result->fetch_assoc();
        $city_name=$row['city_name'];
        $state_id=$row['state_id'];
        $sql="select state_name,country_id from State where state_id='".$state_id."';";
        $result=query($sql);
        $row=$result->fetch_assoc();
        $state_name=$row['state_name'];
        $country_id=$row['country_id'];
        $sql="select country_name from Country where country_id='".$country_id."';";
        $result=query($sql);
        $row=$result->fetch_assoc();
        $country_name=$row['country_name'];
        echo $city_name.",".$state_name.",".$country_name;
    }

?>
