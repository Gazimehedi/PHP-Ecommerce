<?php
require('admin/config.php');
require("config.php");
$user_name = $_SESSION['USER_NAME'];
$amount = $_GET['amount'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>payment</title>
    <style type="text/css">
        .container{
            padding: 50px;
            display: flex;
            justify-content:center;
        }
    </style>
</head>
<body>
    <div class="container">
    
    <form action="submit.php" method="post">
    <script type="text/javascript"
        src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
        data-key="<?php echo $Publishable; ?>"
        data-amount="<?php echo $amount*100; ?>"
        data-name="<?php echo $user_name; ?>"
        data-description="mehedi hasan desc"
        data-image=""
        data-currency="usd"
    ></script>
</form>
</div>
</body>
</html>