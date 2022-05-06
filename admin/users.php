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
                           <h4 class="box-title">Contact Us</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <?php 
                                 $res = query("select * from users");
                                 confirm($res);
                              ?>
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Phone</th>
                                       <th>Date</th>
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
                                       <td><span class="name"><?php echo $row['name']; ?></span> </td>
                                       <td><span style="text-transform: initial;" class="email"><?php echo $row['email']; ?></span> </td>
                                       <td><span class="phone"><?php echo $row['mobile']; ?></span> </td>
                                       <td><span class="name"><?php echo $row['added_on']; ?></span> </td>
                                       <td>
                                          <a onclick="return confirm('Are you sure?')" href="?type=delete&id=<?php echo $row['id']; ?>" class="badge badge-delete">Delete</a>
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