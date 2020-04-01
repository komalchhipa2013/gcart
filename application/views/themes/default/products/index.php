
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.1.min.js"></script>


<!-- ============================================== HEADER : END ============================================== -->
<style>
  .right-arrow-custom:after{
    color: #bababa;
    content: "\f105";
    float: right;
    font-size: 12px;
    height: 20px;
    line-height: 18px;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
    width: 10px;
    font-family: "FontAwesome";
    top: 50%;
    position: absolute;
    right: 15px;
    margin-top: -10px;
  }
  span.right-arrow-custom {
    cursor: pointer;
}
  
  .pagination-data .pagination{
    margin: 0;
  }
</style>
<div id="test"></div>
<form method="POST"> 
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="<?= base_url() ."Home"; ?>">Home</a></li>
        <li class='active'>Category</li>
        <li ><a class="category-title" style="display: none;"></a></li>
        
      </ul>
    </div>
    <!-- /.breadcrumb-inner -->
  </div>
  <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 sidebar'>
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">
<?php
     	        foreach ($main_category as $key => $data)
            	{ 
?>
              <li class="dropdown menu-item menu-item-with-more-category" > <a href="javascript:void(0);" class="parent_category" id="parent_category" value="<?= $data->id ?>"  ><i class="icon fa <?= $data->icon; ?>" aria-hidden="true"></i><?= ucwords($data->name); ?></a>
<?php 
                if(!empty($data->category_id))  
                {
?>
                <span value="<?= $data->id ?>" id="parent" class="dropdown menu-item menu-item-with-more-category right-arrow-custom dropdown-toggle customspan" data-toggle="dropdown"> </span>
<?php
               }
?>
                <ul class="dropdown-menu mega-menu">
                  <li class="yamm-content">      
                   <div class="row">
                      <div class="col-xs-12 col-sm-12 col-lg-12">  
                       <ul class="links list-unstyled">
                                         
<?php 
                    foreach ($sub_category as $key => $sub_categories) 
                    {

                      if ($sub_categories->category_id == $data->id)
                      { 
?>           
                              <div class="col-xs-12 col-sm-12 col-lg-3"> 
                              <li  class="subcategory-name"><a class="sub_category" id="sub_category" value="<?= $sub_categories->id; ?>" href="javascript:void(0);" ><?= ucwords($sub_categories->name);?></a></li>
                             </div>                    
<?php
                        }
                      }
?>
                    
                  </ul>
                    </div>
                  </li>
                </ul>
 
              </li>
<?php
             }
?>
          </ul>
        </nav>
          <!-- /.megamenu-horizontal -->
        </div>
        <!-- /.side-menu -->
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container">
          <div class="sidebar-filter">
            <!-- ============================================== MANUFACTURES============================================== -->  
           <div class="sidebar-widget wow fadeInUp manufactures" style="display: none">
              <div class="widget-header">
                <h4 class="widget-title">Manufactures</h4>
              </div>
              <div class="sidebar-widget-body">
                <ul class="list">
                </ul>
                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
              </div>
              <!-- /.sidebar-widget-body -->
            </div>
            <!-- /.sidebar-widget -->
      <!-- ============================================== MANUFACTURES: END ============================================== -->

           <form method="POST" action="<?= base_url() ."Categories/get_sub_categories_price_filter_products/" ?>">
              <div class="sidebar-widget wow fadeInUp shop-category" style="display: none;">
                <h3 class="section-title">shop by</h3>
                <div class="widget-header">
                  <h4 class="widget-title">Category</h4>
                </div>
                <div class="sidebar-widget-body">
                  <div class="accordion">
                    <div class="accordion-group">
                      <div class="accordion-heading"> </div> 
                      <div class="accordion-body collapse" id="one" style="height: 0px;">
                        <div class="accordion-inner">
                          <ul class="accordion-inner-ul">
                            </ul>
                           </div>
                      </div>
                    </div>
                    <!-- /.accordion-group -->
                  </div>
                  <!-- /.accordion -->
                </div>
                <!-- /.sidebar-widget-body -->
              </div>
          
<!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

            <!-- ============================================== PRICE SILDER============================================== -->
            
              <div class="sidebar-widget wow fadeInUp price_slider_block" style="display: none">
                <div class="widget-header">
                  <h4 class="widget-title">Price Slider</h4>
                </div>
                <div class="sidebar-widget-body m-t-10">
                  <div class="price-range-holder"> <span class="min-max"> </span>
                    <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                    <input type="text" class="price-slider" name="price_slider" value=""  >
                  </div>
                  <!-- /.price-range-holder -->
                  
                  <button  class="lnk btn btn-primary" type="submit" name="submit" > Show Now </button>
                 <!--  <button  class="lnk btn btn-primary" type="submit" name="submit" id ="show_button" style="display: none"> Show Now </button> -->
                 <!--  <a href="#" class="lnk btn btn-primary">Show Now</a>  --></div>
                <!-- /.sidebar-widget-body -->
              </div>
         

          </form>

            <!-- /.sidebar-widget -->
            <!-- ============================================== PRICE SILDER : END ============================================== -->

            <!-- ============================================== PRODUCT TAGS ============================================== -->

            <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs" style="display: none;">
              <h3 class="section-title">Product tags</h3>
              <div class="sidebar-widget-body outer-top-xs">
                <div class="tag-list"> 
                </div>
                <!-- /.tag-list -->
              </div>
              <!-- /.sidebar-widget-body -->
            </div>
            <!-- /.sidebar-widget -->
          <!----------- Testimonials------------->
            <div class="sidebar-widget  wow fadeInUp outer-top-vs">
              <div id="advertisement" class="advertisement">
                <div class="item">
                  <div class="avatar"><img src="<?= base_url(); ?>assets/themes/default/images/testimonials/member1.png ?>" alt="Image"></div>
                  <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                  <div class="clients_author">John Doe <span>Abc Company</span> </div>
                  <!-- /.container-fluid -->
                </div>
                <!-- /.item -->

                <div class="item">
                  <div class="avatar"><img src="<?= base_url(); ?>assets/themes/default/images//testimonials/member3.png ?>" alt="Image"></div>
                  <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                  <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                </div>
                <!-- /.item -->

                <div class="item">
                  <div class="avatar"><img src="<?= base_url(); ?>assets/themes/default/images/testimonials/member2.png ?>" alt="Image"></div>
                  <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                  <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                  <!-- /.container-fluid -->
                </div>
                <!-- /.item -->

              </div>
              <!-- /.owl-carousel -->
            </div>

            <!-- ============================================== Testimonials: END ============================================== -->

            <div class="home-banner"> <img src="<?= base_url(); ?>assets/themes/default/images/banners/LHS-banner.jpg ?>" alt="Image"> </div>
          </div>
          <!-- /.sidebar-filter -->
        </div>
        <!-- /.sidebar-module-container -->
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'>
        <!-- ========================================== SECTION – HERO ========================================= -->

        <div id="category" class="category-carousel hidden-xs">
          <div class="item">
           <div class="image"> <img src="" alt="" class="img-responsive"> </div>
            <div class="container-fluid">
              <div class="caption vertical-top text-left">
                <div class="big-text"> </div>
                <div class="excerpt hidden-sm hidden-md"></div>
                <div class="excerpt-normal hidden-sm hidden-md"></div>
              </div>
            </div>
        </div>

        <div class="clearfix filters-container m-t-10" style="display: none;">
          <div class="row">
            <div class="col col-sm-2 col-md-2">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
              </div>
              <!-- /.filter-tabs -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-6">
              <div class="col col-sm-6 col-md-6 no-padding">
                <div class="lbl-cnt" style="display: none;"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="javascript:void(0);" class="asc-price" >Price:Low to High</a></li>
                        <li role="presentation"><a href="javascript:void(0);" class="desc-price">Price:High to Low</a></li>
                        <li role="presentation"><a href="javascript:void(0);" class="asc-name">Product Name:A to Z</a></li>
                        <li role="presentation"><a href="javascript:void(0);" class="desc-name">Product Name:Z to A</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld -->
                </div>
                <!-- /.lbl-cnt -->
              </div>
            </div>
            <div class="col col-sm-4 col-md-4 text-right pagination-data">

            <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          </div>
          <div class="search-result-container ">
            <div id="myTabContent" class="tab-content category-list" style="display: none;">
              <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                  <div class="row products-data">
                  </div>
                <!-- /.row -->
                </div>
              <!-- /.category-product -->
              </div>
            <!-- /.tab-pane -->
              <div class="tab-pane "  id="list-container">
                <div class="category-product products-list-data">       
                </div>
              <!-- /.category-product -->
              </div>
            <!-- /.tab-pane #list-container -->

       
              <div class="text-right pagination-data" style="display: none;">

              </div>
            
            </div>    
          </div>
        <!-- /.search-result-container -->
        
        <div class=" filters-container products-data-null" style="display: none;">
          <div class="row">
            <div class="col col-sm-12 col-md-12">
              <div class="text-center">
                       No Any Prodcuts
              </div>
            </div>
          </div>
        </div>
      <!-- /.col -->
      </div>
    <!-- /.row -->
  <!-- /container -->
    </div>
<!-- /body-content -->
</div>
</form>

<script type="text/javascript">

  $(document).ready(function(){

    var category_id;
    var sub_category_id;
    var brand_id;
    var brand_data ;
    var shop_parent_category_data;
    var shop_sub_category_data;
    var max_min_price ;
    var products_tags;
    var banner_data;
    var title;
    var lenghts;
    var link;
    var all_products;
    var tags;
    var multiple_sub_category_id;
    var page;

   let get_parent_categroy_base_url="<?php echo base_url("Categories/get_parent_category_products/") ?>"; 
   let get_sub_category_base_url ="<?php echo base_url("Categories/get_sub_category_products") ?>";
   let get_asc_price_base_url ="<?php echo base_url("Categories/get_asc_price_products") ?>";
   let get_desc_price_base_url ="<?php echo base_url("Categories/get_desc_price_products") ?>";
   let get_asc_name_base_url ="<?php echo base_url("Categories/get_asc_name_products") ?>";
   let get_desc_name_base_url ="<?php echo base_url("Categories/get_desc_name_products") ?>";
   let get_tags_products_base_url ="<?php echo base_url("Categories/get_tags_products") ?>"; 
   let get_multiple_sub_category_products_base_url ="<?php echo base_url("Categories/get_multiple_sub_category_products") ?>"; 
   let base_url="<?php echo base_url() ?>" ;
   let get_brand_base_url="<?php echo base_url("Categories/get_brands_products") ?>";

   // $('.parent_category').click(parent_category);

   // function parent_category(page){


   //  // category_id =$(this).attr("value");
   //  // alert('hello'+category_id);
   $(document).on("clicl",".pagination li a",function(event){
    event.preventDefault();
    page= $(this).data("ci-pagination-page");
   });

   console.log(page);
    $('.parent_category').click(function(){

        category_id =$(this).attr("value");

        $(".asc-price").attr('data-sub-category', '');
        $(".desc-price").attr('data-sub-category','');
        $(".asc-name").attr('data-sub-category', '');
        $(".desc-name").attr('data-sub-category','');

        $(".asc-price").attr('data-category', category_id);
        $(".desc-price").attr('data-category',category_id);
        $(".asc-name").attr('data-category', category_id);
        $(".desc-name").attr('data-category',category_id);

        $.ajax({

            type:"POST",
            url:get_parent_categroy_base_url,
            data:{ category_id:category_id },
            dataType:"JSON",
            success:function(data)
            {

                
               console.log(data);
             
              get_brand_data(data.brand_data,category_id);
              get_shop_parent_category_data(data.shop_parent_category_data);
              get_shop_sub_category_data(data.shop_sub_category_data);
              get_max_min_price(data.max_min_price);
              get_products_tags(data.products_tags,category_id);
              get_banner_data(data.banner_data);
              get_title(data.title);


              if(data.all_products != '')
              {
                products_data(data.all_products);
                get_pagination_link(data.link);
              }
              else
              {
                $('.clearfix').css('display','none');
                $('.category-list').css('display','none');
                $('.products-data-null').css('display','block');
              }
  
            }

        });   

    });
     // }


  $('.sub_category').click(function()
  {
    sub_category_id = $(this).attr("value");
    $(".asc-price").attr("data-category", '');
    $(".desc-price").attr('data-category','');
    $(".asc-name").attr('data-category','');
    $(".desc-name").attr('data-category','');


    $(".asc-price").attr('data-sub-category', sub_category_id);
    $(".desc-price").attr('data-sub-category', sub_category_id)
    $(".asc-name").attr('data-sub-category', sub_category_id);
    $(".desc-name").attr('data-sub-category',sub_category_id);


    $('.shop-category').css('display','none');

    $.ajax({

      type:"POST",
      url:get_sub_category_base_url,
      data:{ sub_category_id:sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        
        get_brand_data(data.brand_data,'',sub_category_id);
        get_max_min_price(data.max_min_price);
        get_products_tags(data.products_tags,'',sub_category_id);
        get_banner_data(data.banner_data);
        get_title(data.title);


        if(data.all_products != '')
        {
          products_data(data.all_products);

          get_pagination_link(data.link);
        }
        else
        {
          $('.clearfix').css('display','none');
          $('.category-list').css('display','none');
          $('.products-data-null').css('display','block');
        }

      }
    });
  });

  $(".list").on("click","a.all_brand",function()
  {
    var brand_id = $(this).attr("value");
    // var ids      = $(this).data('value');
    // var obj      = eval('('+ids+')');

    category_id     = $(this).attr('data-category');
    sub_category_id = $(this).attr('data-sub-category');
    multiple_sub_category_id=$(this).attr('data-multiple-sub-category');
    tags=$(this).attr('data-tags');

    console.log(tags);

    $(".asc-price").attr('data-category', category_id);
    $(".desc-price").attr('data-category',category_id);
    $(".asc-name").attr('data-category', category_id);
    $(".desc-name").attr('data-category',category_id);

    $(".asc-price").attr('data-sub-category', sub_category_id);
    $(".desc-price").attr('data-sub-category', sub_category_id)
    $(".asc-name").attr('data-sub-category', sub_category_id);
    $(".desc-name").attr('data-sub-category',sub_category_id);

    $(".asc-price").attr('data-brand-id', brand_id);
    $(".desc-price").attr('data-brand-id', brand_id)
    $(".asc-name").attr('data-brand-id', brand_id);
    $(".desc-name").attr('data-brand-id',brand_id);


    $.ajax({

      type:"POST",
      url:get_brand_base_url,
      data:{ category_id:category_id,sub_category_id:sub_category_id,brand_id:brand_id,multiple_sub_category_id:multiple_sub_category_id,tags:tags },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        if(multiple_sub_category_id == '')
        {
          get_shop_parent_category_data(data.shop_parent_category_data);
          get_shop_sub_category_data(data.shop_sub_category_data,brand_id,tags);
        }
         
        // }
       
        get_max_min_price(data.max_min_price);

        if(tags == '')
        {
          get_products_tags(data.products_tags,category_id,sub_category_id,brand_id,multiple_sub_category_id);
        }
        
        products_data(data.all_products);

        get_pagination_link(data.link);
      }
    });             
  });

  $('.tag-list').on('click',"a.item",function(){

    category_id              = $(this).attr('data-category'); 
    sub_category_id          = $(this).attr('data-sub-category');
    tags                     = $(this).attr('value');
    brand_id                 = $(this).attr('data-brand-id');
    multiple_sub_category_id = $(this).attr('data-multiple-sub-category');

      $('a.item').removeClass("active");
      $(this).addClass("active");
   

    $(".asc-price").attr('data-category', category_id);
    $(".desc-price").attr('data-category',category_id);
    $(".asc-name").attr('data-category', category_id);
    $(".desc-name").attr('data-category',category_id);

    $(".asc-price").attr('data-sub-category', sub_category_id);
    $(".desc-price").attr('data-sub-category', sub_category_id)
    $(".asc-name").attr('data-sub-category', sub_category_id);
    $(".desc-name").attr('data-sub-category',sub_category_id);

    $(".asc-price").attr('data-brand-id', brand_id);
    $(".desc-price").attr('data-brand-id', brand_id)
    $(".asc-name").attr('data-brand-id', brand_id);
    $(".desc-name").attr('data-brand-id',brand_id);

    $(".asc-price").attr('data-tags', tags);
    $(".desc-price").attr('data-tags', tags)
    $(".asc-name").attr('data-tags', tags);
    $(".desc-name").attr('data-tags', tags);

   
     $.ajax({

      type:"POST",
      url:get_tags_products_base_url,
      data:{ category_id:category_id,sub_category_id:sub_category_id,tags:tags,brand_id:brand_id,multiple_sub_category_id:multiple_sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
                
        if(brand_id == '')
        {
          get_brand_data(data.brand_data,category_id,sub_category_id,multiple_sub_category_id,tags);
        }
        
        get_max_min_price(data.max_min_price);

        if(multiple_sub_category_id == '')
        {
           get_shop_parent_category_data(data.shop_parent_category_data);
          get_shop_sub_category_data(data.shop_sub_category_data,brand_id,tags);
      
        }

         
       
        products_data(data.all_products);
        get_pagination_link(data.link);

      }
    });    
  });

  $('.accordion-inner-ul').on('click',"input.sub_category_checkbox",function(){
    var multiple_sub_category_id = [];
    category_id          = $(this).attr('data-category');
    brand_id             = $(this).attr('data-brand-id');
    tags                 = $(this).attr('data-tags');
    $('#sub_category_checkbox:checked').each(function(i){

     multiple_sub_category_id.push($(this).val());

    });
   

    $(".asc-price").attr('data-category', category_id);
    $(".desc-price").attr('data-category',category_id);
    $(".asc-name").attr('data-category', category_id);
    $(".desc-name").attr('data-category',category_id);

    $(".asc-price").attr('data-brand-id', brand_id);
    $(".desc-price").attr('data-brand-id', brand_id)
    $(".asc-name").attr('data-brand-id', brand_id);
    $(".desc-name").attr('data-brand-id',brand_id);

    $(".asc-price").attr('data-tags', tags);
    $(".desc-price").attr('data-tags', tags)
    $(".asc-name").attr('data-tags', tags);
    $(".desc-name").attr('data-tags', tags);

    $(".asc-price").attr('data-multiple-sub-category', multiple_sub_category_id);
    $(".desc-price").attr('data-multiple-sub-category', multiple_sub_category_id)
    $(".asc-name").attr('data-multiple-sub-category', multiple_sub_category_id);
    $(".desc-name").attr('data-multiple-sub-category', multiple_sub_category_id);

    $.ajax({

      type:"POST",
      url:get_multiple_sub_category_products_base_url,
      data:{ category_id:category_id,multiple_sub_category_id:multiple_sub_category_id,brand_id:brand_id,tags:tags },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        products_data(data.all_products);

        if(brand_id == '')
        {
          get_brand_data(data.brand_data,category_id,sub_category_id,multiple_sub_category_id,tags);
        }
        
        get_max_min_price(data.max_min_price);

        if(tags == '')
        {
          get_products_tags(data.products_tags,category_id,'',brand_id,multiple_sub_category_id);
        }
       
        get_pagination_link(data.link);

      }
    });    

        
  });

  $('.asc-price').click(function(){

    category_id     = $(this).attr('data-category'); 
    sub_category_id = $(this).attr('data-sub-category');
    brand_id        = $(this).attr('data-brand-id');
    tags            = $(this).attr('data-tags');
    multiple_sub_category_id=$(this).attr('data-multiple-sub-category');

    $.ajax({

      type:"POST",
      url:get_asc_price_base_url,
      data:{ category_id:category_id,sub_category_id:sub_category_id,brand_id:brand_id,tags:tags,multiple_sub_category_id:multiple_sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        products_data(data.all_products);
        get_pagination_link(data.link);
        
      }
    });    

  });

  $('.desc-price').click(function(){

    category_id     = $(this).attr('data-category'); 
    sub_category_id = $(this).attr('data-sub-category');
    brand_id        = $(this).attr('data-brand-id');
    tags            = $(this).attr('data-tags');
    multiple_sub_category_id=$(this).attr('data-multiple-sub-category');
   
    $.ajax({

      type:"POST",
      url:get_desc_price_base_url,
      data:{ category_id:category_id,sub_category_id:sub_category_id,brand_id:brand_id,tags:tags,multiple_sub_category_id:multiple_sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        products_data(data.all_products);
        get_pagination_link(data.link);
        
      }
    });    
  });

  $('.asc-name').click(function(){
    category_id     = $(this).attr('data-category'); 
    sub_category_id = $(this).attr('data-sub-category');
    brand_id        = $(this).attr('data-brand-id');
    tags            = $(this).attr('data-tags');
    multiple_sub_category_id=$(this).attr('data-multiple-sub-category');

    $.ajax({

      type:"POST",
      url:get_asc_name_base_url,
      data:{ category_id:category_id,sub_category_id:sub_category_id,brand_id:brand_id,tags:tags,multiple_sub_category_id:multiple_sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        products_data(data.all_products);
        get_pagination_link(data.link);
        
      }
    });    
  });

  $('.desc-name').click(function(){

    category_id     = $(this).attr('data-category'); 
    sub_category_id = $(this).attr('data-sub-category');
    brand_id        = $(this).attr('data-brand-id');
    tags            = $(this).attr('data-tags');
    multiple_sub_category_id=$(this).attr('data-multiple-sub-category');
    
    $.ajax({

      type:"POST",
      url:get_desc_name_base_url ,
      data:{ category_id:category_id,sub_category_id:sub_category_id,brand_id:brand_id,tags:tags,multiple_sub_category_id:multiple_sub_category_id },
      dataType:"JSON",
      success:function(data)
      {
        console.log(data);
        products_data(data.all_products);
        get_pagination_link(data.link);
        
      }
    });    
  });
  /**
   * [all_brand_data Display all brand name products wise]
   */
  function get_brand_data(brand_data,category_id='',sub_category_id='',multiple_sub_category_id = '',tags='')
  {
    if(brand_data != '')
    {
      // if(brand_data.length > 0)
      // {
        $('.manufactures').css('display','block');
        var li = new Array();

        brand_data.forEach(data=>{

        li.push(' <li><a class="all_brand" href="javascript:void(0);" data-tags="'+tags+'" data-multiple-sub-category="'+multiple_sub_category_id+'" data-category="'+category_id+'" data-sub-category="'+sub_category_id+'"  id="brand_data" value="'+data.id+'" >'+data.name.charAt(0).toUpperCase() + data.name.slice(1)+'</a></li>');    

        });

        $('.list').html('');
        $('.list').html(li);
      // }
      
    }
    else
      {
        $('.list').html('');
        $('.manufactures').css('display','none');
      }
    

  }

  /**
   * [all_shop_parent_category_data Display aal shope category section in parent category detail]
   */
  function get_shop_parent_category_data(shop_parent_category_data)
  {
    if(shop_parent_category_data != null )
    {
      if(shop_parent_category_data.length >0)
      {
        $('.shop-category').css('display','block');
        var a= new Array();
        shop_parent_category_data.forEach(data=>
        {
        a.push('<a href="#one" data-toggle="collapse" class="accordion-toggle collapsed">'+data.name.charAt(0).toUpperCase() + data.name.slice(1)+'</a> ');

        });
        $('.accordion-heading').html('');
        $('.accordion-heading').html(a);
      }
      else
      {
        $('.accordion-heading').html('');
        $('.shop-category').css('display','none');
      }
     
    }
    
  }

  /**
   * [all_shop_sub_category_data Display aal shope category section in parent category wise sub category detail]
   */
  function get_shop_sub_category_data(shop_sub_category_data,brand_id='',tags='')
  {
    if(shop_sub_category_data != null)
    {
      if(shop_sub_category_data.length > 0)
      {
        $('.shop-category').css('display','block');
        var li = new Array();
        shop_sub_category_data.forEach(data=>
        {
          li.push('<li ><input type="checkbox" name="sub_category[]" class="sub_category_checkbox" data-category="'+data.category_id+'" id="sub_category_checkbox" data-tags="'+tags+'" data-brand-id="'+brand_id+'" value ="'+data.id+'"><a  class="sub-categoriesname" >'+data.name.charAt(0).toUpperCase() + data.name.slice(1)+'</a></li>');
        });

        $('.accordion-inner-ul').html(li);
      }
      else
      {
      $('.accordion-inner-ul').html('');
      }
    }

    
  }

  /**
   * [all_max_min_price Display maximum minimum price products wise]
   */
  function get_max_min_price(max_min_price)
  {
    if(max_min_price != '')
    {
        if(max_min_price.max_price != null && max_min_price.min_price != null)
        {
          $('.price_slider_block').css('display','block');
          var span =' <span class="pull-left" id="pull-left" value="'+Math.trunc(max_min_price.min_price)+'">'+Math.trunc(max_min_price.min_price)+'</span> <span class="pull-right" value="'+Math.trunc(max_min_price.max_price)+'">'+Math.trunc(max_min_price.max_price)+'</span> ';
        $('.min-max').html(span);
        }
        else
        {
          $('.min-max').html('');
          $('.price_slider_block').css('display','none');
        }
    } 
  }

  /**
   * [all_products_tags Display tag products wise]
   */
  function get_products_tags(products_tags='', category_id = '', sub_category_id = '',brand_id = '',multiple_sub_category_id = '')
  {
    if(products_tags != null)
    {
      $('.product-tag').css('display','block');
      var a= new Array();

      products_tags.forEach(data=>{

          if(data != '')
          {
            a.push('<a class="item" id="tags-data" title="'+data+'" data-category="'+category_id+'" data-sub-category="'+sub_category_id+'" data-brand-id="'+brand_id+'" data-multiple-sub-category="'+multiple_sub_category_id+'" value="'+data+'">'+data.charAt(0).toUpperCase() + data.slice(1)+'</a>');  
          }
      });

        $('.tag-list').html(a);
     
      
    }
    else
    {      
      $('.tag-list').append('');
      $('.product-tag').css('display','none');
    }
  }
  function get_banner_data(banner_data)
  {
    if(banner_data != '')
    {
      banner_data.forEach(data=>{

        var href= base_url + data.banner_image;
        $('.img-responsive').prop('src',href);
        $('.big-text').text(data.title);
        $('.excerpt').text(data.sub_title);
        $('.excerpt-normal').text(data.description);

      });
    }
  }

  function get_title(title)
  {
    if(title != null)
    {
      $('.category-title').css('display','inline-block');
      $('.category-title').text(title.charAt(0).toUpperCase() + title.slice(1));
    }
  }

  function get_pagination_link(link)
  {
    if(link != '')
    {
      $('.pagination-data').css('display','block');
      $('.pagination-data').html(link).on('click','pagination li a',function(e){
      e.preventDefault();
      var page=$(this).data('ci-pagination-page');
      alert(page);
      });
    }
    else
    {
      $('.pagination-data').css('display','none');
    }
  }
  /**
   * [products_data Display products data category and sub category wise]
   */
  function products_data(all_products)
  {
    $('.filters-container').css('display','block');
    $('.category-list').css('display','block');
    $('.products-data-null').css('display','none');

    var products_grid = new Array();
    var products_list = new Array();

   
    if(all_products.length > 1)
    {
       $('.lbl-cnt').css('display','inline-block');
    }
    else
    {
      $('.lbl-cnt').css('display','none');
    }

    all_products.forEach(data=>
    {
         
        
        // document.getElementById("asc-price").setAttribute("value", data.sub_category_id);

        var image= base_url + data.thumb_image;
        if(data.is_sale == 1)
        {
          var sale_hot ='<div class="tag sale"><span>Sale</span></div>';
        }
        else if(data.is_hot == 1)
        {
          
            var sale_hot ='<div class="tag hot"><span>Hot</span></div>';    
         
        }
        else
        {
          var sale_hot = '';
        }
        let products_detale_url="<?php echo base_url("Products/show_detail/") ?>";

         var rating_star ='<button id="rateit-reset-2" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2" style="display: none;"></button><div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-2" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" style="width: 70px; height: 14px;" aria-readonly="true"><div class="rateit-selected" style="height: 14px; width: 56px;"></div><div class="rateit-hover"></div></div>';

          products_grid.push('<div class="col-sm-6 col-md-4 wow fadeInUp"><div class="products"> <div class="product"><div class="product-image"><div class="image"> <a href='+products_detale_url+data.id+' "><img  src="'+image+'" alt=""></a> </div>'+sale_hot+'<div class="product-info text-left"><h3 class="name" id="name"><a href='+products_detale_url+data.id+' ">'+data.name.charAt(0).toUpperCase() + data.name.slice(1)+'</a></h3><div class="rating rateit-small">'+rating_star+'</div><div class="description"></div> <div class="product-price"> <span class="price"> '+data.new_price+'</span> <span class="price-before-discount">'+data.old_price+'</span> </div></div> <div class="cart clearfix animate-effect"><div class="action"><ul class="list-unstyled"><li class="add-cart-button btn-group"><button class="btn btn-primary icon"  type="button"> <i class="fa fa-shopping-cart" ></i> </button><button class="btn btn-primary cart-btn" type="button">Add to cart</button></li> <li class="lnk wishlist"> <a class="add-to-cart" href="'+products_detale_url+data.id+' " title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li></ul> </div></div></div></div> </div>');


          products_list.push('<div class="category-product-inner wow fadeInUp"> <div class="products"><div class="product-list product"><div class="row product-list-row"><div class="col col-sm-4 col-lg-4"><div class="product-image"><div class="image"> <a href='+products_detale_url+data.id+' "> <img src="'+image+'" alt=""> </a></div> </div></div> <div class="col col-sm-8 col-lg-8"><div class="product-info"> <h3 class="name"><a href='+products_detale_url+data.id+' ">'+data.name.charAt(0).toUpperCase() + data.name.slice(1)+'</a></h3> <div class="rating rateit-small">'+rating_star+'</div><div class="product-price"> <span class="price">'+data.new_price+'</span> <span class="price-before-discount">'+data.old_price+'</span> </div> <div class="description m-t-10">'+data.long_description+'</div> <div class="cart clearfix animate-effect"><div class="action"><ul class="list-unstyled"><li class="add-cart-button btn-group"><button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button><button class="btn btn-primary cart-btn" type="button">Add to cart</button> </li> <li class="lnk wishlist"> <a class="add-to-cart" href='+products_detale_url+data.id+' " title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li></ul></div></div> </div></div></div>'+sale_hot+'</div></div></div>');

        
      

      
    });

    $('.products-data').html(products_grid);
    $('.products-list-data').html(products_list);
  }



  function shope_sub_category()
  {
    var id=[];
    $(".sub_category_checkbox:checked").each(function(e){

      id.push($(this).val());

    });

    if(id.length >0)
    {
      $.ajax({

            type:"POST",
            url:"<?php echo base_url(); ?>"+"Categories/shope_category/",
            dataType:'JSON',
            data:{ sub_category_id:id },
            success:function(data)
            {
             
              // $.get('<?php echo base_url(); ?>"+"Categories/shope_category/',function(data){
              //       alert(data);
              // });
              
            }

      });
    }

  }

function display_show_now_button()
{
  var checkBox = document.getElementById("sub_category");
  var show_button=document.getElementById("show_button");

  if (checkBox.checked == true)
  {
    show_button.style.display = "block";
  } 
  else
  {
     show_button.style.display = "none";
  }
}
});
 </script>