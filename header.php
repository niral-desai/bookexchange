<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Rent-Sell-Ex | Online Book Exchange</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/fwslider.css" media="all">
<link rel="stylesheet" href="css/simple-sidebar.css" media="all">
<link rel="stylesheet" type="text/css" href="css/sdstyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/fwslider.js"></script>
<script src="js/jeditable.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
    $( "#search" ).autocomplete({
        source: 'autocomplete.php'
    });
});
</script>



<script type="text/javascript">
        $(document).ready(function() {



            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).php();
                $(".dropdown dt a span").php(text);
                $(".dropdown dd ul").hide();
                $("#result").php("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").php();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });

            $(".wishlist").click(function(e){
                var item_id=e.target.id;
                var type=$(e.target).attr('data-wish');
                console.log(type);
                if(type=='added')
                {
                  $.get('wishlist_action.php',{action:'remove',id:item_id}).done(function(){
                    console.log(item_id);
                    $('#'+item_id).find('img').attr('src','images/wish.png');
                    $('#'+item_id).get(0).lastChild.nodeValue = 'Add to Wishlist';
                    $('#'+item_id).attr('data-wish','not added');
                  });
                }
                else
                {
                  $.get('wishlist_action.php',{action:'add',id:item_id}).done(function(){
                    $('#'+item_id).find('img').attr('src','images/wish2.png');
                    $('#'+item_id).get(0).lastChild.nodeValue = 'Remove from Wishlist';
                    $('#'+item_id).attr('data-wish','added');
                  });
                }
                if(location.href.indexOf('wishlist')!=-1)
                  location.reload();
            });

             $( "#datepicker" ).datepicker();
             $("#zipcode").blur(function(){
               var zip=$('#zipcode').val();
               $.get("zipcode_ajax.php",{zipcode:zip}).done(function(data){
                 if(data!="NILL")
                 {
                   var array=data.split(',');
                   $('#city').val(array[0]);
                   $('#state').val(array[1]);
                   $('#country').val(array[2]);
                 }
                 else
                 {
                   $('#city').val('');
                   $('#state').val('');
                   $('#country').val('');
                 }
               });
             });

            allItems=$(".shop_box");
            visibleItems=allItems;
        });
     </script>
 </head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                 <div class="header-left">
                     <div class="logo">
                        <a href="index.php"><img src="images/logo.png" alt=""/></a>
                     </div>
                     <div class="menu">
                          <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
                            <ul class="nav" id="nav">
                              <li><a href="shop.php">Catalog</a></li>
                              <?php
								error_reporting(E_ERROR);
                                session_start();
                                if(!isset($_SESSION['userid']))
                                {
                                  echo '<li><a href="login.php">Login</a></li>';
                                }
                                else
                                {
                                  echo '<li><a href="user_profile.php">Profile</a></li>';
                                  echo '<li><a href="wishlist.php">Wishlist</a></li>';
                                  echo '<li><a href="listbooks.php">my posts</a></li>';
                                  echo '<li><a href="postbook.php">Post Item</a></li>';
                                  echo '<li><a href="logout.php">Log out</a></li>';
                                }
                              ?>
                              <div class="clear"></div>
                            </ul>
                            <script type="text/javascript" src="js/responsive-nav.js"></script>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="header_right">
                  <!-- start search-->
                   <div class="search-box ui-widget">
                            <div id="sb-search" class="sb-search">
                                <form action="search.php" method="GET">
                                  <label for="skills">Skills: </label>
                                    <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
                                    <input class="sb-search-submit" type="submit" value="">
                                    <span class="sb-icon-search"> </span>
                                </form>
                            </div>
                        </div>
                        <!----search-scripts---->
                        <script src="js/classie.js"></script>
                        <script src="js/uisearch.js"></script>
                        <script>
                            new UISearch( document.getElementById( 'sb-search' ) );
                        </script>
                <div class="clear"></div>
           </div>
          </div>
         </div>
        </div>
      </div>
