<?php
session_start();
    if(!isset($_SESSION['userid']))
   {
    header("location:login.php");
   }
   else
   {
        include 'header.php';
   }
?>
    <div class="main">
      <div class="shop_top">
         <div class="container">
                        <form enctype="multipart/form-data" action="postbook_event.php" id="register_form" method="POST">
                                <div class="register-top-grid">
                                        <h3>ITEM INFORMATION</h3><hr style="margin-top:1px;margin-bottom:20px">
                                        <div class="top">
                                            <span>Title<label>*</label></span>
                                            <input name="title" type="text" required>
                                        </div>
                                        <div class="top">
                                            <span>Author<label>*</label></span>
                                            <input name="author" type="text" required>
                                        </div>
                                        <div class="top">
                                            <span>Price<label>*</label></span>
                                            <input name="price" style="border: 2px solid #EEE; outline-color: #00BFF0; width: 96%; font-size: 1em; padding: 0.5em; font-family: 'Open Sans', sans-serif;" type="number" required>
                                        </div>
                                        <div class="top">
                                            <span>Description<label>*</label></span>
                                            <input name="description" type="text" required>
                                        </div>
                                        <div class="top">
                                            <span>Condition</span>
                                            <select name="condition" id="condition" required>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Mint</option>
                                            </select>
                                        </div>
                                        <div class="top">
                                            <span>Category</span>
                                            <select name="category" id="category" required>
                                            <?php
                                                include 'connection/connection.php';
                                                connectdb();
                                                $sql="SELECT category_name from Category;";
                                                $res=query($sql);
                                                while($row=$res->fetch_assoc())
                                                {
                                                    echo "<option>".$row['category_name']."</option>";
                                                }

                                            ?>
                                            </select>
                                        </div>
                                        <div class="top">
                                            <span>Type</span>
                                            <select name="type" id="type" required>
                                            <?php
                                                $sql="SELECT type_name from ItemType;";
                                                $res=query($sql);
                                                while($row=$res->fetch_assoc())
                                                {
                                                    echo "<option>".$row['type_name']."</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="top">
                                            <span>Available for:</span>
                                            <select name="availability" id="availability" required>
                                                <option>Rent</option>
                                                <option>Sell</option>
                                                <option>Exchange</option>
                                            </select>
                                        </div>
                                        <div class="top">
                                            <span>Image<label>*</label></span>
                                            <input name="image" type="file" accept="image/jpeg" required>
                                        </div>
                                        <div class="clear"> </div>
                                </div>
                                <div class="clear"> </div>
                                <input type="submit" value="submit">
                        </form>
                    </div>
           </div>
      </div>

<?
    include 'footer.php';
?>
