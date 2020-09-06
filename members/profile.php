<?php 
include_once('../db_control.php');
$access = new Access();
include_once('details.php');
?>
</head>
<body>
<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>
<div class='panel-heading text-center'>
	<em>Profile :: <?php echo $uname ?></em>
</div>
<div class="panel-body">
	<form action="wp-profile.php?id=<?php echo $id ?>" method="POST" role='form'>
		<div class="personal-details float-left clearfix p-2">
			<div class="form-group">
				<label for='id'>ID Number:</label>
				<input class='form-control form-control-sm' type ="text" name ="id" size = "25" value="<?php echo $id ?>" disabled>
			</div>
			<div class="form-group">
				<label for='fname'>First Name</label>
				<input class='form-control form-control-sm 'type ="text" name ="fname" size = "25" value="<?php echo $fname; ?>" disabled>
			</div>
			<div class="form-group">
				<label for='lname'>Last Name</label>
				<input class='form-control form-control-sm 'type ="text" name ="lname" size = "25" value="<?php echo $lname; ?>" disabled>
			</div>
			<div class="form-group">
				<label for='phone'>Phone</label>
				<input class='form-control form-control-sm 'type ="phone" name ="phone" size = "25" value="<?php echo $phone; ?>" >
			</div>
			<div class="form-group">
				<label for ='adrs'>Address</label>
				<input class='form-control form-control-sm ' type ="text" name ="adrs" size = "25" value="<?php echo $address; ?>" >
			</div>
		</div>
		<div class="security-details float-left clearfix p-2">
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
		</div>
		<div style="clear:both"></div>
		<div class="float-right btn-group">
			<button class='btn btn-sm btn-success mr-3'  type="submit" name="btnSave">Update</button>
			<a class='btn btn-danger btn-sm btn-success'  href='delete.php?id=<?php echo $id ?>'>Delete</a>
		</div>
			
	</form>
</div>
</div>
</div>