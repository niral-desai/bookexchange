<?php
$db = new mysqli('localhost', 'root', 'root', 'bookexchange');
$file = fopen("db.csv","r");
fgetcsv($file);
while(! feof($file))
{
    $fields=fgetcsv($file);
    $sql = "select * from State where state_name='".$fields[3]."';";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $state_id=$row['state_id'];

    $sql2 = "select * from City where city_name='".$fields[2]."' and state_id=".$state_id.";";
    $result = $db->query($sql2);
    if($result->num_rows == 0)
    {
        $sql3="Insert into City(city_name,state_id) values ('".$fields[2]."',".$state_id.");";
        $db->query($sql3);
        $result = $db->query($sql2);
    }
    $row = $result->fetch_assoc();
    $city_id=$row['city_id'];


    $rquery="Insert into Zipcode(zipcode,city_id) values('".$fields[0]."',".$city_id.");";
    $db->query($rquery);
}

fclose($file);
?>

