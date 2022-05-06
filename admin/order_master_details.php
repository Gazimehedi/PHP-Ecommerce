<?php include "header.php"; 
$oid = $_GET['id']; 
if(isset($_POST['order_status_arr'])){
  $update_status = $_POST['order_status'];
  query("update `order` set order_status = '$update_status' where id=$oid");

}
?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order Master</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
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
                                      $total_price = 0;
                                      $res = query("select distinct(order_details.id),order_details.*,products.name,products.img,`order`.address,`order`.city,`order`.post_code from `order_details`,products,`order` where order_details.order_id = $oid and  products.id=order_details.product_id");
                                      while($row=f_array($res)){
                                          $address = " {$row['address']} {$row['city']} {$row['post_code']}";
                                          $total_price=$total_price+($row['qty'] * $row['price']);
                                      ?>
                                      <tr>
                                          <td class="product-remove"><?php echo $row['name'] ?></td>
                                          <td class="product-thumbnail"><img  src="<?php echo PRODUCT_IMG_SITE_PATH.$row['img']; ?>" alt="product img" /></td>
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
                              <br>
                              <div class="px-4">
                                <strong>Address: </strong>
                                <?php echo $address; ?>
                                <br><br>
                                <strong>Order Status: </strong>
                                <?php 
                                  $order_status_arr = f_array(query("select order_status.name from order_status,`order` where `order`.id = $oid and `order`.order_status = order_status.id"));
                                  echo $order_status_arr['name'];
                                ?>
                              </div>
                              <div class="px-4 w-25">
                                <br>
                                <form method="post">
                                  <select name="order_status" id="order_status" class="form-control">
                                  <option value="">Select Status</option>
                                  <?php 
                                    $data = query("select * from order_status");
                                    while ($status = f_array($data)) {
                                      // if(isset($_GET['id']) && $status['id'] == $status){
                                      //   $selected = "selected";
                                      // }else{
                                      //   $selected = "";
                                      // }
                                      echo "<option value='{$status['id']}' {$selected}>{$status['name']}</option>";
                                    }
                                   ?>
                                  
                                  </select>
                                  <br>
                                  <input class="btn btn-success text-right" type="submit" value="Update" name="order_status_arr">
                                </form> 
                                <br>
                                <br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

<?php include "footer.php"; ?>