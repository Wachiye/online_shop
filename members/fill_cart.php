<?php
include_once('../db_control.php');

$access = new Access();

include_once('details.php');

    if(isset($_SESSION['cart']))
        $cart = $_SESSION['cart'];

$myid = $_SESSION['myid'];

if (isset($_POST['empty']))
{
    $query ="DELETE FROM $cart";
    $result= $access->query($query);
    if($result)
    {
        header('location:items.php?d');

    }
    else
    {
        header('location:items.php');
    }
}
if (isset($_POST['order']))
{
    if(isset($_GET['q']) && isset($_GET['p']))
    {
        $items = $_GET['q'];
        $amount = $_GET['p'];

        $order = "INSERT INTO orders(user_id,items,amount,order_status)
            VALUES($myid,$items,$amount,'Pending')";
        $order_result = $access->query($order);
        if($order_result)
        {
            $fetch_id = mysqli_fetch_row($access->query("SELECT MAX(id) as id FROM orders"));
            $fetched_id = $fetch_id[0];
            $fetch_order = $access->query("SELECT * FROM $cart");
            $rows = $access->rows($fetch_order);
            for ($i=0 ; $i <  $rows; ++$i) 
            { 
                $row = mysqli_fetch_row($fetch_order);
                $order_items = "INSERT INTO order_items VALUES( $fetched_id,'$row[0]','$row[1]',$row[2],$row[3],'$row[4]')";
                if(!$access->query($order_items))
                {
                    die("Unable to place your order");
                }
            }
            //delete cart items
            $delete_cart= $access->query("DELETE FROM ".$cart."");
            if($delete_cart)
            {
                header("location:items.php?o&e");
            }
            else
            {
                die("Error occured while emptying your cart");
            }
        }
        else
        {
            die("Could not place your order");
        }
    }
    
}
if (isset($_GET["id"]) && isset($_POST['size'])) 
{
    $id =$_GET['id'];
    $size = $_POST['size'];

    $exists = "SELECT * FROM $cart  WHERE id ='$id'";
    $result = $access->query($exists);
    $current = mysqli_fetch_row($result)[2];
    $count = $access->rows($result);
    $row = mysqli_fetch_row($access->query("SELECT * FROM tblproduct WHERE code = '$id'"));
    if($row[7] < $size || ($current + $size) > $row[7])
    {
        $message = "Only $row[7] $row[1] available.";
        header('location:items.php?f='.$message);
    }
    else
    {
        if($count == 0)
        {
            $insert = "INSERT INTO $cart VALUES('$row[2]','$row[1]',$size,$row[4]*$size,'$row[3]')";
            if($access->query($insert))
                header('location:items.php');
            else
                echo "Error";
        }
        else
        {
            $update = "UPDATE $cart SET quantity=$cart.quantity+$size, price =$row[4]*$cart.quantity  WHERE id ='$id'";
            if($access->query($update))
                header('location:items.php');
            else
                echo "Error";
        }    
    }
}
if(isset($_GET['remove']))
{
    $id = $_GET['remove'];
    $query = "DELETE FROM $cart WHERE id='$id'";
    $result = $access->query($query);
    if($result)
    {
        header('location:items.php?d');
    }
    else
    {
        header('location:items.php');
    }
}
?>