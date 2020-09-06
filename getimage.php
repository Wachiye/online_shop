<?php
	
	include("login.php");
	/*get user id for retreiving image from database*/
	$id = $_GET['id'];

	//query to fetch image from database
	$query = "SELECT photo FROM users WHERE id = $id";
	//execute query
	$result = myslqi_query(%$db_server, $query);
	$row = mysqli_fetch_assoc($result);

	//specify return type
	header("content-type: image/png");
	echo $row['photo'];
?>