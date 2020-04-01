<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?= base_url() ."Home"; ?>">Home</a></li>
				<li><a href="javascript:void(0);" class="parent_category" onclick="window.history.back();"><?= ucwords($category_name); ?></a></li>
				<li class='active'><?= ucwords($products_name); ?></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<!-- ================================== BODY Content========================================================= -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					<div class="home-banner outer-top-n">
						<img src="<?php echo base_url(); ?>assets/themes/default/images/banners/LHS-banner.jpg" alt="Image">
					</div>

<!-- ============================================== HOT DEALS ============================================== -->
					<form method="POST">
					<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
						<h3 class="section-title">hot deals</h3>
						<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
<?php
						foreach ($hot_deals_products as $key => $hot_deals) 
						{			
?>
							<div class="item">
								<div class="products">
									<div class="hot-deal-wrapper">
										<div class="image">
											<img src="<?= base_url().$hot_deals->thumb_image; ?>" alt="">
										</div>
										<div class="sale-offer-tag"><span><?= $hot_deals->off_percentage ."%";?><br>off</span></div>
										<div class="timing-wrapper">
											<div class="box-wrapper">
												<div class="date box">
													<span class="key" id="day"></span>
													<span class="value">Days</span>
												</div>
											</div>

							                <div class="box-wrapper">
												<div class="hour box">
													<span class="key" id="hour"></span>
													<span class="value">HRS</span>
												</div>
											</div>

							                <div class="box-wrapper">
												<div class="minutes box">
													<span class="key" id="minutes"></span>
													<span class="value">MINS</span>
												</div>
											</div>

							                <div class="box-wrapper hidden-md">
												<div class="seconds box">
													<span class="key" id="seconds"></span>
													<span class="value">SEC</span>
												</div>
											</div>
										</div>
									</div><!-- /.hot-deal-wrapper -->
									<div class="product-info text-left m-t-20">
										<h3 class="name"><a href="<?= base_url() ."Products/show_detail/". $hot_deals->id; ?>"><?= $hot_deals->name ;?></a></h3>
										<div class="rating rateit-small"></div>

										<div class="product-price">
											<span class="price"><?= $hot_deals->new_price ;?></span>
										    <span class="price-before-discount"><?= $hot_deals->old_price ;?></span>
										</div><!-- /.product-price -->
									</div><!-- /.product-info -->

									<div class="cart clearfix animate-effect">
										<div class="action">
											<div class="add-cart-button btn-group">
												<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
													<i class="fa fa-shopping-cart"></i>
												</button>
												<button class="btn btn-primary cart-btn" onclick="add_to_cart(<?= $hot_deals->id ?>)" type="button">Add to cart</button>
											</div>
									    </div><!-- /.action -->
								    </div><!-- /.cart -->
							    </div><!-- /products -->
						    </div><!-- /items -->
<?php
						}
?>  
		    			</div><!-- /.owl-carousel -->
					</div><!-- /sidebar-widget -->
					
<!-- ============================================== HOT DEALS: END ============================================== -->

<!-- ============================================== NEWSLETTER ============================================== -->
					<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
						<h3 class="section-title">Newsletters</h3>
						<div class="sidebar-widget-body outer-top-xs">
							<p>Sign Up for Our Newsletter!</p>
					        <form>
					        	 <div class="form-group">
								    <label class="sr-only" for="exampleInputEmail1">Email address</label>
								    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
								  </div>
								<button class="btn btn-primary">Subscribe</button>
							</form>
						</div><!-- /.sidebar-widget-body -->
					</div><!-- /.sidebar-widget -->
		<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== Testimonials============================================== -->
					<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
						<div id="advertisement" class="advertisement">
					        <div class="item">
					            <div class="avatar"><img src="<?php echo base_url();?>assets/themes/default/images/testimonials/member1.png" alt="Image"></div>
								<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
								<div class="clients_author">John Doe<span>Abc Company</span></div><!-- /.container-fluid -->
					        </div><!-- /.item -->

		         			<div class="item">
		         				<div class="avatar"><img src="<?php echo base_url();?>assets/themes/default/images/testimonials/member3.png" alt="Image"></div>
								<div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
								<div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>
		        			</div><!-- /.item -->

		        			<div class="item">
		            			<div class="avatar"><img src="<?php echo base_url();?>assets/themes/default/images/testimonials/member2.png" alt="Image"></div>
								<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
								<div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
		       				</div><!-- /.item -->
		    			</div><!-- /.owl-carousel -->
					</div>
				</div><!-- /sidebar-module-container -->
			</div><!-- /.sidebar -->
<!-- ============================================== Testimonials: END ============================================== -->

			<div class='col-md-9'>
            	<div class="detail-block">
					<div class="row  wow fadeInUp">
					    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
   							<div class="product-item-holder size-big single-product-gallery small-gallery">
   							
        						<div id="owl-single-product">
						            <div class="single-product-gallery-item" id="slide11">
						                <a data-lightbox="image-1" data-title="Gallery" href="<?php echo base_url().$products_detail['thumb_image']; ?>">
						                    <img class="img-responsive" alt="" src="<?php echo base_url().$products_detail['thumb_image']; ?>" data-echo="<?php echo base_url().$products_detail['thumb_image']; ?>" />
						                </a>
						            </div><!-- /.single-product-gallery-item -->
<?php
										// $products_images = implode(',', array_unique(explode(',', $products_detail['images'])));

										// $products_images = explode(',', $products_images);
									
										// echo serialize($products_images);										
										$products_images =unserialize($products_detail['images']);
										if(!empty($products_images))
										{
											foreach ($products_images as $key => $images) 
											{
												if(!empty($images))
												{
?>
						            <div class="single-product-gallery-item" id="slide<?= $key ?>">
						                <a data-lightbox="image-1" data-title="Gallery" href="<?= base_url().$images; ?>">
						                     <img class="img-responsive" alt="" src="<?= base_url().$images; ?>" data-echo="<?= base_url().$images; ?>" />
						                </a>
						            </div><!-- /.single-product-gallery-item -->
<?php
												}
								            }
						            	}	
?>
        						</div><!-- /.single-product-slider -->

        						<div class="single-product-gallery-thumbs gallery-thumbs">

            						<div id="owl-single-product-thumbnails">
						                <div class="item">
						                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="11" href="#slide11">
						                        <img class="img-responsive" width="85" alt="" src="<?php echo base_url().$products_detail['thumb_image']; ?>" data-echo="<?php echo base_url().$products_detail['thumb_image']; ?>" />
						                    </a>
						                </div>
<?php
										// $products_images = implode(',', array_unique(explode(',', $products_detail['images'])));

										// $products_images = explode(',', $products_images);
										
										$products_images =unserialize($products_detail['images']);
										if(!empty($products_images))
										{
										foreach ($products_images as $key => $images) 
										{
											if(!empty($images))
											{
										
?>
						                <div class="item">
						                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="<?= $key ?>" href="#slide<?= $key ?>">
						                        <img class="img-responsive" width="85" alt="" src="<?= base_url().$images; ?>" data-echo="<?= base_url().$images; ?>"/>
						                    </a>
						                </div>
<?php
										}
						            	}
						            }	
?>
          						</div><!-- /#owl-single-product-thumbnails -->
        						</div><!-- /.gallery-thumbs -->
   							</div><!-- /.single-product-gallery -->
						</div><!-- /.gallery-holder -->
						<div class='col-sm-6 col-md-7 product-info-block'>
							<div class="product-info">
								<h1 class="name"><?php echo $products_detail['name'];?></h1>

								<div class="rating-reviews m-t-20">
									<div class="row">
										<div class="col-sm-3">
											<div class="rating rateit-small"></div>
										</div>
<?php
									if($reviews > 0)
									{
?>
										<div class="col-sm-8">
											<div class="reviews">
												<a href="#" class="lnk"><?= "(".$reviews." Reviews)"?></a>
											</div>
										</div>
<?php
									}
?>
									</div><!-- /.row -->
								</div><!-- /.rating-reviews -->

								<div class="stock-container info-container m-t-10">
									<div class="row">
										<div class="col-sm-2">
											<div class="stock-box">
												<span class="label">Availability :</span>
											</div>
										</div>
<?php 
									if($products_detail['quantity'] > 0)
									{
?>
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="value">In Stock</span>
											</div>
										</div>
<?php
									}
									else
									{
?>
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="value">Out of Stock</span>
											</div>
										</div>
<?php
									}
?>
									</div><!-- /.row -->
								</div><!-- /.stock-container -->

								<div class="description-container m-t-20">
									<?php echo $products_detail['short_description'];?>
								</div><!-- /.description-container -->

								<div class="price-container info-container m-t-20">
									<div class="row">
										<div class="col-sm-6">
											<div class="price-box">
												<span class="price"><?php echo $products_detail['new_price'];?></span>
												<span class="price-strike"><?php echo $products_detail['old_price'];?></span>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="favorite-button m-t-10">
<?php 
												// if(is_user_logged_in() == TRUE)
												// {
?>
												<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" onclick="add_wishlist_products(<?= $products_detail['id']; ?>)" href="javascript:void(0);">
												    <i class="fa fa-heart"></i>
												</a>
<?php
												// }
?>
												<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
												    <i class="fa fa-envelope"></i>
												</a>
											</div>
										</div>
									</div><!-- /.row -->
								</div><!-- /.price-container -->

								<div class="quantity-container info-container">
									<div class="row">
										<div class="col-sm-2">
											<span class="label">Qty :</span>
										</div>

										<div class="col-sm-2">
											<div class="cart-quantity">
												<div class="quant-input">
<?php
								                if( $products_detail['quantity'] > 0)
								               	{
?>
									                <div class="arrows">

									                  <div class="arrow plus gradient" ><span class="ir" ><i class="icon fa fa-sort-asc" onclick="increment_quntity('<?php  echo $products_detail['quantity']; ?>')"></i></span></div>
									                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc" onclick="decrement_quntity()"></i></span></div> 
									                </div>
									               
									                <input type="text" id="quantity" value="1">
<?php
								                }
								                else
								                {
?>
									               	<input type="text" value="0" disabled="disabled">
<?php
								            	}
?>
								              </div>
								            </div>
										</div>
<?php
									if( $products_detail['quantity'] > 0)
								    { 
?>
										<div class="col-sm-7">
											<a href="#" class="btn btn-primary" ><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
										</div>
<?php
									}
									else
									{
?>
										<div class="col-sm-7">
											<a href="#" class="btn btn-primary" disabled="disabled"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
										</div>
<?php
									}
?>
									</div><!-- /.row -->
								</div><!-- /.quantity-container -->
							</div><!-- /.product-info -->
						</div><!-- /.col-sm-7 -->
					</div><!-- /.row -->
                </div><!-- /detail-block -->

				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
<?php

								// if (is_user_logged_in())
								// {
?>
									<li><a data-toggle="tab" href="#review">REVIEW</a></li>
<?php
							//	}

?>
								<li><a data-toggle="tab" href="#tags">TAGS</a></li>
								<li><a data-toggle="tab" href="#comments">COMMENTS</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">

								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?php echo $products_detail['long_description'];?> </p>
									</div>
								</div><!-- /.tab-pane -->
<?php

								// if (is_user_logged_in())
								// {
?>
								<div id="review" class="tab-pane">
									<div class="product-tab">

										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>

											<div class="reviews">
												<div class="review">
													<div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
													<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
												</div>

											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->



										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											<div class="review-table">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th class="cell-label">&nbsp;</th>
																<th>1 star</th>
																<th>2 stars</th>
																<th>3 stars</th>
																<th>4 stars</th>
																<th>5 stars</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="cell-label">Quality</td>
																<td><input type="radio" name="quality" class="radio" value="1"></td>
																<td><input type="radio" name="quality" class="radio" value="2"></td>
																<td><input type="radio" name="quality" class="radio" value="3"></td>
																<td><input type="radio" name="quality" class="radio" value="4"></td>
																<td><input type="radio" name="quality" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Price</td>
																<td><input type="radio" name="Price" class="radio" value="1"></td>
																<td><input type="radio" name="Price" class="radio" value="2"></td>
																<td><input type="radio" name="Price" class="radio" value="3"></td>
																<td><input type="radio" name="Price" class="radio" value="4"></td>
																<td><input type="radio" name="Price" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Value</td>
																<td><input type="radio" name="Value" class="radio" value="1"></td>
																<td><input type="radio" name="Value" class="radio" value="2"></td>
																<td><input type="radio" name="Value" class="radio" value="3"></td>
																<td><input type="radio" name="Value" class="radio" value="4"></td>
																<td><input type="radio" name="Value" class="radio" value="5"></td>
															</tr>
														</tbody>
													</table><!-- /.table .table-bordered -->
												</div><!-- /.table-responsive -->
											</div><!-- /.review-table -->

											<div class="review-form">
												<div class="form-container">
													<form role="form" class="cnt-form">

														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Review <span class="astk">*</span></label>
																	<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														<div class="action text-right">
															<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->

							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
								<!-- =================================================================================== -->
								<div id="comments" class="tab-pane">
									<div class="product-tab">

										<div class="product-reviews">
											<h4 class="title">Customer Comments</h4>

											<div class="reviews">
												<div class="review">
													<div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
													<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
												</div>

											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->



										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											

											<div class="review-form">
												<div class="form-container">
													<form role="form" class="cnt-form">

														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Email<span class="astk">*</span></label>
																	<input type="email" class="form-control txt" id="exampleInputSummary" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Comments <span class="astk">*</span></label>
																	<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														<div class="action text-right">
															<button class="btn btn-primary btn-upper">SUBMIT Comments</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->

							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
<?php
								// }

?>

								<div id="tags" class="tab-pane">
									<div class="product-tag">

										<h4 class="title">Product Tags</h4>
										<form role="form" class="form-inline form-cnt">
											<div class="form-container">

												<div class="form-group">
													<label for="exampleInputTag">Add Your Tags: </label>
													<input type="email" id="exampleInputTag" class="form-control txt">


												</div>

												<button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
											</div><!-- /.form-container -->
										</form><!-- /.form-cnt -->

										<form role="form" class="form-inline form-cnt">
											<div class="form-group">
												<label>&nbsp;</label>
												<span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
											</div>
										</form><!-- /.form-cnt -->

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

<!-- ============================================== UPSELL PRODUCTS ============================================== -->
				<section class="section featured-product wow fadeInUp">
					<h3 class="section-title">upsell products</h3>
					<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

<?php
					foreach ($upsell_products as $key => $upsell)
					{							
?>
						<div class="item item-carousel">
							<div class="products">
								<div class="product">
									<div class="product-image">
										<div class="image">
												<a href="<?= base_url() ."Products/show_detail/". $upsell->id; ?>"><img  src="<?php echo base_url(). $upsell->thumb_image; ?> " alt=""></a>
						    			</div><!-- /.image -->
										<div class="tag sale"><span>sale</span></div>
									</div><!-- /.product-image -->
									<div class="product-info text-left">
										<h3 class="name"><a href="<?= base_url() ."Products/show_detail/". $upsell->id; ?>"><?= $upsell->name; ?></a></h3>
										<div class="rating rateit-small"></div>
										<div class="description"></div>
										<div class="product-price">
											<span class="price"><?= $upsell->new_price; ?></span>
											<span class="price-before-discount"><?= $upsell->old_price; ?></span>
										</div><!-- /.product-price -->
									</div><!-- /.product-info -->
									<div class="cart clearfix animate-effect">
										<div class="action">
											<ul class="list-unstyled">
												<li class="add-cart-button btn-group">
													<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
														<i class="fa fa-shopping-cart"></i>
													</button>
													<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
								        		</li>
<?php
						        			if(is_user_logged_in())
						        			{
?>
				                				<li class="lnk wishlist">
													<a class="add-to-cart" href="<?= base_url() ."Products/show_detail/". $upsell->id; ?>" title="Wishlist">
														 <i class="icon fa fa-heart"></i>
													</a>
												</li>
<?php
											}
?>
											</ul>
										</div><!-- /.action -->
									</div><!-- /.cart -->
								</div><!-- /.product -->
							</div><!-- /.products -->
						</div><!-- /.item -->
<?php
					}
?>
					</div><!-- /.home-owl-carousel -->
				</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			</form>
			</div><!-- /col-md-9 -->
		</div><!-- /row single-product-->
	</div><!-- /container -->
</div> <!-- /body-content -->
<!-- ================================== BODY Content : END ========================================================= -->

<script>
	var to_date=new Date("2020-04-17 00:00:00").getTime();
	var from_date=new Date("2020-03-17 00:00:00").getTime();

	var today_date= new Date().getTime();

	if(from_date >= today_date || to_date <= to_date)
	{
		var x = setInterval(function() {

		// Get today's date and time
		var now = new Date().getTime();

		// Find the distance between now and the count down date
		var distance = to_date - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		document.getElementById("day").innerHTML = days; 
		document.getElementById("hour").innerHTML = hours;
		document.getElementById("minutes").innerHTML = minutes;
		document.getElementById("seconds").innerHTML = seconds;

		}, 1000);
	}


	var i = 1;
    function increment_quntity(limit) 
    {
    	if(i < limit)
    	{
    		 i++;
       		document.getElementById('quantity').value = i;
       		document.getElementById("quantity").setAttribute("value", i);
    	}
      
    }

    function decrement_quntity()
    {
    	if(i > 1 )
    	{
    		i--;
    		document.getElementById('quantity').value = i;
    		document.getElementById("quantity").setAttribute("value", i);
    	}
    }

	function add_to_cart(id)
	{
		$.ajax({

			type:'POSt',
			url:"<?php echo base_url(); ?>"+"Products/add_cart_products/",
			data:{products_id:id},
			success:function(){}
		});
	}
    
    function add_wishlist_products(id)
    {    

		$.ajax({
			type:'POST',
			url:"<?php echo base_url(); ?>"+"Products/add_wishlist_products/",
			data:{ products_id:id },
			success:function(data){
				
			}

		});
    }
</script>
