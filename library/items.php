<?php
	include_once('db_control.php');
	include_once('header.php');
	include_once('navigation.php');
	$access = new Access();
	$result = $access->query("SELECT * FROM tblproduct ORDER BY id");
	$count = $access->rows($result);

	function display_data($row)
	{
		echo "
		<div id ='$row[0]' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
				<div class ='modal-content'>
					<div class='modal-header'>
						<h6 class='modal-title'>Item Description</h6>
						<button type='button' class='close' data-dismiss='modal'>&times;</button>
					</div>
					<div class ='modal-body'>
						<div class='float-left clearfix' style='width:70%;'>
							<div class='item-code'>Code: $row[2]</div>
							<div class='item-name'>Name: $row[1]</div>
							<div class='item-available'>Available: $row[7]</div>
							<div class='item-price'>Price: $row[4]</div>
							<div class='item-category'>Category: $row[5]</div>
							<div class='item-tags'>Tags: $row[6] </div>
							<div class='item-offer'>On Offer?: $row[8]</div>
						</div>
						<div class='float-left clearfix' style='width:30%;'>
							<img class='img-responsive' src ='$row[3]' width='100%' height='100%'>
						</div>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn' data-dismiss='modal'>Close</button>
					</div>
				</div>
			</div>
		</div>";
		echo "
		<div id ='edit_$row[0]' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
				<div class ='modal-content'>
					<div class='modal-header'>
						<h6 class='modal-title'>Edit and Update Product</h6>
						<button type='button' class='close' data-dismiss='modal'>&times;</button>
					</div>
					<div class ='modal-body'>
						<form role='form' action='items.php?edit=$row[2]' method='POST'>	
							<div class='container'>
								<div class=\"form-grou\">
									<label for=\"name\">Name</label>
									<input class='form-control form-control-sm' type=\"text\" name=\"name\" value='$row[1]' >
								</div>
								<div class=\"form-group\">
									<label for=\"category\">Category</label>
									<input class='form-control form-control-sm' type=\"text\" name=\"category\" value=$row[5] >
								</div>
								<div class=\"form-group\">
									<label for=\"tags\">Tags</label>
									<input class='form-control form-control-sm' type=\"text\" name=\"tags\" value=$row[6]>
								</div>
								<div class=\"form-group\">
									<label for=\"quantity\">Quantity</label>
									<input class='form-control form-control-sm' type=\"text\" name=\"quantity\" value=$row[7]>
								</div>
								<div class=\"form-group\">
									<label for=\"price\">Price</label>
									<input class='form-control form-control-sm' type=\"text\" name=\"price\" value=$row[4]>
								</div>
								<div class='checkbox'>
									<label for='offer' class='mx-2'>On Offer?";
									if($row[8] == 'True')
										echo "<input type='checkbox' name='offer' id='offer' checked>";
									else
										echo "<input type='checkbox' name='offer' id='offer' >";
									echo "
									</label>		
								</div>
							</div>
							<button class=\"btn btn-success btn-block btn-sm\" type ='submit'>Update</button>
						</form>
						<form class='mt-3' action='items.php?upload=$row[2]' method = 'POST' enctype='multipart/form-data'>
							<img id='$row[0]' src=\"$row[3]\" width='100' height='100'>
							<input type=\"file\" name=\"image\" onchange='document.getElementById(\"$row[0]\").src=window.URL.createObjectURL(this.files[0])'>
							<button class='btn btn-sm btn-secondary m-2' type='submit'>Upload Photo</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		";
					
	}
?>

<div class="item-admin-header">
	<h5 class='float-left clearfix'>Items in Store
		<span class='badge bg-info'><?php echo mysqli_fetch_row($access->query("SELECT SUM(quantity) as items FROM tblproduct"))[0]; ?> 
		</span>
	</h5>
	<div class="float-left clearfix ml-3">
		<form action="" class="form-inline" role='form'>
			<input class="form-control form-control-sm mr-2" type="text" name ='search' placeholder='Search..'>
			<button class='btn btn-outline-info btn-sm' type='submit'><i class="fa fw fa-search"></i> Search</button>
		</form>
	</div>
	<div class="float-left clearfix ml-3">
		<div class="dropdown">
			<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Filter
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="#">Laptops</a></li>
				<li class="divider"></li>
				<li><a href="#">PCs</a></li>
				<li class="divider"></li>
				<li><a href="#">Tablets/Ipads</a></li>
				<li class="divider"></li>
			</ul>
		</div>
	</div>
	<div class="float-left clearfix ml-4">
		<a href="items.php" class="btn btn-warning btn-sm"><i class='fa fa-fw fa-refresh'></i>Refresh</a>
	</div>
	<div class="float-right clearfix">
		<div class="dropdown">
			<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a data-toggle='modal' data-target='#newitem'>Add New Product</a></li>
				<li class="divider"></li>
				<li><a href="#">Select All</a></li>
				<li class="divider"></li>
				<li><a href="#">Delete Selected</a></li>
			</ul>
		</div>
	</div>
</div>
<button class="float-right btn btn-success btn-sm mr-1" data-toggle='modal' data-target='#addnew'>Add New</button>
        <div id='addnew' class='modal fade' role='dialog'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title'>Add New Product</h4>
                        <button class='close' type='button' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                        <form action='items.php?add' enctype="multipart/form-data" method='post' role='form'>
                            <div class='form-group'>
                                <label for='code'>Code</label>
                                <input class='form-control form-control-sm' type='text' name='code' placeholder='Code'>
                            </div>
                            <div class='form-group'>
                                <label for='id'>Name</label>
                                <input class='form-control form-control-sm' type='name' name='name' placeholder='Name'>
                            </div>
                            <div class='form-group'>
                                <label for='category'>Category</label>
                                <select name="category">
                                    <option value="laptop">Laptop</option>
                                    <option value="pc">PC</option>
                                    <option value="tablet">Tablet/Ipad</option>
                                    <option value="storage">Storage/Memory</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='tags'>Tags</label>
                                <span class='small text-info'><em>Seperate each tag with a comma(,)</em></span>
                                <input class='form-control form-control-sm' type='text' name='tags' placeholder='tags'>
                            </div>
                            <div class='form-group'>
                                <label for='quantity'>Quantity</label>
                                <input class='form-control form-control-sm' type='text' name='quantity' placeholder='Quantity'>
                            </div>
                            <div class='form-group'>
                                <label for='price'>Price</label>
                                <input class='form-control form-control-sm' type='text' name='price' placeholder='Price'>
                            </div>
                            <div class='form-group'>
                                <label for='image'>Image</label>
                                <input type='file' accept='image/*' name='image' onchange='document.getElementById("show_image").src=window.URL.createObjectURL(this.files[0])'>
                                <img src="#" alt="Selected Image" width='100' height='auto' id='show_image'>
                            </div>
                            <div class="radio-inline">
								<span>On Offer?</span>
                                <label class="radio-inline"><input type="radio" name="offer" value='True'>Yes</label>
								<label class="radio-inline"><input type="radio" name="offer" value ='False'>No</label>
                            </div>
                            <div class="float-right">
                                <button class='btn btn-success btn-sm mr-3' type='submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <p id='date'></p>
                        <script>document.getElementById('date').innerHTML=Date()</script>
                    </div>
                </div>
            </div>
        </div>
<div style="clear:both;"></div>
<div class="panel-body">
		<?php
			
			for ($i=0; $i < $count; $i++) 
			{ 
				$row = mysqli_fetch_row($result);
				echo "
				<div class='item-admin img-thumbnail float-left clearfix m-1 p-1'>
					<div class ='image'>
						<img class='img-responsive' src = '$row[3]' width = '100%' height ='100%' alt ='$row[1]'>
					</div>
					<div class = 'small price'>Ksh $row[4]</div>
					<div class = 'small name'>$row[1]
						<div class='float-right checkbox'>
							<input type='checkbox' name ='items' value ='$row[2]'>
						</div>
					</div>
					<div class = 'item-admin-btn'>
						<span><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#$row[0]'>More</button></span>
						<span><button class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_$row[0]'>Edit</button></span>
					</div>
					";
					display_data($row);
				echo "</div>
				";
			}
		?>
</div>
</div>
</div>
<?php 
//checking for empty fields
function check_fields()
{
	if(isset($_POST['code']) && !empty($_POST['code']) 
		 && isset($_POST['name']) && !empty($_POST['name'])
		 && isset($_POST['category']) && !empty($_POST['category'])
		 && isset($_POST['tags']) && !empty($_POST['tags'])
		 && isset($_POST['quantity']) && !empty($_POST['quantity'])
		 && isset($_POST['price']) && !empty($_POST['price']) 
		 && isset($_FILES['image']) && !empty($_FILES['image']) )
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
 if(isset($_GET['add']))
 {
	 if(check_fields() == 1) //feilds not empty
		 {
			//sanitize inputs
			$code = $access->clean($_POST['code']);
			$name = $access->clean($_POST['name']);
			$cat = $access->clean($_POST['category']);
			$tags = $access->clean($_POST['tags']);
			$size = $access->clean($_POST['quantity']);
			$price = $access->clean($_POST['price']);
			$image = $_FILES['image']['name'];

			if($_POST['offer'] == 'True')
				$offer = "True";
			else
				$offer = "False";

			if(upload_image($_FILES['image']) == 1) //image saved successfully
			{
				//rename the file to item code
				rename('Products/images/'.$image,'Products/images/'.$code);
				//save product details
				$query = "INSERT INTO tblproduct(code,name,category,tags,quantity,price,image,offer)
				 VALUES('$code','$name','$cat','$tags',$size,$price,'Products/images/$code',$offer)";
				$result = $access->query($query);
				if(!$result)
				{
					echo "Erro...";
				}
			}
			else{
				echo "could not upload image";
				header('refresh:0');
			}

		 }
		 else{
			 echo "Empty fields ";
			 header('refresh:0');
		 }

 }
if(isset($_GET['edit']))
{
	//check inputs
	if(isset($_POST['name']) && !empty($_POST['name'])
		 && isset($_POST['category']) && !empty($_POST['category'])
		 && isset($_POST['tags']) && !empty($_POST['tags'])
		 && isset($_POST['quantity']) && !empty($_POST['quantity'])
		 && isset($_POST['price']) && !empty($_POST['price']) )
	{
		$code = $_GET['edit'];
		$name = $access->clean($_POST['name']);
		$cat = $access->clean($_POST['category']);
		$tags = $access->clean($_POST['tags']);
		$size = $access->clean($_POST['quantity']);
		$price = $access->clean($_POST['price']);
	
		$query = "UPDATE tblproduct SET name = '$name',category = '$cat',
		tags = '$tags',quantity = $size,price = $price WHERE code = '$code'";
		
		$result = $access->query($query);
		if(!$result)
		{
			echo "Erro...";
		}
	
	}
	else
	{
		echo "some fields are empty";
	}
	if(isset($_GET['upload']))
	{
		if(!empty($_FILES['image']))
		{
			$image = $_FILES['image']['name'];
			if(upload_image($_FILES['image']) == 1)
			{
				//rename the file to item code
				rename('Products/images/'.$image,'Products/images/'.$code);
				//save product details
				$query = "UPDATE tblproduct SET image = 'Products/images/$code' WHERE code = '$code'";
			}
		}
	}
}
if(isset($_GET['upload']))
{
	$code = $_GET['upload'];
	if(isset($_FILES['image']) && !empty($_FILES['image']))
	{
		$image = $_FILES['image']['name'];
		if(upload_image($_FILES['image']) == 1)
		{
			//rename the file to item code
			rename('Products/images/'.$image,'Products/images/'.$code);
			//save product details
			$query = "UPDATE tblproduct SET image = 'Products/images/$code' WHERE code = '$code'";
		}
	}
	else
	{
		echo "No image selected";
	}
}
function upload_image($image)
{
	$image_dir = "Products/images/";
	$target_file = $image_dir.basename($image['name']);
	$upload_ok = 1;
	$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$err = "Error: ";
	
	$check = getimagesize($image['tmp_name']);
	
	if($check !== false)
	{
		$upload_ok = 1;
	}
	else
	{
		$err.= "File is not an image.<br>";
		$upload_ok = 0;
	}
	if(file_exists($target_file))
	{
		$err .= "Sorry, file already exits.<br>";
		$upload_ok = 0;
	}
	if(file_exists($target_file) && isset($_GET['edit']))
	{
		$upload_ok = 1;
	}
	if($_FILES['image']['size'] > 500000)
	{
		$err .= "Sorry, your file is too large. Select an image less or equal to 500KB<br>";
		$upload_ok = 0;
	}

	if($image_file_type != 'jpeg' && $image_file_type != 'jpg' && $image_file_type != 'png' && $image_file_type != 'gif')
	{
		$err .="Sorry, only JPEG,JPG,GIF and PNG files are allowed.<br>";
		$upload_ok = 0;
	}

	if($upload_ok == 0)
	{
		$err .= "Sorry, your file wass not uploaded.<br>";
	}
	else
	{
		if(move_uploaded_file($image['tmp_name'],$target_file))
		{
			$upload_ok = 1;
		}
		else
		{
			echo 'Sorry, there was an error uploading your file.';
			$upload_ok = 0;
		}
	}
	if ($err != "Error: ")
		echo $err;
	return $upload_ok;
}
if(isset($_GET['remove']) && !empty($_GET['remove']))
{
	$code = $_GET['remove'];
	$query = "DELETE FROM tblproduct WHERE code = '$code'";
	if($access->query($query))
	{
		array_map("unlink",glob('Products/images/'.$code.'.*'));
	}
		header('refresh:0');
}
?>

