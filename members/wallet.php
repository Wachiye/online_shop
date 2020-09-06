<?php 
include_once("details.php");
include_once('../db_control.php');
$access = new Access();
$credit_query = "SELECT amount FROM debts WHERE user_id = $id";
$credit_result = $access->query($credit_query);
$count = $access->rows($credit_result);
if($count == 0)
{
	$credit = 0;
}
else
{
	$credit = mysqli_fetch_row($credit_result)[0];
}

$myorders = $access->query("SELECT id FROM orders WHERE user_id = $id AND order_status like '%processed%'");
$orders = $access->rows($myorders);
?>
<?php include_once('header.php'); ?>
		<?php include_once('nav.php'); ?>
			<div class="panel-header text-center">
				<h5>Deposit to pay your credits</h5>
			</div>
			<div class='panel-body'>
				<form class = 'p-2 float-left clearfix' action = "deposit.php" METHOD = "POST" role='form' >
					<div class="form-group">
						<label for='email'>Email</label>
	                	<input  class='form-control form-control-sm' type ="email" name ="email" size = "25" value=" <?php echo $email ?>" disabled>
					</div>
					<div class="form-group">
						<label for='balance'>You owe us</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Ksh</span>
							</div>
							<input  class='form-control form-control-sm' type ="text" name ="balance" size = "25" value="<?php echo $credit ?>" disabled>
							<div class="input-group-append">
								<span class="input-group-text">.00</span>
							</div>
						</div>
	               </div>
					<div class="form-group">
						<label for='mpesa_code'>M-Pesa Code</label>
	                	<input  class='form-control form-control-sm' type ="text" name ="mpesa_code" size = "25" >
					</div>
					<div class="form-group">
		                <label for='amount'>Amount</label>
						<input class='form-control form-control-sm' type ="text" name ="amount" size = "25" >
					</div>
					<div class="form-group">
						<label for="order">Order</label> <span class='text-info'><em>select order id</em></span>
						<select name="order" id="order" class="form-control">
							<?php
								for ($i=0; $i < $orders; $i++) 
								{ 
									$val = mysqli_fetch_row($myorders);
									echo "<option class='text-light' value='$val[0]'>$val[0]</option>";
								}
							?>
						</select>
					</div>
					<div class="btn-group">
						<button class="btn btn-success btn-sm mr-3" type='submit'>Deposit</button>
					</div>
				</form>
				<div class="float-left clearfix bg-info p-2 mx-3" style='border-radius:2em;'>
					<em class='text-light'>How to deposit and pay your credits</em><br>
					<ol class='list'>
						<li>Open your M~Pesa Toolkit</li>
						<li>Select <strong>Lipa na M-PESA</strong></li>
						<li>Select <strong>Buy Goods and Services</strong> </li>
						<li>Enter <strong>till no: <em>636002</em></strong> </li>
						<li>Enter the amount you want to pay(<em>Full amount</em>)</li>
						<li>Enter you M-PESA PIN</li>
						<li>Confrim transaction by clicking OK</li>
						<span class='text-light'>After depositing to the till no, Proceed as follows</span>
						<li>Log in to your account : <a class='text-dark' href="wallet.php">www.easytech.com</a></li>
						<li>Scroll down to your wallet page</li>
						<li>Enter the M-PESA code you recieved</li>
						<li>Enter the amount you deposited</li>
						<li>Select the Order id you want to pay for.</li>
						<span class='text-warning'><strong>NOTE:</strong> Only Processed orders can be paid for</span>
						<li>Click Deposit and wait for a confimation message from EasyTech</li>
						<span class='text-light float-right'><em>Buy many, spend less.</em></span>
					</ol>
				</div>
			</div>
<?php include_once('footer.php'); ?>