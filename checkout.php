<?php 
require('header.php');
require("config.php");
if(!isset($_SESSION['card']) || count($_SESSION['card'])==0){ ?>
<script>
    window.location.href="index.php";
</script>
<?php }

$total_price=0;
foreach ($_SESSION['card'] as $key => $val) {
    $productarr = get_product('','','',$key);
    $pprice = $productarr[0]['price'];
    $qty = $val['qty'];
    $total_price = $total_price + ($pprice*$qty);
}

if(isset($_POST['submit'])){
    $user_id = $_SESSION['USER_ID'];
    $address = safe($_POST['address']);
    $city = safe($_POST['city']);
    $post_code = safe($_POST['post_code']);
    $payment_type = safe($_POST['payment_type']);
    $total_price = $total_price;
    if($payment_type=="cod"){
        $payment_status = "success";
    }else{
        $payment_status = "pending";
    }
    $order_status = "pending";
    $added_on = date('Y-m-d h:i:s');

    query("insert into `order`(user_id,address,city,post_code,payment_type,payment_status,total_price,order_status,added_on) value($user_id,'$address','$city',$post_code,'$payment_type','$payment_status',$total_price,'$order_status','$added_on')");

    $order_id = mysqli_insert_id($connection);

    foreach ($_SESSION['card'] as $key => $val) {
    $productarr = get_product('','','',$key);
    $pprice = $productarr[0]['price'];
    $qty = $val['qty'];
    query("insert into order_details (order_id,product_id,qty,price) value('$order_id','$key','$qty','$pprice')");
}
unset($_SESSION['card']); 
if($payment_type=="cod"){
?>
<script>
    window.location.href='thank_you.php';
</script>
<?php 
    }
if($payment_type=="stripe"){
?>
<script>
    window.location.href='payment.php?amount=<?php echo $total_price; ?>&type=stripe';
</script>
<?php }
}
 ?>

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
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    <?php 
                                        $accordion_class = "accordion__title";
                                        if(!isset($_SESSION['LOGIN'])){
                                            $accordion_class = "accordion__hide";
                                     ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="contact-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="login_email" name="login_email">
                                                                <span class='feild_error login_feild_error' id="login_email_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="login_password" name="login_password">
                                                                <span class='feild_error login_feild_error' id="login_password_error"></span>
                                                            </div>
                                                            <div class="dark-btn">
                                                                <a href="javascript:void()" type="button" onclick="user_login()" >LogIn</a>
                                                            </div>
                                                            <div class="form-output form-messege login_msg"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="text" id="name" name="name" >
                                                                <span class='feild_error' id="name_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="email" name="email" >
                                                                <span class='feild_error' id="email_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-email">Mobile</label>
                                                                <input type="text" id="mobile" name="mobile" >
                                                                <span class='feild_error' id="mobile_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="text" id="password" name="password" >
                                                                <span class='feild_error' id="password_error"></span>
                                                            </div>
                                                            <div class="dark-btn">
                                                                <a href="javascript:void()" type="button" onclick="user_register()" >Register</a>
                                                            </div>
                                                            <div class="form-output" id="success">
                                                                <p class="form-messege"></p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <div class="<?php echo $accordion_class; ?>">
                                        Address Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="post_code" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="<?php echo $accordion_class; ?>">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                COD&nbsp;<input type="radio" name="payment_type" value="cod" required>
                                                &nbsp;&nbsp;&nbsp;Stripe&nbsp;<input type="radio" name="payment_type" value="stripe" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="fv-btn" type="submit" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php 
                                $card_total=0;
                                foreach ($_SESSION['card'] as $key => $val) {
                                    $productarr = get_product('','','',$key);
                                    $pname = $productarr[0]['name'];
                                    $pmrp = $productarr[0]['mrp'];
                                    $pprice = $productarr[0]['price'];
                                    $pimg = $productarr[0]['img'];
                                    $qty = $val['qty'];
                                    $card_total = $card_total + ($pprice*$qty);
                            ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMG_SITE_PATH.$pimg; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href=""><?php echo $pname; ?></a>
                                        <span class="price">$<?php echo $qty * $pprice; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void()" onclick="manage_card(<?php echo $key; ?>,'remove')" ><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                            <?php } ?>    
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">$<?php echo $card_total; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        
<?php require('footer.php'); ?>