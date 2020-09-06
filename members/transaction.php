<?php
include("details.php");
include_once('../db_control.php');

$access = new Access();

$data = "SELECT mpesa_code,amount,date,service_type FROM transactions WHERE id_number = $id";
$result = $access->query($data);
if(!$result)
{
	echo '<script language="Javascript"> alert("No transacrtions found")
	document.location.href = "profile.php"; </script> ';
}
?>
</head>
<body>
<?php include_once('header.php'); ?>
	<div style="clear:both">
	</div>
		<?php include_once('nav.php'); ?>
			<div class="panel-heading">
				<h5>Transactions</h5>
			</div>
			<div class='panel-body'>
				<table class="table table-striped">
					<tr class='bg-dark text-light'>
						<th>Mpesa Code</th>
						<th>Amount</th>
						<th>Date</th>
						<th>Service Type</th>
					</tr>
			<?php
				$rows = $access->rows($result);
				for ($j = 0 ; $j < $rows ; ++$j)
				{
					$row = mysqli_fetch_row($result);
					echo "<tr>
					<td>$row[0]</td>
					<td>$row[1]</td>
					<td>$row[2]</td>
					<td>$row[3]</td>
					</tr>";
					
				}
				echo "</table>
				</div>";
			?>

	<?php include_once('footer.php'); ?>