<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>GCART</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-user"></i>My Account</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-check"></i>Checkout</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-lock"></i>Login</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-user"></i>Sell</a></li>
          </ul>
        </div>
        <!-- /.cnt-account -->


        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.header-top -->
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="<?php echo base_url(); ?>home.html"> <img src="<?php echo base_url(); ?>assets/themes/default/images/logo.png" alt="logo"> </a> </div>
          <!-- /.logo -->
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->

        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
          <!-- /.contact-row -->
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form>
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="<?php echo base_url(); ?>category.html">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
                      <li class="menu-header">Computer</li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>category.html">- Clothing</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>category.html">- Electronics</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>category.html">- Shoes</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>category.html">- Watches</a></li>
                    </ul>
                  </li>
                </ul>
                <input class="search-field" placeholder="Search here..." />
                <a class="search-button" href="<?php echo base_url(); ?>#" ></a> </div>
            </form>
          </div>
          <!-- /.search-area -->
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->

        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

          <div class="dropdown dropdown-cart"> <a href="<?php echo base_url(); ?>#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count">2</span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value">600.00</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="<?php echo base_url(); ?>detail.html"><img src="assets/themes/default/images/cart.jpg" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="<?php echo base_url(); ?>index.php?page-detail">Simple Product</a></h3>
                      <div class="price">$600.00</div>
                    </div>
                    <div class="col-xs-1 action"> <a href="<?php echo base_url(); ?>#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                  <div class="clearfix"></div>
                  <a href="<?php echo base_url(); ?>checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                <!-- /.cart-total-->

              </li>
            </ul>
            <!-- /.dropdown-menu-->
          </div>
          <!-- /.dropdown-cart -->

          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  </div>
  <!-- /.main-header -->

  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="<?php echo base_url(); ?>Home/" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                <li class="dropdown yamm mega-menu"> <a href="<?php echo base_url(); ?>#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Clothing</a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Men</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>Categories/">Dresses</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shoes </a></li>
                              <li><a href="<?php echo base_url(); ?>#">Jackets</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Sunglasses</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Sport Wear</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Blazers</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shirts</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Women</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Handbags</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Jwellery</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Swimwear </a></li>
                              <li><a href="<?php echo base_url(); ?>#">Tops</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Flats</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shoes</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Winter Wear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Boys</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Toys & Games</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Jeans</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shirts</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shoes</a></li>
                              <li><a href="<?php echo base_url(); ?>#">School Bags</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Lunch Box</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Footwear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Girls</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Sandals </a></li>
                              <li><a href="<?php echo base_url(); ?>#">Shorts</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Dresses</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Jwellery</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Bags</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Night Dress</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Swim Wear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="assets/themes/default/images/banners/top-menu-banner.jpg" alt=""> </div>
                          <!-- /.yamm-content -->
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown mega-menu">
                <a href="<?php echo base_url(); ?>category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Laptops</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Gaming</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Laptop Skins</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Apple</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Dell</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Lenovo</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Microsoft</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Asus</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Adapters</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Batteries</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Cooling Pads</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Desktops</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Routers & Modems</a></li>
                              <li><a href="<?php echo base_url(); ?>#">CPUs, Processors</a></li>
                              <li><a href="<?php echo base_url(); ?>#">PC Gaming Store</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Graphics Cards</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Components</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Webcam</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Memory (RAM)</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Motherboards</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Keyboards</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Headphones</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->

                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Cameras</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Accessories</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Binoculars</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Telescopes</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Camcorders</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Digital</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Film Cameras</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Flashes</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Lenses</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Surveillance</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Tripods</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Mobile Phones</h2>
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>#">Apple</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Samsung</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Lenovo</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Motorola</a></li>
                              <li><a href="<?php echo base_url(); ?>#">LeEco</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Asus</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Acer</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Accessories</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Headphones</a></li>
                              <li><a href="<?php echo base_url(); ?>#">Memory Cards</a></li>
                            </ul>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="<?php echo base_url(); ?>#"><img alt="" src="assets/themes/default/images/banners/banner-side.png"></a> </div>
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.yamm-content --> </li>
                  </ul>
                </li>
                <li class="dropdown hidden-sm"> <a href="<?php echo base_url(); ?>category.html">Health & Beauty <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                <li class="dropdown hidden-sm"> <a href="<?php echo base_url(); ?>category.html">Watches</a> </li>
                <li class="dropdown"> <a href="<?php echo base_url(); ?>contact.html">Jewellery</a> </li>
                <li class="dropdown"> <a href="<?php echo base_url(); ?>contact.html">Shoes</a> </li>
                <li class="dropdown"> <a href="<?php echo base_url(); ?>contact.html">Kids & Girls</a> </li>
                <li class="dropdown"> <a href="<?php echo base_url(); ?>#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="<?php echo base_url(); ?>home.html">Home</a></li>
                              <li><a href="<?php echo base_url(); ?>category.html">Category</a></li>
                              <li><a href="<?php echo base_url(); ?>detail.html">Detail</a></li>
                              <li><a href="<?php echo base_url(); ?>shopping-cart.html">Shopping Cart Summary</a></li>
                              <li><a href="<?php echo base_url(); ?>checkout.html">Checkout</a></li>
                              <li><a href="<?php echo base_url(); ?>blog.html">Blog</a></li>
                              <li><a href="<?php echo base_url(); ?>blog-details.html">Blog Detail</a></li>
                              <li><a href="<?php echo base_url(); ?>contact.html">Contact</a></li>
                              <li><a href="<?php echo base_url(); ?>sign-in.html">Sign In</a></li>
                              <li><a href="<?php echo base_url(); ?>my-wishlist.html">Wishlist</a></li>
                              <li><a href="<?php echo base_url(); ?>terms-conditions.html">Terms and Condition</a></li>
                              <li><a href="<?php echo base_url(); ?>track-orders.html">Track Orders</a></li>
                              <li><a href="<?php echo base_url(); ?>product-comparison.html">Product-Comparison</a></li>
                              <li><a href="<?php echo base_url(); ?>faq.html">FAQ</a></li>
                              <li><a href="<?php echo base_url(); ?>404.html">404</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>

              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer -->
          </div>
          <!-- /.navbar-collapse -->

        </div>
        <!-- /.nav-bg-class -->
      </div>
      <!-- /.navbar-default/ -->
    </div>
    <!-- /.container-class -->

  </div>
  <!-- /.header-nav -->
  <!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- main container -->
  <!-- ============================================== CONTAINER  : START ============================================== -->
  <?php echo $content; ?>

    <!-- ============================================== CONTAINER  : END============================================== -->

 <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          <div class="item m-t-15"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand1.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item m-t-10"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand2.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand3.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand4.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand5.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand6.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand2.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand4.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand1.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand5.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
        </div>
        <!-- /.owl-carousel #logo-slider -->
      </div>
      <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
  </div>

<!-- /#top-banner-and-menu -->
<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class="toggle-footer" style="">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>+(888) 123-4567<br>
                    +(888) 456-7890</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="<?php echo base_url(); ?>#">flipmart@themesground.com</a></span> </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Customer Service</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo base_url(); ?>#" title="Contact us">My Account</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="About us">Order History</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="faq">FAQ</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Popular Searches">Specials</a></li>
              <li class="last"><a href="<?php echo base_url(); ?>#" title="Where is my order?">Help Center</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Corporation</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a title="Your Account" href="<?php echo base_url(); ?>#">About us</a></li>
              <li><a title="Information" href="<?php echo base_url(); ?>#">Customer Service</a></li>
              <li><a title="Addresses" href="<?php echo base_url(); ?>#">Company</a></li>
              <li><a title="Addresses" href="<?php echo base_url(); ?>#">Investor Relations</a></li>
              <li class="last"><a title="Orders History" href="<?php echo base_url(); ?>#">Advanced Search</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Why Choose Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo base_url(); ?>#" title="About us">Shopping Guide</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Blog">Blog</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Company">Company</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Investor Relations">Investor Relations</a></li>
              <li class=" last"><a href="<?php echo base_url(); ?>contact-us.html" title="Suppliers">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      <div class="col-xs-12 col-sm-6 no-padding social">
        <ul class="link">
          <li class="fb pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Facebook"></a></li>
          <li class="tw pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Twitter"></a></li>
          <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="GooglePlus"></a></li>
          <li class="rss pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="RSS"></a></li>
          <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="PInterest"></a></li>
          <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Linkedin"></a></li>
          <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Youtube"></a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-sm-6 no-padding">
        <div class="clearfix payment-methods">
          <ul>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/1.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/2.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/3.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/4.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/5.png" alt=""></li>
          </ul>
        </div>
        <!-- /.payment-methods -->
      </div>
    </div>
  </div>
</footer>
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/echo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery.rateit.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/lightbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/scripts.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/themes/default/js/category.js"></script> -->
</body>
</html>