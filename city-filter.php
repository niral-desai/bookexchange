<?php
	
		include 'connection/connection.php';
        connectdb();
        $term=$_GET['term'];
        $sql="select distinct city_name from Item,Category,User,Zipcode,City,ItemType where post_status='available' and Item.type_id=ItemType.type_id and Item.category_id=Category.category_id and Item.user_id=User.user_id and User.zipcode=Zipcode.zipcode and Zipcode.city_id=City.city_id and city_name like '%".$term."%'";
        $res=query($sql);
        $data=[];
        while ($row = $res->fetch_assoc()) {
        array_push($data,$row['city_name']);
    	}
    	
    	echo json_encode($data);
?>