<?php
	include 'header.php';
?>
     <div class="main">
      <div class="shop_top">
		<div class="container">
			<div class="row">
				<div class="col-md-9 single_left">
				   <div class="single_image">
					<?php
						include 'connection/connection.php';
						connectdb();
						$sql="select * from item where item_id=".$_GET['id'];
						$res=query($sql);
						$row=$res->fetch_assoc();
						echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" height="293" width="182" alt=""/>';
					?>
					</div>
				        <!-- end product_slider -->
				        <div class="single_right">
				        	<h3><?=$row['title'];?></h3>
				        	<p class="m_10"><?=$row['author'];?></p>
				        	<ul class="options">
								<h4 class="m_12">item Condition</h4>
								<li><a href="#"><?=$row['item_condition'];?></a></li>
							</ul>
				        	<ul class="options">
								<h4 class="m_12">Available for</h4>
								<li><a href="#"><?=$row['availability_type'];?></a></li>
								<div class="clear"> </div>
							</ul>
							<ul class="options">
								<h4 class="m_12">category</h4>
								<li><a href="#"><?php
									$category_id=$row['category_id'];
									$sql="select category_name from category where category_id=".$category_id;
									$res=query($sql);
									$row2=$res->fetch_assoc();
									echo $row2['category_name'];
								?></a></li>
								<div class="clear"> </div>
							</ul>
							<!-- <div class="btn_form">
							   <form>
								 <input type="submit" value="buy now" title="">
							  </form>
							</div> -->

							<div class="social_buttons">
								<button type="button" class="btn1 btn1-default1 btn1-twitter" onclick="">
					              <i class="icon-twitter"></i> Tweet
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-facebook" onclick="">
					              <i class="icon-facebook"></i> Share
					            </button>
					             <button type="button" class="btn1 btn1-default1 btn1-google" onclick="">
					              <i class="icon-google"></i> Google+
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-pinterest" onclick="">
					              <i class="icon-pinterest"></i> Pinterest
					            </button>
					        </div>
				        </div>
				        <div class="clear"> </div>
				</div>
				<div class="col-md-3">
				  <div class="box-info-product">
					<p class="price2">$<?=$row['price'];?></p>
					<?php
					if(isset($_SESSION['userid']))
                        {
                            $sql='select * from wishlist where user_id='.$_SESSION['userid'].' and item_id='.$row['item_id'];
                            $res2=query($sql);
                            if($res2->num_rows>0)
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="added"><img src="images/wish2.png"  alt=""/>Remove from wishlist</a></li><div class="clear"> </div></ul>';
                            }
                            else
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="not added"><img src="images/wish.png" alt=""/>Add to wishlist</a></li><div class="clear"> </div></ul>';
                            }
                        }
				   ?>
				   </div>
			   </div>
			</div>
			<div class="desc">
			   	<h4>Description</h4>
			   	<p><?=$row['description'];?></p>
			</div>
			<div class="desc">
			   	<h4>Contact</h4>
			   	<ul class="options">
								<?php
									$sql="select firstname,lastname, contact_no,address1,address2,user.zipcode,city_name,state_name from user, zipcode,city,state where user.zipcode=zipcode.zipcode and zipcode.city_id=city.city_id and city.state_id=state.state_id and user_id=".$row['user_id'];
									$res=query($sql);
									$row2=$res->fetch_assoc();
									echo '<li><h5>'.$row2['firstname'].' '.$row2['lastname'].'</h5></li><br/>';
									echo '<li><p>Contact: '.$row2['contact_no'].'</p></li><br/>';
									echo '<li>Address: '.$row2['address1'].', '.$row2['address2'].', '.$row2['city_name'].', '.$row2['state_name'].' '.$row2['zipcode'].'</li>';
								?>
								<div class="clear"> </div>
							</ul>
			</div>
			<?php
					$sql="select * from item where post_status='available' and category_id=".$row['category_id'];
					$res=query($sql);
					if($res->num_rows>0)
					{
						echo '<div class="row">
				<h4 class="m_11">Related Products in the same category</h4>';
						$cnt=0;
						while($row2=$res->fetch_assoc())
						{
							if($row2['item_id']==$row['item_id'])
								continue;
                            if($cnt>3)
								break;
                        echo '<div class="col-md-3 shop_box" data-city="'.$row2['city_name'].'" data-type="'.$row2['type_name'].'" data-category="'.$row2['category_name'].'" data-for="'.$row2['availability_type'].'"><a href="single.php?id='.$row2['item_id'].'"><div style="height:300px;overflow:hidden;">
                    <img src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'" style="width:100%" alt=""/></div>
                    <span class="new-box">';
                        if ($row2['item_condition']=='new')
                            echo '<span class="new-label">New</span>';
                        elseif($row2['item_condition']=='used')
                            echo '<span class="used-label">Used</span>';
                        else
                            echo '<span class="mint-label">Mint</span>';
                    echo '</span>
                    <span class="sale-box">
                        <span class="sale-label">'.$row2['availability_type'].'</span>
                    </span>
                    <div class="shop_desc">
                        <h3><a href="single.php?id='.$row2['item_id'].'">'.$row2['title'].'</a></h3>
                        <p>'.$row2['author'].'</p>
                        <span class="actual">$'.$row2['price'].'</span><br>';

                        if(isset($_SESSION['userid']))
                        {
                            $sql='select * from wishlist where user_id='.$_SESSION['userid'].' and item_id='.$row2['item_id'];
                            $res2=query($sql);
                            if($res2->num_row2s>0)
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row2['item_id'].'" data-wish="added"><img src="images/wish2.png" alt=""/>Remove from wishlist</a></li><div class="clear"> </div></ul>';
                            }
                            else
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row2['item_id'].'" data-wish="not added"><img src="images/wish.png" alt=""/>Add to wishlist</a></li><div class="clear"> </div></ul>';
                            }
                        }

                        echo'</div>
                    </a></div>';
 							$cnt+=1;
						}

					}

			?>
	     </div>
	   </div>
	  </div>
<?php
	include 'footer.php';
?>
