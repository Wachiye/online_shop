<?php
include_once('../db_control.php');
$access = new Access();

if(isset($_POST['phone']) && isset($_POST['adrs']))
{
	if(!empty($_POST['phone']) && !empty($_POST['adrs']))
	{
		$phone = $access->clean($_POST['phone']);
		$address = $access->clean($_POST['adrs']);
		$id = $_GET['id'];
		$query ="UPDATE users SET address='$address', phone ='$phone' WHERE id_number=$id";
		$result = $access->query($query);
		if($result)
		{
			header('location:profile.php');
		}
		else
		{
			die("Error");
		}
	}
	else
	{
		echo "
			<script laguange='javascript'>alert('Passwords don't match')
			document.location.href='profile.php';
			</script>
			";
	}
}

elseif(isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pass']) && isset($_POST['question']) && isset($_POST['ans']))
{
	if(!empty($_POST['uname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pass']) && !empty($_POST['question']) && !empty($_POST['ans']))
	{
		$uname = $access->clean($_POST['uname']);
		$email = $access->clean($_POST['email']);
		$password = $access->clean($_POST['password']);
		$pass = $access->clean($_POST['pass']);
		$question = $access->clean($_POST['question']);
		$ans = $access->clean($_POST['ans']);
		$id = $_GET['id'];
		if($password!=$pass)
		{
			echo "
			<script laguange='javascript'>alert('Passwords don't match')
			document.location.href='profile.php';
			</script>
			";
		}
		else
		{
			$query ="UPDATE users SET username='$uname', email ='$email',password=md5('$password'),question='$question',answer='$ans' WHERE id_number=$id";
			$result = $access->query($query);
			if($result)
			{
				header('location:profile.php');
			}
			else
			{
				header('location:profile1.php');
			}	
		}
		
	}
	else
	{
		echo "
			<script laguange='Javasript'>alert('Some fields are empty)
			document.location.href='profile.php';
			</script>
			";
	}
	
}
