<?php
include_once('db_control.php');
//include_once('header.php');

$access = new Access();

if(isset($_GET['edit']))
{
	$code = $_GET['edit'];
	$name = $access->clean($_POST['name']);
	$cat = $access->clean($_POST['category']);
	$tags = $access->clean($_POST['tags']);
	$size = $access->clean($_POST['quantity']);
	$price = $access->clean($_POST['price']);
	$query = "UPDATE tblproduct SET 
				name='$name',category='$cat',tags='$tags',quantity=$size,price=$price WHERE code='$code' ";
	$item = $access->query($query);
	if($item)
	{
		header('location.items.php');
	}
	else
	{
		die("An error occured while processing your request.");
	}
}

?>
