<?php

include_once('details.php');
	$myid = $id;
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$to = $email;
	$subject = "ORDER RECEIVED AND IS BEING PROCESSED";

	$name = $uname;
	$from = "siranjofuw@gmail.com";

	$order = mysqli_fetch_row(mysqli_query($db_server,"SELECT * FROM orders WHERE id = $id AND order_status ='Pending'"));
	$get_items = mysqli_query($db_server,"SELECT * FROM order_items WHERE id = $id");
	$items = mysqli_num_rows($get_items);
	
	$message = "
	<html>
	<head>
		<title> Your order has been recieved and is being processed</title>
	</head>
	<body>
		<p>Below is your order summary</p>
		<p>Username : $name <br>ID: $myid<br>Order ID: $order[0]<br>No of Items: $order[2]<br>Amount to Pay: Ksh $order[3]
		<br>Date Ordered: $order[4] <br>Order Status: $order[5]<br></p>
		<p>Below are is the list of items selected</p>
		<table>
			<th>Item Code</th> <th>Name</th> <th>Quantity</th> <th>Price</th> <th>Image</th>" ;
	for ($i=0; $i < $items; ++$i) 
	{ 
		$item = mysqli_fetch_row($get_items);
		$message .= "
		<tr><td>$item[0]</td>
			<td>$item[1]</td>
			<td>$item[2]</td>
			<td>$item[3]</td>
			<td><img src ='$item[4]' width='50' height='50' ></td>
		</tr>" ;
	}
	$message .= "
		</table>
		<br>
		<p>If you wish to cancel this order, please send as a reply within 3 days of receiving this email</p>
		<p>We are processing your order and a confirmation email will be send to you after processing. Thank you.</p>
		<p>EasyTech,</br>www.easytech.co.ke</p>
	</body>
	</html>" ;

	//contect type
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html ; charset=iso-8859-1';

	$headers[] = 'X-Mail:'.PHP_VERSION;
	$headers[] ='From:jerrysirah8@gmail.com';
	//sent mail
	if(mail($to,$subject,$message,implode("\r\n", $headers)))
		echo "Mail sent";
	else
		echo("Not sent");
}
?>