<?php 
session_start();
include_once('../db_control.php');
$access = new Access();
if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}
else
{
    die("You must be logged in to access the content of this page");
}
//get user details
$query = "SELECT * FROM users WHERE username ='$user' ";
$result = $access->query($query);
$count = $access->rows($result);
$row = mysqli_fetch_row($result);
if($count ==1)
{
    $id = $row[0];
    $fname = $row[1];
    $lname = $row[2];
    $uname = $row[9];
    $email = $row[5];
    $quiz = $row[7];
    $ans = $row[8];
    $address = $row[4];
    $phone = $row[3];

    if($access->rows($access->query("show tables like '%cart$id%'")) == 0)
    {
        $cart_table="CREATE TABLE cart".$id ."(
        id varchar(15) primary key,
        name varchar(30),
        quantity int,
        price double(18,2),
        image varchar(40)
        )";
        $cart = $access->query($cart_table);
        if($cart)
        {
          $_SESSION['cart'] = "cart".$id;
          $_SESSION['myid'] = $id;
        }
    }
    else
    {
        $_SESSION['cart'] = "cart".$id;
        $_SESSION['myid'] = $id;   
    }
    
    
}
else
{
    echo '<script language="javascript"> alert("Login was successful but an error occured while processing your account details.")
			document.location.href = "../login.php" ; </script>';
}
?>