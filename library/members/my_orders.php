<?php 
include_once("details.php");
include_once('header.php');
include_once('../db_control.php');

$access = new Access();

$my_id = $_SESSION['myid'];

$query = "SELECT id,items,amount,order_date,order_status FROM orders WHERE user_id = $my_id";
$result = $access->query($query);
$count = $access->rows($result);
if($count > 0)
{
?>
 <div style="clear:both">
    </div>
        <?php include_once('nav.php'); ?>
            <div class="panel-heading text-center">
                <h5>Orders</h5>
            </div>
            <div class="panel-body">
                <div class='container-fluid table-responsive'>
                <table class="table small table-hover">
                    <tr class='bg-dark text-light small'>
                        <th>Order Id</th><th>Number of Items</th>
                        <th>Amount</th><th>Date Ordered</th><th>Order Status</th>
                    </tr>

<?php
    $rows = $access->rows($result); //rows fetched
    for ($j = 0 ; $j < $rows ; $j++)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr class='text-center'>
                <td class='small'>$row[0]</td>
                <td class='small'>$row[1]</td>
                <td class='small'>$row[2]</td>
                <td class='small'>$row[3]</td>
                <td class='small'>$row[4]</td>
                <td class='small'><button  data-toggle='collapse' data-target='#$row[0]'>View</button></td>
                <td class='small'><a class='btn-link' href='my_orders.php?remove=$row[0]'>Delete</a></td>
            </tr>
        ";
        view_details($row[0]);
    }
    echo "</table>";
    
}
else
{
    echo "<script language ='Javascript'>alert('Could not fetch orders associated to your account')
    document.location.href ='profile.php'
    </script>";
}
?>
</div>
<div class='container-fluid table-responsive'>
<?php
function view_details($id)
{
    $access = new Access();
    echo'
    <tr id='."$id".' class="collapse">
    <td colspan="7">
    <div class="container">
    <table class="table small table-bordered table-hover " style="width:flex;">
        <tr class="bg-info text-light small">
            <th>Code</th><th>Name</th>
            <th>Quantity</th><th>Price/item</th><th>Photo</th>
        </tr>';
    $query = "SELECT * FROM order_items where id=$id";
    $result= $access->query($query);
    $count = $access->rows($result);
    for ($j = 0 ; $j < $count ; $j++)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>
            <td class='small text-center'>$row[1]</td>
            <td class='small text-center'>$row[2]</td>
            <td class='small text-center'>$row[3]</td>
            <td class='small text-center'>$row[4]</td>
            <td ><img src='../$row[5]' width='20' height='20' /></td>
            </tr>";
        }
        echo "
    </table> 
    </div>
    </td>
    </tr>";
}
include_once('footer.php');
?>
<?php


if(isset($_GET['remove']))
{
    $remove = $_GET['remove'];
    $order = "DELETE FROM orders WHERE id = $remove "; 
    $deleted = $access->query($order);
    if($deleted)
    {
        $order = "DELETE FROM order_items WHERE id =$remove";
        $deleted = $access->query($order);
        if($deleted)
        {
            header('location:my_orders.php');
        }
    }
    else
    {
       
    }
}

?>
