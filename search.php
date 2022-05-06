<?php 
require('header.php');
$str = safe($_GET['str']);
if($str != ''){
    $get_product=get_product('','','','',$str);
}else{ ?>
    <script>
        window.location.href='index.php';
    </script>
<?php }
 ?>
        <div class="body__overlay"></div>
                <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Search</span>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $str; ?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
                    <?php
                     if(count($get_product)>0){
                     ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select">
                                        <option>Default softing</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by newness</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        <!-- Start Single Product -->
                                        <?php
                            foreach ($get_product as $product_data) {
                             ?>
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="product.php?id=<?php echo $product_data['id']; ?>">
                                                <img src="<?php echo PRODUCT_IMG_SITE_PATH.$product_data['img']; ?>" alt="product images">
                                            </a>
                                        </div>
                                        
                                        <div class="fr__product__inner">
                                            <h4><a href="product.php?id=<?php echo $product_data['id']; ?>"><?php echo $product_data['name']; ?></a></h4>
                                            <ul class="fr__pro__prize">
                                                <li class="old__prize">$<?php echo $product_data['mrp']; ?></li>
                                                <li>$<?php echo $product_data['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        <?php } ?>
                                        <!-- End Single Product -->
                                </div>
                            </div>
                            <!-- End Product View -->
                        </div>
                    </div>
                </div>
            <?php 
        }else{
                echo "Data not found";
            }
             ?>
            </div>
        </section>
        <!-- End Product Grid -->
}
<?php require('footer.php'); ?>