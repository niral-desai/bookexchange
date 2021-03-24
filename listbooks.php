<?php
include 'header.php';
?>
<div class="main">
  <div class="shop_top">
    <div class="container">
        <?php
            include 'connection/connection.php';
            connectdb();
            $sql="select * from Item where post_status="available" user_id=".$_SESSION['userid'];
            $res=query($sql);
            $cnt=0;
            while($row=$res->fetch_assoc())
            {
                if($cnt%4==0)
                {
                    echo '<div class="row shop_box-top">';
                }
                echo '<div class="col-md-3 shop_box"><a href="single.php?id='.$row['item_id'].'"><div style="height:300px;overflow:hidden;">
                <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"  width="100%;" alt=""/></div>
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
                        <span class="actual">$'.$row['price'].'</span><br>
                        <ul class="add-to-links">
                            <li class="delete" id="'.$row['item_id'].'""><a href="#" id="'.$row['item_id'].'">Delete this post</a></li>
                            <div class="clear"> </div>
                        </ul>
                    </div>
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
<script type="text/javascript">
$(".delete").click(function(data){
    console.log(data.target.id);
    $.post("delete_item.php",{itemid : data.target.id}).done(function(data2){
        if(data2=='1'){
            location.reload();
        }
    });
});
</script>
<?php
include 'footer.php';
?>
