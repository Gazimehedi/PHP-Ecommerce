<?php 
require('header.php');
if(!isset($_SESSION['LOGIN'])){?>
<script> 
    window.location.href="index.php";
</script>
<?php } ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">my order</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                <th class="product-thumbnail">Qty</th>
                                                <th class="product-thumbnail">Price</th>
                                                <th class="product-thumbnail">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $oid = $_GET['id'];
                                            $uid = $_SESSION['USER_ID'];
                                            $total_price = 0;
                                            $res = query("select distinct(order_details.id),order_details.*,products.name,products.img from `order_details`,products,`order` where order_details.order_id = $oid and `order`.user_id=$uid and products.id=order_details.product_id");
                                            while($row=f_array($res)){
                                                $total_price=$total_price+($row['qty'] * $row['price']);
                                            ?>
                                            <tr>
                                                <td class="product-remove"><?php echo $row['name'] ?></td>
                                                <td class="product-thumbnail"><img height="150px" src="<?php echo PRODUCT_IMG_SITE_PATH.$row['img']; ?>" alt="product img" /></td>
                                                <td class="product-remove"><?php echo $row['qty'] ?></td>
                                                <td class="product-remove">$<?php echo $row['price'] ?></td>
                                                <td class="product-remove">$<?php echo $row['qty'] * $row['price'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Total Price</td>
                                            <td><?php echo $total_price; ?></td>
                                        </tr>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
        
<?php require('footer.php'); ?>