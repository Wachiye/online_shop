<?php 
include_once("details.php");
include_once('../db_control.php');
$access = new Access();
?>
</head>
<body>
<?php include_once('header.php'); ?>
	<div style="clear:both">
	</div>
		<?php include_once('nav.php'); ?>
			<div class="panel-heading">
				<ul class="nav nav-tabs ">
					<li class = "mr-2"><a href="profile.php">Personal Details</a></li>
					<li class = "active "><a href="security.php">Security/Login Details</a></li>
				</ul>
			</div>
			<div class="panel-body p-2">
				<form action="wp-profile.php?id=<?php echo $id ?>" method="POST" role='form'>
					<div class="form-group">
						<label for="uname">Username</label>
						<input class="form-control form-control-sm" type ="text" name ="uname" size = "25" value="<?php echo $uname ?>" >
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control form-control-sm" type ="email" name ="email" size = "25" value="<?php echo $email ?>" >	
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input class="form-control form-control-sm" type ="password" name ="password" size = "25" value="" >
					</div>
					<div class='form-group'>
						<label for='pass'>Confirm Password</label>
						<input class="form-control form-control-sm" type ="password" name ="pass" size = "25" value="" >
					</div>
					<div class="form-group">
						<label for='name'>Select a security question</label>
						<select class="form-control form-control-sm" name='question' >
							<option value="birth">What is your birth place?</option>
							<option value="hobby">What is your hobby?</option>
							<option value="nickname">Wh
							at was your Highschool nickname?</option>
						</select>
					</div>
					<div class="form-group">
						<label for="ans">Answer</label>
						<input class="form-control form-control-sm" type ="text" name ="ans" size = "25" value="<?php echo $ans ?>" >
					</div>
					<button class="btn btn-success btn.sm btn-block" type='submit'>Update</button>
				</form>
			</div>

	<?php include_once('footer.php'); ?>