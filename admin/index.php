<?php include "header.php";  
if(isset($_GET['type']) && $_GET['type'] == "delete"){
   $id = $_GET['id'];
   query("delete from users where id={$id}");
   redirect("users.php");
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
                                          <th class="product-thumbnail">Order Id</th>
                                          <th class="product-add-to-cart"><span class="nobr">View</span></th>
                                          <th class="product-name"><span class="nobr">Order Date</span></th>
                                          <th class="product-price"><span class="nobr"> Address </span></th>
                                          <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                          <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                          <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                      $res = query("select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id = `order`.order_status");
                                      while($row=f_array($res)){
                                      ?>
                                      <tr>
                                          <td class="product-remove"><?php echo $row['id'] ?></td>
                                          <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id'] ?>"> view</a></td>
                                          <td class="product-thumbnail"><?php echo $row['added_on'] ?></td>
                                          <td class="product-name"><?php echo $row['address'] ?><br><?php echo $row['city'] ?></td>
                                          <td class="product-price"><span class="amount"><?php echo $row['payment_type'] ?></span></td>
                                          <td class="product-price"><span class="amount"><?php echo $row['payment_status'] ?></span></td>
                                          <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['order_status_str'] ?></span></td>
                                      </tr>
                                  <?php } ?>
                                  </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

<?php include "footer.php"; ?>