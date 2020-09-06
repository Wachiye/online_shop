<?php
session_start();
include_once("db_control.php");
$access = new Access();

if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $access->clean($_POST['username']); //clean username
	$password = $access->clean($_POST['password']); //clean password
	$admin = $access->login("SELECT * FROM admins WHERE username='$username' AND password = md5('$password')",$username);
	$member = $access->login("SELECT * FROM users WHERE username='$username' AND password = md5('$password')",$username);
	if($admin)
	{
		printf("Login was successful. Please wait...");
		sleep(3);
		header('location: profile.php');
	}
	elseif($member)
	{
		printf("Login was successful. Please wait...");
		sleep(3);
		header('location: members/profile.php');
	}
	elseif ($admin == $member) 
	{
		printf("Sorry, access to $username has been temporarily denied. \n Adminstrater has been notified and it is being worked on." );
		sleep(3);
		header('location: index1.php');
	}
	else
	{
		printf("Wrong username or password combination. Redirecting to login page ...");
		sleep(3);
		header('location: index1.php');
	}
}
?>
