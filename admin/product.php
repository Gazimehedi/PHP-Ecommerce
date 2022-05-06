<?php include "header.php";  
if(isset($_GET['type']) && $_GET['type'] == "delete"){
   $id = $_GET['id'];
   query("delete from products where id={$id}");
   header("location: product.php");
}
if(isset($_GET['type']) && $_GET['type'] == "status"){
   $id = safe($_GET['id']);
   if($_GET['status']=="Active"){
      $status = 1;
   }elseif($_GET['status']=="Dactive"){
      $status = 0;
   }else{
      $status = "";
   }
   if($status == 0 || $status == 1){
      $check = query("update products set status='{$status}' where id={$id}");
   }
}
?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Products &nbsp;&nbsp;<a class="badge-add" href="manage_products.php">add new</a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <?php 
                                 $res = query("select products.*,categoris.category_name from products,categoris where products.category_id=categoris.category_id order by products.id desc");
                                 confirm($res);
                              ?>
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Image</th>
                                       <th>Category</th>
                                       <th>Name</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>QTY</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       if(counter($res) > 0){
                                          $sl = 1;
                                          while($row = f_array($res)){
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $sl; ?>.</td>
                                       <td><?php echo $row['id']; ?></td>
                                       <td><img src="../media/product/<?php echo $row['img']; ?>" /></td>
                                       <td><span class="name"><?php echo $row['category_name']; ?></span> </td>
                                       <td><span class="name"><?php echo $row['name']; ?></span> </td>
                                       <td><span class="name"><?php echo $row['mrp']; ?></span> </td>
                                       <td><span class="name"><?php echo $row['price']; ?></span> </td>
                                       <td><span class="name"><?php echo $row['qty']; ?></span> </td>
                                       <td>
                                          <?php if($row['status'] == 1){echo "<a href='?type=status&id={$row['id']}&status=Dactive' class='badge badge-complete'>Active</a>";}else{echo "<a href='?type=status&id={$row['id']}&status=Active' class='badge badge-pending'>Dactive</a>";} ?>
                                          &nbsp;<a href="manage_products.php?id=<?php echo $row['id']; ?>" class="badge badge-edit">Edit</a>&nbsp;<a onclick="return confirm('Are you sure?')" href='?type=delete&id=<?php echo $row['category_id']; ?>' class="badge badge-delete">Delete</span>
                                       </td>
                                    </tr>
                                    <?php 
                                    $sl++;
                                 }
                              }
                              ?>
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