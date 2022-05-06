<?php 
include "header.php";
if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = safe($_GET['id']);
	$data = query("select products.*,categoris.category_name from products,categoris where products.id = '{$id}'");
	if(counter($data) > 0){
		$product_data = f_array($data);
	}else{
		header("location: product.php");
		die();
	}
}
if(isset($_GET['id']) && $_GET['id'] != ""){
	$required = "";
}else{
	$required = "required";
}
if(isset($_POST['submit'])){
		$category = safe($_POST['category']);
		$name = safe($_POST['name']);
		$mrp = safe($_POST['mrp']);
		$price = safe($_POST['price']);
		$qty = safe($_POST['qty']);
		$short_desc = safe($_POST['short_desc']);
		$description = safe($_POST['description']);
		$meta_title = safe($_POST['meta_title']);
		$meta_desc = safe($_POST['meta_desc']);
		$meta_keyword = safe($_POST['meta_keyword']);
		
		$res = query("select * from products where name = '{$name}'");
		$check = counter($res);
		$msg="";
		if($check > 0){
				if(isset($_GET['id']) && $_GET['id'] != ""){
					$required = "";
					$getdata = f_array($res);
				if($id==$getdata['id']){
					$msg="";
				}else{
					$msg = "Product allready exists";
				}
			}else{
			$msg = "Product allready exists";
		}
	}
	if($msg == ""){
		if(isset($_GET['id']) && $_GET['id'] != ""){
			if(!empty($_FILES['image']['name'])){
				$image = rand(111111111,999999999)."-".$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'], "../media/product/".$image);
				$res = query("update products set category_id='{$category}',name='{$name}',mrp='{$mrp}',price='{$price}',qty='{$qty}',short_desc='{$short_desc}',description='{$description}',meta_title='{$meta_title}',meta_desc='{$meta_desc}',meta_keyword='{$meta_keyword}',img='{$image}' where id = {$id}");
			}else{
				$res = query("update products set category_id='{$category}',name='{$name}',mrp='{$mrp}',price='{$price}',qty='{$qty}',short_desc='{$short_desc}',description='{$description}',meta_title='{$meta_title}',meta_desc='{$meta_desc}',meta_keyword='{$meta_keyword}' where id = {$id}");
			}
			
		}else{
			$image = rand(111111111,999999999)."-".$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], "../media/product/".$image);
			query("insert into products (category_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,img,status) value('{$category}','{$name}','{$mrp}','{$price}','{$qty}','{$short_desc}','{$description}','{$meta_title}','{$meta_desc}','{$meta_keyword}','{$image}',1)");
		}
		header("location: product.php");
		die();
	}
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Product</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                           		<div class="form-group">
                           			<label for="category" class=" form-control-label">Category</label>
                           			<select name="category" id="category" class="form-control">
                           				<option value="">Select Category</option>
                           				<?php 
                           					$res = query("select * from categoris");
                           					while ($row = f_array($res)) {
                           						if(isset($_GET['id']) && $row['category_id'] == $product_data['category_id']){
                           							$selected = "selected";
                           						}else{
                           							$selected = "";
                           						}
                           						echo "<option value='{$row['category_id']}' {$selected}>{$row['category_name']}</option>";
                           					}
                           				 ?>
                           				
                           			</select>
                           		</div>
                           		<div class="form-group">
                           			<label for="name" class=" form-control-label">Name</label><input name="name" type="text" id="name" placeholder="Enter your Product name" value="<?php if(isset($product_data['name'])){echo $product_data['name'];} ?>" class="form-control" required>
                           		</div>
                           		<div class="form-group">
                           			<label for="mrp" class=" form-control-label">MRP</label>
                           			<input name="mrp" type="text" id="mrp" placeholder="Enter your Product MRP" value="<?php if(isset($product_data['mrp'])){echo $product_data['mrp'];} ?>" class="form-control" required>
                           		</div>
                           		<div class="form-group">
                           			<label for="price" class=" form-control-label">Price</label>
                           			<input name="price" type="text" id="price" placeholder="Enter your Product Price" value="<?php if(isset($product_data['price'])){echo $product_data['price'];} ?>" class="form-control" required>
                           		</div>
                           		<div class="form-group">
                           			<label for="qty" class=" form-control-label">Quantity</label>
                           			<input name="qty" type="text" id="qty" placeholder="Enter your Product Quantity" value="<?php if(isset($product_data['qty'])){echo $product_data['qty'];} ?>" class="form-control" required>
                           		</div>
                           		<div class="form-group">
                           			<label for="image" class=" form-control-label">Image</label>
                           			<input name="image" type="file" id="image" class="form-control" <?php echo $required; ?>>
                           		</div>
                           		<div class="form-group">
                           			<label for="short_desc" class=" form-control-label">Short Description</label>
                           			<textarea name="short_desc" type="text" id="short_desc" placeholder="Enter your Product Short Description" class="form-control" required><?php if(isset($product_data['short_desc'])){echo $product_data['short_desc'];} ?></textarea>
                           		</div>
                           		<div class="form-group">
                           			<label for="description" class=" form-control-label">Description</label>
                           			<textarea rows="5" name="description" type="text" id="description" placeholder="Enter your Product Description" class="form-control" required><?php if(isset($product_data['description'])){echo $product_data['description'];} ?></textarea>
                           		</div>
                           		<div class="form-group">
                           			<label for="meta_title" class=" form-control-label">Meta Title</label>
                           			<textarea name="meta_title" type="text" id="meta_title" placeholder="Enter your Product Meta Title" class="form-control"><?php if(isset($product_data['meta_title'])){echo $product_data['meta_title'];} ?></textarea>
                           		</div>
                           		<div class="form-group">
                           			<label for="meta_desc" class=" form-control-label">Meta Description</label>
                           			<textarea rows="5" name="meta_desc" type="text" id="meta_desc" placeholder="Enter your Product Meta Description" class="form-control"><?php if(isset($product_data['meta_desc'])){echo $product_data['meta_desc'];} ?></textarea>
                           		</div>
                           		<div class="form-group">
                           			<label for="meta_keyword" class=" form-control-label">Meta Keyword</label>
                           			<textarea rows="5" name="meta_keyword" type="text" id="meta_keyword" placeholder="Enter your Product Meta Keyword" class="form-control"><?php if(isset($product_data['meta_keyword'])){echo $product_data['meta_keyword'];} ?></textarea>
                           		</div>

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