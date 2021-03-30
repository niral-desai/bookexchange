<?php
	
		include 'connection/connection.php';
        connectdb();
        $term=$_GET['term'];
        $sql="select distinct title from item where post_status='available' and (title like '%".$term."%') ORDER BY title ASC";
        $res=query($sql);
        $data=[];
        while ($row = $res->fetch_assoc()) {
        array_push($data,$row['title']);
    	}
    	
        $sql="select distinct author from item where post_status='available' and (author like '%".$term."%') ORDER BY author ASC";
        $res=query($sql);
        while ($row = $res->fetch_assoc()) {
        array_push($data,$row['author']);
    	}
    	echo json_encode($data);
?>