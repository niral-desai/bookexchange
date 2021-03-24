<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        header("location:login.php");
    }
    else
    {
        include 'connection/connection.php';
        connectdb();
        $userid=$_SESSION['userid'];
        $title=$_POST['title'];
        $author=$_POST['author'];
        $price=$_POST['price'];
        $desc=$_POST['description'];
        $date=getdate();
        $condition=$_POST['condition'];
        $category=$_POST['category'];
        $type=$_POST['type'];
        $availability=$_POST['availability'];

        $sql='select category_id from Category where category_name="'.$category.'";';
        $res=query($sql);
        $row=$res->fetch_assoc();
        $category_id=$row['category_id'];
        $sql='select type_id from ItemType where type_name="'.$type.'";';
        $res=query($sql);
        $row=$res->fetch_assoc();
        $type_id=$row['type_id'];
        $sql= "Insert into Item(user_id,category_id,type_id,title,author,price,description,post_date,post_status,item_condition,availability_type) values (".$userid.",".$category_id.",".$type_id.",\"".$title."\",\"".$author."\",".$price.",\"".$desc."\",\"".$date['year']."-".$date['mon']."-".$date['mday']."\",\"under_review\",\"".$condition."\",\"".$availability."\");";

        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $tmpName = $_FILES['image']['tmp_name'];
            $fp = fopen($tmpName, 'r');
            $data = fread($fp, filesize($tmpName));
            $data = addslashes($data);
            fclose($fp);
            $sql= "Insert into Item(user_id,category_id,type_id,title,author,price,description,post_date,post_status,item_condition,availability_type,image) values (".$userid.",".$category_id.",".$type_id.",\"".$title."\",\"".$author."\",".$price.",\"".$desc."\",\"".$date['year']."-".$date['mon']."-".$date['mday']."\",\"under_review\",\"".$condition."\",\"".$availability."\",\"$data\");";
        }

        query($sql);
        header("Location: user_profile.php");
    }
?>
