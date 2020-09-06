<?php
include_once('details.php');
include_once("../db_control.php");
check_debt();
//check if user has a debt
function check_debt()
{
    $access = new Access();
    $id = $_SESSION['myid'];
    $query = "SELECT * FROM debts WHERE user_id = $id and amount=0";
    $result = $access->query($query);
    if(!$result)
    {
        echo "<script language = 'Javascript'>
        alert('Sorry,something went wrong while preparing your account for deletion.')
        document.location.href='profile.php' </script>";
    }
    $count = $access->rows($result);
    if($count == 0)
        delete();
    else
    {
        echo "<script language = 'Javascript'>
        alert('You still owe us some money. Account can't be deleted. 
        Please contact us for more details')
        document.location.href='profile.php' </script>";
    }
}
function delete()
{
    $access = new Access();
    $id = $_SESSION['myid'];
    $del_user = "DELETE FROM users WHERE id_number = $id";
    $del_orders = "DELETE FROM orders WHERE user_id = $id";
    $del_trans = "DELETE FROM transactions WHERE id_number = $id";
    $del_wallet = "DELETE FROM wallet WHERE id= $id";
    if($access->query($del_user) && $access->query($del_orders) && $access->query($del_trans) && $access->query($del_wallet))
    {
        echo "<script language = 'Javascript'>
        alert('Account deleted successfully. Thank you.')
        document.location.href='logout.php' </script>";
    }
    else
    {
        echo "<script language = 'Javascript'>
        alert('There was an error deleting your account. Please contact us for help. Thank you.')
        document.location.href='profile.php' </script>";
    }
}
?>