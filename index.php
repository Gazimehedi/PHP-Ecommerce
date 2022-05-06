<?php require('header.php'); ?>
        <div class="body__overlay"></div>
        <?php include('slider.php'); ?>
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <!-- Start Single Category -->
                            <?php
                            $get_product=get_product('latest',4,'','','');
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
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Category Area -->
        <!-- Start Product Area -->
        <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">
                        <!-- Start Single Category -->
                        <?php
                            $get_product=get_product('latest',8,'','','');
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
                        <!-- End Single Category -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Area -->
<?php require('footer.php'); ?>