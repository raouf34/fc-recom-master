       <?php
            session_start();
            include_once("/connect/connection.php");
                if (isset($_SESSION['email'])){
                   $email = $_SESSION['email'] ;
                                 
                   $r= mysqli_query($connect, "SELECT * FROM client WHERE email = '$email' ");
                    $l=mysqli_fetch_assoc($r);
                    $clientID = $l['clientID'] ;
                  $sql2 = mysqli_query($connect, "SELECT * FROM favourite WHERE clientID = '$clientID' ");
                  $cpt = mysqli_num_rows($sql2) ;
                  $fav = array() ;
                  if ($cpt > 0 ){
                    $i = 0;
                    while ( $mk = mysqli_fetch_assoc($sql2)){
                      $fav[$i] = $mk['hotelID'] ;
                      $i = $i + 1 ;
                    }
                  }
                  $len = count($fav) ;
                  
                  }
       
        if($_GET){
        
         $city=$_GET['search_booking'] ;
         $date = $_GET['check_in'];
         $date2 = $_GET['check_out'] ;
         $child = (float)$_GET['children'] ; 
         $adult = (float)$_GET['adults'] ;
         $d1 = strtotime($date) ;
         $d2 = strtotime($date2) ;
         $diff = $d2 - $d1 ;
         $nbr_days = abs(floor($diff /(60 * 60 * 24))) ;

         $k=mysqli_query($connect, "SELECT * FROM hotel WHERE (`location_hotel` LIKE '%".$city."%')");
         while ($row = mysqli_fetch_assoc($k)) {
            $id = $row['hotelID'] ;
            $price = $nbr_days * (($child * $row['price_children']) + ($adult * $row['price_adults'])) ;
            $sql = "UPDATE `hotel` SET `total` = '$price' WHERE `hotel`.`hotelID` = '$id'";
            $resu=mysqli_query($connect,$sql) ;
         }
         $ord = mysqli_query($connect, "SELECT * FROM hotel WHERE (`location_hotel` LIKE '%".$city."%') ORDER BY total ASC ");
         $countHotel=mysqli_num_rows($k); 

       }
          ?>
        <!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="hotel, bed and breakfast, accommodations, travel, motel">
    <meta name="description" content="FC Recom - Hotel and Bed&amp;Breakfast">
    <meta name="author" content="Ansonika">
    <title>DZ BOOKINg - Compare the prices of hotels around the world</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- SPECIFIC CSS -->
    <link rel="stylesheet" type="text/css" href="css/DateTimePicker.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">

 

    <!-- modal login form css -->
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
<script>
  $(document).ready(function(){

   load_data();

   function load_data(query)
   {
    $.ajax({
     url:"res.php",
     method:"POST",
     data:{query:query},
     success:function(data)
     {
      $('#result').html(data);
     }
    });
   }
   $('#name_booking').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
     load_data(search);
    }
    else
    {
     load_data();
    }
   });
  });
</script>
    
    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->
    
    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->
    
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- End Preload -->
    
     <!-- Header ================================================== -->
 <header>
     <div class="container">
        <div class="row">
            <div class="col--md-3 col-sm-3 col-xs-3">
                <a href="indexP.php" id="logo">
                <img src="img/logoN.png" width="190" height="23" alt="" data-retina="true">
                </a>
            </div>
            <nav class="col--md-9 col-sm-9 col-xs-9">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
            
            <div class="main-menu">
                <div id="header_menu">
                     <img src="img/logo_m.png" width="141" height="40" alt="" data-retina="true">
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                 <ul>
                    <li class="submenu">
                    <a href="indexP.php">Home<i class="icon-home"></i></a>
                    </li>
                    <li><a href="contacts.php">Contacts<i class="icon-mail-alt"></i></a></li>
                    
                    <?php if (isset($_SESSION['email'])){ ?>
                      <li> |</li>
                    <li class="submenu" id="profil">
                    <a href="javascript:void(0);" class="show-submenu"><?php echo $l['username']; ?> <img width="30px" height="30px" src="my/lite/<?php echo $l['img'];?>" style="border-radius: 50%"></a>
                    <ul>
                        <li><a href="my/lite/index.php">My Profile</a> </li>
                        <li><a href="php/logout.php">Log Out</a></li>
                    </ul>  
                    </li>  
                    <?php  } else{?>
                    <button onclick="document.getElementById('modal-wrapper').style.display='block'" class="btn_1" >Sign in</button>
                    <button onclick="document.getElementById('modal-register').style.display='block'" class="btn_1" >Register</button>
                    <?php } ?>
                </ul>
            </div><!-- End main-menu -->
            
            </nav>
        </div><!-- End row -->
     </div><!-- End container -->
    </header>
    <!-- End Header =============================================== -->
    <div class="row">
        <div class="col-lg-4">
          	<!-- SubHeader =============================================== -->
            <div class="container add_bottom_60" style="transform: none;">
                                                          
            <!-- End col -->                         
              <div class="col-md-4" id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                  <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 80px; left: 884.5px;">
                      <div class="box_style_1">
                        <div id="message-booking"></div>
                          <form method="GET" action="check_avail_home.php"  autocomplete="off">
                               
                                <div class="row">
                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                      <label>Arrival date</label>
                                      <input class="startDate1 form-control datepick" type="text" data-field="date" data-startend="start" data-startendelem=".endDate1" readonly="" placeholder="Arrival" id="check_in" name="check_in">
                                       <span class="input-icon"><i class="icon-calendar-7"></i></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                      <label>Departure date</label>
                                      <input class="endDate1 form-control datepick" type="text" data-field="date" data-startend="end" data-startendelem=".startDate1" readonly="" placeholder="Departure" id="check_out" name="check_out">
                                      <span class="input-icon"><i class="icon-calendar-7"></i></span>
                                    </div>
                                  </div>
                                </div><!-- End row -->
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                      <label>Adults</label>
                                      <div class="qty-buttons">
                                        <input type="button" value="-" class="qtyminus" name="adults">
                                        <input type="text" name="adults" id="adults" value="" class="qty form-control" placeholder="0">
                                        <input type="button" value="+" class="qtyplus" name="adults">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                      <label>Children</label>
                                      <div class="qty-buttons">
                                        <input type="button" value="-" class="qtyminus" name="children">
                                        <input type="text" name="children" id="children" value="" class="qty form-control" placeholder="0">
                                        <input type="button" value="+" class="qtyplus" name="children">
                                      </div>
                                    </div>
                                  </div>
                                </div><!-- End row -->
                                <div class="row">                      
                                  <div class="col-md-12 col-sm-6">
                                    <div class="form-group">
                                      <label>search</label>
                                      <input type="text" class="form-control" name="search_booking" id="name_booking" placeholder="<?php echo $city ; ?>">
                                    </div>                           
                                  </div>
                                  <div class="col-md-12 col-sm-6"id="result"></div>
                                    <div class="col-md-12 col-sm-12">
                                      <div class="form-group">
                                        <input type="submit" value="Search" class="btn_full" id="submit-booking">
                                      </div>
                                    </div>
                                </div>
                          </form>
                          <hr>
                          <a href="contacts.php" class="btn_outline"> or Contact us</a>
                          <a href="tel://004542344599" id="phone_2"><i class="icon_set_1_icon-91"></i>+213 773 34 79 71</a>
                                                 
                      </div><!-- End box_style -->
                  </div><!-- End theiaStickySidebar -->
            </div><!-- End col -->               
          </div>
            <!-- End SubHeader ============================================ -->
        </div>
         
      <div class="col-md-4">
          <div class="container margin_60_35">
              <h2>Welcome to <?php echo $city ; ?>'s hotels : <?php echo $countHotel;?> Properties found </h2> 

           </div><!-- End container -->
          
        <?php
        while ( $row=mysqli_fetch_assoc($ord))
              { 
                
         ?>
          
          <div class="container_styled_1">
              <div class="container margin_60">
                  <div class="row">
                      <div class="col-md-5 ">
                        <div class="titi">
                          <img src="<?php echo $row['imgg'] ?>" width="450px" height="320px">
                            <?php
                              if ($nbr_days > 0) {
                              ?>
                             <div class="titi-text">
                               <h2><?php echo $row['total'] ?> DZD</h2>
                             </div>
                            <?php } ?>
                        </div>    
                      </div>
                      <div class="col-md-4 ">
                          <div class="room_desc_home">
                             <div class="cd">
                              <div class="hotel_name"><h3><?php echo $row['name_hotel']; ?></h3></div>
                               <div id="aaa">
                                <?php
                                  $t = $row['rate'] ;
                                  if ( $t < 2 ) { echo "Low" ; $co = "#c94a30"; }
                                  if ( $t >= 2 && $t < 4 ) { echo "Sufficient" ; $co="#f48f00";}
                                  if ( $t >= 4 && $t < 6 ) { echo "Good" ; $co="#ed5434"; }
                                  if ( $t >= 6 && $t < 8 ) { echo "Excellent" ; $co="#0b9808"; }
                                  if ( $t >= 8  ) { echo "Super" ; $co = "#061798"; } 
                                ?>
                                <span style="background-color:<?php echo $co; ?> "><?php echo round($row['rate'], 1) ?></span></div>
                             </div>
                              <p>
                                   <i class="icon-location" style="color: #0836ff"></i> <?php echo $row['address_hotel']; 
                                      
                                      $star=$row['stars_hotel'];
                                      $i = 0 ;
                                      while ($i < $star ){ ?>
                                          <i class="icon-star" style="color:#F90;"></i>
                                      <?php 
                                      $i = $i + 1 ;    
                                      } 
                                     ?>  
                                    
                              </p>
                              <p>
                                <?php echo $row['description_hotel'] ?>
                              </p>
                              
                              <ul>
                                  <li>
                                  <div class="tooltip_styled tooltip-effect-4">
                                      <span class="tooltip-item"><i class="icon_set_2_icon-104"></i></span>
                                      <div class="tooltip-content">
                                          King size bed
                                      </div>
                                  </div>
                                  </li>
                                  <li>
                                  <div class="tooltip_styled tooltip-effect-4">
                                      <span class="tooltip-item"><i class="icon_set_2_icon-111"></i></span>
                                      <div class="tooltip-content">
                                          Bathtub
                                      </div>
                                  </div>
                                  </li>
                                  <li>
                                  <div class="tooltip_styled tooltip-effect-4">
                                      <span class="tooltip-item"><i class="icon_set_2_icon-116"></i></span>
                                      <div class="tooltip-content">
                                          Plasma TV
                                      </div>
                                  </div>
                                  </li>
                                  <li>
                                  <div class="tooltip_styled tooltip-effect-4">
                                      <span class="tooltip-item"><i class="icon_set_1_icon-15"></i></span>
                                      <div class="tooltip-content">
                                          Welcome bottle
                                      </div>
                                  </div>
                                  </li>
                                  <li>
                                  <div class="tooltip_styled tooltip-effect-4">
                                      <span class="tooltip-item"><i class="icon_set_2_icon-106"></i></span>
                                      <div class="tooltip-content">
                                          Safe box
                                      </div>
                                  </div>
                                  </li>
                              </ul>
                              <div class="btnn">
                                <div>
                                  <a href="hotel_detail.php ?id=<?php echo $row['hotelID']?>" class="btn_1_outline">Read more</a>
                                </div>
                                <div>
                                  <?php if(isset($_SESSION['email'])){ ?>
                                  <span><i class="<?php if($len == 0){
                                            echo "icon-heart-empty";
                                          }else{ $ress = 0;
                                           for($i = 0 ; $i < $len ; $i++){
                                            if($fav[$i] == $row['hotelID']){
                                              $ress = 1 ;
                                            }
                                            }
                                            if($ress == 1){ echo "icon-heart"; }
                                            else{ echo "icon-heart-empty"; }
                                          }?>" id="<?php echo $row['hotelID']?>" style="font-size: 30px;color: #ed5434;cursor: pointer;" onclick="trans(this)" title="<?php echo $clientID ?>" ></i></span>
                                  
                                  <?php } ?>
                                </div>                             
                              </div>
                          </div><!-- End room_desc_home -->
                      </div>
                  </div><!-- End row -->
              </div><!-- End container -->
          </div><!-- End container_styled_1 -->
            
          <?php } ?>
      </div>
    </div>
    <script >
        function trans(x){
                var hotelid =  x.id;
                var cleintid = x.title;
            if (x.className == "icon-heart-empty") {
                x.className = "icon-heart" ;
                //x.title = "Remove from favourite" ;                      
                $.post('php/addFav.php', {variable: hotelid ,alv : cleintid});
              
            }
            else { 
                x.className = "icon-heart-empty"  ;
                //x.title = "Add to favourite" ;
                $.post('php/deleteFav.php', {variable: hotelid ,alv : cleintid });
                 }
        }
    </script>
     
    <section class="promo_full"><div class="promo_full_wp">
        <div>
            <h3>What Clients say<span>Id tale utinam ius, an mei omnium recusabo iracundia.</span></h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="carousel_testimonials owl-carousel owl-theme owl-loaded owl-responsive-600">              
                                 <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1380px, 0px, 0px); transition: 0s; width: 4890px; padding-left: 30px; padding-right: 30px;"><div class="owl-item cloned" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item cloned" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item active" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item cloned" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div><div class="owl-item cloned" style="width: 660px; margin-right: 30px;"><div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="img/testimonial_1.jpg" alt="" class="img-circle"></figure>
                                        <h4>Roberta<small>12 October 2015</small></h4>
                                    </div>
                                    <div class="comment">
                                        "Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud. No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
                                    </div>
                                </div><!-- End box_overlay -->
                            </div></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style="display: none;">prev</div><div class="owl-next" style="display: none;">next</div></div><div class="owl-dots" style=""><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div></div></div><!-- End carousel_testimonials -->
                    </div><!-- End col-md-8 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End promo_full_wp -->
    </div>
    </section><!-- End section -->    
     
    <div id="dtBox"></div><!-- End datepicker -->
    
     <footer >
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <img src="img/logooo.png" width="141" height="40" alt="" id="logo_footer" data-retina="true">
					<ul id="contact_details_footer">
          				<li>Road 1008, Bordj bou arreridj<br>Algeria 34000</li>
                        <li><a href="tel://00213773347971">+213 773 34 79 71</a> / <a href="#0"><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></a></li>
                    </ul>  
                </div>
                <div class="col-md-2 col-sm-4">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Rooms</a></li>
                        <li><a href="#">Activities</a></li>
                        <li><a href="#">Contact us</a></li>
                         <li><a href="#">Gallery</a></li>
                    </ul>
                </div>                
                <div class="col-md-3 col-sm-4">
                    <h3>Change language</h3>
                   <ul>
                        <li><a href="#">English</a></li>
                        <li><a href="#">French</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4"  id="newsletter">
                    <h3>Newsletter</h3>
                    <p>Join our newsletter to keep be informed about offers and news.</p>
					<div id="message-newsletter_2"></div>
						<form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                        <div class="form-group">
                            <input name="email_newsletter_2" id="email_newsletter_2"  type="email" value=""  placeholder="Your mail" class="form-control">
                          </div>
                            <input type="submit" value="Subscribe" class="btn_1 white" id="submit-newsletter_2">
                    	</form>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div id="social_footer">
                        <ul>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-google"></i></a></li>
                            <li><a href="#"><i class="icon-instagram"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon-vimeo"></i></a></li>
                            <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                        </ul>
                          <p>Copyright © 2018 <a target="_blank" title="DZBOOKING" href="http://DZBOOKING.com/">DZ BOOKINg</a>  |  All Right Reserved</p>

                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

<div id="modal-register" class="modal">
  
  <form class="modal-content animate"  method="POST" action="php/register.php">
        
    <div class="imgcontainerr">
      <span onclick="document.getElementById('modal-register').style.display='none'" class="close" title="Close">&times;</span>
      <img src="img/50.png" alt="Avatar" class="avatar">
      <h1 style="font-family:Poppins;font-style:normal;text-align:center ; color: white;" >Register</h1>
    </div>
    

    <div  class="containerr">
    
        <input type="text" placeholder="Enter name" name="name" id="t1">
        <input type="text" placeholder="Enter lastname" name="lastname" id="t1">
      <input type="text" placeholder="Enter Email" name="email" id="t1">
      <input type="text" placeholder="Enter User name" name="username" id="t1">
      <input type="password" placeholder="Enter Password" name="password" id="t1">
      <input type="password" placeholder="Repeat your Password" name="password" id="t1">        
      <input type="submit" id="b1" value="register"> 
  
      
    </div>
    
  </form>
  
</div>
// <script>
//     // If user clicks anywhere outside of the modal, Modal will close

//     var modale = document.getElementById('modal-register');
//     window.onclick = function(event) {
//         if (event.target == modale) {
//             modale.style.display = "none";
//         }
//     }
// </script>


<!-- modal login form -->
<div id="modal-wrapper" class="modal">
  
  <form class="modal-content animate"  method="POST" action="php/login.php">
        
    <div class="imgcontainerr">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close ">&times;</span>
      <img src="img/50.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center ; color: white;" >Sign In</h1>
    </div>

    <div class="containerr">
      <input type="text" placeholder="Enter Email" name="email" id="t1">
      <input type="password" placeholder="Enter Password" name="password" id="t1">        
      <input type="submit"  value="login" id="b1">
      <input type="checkbox" name="remember" style="margin:26px 30px;"> <label style="color: white;">Remember me </label> 
      <a href="forgot.php" style="color: white; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
    </div>
    
  </form>
  
</div>

<script>
    // If user clicks anywhere outside of the modal, Modal will close

    var m = document.getElementById('modal-register');
    var modal = document.getElementById('modal-wrapper');
    window.onclick = function(event) {
        if ((event.target == m) ||(event.target==modal)) {
            m.style.display = "none";
            modal.style.display="none";
        }
    }
</script>
        
<!-- COMMON SCRIPTS -->
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="assets/validate.js"></script>
<script src="js/functions.js"></script>

<script type="text/javascript" src="js/DateTimePicker.js"></script>
<script type="text/javascript">$("#dtBox").DateTimePicker();</script>
</body>
</html>