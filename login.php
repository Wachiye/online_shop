<?php
include_once('header.php');
?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="login">Open Modal</button>

<!-- Modal -->
<div id="login" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">EasyTech::Login</h4>
			</div>
			<div class="modal-body">
				<form class='p-2 my-2' action="wp-login.php" method="post">
					<div class="form-group my-2">
						<div class="float-left clearfix">
							<i class='fa fa-fw fa-user'></i>
						</div>
						<div class='float-left clearfix'>
							<input class='form-control form-control-sm' type = "text" name = "username" placeholder = "Username">
						</div>
					</div>
					<div style='clear:both;'></div>
					<div class="form-group my-2">
						<div class="float-left clearfix">
							<i class='fa fa-fw fa-lock'></i>
						</div>
						<div class="float-left">
							<input class='form-control form-control-sm' type = "password" name = "password" placeholder = "Password">
						</div>
					</div>
					<div style='clear:both;'></div>
					<div class="container my-2">
						<button class='btn btn-sm btn-success' type="submit"><i class='fa fa-fw fa-sign-in'></i>Sign In</button>
						<a href = "forgotPassword.php">Forgot Password?</a>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
    	</div>
	</div>
</div>
<div class="container bg-dark text-light mt-3">
	<div class="container text-center">
		<h3>EasyTech</h3>
	</div>
	<form class='p-2 my-2' action="wp-login.php" method="post">
		<div class="form-group my-2">
			<div class="float-left clearfix">
				<i class='fa fa-fw fa-user'></i>
			</div>
			<div class='float-left clearfix'>
				<input class='form-control form-control-sm' type = "text" name = "username" placeholder = "Username">
			</div>
		</div>
		<div style='clear:both;'></div>
		<div class="form-group my-2">
			<div class="float-left clearfix">
				<i class='fa fa-fw fa-lock'></i>
			</div>
			<div class="float-left">
				<input class='form-control form-control-sm' type = "password" name = "password" placeholder = "Password">
			</div>
		</div>
		<div style='clear:both;'></div>
		<div class="container my-2">
			<button class='btn btn-sm btn-success' type="submit"><i class='fa fa-fw fa-sign-in'></i>Sign In</button>
			<a href = "forgotPassword.php">Forgot Password?</a>
		</div>
	</form>
</div>