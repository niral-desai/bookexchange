<?php
    include 'header.php';
?>


     <div class="main">
     <div class="row">

      <div class="shop_top">
        <div class="container" id="main-container">
            <?php
                include 'connection/connection.php';
                connectdb();
                $term=$_GET['search'];
                $sql="select * from item where post_status='available' and (title like '%".$term."%' or description like '%".$term."%' or author like '%".$term."%')";
                $res=query($sql);
                    $cnt=0;
                    while($row=$res->fetch_assoc())
                    {
                        if($cnt%4==0)
                        {
                            echo '<div class="row shop_box-top">';
                        }
                        echo '<div class="col-md-3 shop_box"><a href="single.php?id='.$row['item_id'].'"><div style="height:300px;overflow:hidden;">
                    <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" style="width:100%" alt=""/></div>
                    <span class="new-box">';
                        if ($row['item_condition']=='new')
                            echo '<span class="new-label">New</span>';
                        elseif($row['item_condition']=='used')
                            echo '<span class="used-label">Used</span>';
                        else
                            echo '<span class="mint-label">Mint</span>';
                    echo '</span>
                    <span class="sale-box">
                        <span class="sale-label">'.$row['availability_type'].'</span>
                    </span>
                    <div class="shop_desc">
                        <h3><a href="single.php?id='.$row['item_id'].'">'.$row['title'].'</a></h3>
                        <p>'.$row['author'].'</p>
                        <span class="actual">$'.$row['price'].'</span><br>';

                        if(isset($_SESSION['userid']))
                        {
                            $sql='select * from wishlist where user_id='.$_SESSION['userid'].' and item_id='.$row['item_id'];
                            $res2=query($sql);
                            if($res2->num_rows>0)
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="added"><img src="images/wish2.png" alt=""/>Remove from wishlist</a></li><div class="clear"> </div></ul>';
                            }
                            else
                            {
                                echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="not added"><img src="images/wish.png" alt=""/>Add to wishlist</a></li><div class="clear"> </div></ul>';
                            }
                        }

                        echo'</div>
                    </a></div>';
                    if($cnt%4==3)
                    {
                        echo '</div>';
                    }
                    $cnt=$cnt+1;
                }
            ?>
         </div>
       </div>
    </div>

</div>
<?php
    include 'footer.php';
?>
