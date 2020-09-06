<?php
include_once('../db_control.php');

$access = new Access();

require_once("details.php");

if(isset($_SESSION['myid']))
{	
	$cart =$_SESSION['cart'];

	$query = "DROP TABLE $cart";
	$result = $access->query($query);
	if($result)
	{
		session_destroy();
	    sleep(2);
	    header("location: ../index1.php");
	}
	else
	{
		die("Sorry, an error occured while logging you out");
	}
    
}