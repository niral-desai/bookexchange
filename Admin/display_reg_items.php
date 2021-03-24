<?php 
	session_start();
    if(!isset($_SESSION['userid']))
   {
    header("location:/bookexchange/login.php");
   }
   else
   {
    include 'header.php';


    include 'connection.php';
    connectdb();
	
	$sql = "select user_id,type_id, category_id, title, author, description, item_condition, availability_type from item where post_status ='available';";
	
	$itemsr_list = array();
	$result = query($sql);
	
    }

	
	
	
	
?>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
					<th class="table-header-repeat line-left minwidth-1"><a href="">Username</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Type</a></th>
					<th class="table-header-repeat line-left"><a href="">Category</a></th>
					<th class="table-header-repeat line-left"><a href="">Title</a></th>
					<th class="table-header-repeat line-left"><a href="">Author</a></th>
					<th class="table-header-options line-left"><a href="">Descrption</a></th>
					<th class="table-header-options line-left"><a href="">Item Condition</a></th>
					<th class="table-header-options line-left"><a href="">Availability</a></th>
					
				</tr>
				<?php if($result->num_rows != 0){
				while($row = $result->fetch_assoc()) {
						
						array_push($itemsr_list,array('user_id'=>$row['user_id'],'type_id'=>$row['type_id'],'category_id'=>$row['category_id'],'title'=>$row['title'],'author'=>$row['author'],'description'=>$row['description'],'item_condition'=>$row['item_condition'],'availability_type'=>$row['availability_type']));
						
						$sql1 = "select username from user where user_id ='".$row['user_id']."';";
						$sql2 = "select type_name from itemtype where type_id ='".$row['type_id']."';";
						$sql3 = "select category_name from category where category_id ='".$row['category_id']."';";
						$result1 = query($sql1);
						$result2 = query($sql2);
						$result3 = query($sql3);
						if($result1->num_rows != 0 ){
							$row1 = $result1->fetch_assoc();
							
						}
						
						if($result2->num_rows != 0 ){
							
							$row2 = $result2->fetch_assoc();
							
						}
						if($result3->num_rows != 0 ){
							
							$row3 = $result3->fetch_assoc();
						}
   
					echo "<tr>";
					
					echo"<td>".$row1['username']."</td>";
					echo"<td>".$row2['type_name']."</td>";
					echo"<td>".$row3['category_name']."</td>";
					echo"<td>".$row['title']."</td>";
					echo"<td>".$row['author']."</td>";
					echo"<td>".$row['description']."</td>";
					echo"<td>".$row['item_condition']."</td>";
					echo"<td>".$row['availability_type']."</td>";
					
					echo "</tr>";
					
					
				
				}
				}
				
				else{
					echo "<h1> No Items Found </h1>";
				}
					?>
				
				</table>
			
			
			</div>
			<!--  end content-table  -->
		
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
			
<?php
include 'footer.php';
?>
