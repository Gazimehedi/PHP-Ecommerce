<?php include "header.php";  
if(isset($_GET['type']) && $_GET['type'] == "delete"){
   $id = $_GET['id'];
   query("delete from categoris where category_id={$id}");
   header("location: categorise.php");
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
      query("update categoris set status='{$status}' where category_id={$id}");
   }
}
?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Categoris &nbsp;&nbsp;<a class="badge-add" href="manage_category.php">add new</a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <?php 
                                 $res = query("select * from Categoris");
                                 confirm($res);
                              ?>
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
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
                                       <td><?php echo $row['category_id']; ?></td>
                                       <td><span class="name"><?php echo $row['category_name']; ?></span> </td>
                                       <td>
                                          <?php if($row['status'] == 1){echo "<a href='?type=status&id={$row['category_id']}&status=Dactive' class='badge badge-complete'>Active</a>";}else{echo "<a href='?type=status&id={$row['category_id']}&status=Active' class='badge badge-pending'>Dactive</a>";} ?>
                                          &nbsp;<a href="manage_category.php?id=<?php echo $row['category_id']; ?>" class="badge badge-edit">Edit</a>&nbsp;<a onclick="return confirm('Are you sure?')" href='?type=delete&id=<?php echo $row['category_id']; ?>' class="badge badge-delete">Delete</span>
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