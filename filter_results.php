<?php
include 'connection/connection.php';
connectdb();
$sql="select * from Item,Category,User,Zipcode,City,ItemType where post_status='available' and Item.type_id=ItemType.type_id and Item.category_id=Category.category_id and Item.user_id=User.user_id and User.zipcode=Zipcode.zipcode and Zipcode.city_id=City.city_id";

foreach ($_GET as $key => $value) {
    if($key=='city')
    {
        if(empty($value))
            continue;
        $sql=$sql.' and city_name="'.$value.'"';
    }
    else
    {
        $fcnt=0;
        foreach($value as $v){
            if($fcnt==0)
                $sql=$sql.' and ('.$key.'="'.$v.'"';
            else
                $sql=$sql.' or '.$key.'="'.$v.'"';
            $fcnt+=1;
        }
        $sql=$sql.')';
    }

}
error_log($sql);
$res=query($sql);
$cnt=0;
while($row=$res->fetch_assoc())
{
    if($cnt%3==0)
    {
        echo '<div class="row shop_box-top">';
    }
    echo '<div class="col-md-3 shop_box" data-city="'.$row['city_name'].'" data-type="'.$row['type_name'].'" data-category="'.$row['category_name'].'" data-for="'.$row['availability_type'].'"><a href="single.php?id='.$row['item_id'].'"><div style="height:300px;overflow:hidden;">
    <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" style="width:100%;" alt=""/></div>
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
                $sql='select * from Wishlist where user_id='.$_SESSION['userid'].' and item_id='.$row['item_id'];
                $res2=query($sql);
                if($res2->num_rows>0)
                {
                    echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="added"><img src="images/wish2.png" alt=""/>Remove from Wishlist</a></li><div class="clear"> </div></ul>';
                }
                else
                {
                    echo '<ul class="add-to-links"><li><a href="#" class="wishlist" id="'.$row['item_id'].'" data-wish="not added"><img src="images/wish.png" alt=""/>Add to Wishlist</a></li><div class="clear"> </div></ul>';
                }
            }

            echo'</div>
        </a></div>';
        if($cnt%3==2)
        {
            echo '</div>';
        }
        $cnt=$cnt+1;
    }
    ?>
