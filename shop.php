<?php
    include 'header.php';
?>
     <div class="main">
     <div class="row">
     <div class="col-sm-3 toppadd" >
         <div class="row  panel">
             <div class="col-md-12 well ">
                <p class="panelFontsize">Find books in your city:</p>
                <br/>
                <div class="col-md-12 ui-widget" style="font-size:12px;font-family: 'Open Sans', sans-serif;" >
                    <input id="city-filter" class="innerFont filter" type="text" placeholder="Select city"/>

                </div>

            </div>
             <div class="col-md-12 well">
                <p class="panelFontsize">Looking For:</p>
                <br/>
                <?php
                    include 'connection/connection.php';
                    connectdb();
                    $sql="select type_name from ItemType";
                    $res=query($sql);
                    while($row=$res->fetch_assoc())
                    {
                        echo '<div class="col-md-12 "><input type="checkbox" class="filter" data-type="type_name" id="'.$row['type_name'].'" name="'.$row['type_name'].'" value="1">&nbsp;<text class="innerFont">'.$row['type_name'].'</text></div>';
                    }
                ?>

            </div>
             <div class="col-md-12 well">
                <p class="panelFontsize">Posted On:</p>
                <br/>
                <div class="col-md-12 ">
                    <input class="filter" type="checkbox"  id="sell" data-type="availability_type" name="Book" value="1">&nbsp;<text class="innerFont">Sell</text>
                </div>
                <div class="col-md-12">
                    <input class="filter" type="checkbox" id="rent" data-type="availability_type" class="space" name="Book" value="1">&nbsp;<text class="innerFont">Rent</text>
                </div>
                <div class="col-md-12">
                    <input class="filter" type="checkbox" id="exchange" data-type="availability_type" class="space" name="Book" value="1">&nbsp;<text class="innerFont">Exchange</text>
                </div>
            </div>
             <div class="col-md-12 well">
                <p class="panelFontsize">Filter by Catagory:</p>
                <br/>
                <?php
                    $sql="select category_name from Category";
                    $res=query($sql);
                    while($row=$res->fetch_assoc())
                    {
                        echo '<div class="col-md-12 "><input class="filter" type="checkbox" data-type="category_name" id="'.$row['category_name'].'" class="space" name="'.$row['category_name'].'" value="1">&nbsp;<text class="innerFont">'.$row['category_name'].'</text></div>';
                    }
                ?>
            </div>
         </div>
     </div>

    <script type="text/javascript">

          $( "#city-filter" ).autocomplete({
                source: 'city-filter.php'
            });


        $(".filter").change(function(){
            var myobj=new Object();
            myobj.city=$('#city-filter').val();
            $("input:checkbox.filter").each(function(){
                if(this.checked){
                    if (typeof myobj[$(this).attr('data-type')] !== 'undefined')
                        myobj[$(this).attr('data-type')].push($(this).attr('id'));
                    else
                        myobj[$(this).attr('data-type')]=[$(this).attr('id')];
                }
            });
            $.get('filter_results.php',myobj).done(function(data){
                if(data=="")
                    $('#main-container').get(0).innerHTML="<p>No items found.</p>";
                else
                    $('#main-container').get(0).innerHTML=data;
            });
        });
    </script>

      <div class="shop_top col-md-8">
        <div class="container" id="main-container">
            <?php
                $sql="select * from Item,Category,User,Zipcode,City,ItemType where post_status='available' and Item.type_id=ItemType.type_id and Item.category_id=Category.category_id and Item.user_id=User.user_id and User.zipcode=Zipcode.zipcode and Zipcode.city_id=City.city_id";
                $res=query($sql);
                    $cnt=0;
                    while($row=$res->fetch_assoc())
                    {
                        if($cnt%3==0)
                        {
                            echo '<div class="row shop_box-top">';
                        }
                        echo '<div class="col-md-3 shop_box" data-city="'.$row['city_name'].'" data-type="'.$row['type_name'].'" data-category="'.$row['category_name'].'" data-for="'.$row['availability_type'].'"><a href="single.php?id='.$row['item_id'].'"><div style="height:300px;overflow:hidden;">
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
         </div>
       </div>
    </div>
</div>
<?php
    include 'footer.php';
?>
