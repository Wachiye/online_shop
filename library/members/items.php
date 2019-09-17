<?php
session_start();

if(isset($_SESSION['cart']))
	$cart = $_SESSION ['cart'];

	include_once('header.php');
	include_once('../db_control.php');

	$access = new Access();
?>
        
<?php
include_once('nav.php');

cart_items();
if(isset($_POST['search']))
{
	search();
}
elseif (isset($_POST['filter']) ) 
{
	filter();
}
else
{
	$access = new Access();
	$items_query = "SELECT * FROM tblproduct ORDER BY id ASC";
	$items_result = $access->query($items_query);
	$count = $access->rows($items_result);
	if($count >= 1)
	{
		
		display_data($items_result);
		
	}
	else
	{
		echo '<script language="Javascript">
		alert("Soryy, attempt to fetch items details has failed.")
		document.location.href="profile.php"
		</script>';
	}
}

function cart_items()
{
	$access = new Access();
	if(isset($_SESSION['cart']))
		$cart = $_SESSION['cart'];
	$query = "SELECT * FROM $cart ";
	$result =$access->query($query);
	$quantity = mysqli_fetch_row($access->query("SELECT SUM(quantity) FROM $cart"))[0];
	$price = mysqli_fetch_row($access->query("SELECT SUM(price) FROM $cart "))[0];
	$count = $access->rows($result);
	if($count > 0)
	{
		echo "
		<div class='panel-heading'>
		<h5>Items In Cart</h5>
		</div>
		<div class='panel-body table-responsive'>
            <table class='table table-sm table-hover table-striped'>
                <tr><th>Image</th><th>Code</th><th  colspan='3'>Name</th><th class='text-center'>Quantity</th><th>Price</th><th>Remove</th></tr>";
		for ($i=0; $i < $count; $i++) { 
			
			$row = mysqli_fetch_row($result);
			echo "
			<tr><td  class='text-center'><img src='../$row[4]' alt='' width='20' height='20'></td>
				<td  class='text-center'>$row[0]</td>
				<td  colspan='3' class='justify'>$row[1]</td>
				<td  class='text-center'>$row[2]</td>
				<td  class='text-center'>$row[3]</td>
				<td  class='text-center'>
					<a href='fill_cart.php?remove=$row[0]' class='btn-link'>
						<img src='icon-delete.png' alt='Remove'>
					</a>
				</td>
			</tr>";
		}
		echo "
		<tr><td></td><td></td><td></td>
			<td  class='text-center'>$quantity</td>
			<td  class='text-center'>$price</td>
		</tr>
		<tr class='bg-light'><td colspan='2'>
				<form action='fill_cart.php' method='POST'>
					<button class='btn btn-outline-danger btn-block' form-control-sm name='empty'>Empty Cart</button>
				</form>
			<td>
			<td colspan='2'>
				<form action='fill_cart.php?q=$quantity&p=$price' method='POST'>
					<button class='btn btn-success btn-block' form-control-sm name='order'>Make Order</button>
				</form>
			</td>
		</tr>
        </table>
        </div>";
		
	}
	else
	{
		cart_empty();
	}
}

function filter()
{
	$access = new Access();
	if(isset($_POST['filter']))
	{
		$select = $_POST['filter'];

		$query= "SELECT * FROM tblproduct WHERE category like '%$select%'";
		$count = $access->rows($access->query($query));
		if($count >=1)
		{
			display_data($access->query($query));
		}
		else
		{
			header('location:items.php');
		}	
	}
	
}

function search()
{
	$access = new Access();
	if(isset($_POST['search']))
	{
		$search = $_POST['search'];
		$query = "SELECT * FROM tblproduct where tblproduct.name like '%$search%' or tags like '%$search%' ";
		$count = $access->rows($access->query($query));
		if($count >=1)
		{
			display_data($access->query($query));
		}
		else
		{
			header('location:items.php');
		}
	}
	
}
function display_data($result)
{
	$rows = mysqli_num_rows($result);
	if( isset($_GET['o']))
		success_order();
	if( isset($_GET['d']))
		success_delete();
	if( isset($_GET['e']))
		cart_empty();
	if( isset($_GET['f']))
	{
		$message = $_GET['f'];
		order_fail($message);
	}	
	echo '
	<div class="container-fluid my-2">
   <form class="form-inline" action="items.php" method="POST">
 		<div class="form-group mx-2">
 			<select name="category" id="category">
                <option value="Laptop">Electronics</option>
                <option value="Laptop">Kitchen Appliances</option>
                <option value="Laptop">Office Tools</option>
                <option value="Laptop">Beds/Chairs</option>
            </select>
 		</div>
        <div class="form-group mx-2">
    		<input class="form-control form-control-sm" type="search" name="search" id="search" placeholder="Search ...">
    		<button class="btn btn-outline-info btn-sm"><i class="fa fa-fw fa-search"></i>Search</button>
    	</div>
        <div class="form-group mx-2">
        	<select class="float-left form-control form-control-sm"  name="filter" id="filter" >
                <option value="PC">PC</option>
                <option value="Phone">Phone</option>
                <option value="Speaker">Speakers/Earphones</option>
                <option value="Tablets">Tablets/iPads</option>
                <option value="Laptop">Laptops</option>
                <option value="Bags">Laptop Bags</option>
                <option value="cover">Laptop Covers</option>
                <option value="Processors">Processors</option>
            </select>
            <button class="btn btn-outline-info btn-sm"><i class="fa fa-fw fa-filter"></i>Filter</button>
    	</div>
    </form>
</div>';
	for ($i=0; $i <$rows ; $i++) { 
		$row = mysqli_fetch_row($result);
		echo " 
		<div class ='item'>
				<form action='fill_cart.php?id=$row[2]' method = 'post'>
				<div class='image small'>";
				if($row[8] == 'True')
					{
						echo "<div class='offer bg-danger p-1 text-light'>On Offer</div>";
					}
			echo "	<img src='../$row[3]' width='100%' height='auto'><span class='bg-info badge item-badge'>$row[7]</span></div>
				<div class='name  small'>$row[1]</div>
				<div class='price small'>Ksh $row[4]</div>
				<div class='small text-center info'><a class='btn btn-link btn-sm' href='#'>More</a></div>
				<div style='clear:both'></div>
				<div class='size small'><input class='form-control form-control-sm' type='text' name='size' id='size' value='1'></div>
				<div class='add-btn'><input class='form-control form-control-sm' type='submit' value='Add' /></div>
				</form>
			</div>";
	}
	echo "</div>"	;
}

function order_fail($message)
{
	echo "
		<div class='container alert alert-warning alert-dismissible'>
            <button class='close' type='button' data-dismiss='alert'>
                <span>&times;</span>
            </button>
            <strong>Error: </strong>".$message
        ."</div>
	";
}
function success_order()
{
	echo "
		<div class='container alert alert-success alert-dismissible'>
            <button class='close' type='button' data-dismiss='alert'>
                <span>&times;</span>
            </button>
            <strong>Order Created. </strong>An email will be sent to you once processed. Meanwhile check your inbox. Thank you.
        </div>
	";
}
function success_delete()
{
	echo "
		<div class='container alert alert-danger alert-dismissible'>
            <button class='close' type='button' data-dismiss='alert'>
                <span>&times;</span>
            </button>
            <strong>Item(s) removed. </strong>
        </div>
	";
}
function cart_empty()
{
	echo "
		<div class=' container alert alert-info alert-dismissible fade show' role='alert'>
            <button class='close' type='button' data-dismiss='alert'>
                <span>&times;</span>
            </button>
            <em>No items in cart</em></button>
        </div>
	";
}
?>
<script>

</script>