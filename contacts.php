<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<?php
session_start();
            include_once("/connect/connection.php");
            if (isset($_SESSION['email'])){
                   $email = $_SESSION['email'] ;
                                 
                   $r= mysqli_query($connect, "SELECT * FROM client WHERE email = '$email' ");
                    $c=mysqli_fetch_assoc($r);
                  }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="hotel, bed and breakfast, accommodations, travel, motel">
    <meta name="description" content="FC Recom - Hotel and Bed&amp;Breakfast">
    <meta name="author" content="Ansonika">
    <title>DZ BOOKINg - Contact us</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php  if(!isset($_SESSION['email'])){echo"css/modal.css";}?>">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

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
                    <li class="submenu" id="profil">
                    <a href="javascript:void(0);" class="show-submenu"><?php echo $c['username']; ?> <img width="40px" src="my/lite/<?php echo $c['img'];?>"></a>
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
    
    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_short_2.jpg" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <h1>Contact Us</h1>
    </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->
	
        
    <div class="container margin_60_35">
    <h2 class="main_title"><em></em>Welcome to DZ BOOKINg <span>World of Hotels</span></h2>
    	<div class="row add_top_20">
        
        <div class="col-md-4">
            	<div class="box_style_1">
                <div class="box_contact">
                    <i class="icon_set_1_icon-41"></i>
                    <h4>Address</h4>
                    <p>Road 1008, Bordj bou arreridj<br>Algeria 34000<br><a href="tel://00213773347971">+213 773 34 79 71</a></p>
                    </div>
                    <div class="box_contact">
            	<i class="icon_set_1_icon-37"></i>
                <h4>Get directions</h4>
                <form action="http://maps.google.com/maps" method="get" target="_blank">
                	<div class="form-group">
					<input type="text" name="saddr" placeholder="Enter your starting point" class="form-control" />
					<input type="hidden" name="daddr" value=""/><!-- Write here your end point -->
                    </div>
                    <div class="form-group">
					<button class="btn_1" type="submit" value="Get directions">Get directions</button>
                    </div>
			</form>
            </div>
            </div>
            </div>   
            
        	<div class="col-md-7 col-md-offset-1">
            
            <div id="message-contact"></div>
				<form method="post" action="php/contact.php" id="contactform">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="Enter Name">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="Enter Last Name">
							</div>
						</div>
					</div>
					<!-- End row -->
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="Enter Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Enter Phone number">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Message</label>
								<textarea id="message_contact" name="message_contact" class="form-control" placeholder="Write your message" style="height:150px;"></textarea>
							</div>
						</div>
					</div>
					<div class="row add_bottom_30">
						<div class="col-md-6">
                        	
							<input type="submit" value="Submit" class="btn_1" id="submit-contact">
						</div>
					</div>
				</form>               
            </div><!-- End col-md-8 -->    
            
             
        </div><!-- End row -->
    </div><!-- End Container -->
      
  

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
                            <li><a href="#"><i class="icon-vimeo"></i></a></li>
                            <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                        </ul>
                          <p>Copyright © 2018 <a target="_blank" title="Free CSS Themes" href="http://freecssthemes.com/">FreeCSSThemes</a>  |  All Right Reserved</p>

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

<!-- Specifi scripts -->


</body>
</html>