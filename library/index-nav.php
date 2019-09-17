<div class="index-main">
	<nav class='navbar index-main-nav'>
		<ul class="nav navbar-nav index-nav nav-justified ">
			<li class="nav-item">
				<a class="nav-link" href='index1.php'>Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href='about.php'>About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href='contact.php'>Contact</a>
			</li>
			<li class="nav-item">
				<button class="btn btn-link btn-sm" data-toggle='modal' data-target='#login'>Login/Signup</button>
			</li>
		</ul>
	</nav>
	<div style='clear:both;'></div>
		<form class="float-right clearfix index-main-form">
			<div class="float-right clearfix btn-group mx-2">
				<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Tablet</a></li>
					<li><a href="#">Smartphone</a></li>
					<li><a href="#">Tablet</a></li>
					<li><a href="#">Smartphone</a></li>
					<li><a href="#">Tablet</a></li>
					<li><a href="#">Smartphone</a></li>
				</ul>
			</div>
			<div class='float-right clearfix'>
				<button class='float-right clearfix  btn-sm btn btn-success ml-2'>Search</button>
			</div>
			<div class="float-right clearfix">
				<input class='float-right clearfix ml-2 form-control form-control-sm' type="search" name="search" placeholder="Search...">
			</div>
		</form>
	</div>
</div>
<div id='login' class="modal fade" role='dialog'>
	<div class="modal-dialog ">
		<div class="modal-content bg-dark text-light">
			<div class="modal-header">
				<h6 class="modal-title ">EasyTech::Login</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form class='p-2 my-2' action="wp-login.php" method="post">
					<div class="form-group my-2">
						<span><i class='fa fa-fw fa-user'></i></span>
						<input class='form-control form-control-sm' type = "text" name = "username" placeholder = "Username">
					</div>
					<div class="form-group my-2">
						<span><i class='fa fa-fw fa-lock'></i></span>
						<input class='form-control form-control-sm' type = "password" name = "password" placeholder = "Password">
					</div>
					<div class="container my-2">
						<button class='btn btn-sm btn-success' type="submit"><i class='fa fa-fw fa-sign-in'></i>Sign In</button>
						<a href = "forgotPassword.php">Forgot Password?</a>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<em>You don't have an account? Click <a href='register.php' target='_BLANK'	>here</a></em>
			</div>
		</div>
	</div>
</div>
