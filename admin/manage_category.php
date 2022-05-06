<?php 
include "header.php";
if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = safe($_GET['id']);
	$data = query("select * from categoris where category_id = '{$id}'");
	if(counter($data) > 0){
		$cat_data = f_array($data);
	}else{
		header("location: categorise.php");
		die();
	}
}

if(isset($_POST['submit'])){
		$cat_name = safe($_POST['cat_name']);
		$res = query("select * from categoris where category_name = '{$cat_name}'");
		$check = counter($res);
		$msg="";
		if($check > 0){
			if(isset($_GET['id']) && $_GET['id'] != ""){
			$getdata = f_array($res);
			if($id==$getdata['category_id']){
				$msg="";
			}else{
				$msg = "Category allready exists";
			}
		}else{
			$msg = "Category allready exists";
		}
	}
		if($msg == ""){
			if(isset($_GET['id']) && $_GET['id'] != ""){
				$res = query("update categoris set category_name='{$cat_name}' where category_id = {$id}");
			}else{
				query("insert into categoris (category_name,status) value('{$cat_name}',1)");
			}
			header("location: categorise.php");
			die();
		}
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Categorise</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                           		<div class="form-group"><label for="cat_name" class=" form-control-label">Category</label><input name="cat_name" type="text" id="cat_name" placeholder="Enter your Category name" value="<?php if(isset($cat_data['category_name'])){echo $cat_data['category_name'];} ?>" class="form-control" required></div>
	                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
	                            <span id="payment-button-amount">Submit</span>
	                            </button>
                           </form>
                           <?php if(isset($msg)){echo "<div class='alert alert-danger mt-3'>".$msg."</div>";} ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php 
include "footer.php";
?>