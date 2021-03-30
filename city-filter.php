<?php
	
		include 'connection/connection.php';
        connectdb();
        $term=$_GET['term'];
        $sql="select distinct city_name from item,category,user,zipcode,city,itemtype where post_status='available' and item.type_id=itemtype.type_id and item.category_id=category.category_id and item.user_id=user.user_id and user.zipcode=zipcode.zipcode and zipcode.city_id=city.city_id and city_name like '%".$term."%'";
        $res=query($sql);
        $data=[];
        while ($row = $res->fetch_assoc()) {
        array_push($data,$row['city_name']);
    	}
    	
    	echo json_encode($data);
?>