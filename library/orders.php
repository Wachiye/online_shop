<?php
include_once('db_control.php');
include_once('header.php');
include_once('navigation.php');
$access = new Access();
$pending = $access->rows($access->query("SELECT * FROM orders WHERE  order_status like '%pending%'"));
$all = $access->rows($access->query("SELECT * FROM orders "));
$shipping = $access->rows($access->query("SELECT * FROM orders WHERE  order_status like '%shipping%'"));

if(isset($_GET['confirm']))
{
    confirm_order($_GET['confirm']);
}
function view_details($id)
{
    $access = new Access();
    $order_details="SELECT * FROM order_items WHERE id = $id";
    $details = $access->query($order_details);
    $rows = $access->rows($details);
    echo "
    <tr id='$id' class='bg-light collapse'><td colspan='10'>
    <div class='container-fluid bg-light'>
        <table class='table small table-bordered'>
            <tr class='bg-dark text-light'>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            </tr>
    ";
    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_row($details);
        echo "
            <tr><td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
                <td><img src='$row[5]' width='50' height='auto' /></td>
            </tr>
        ";
    }
    echo "
    </table>
    </div></td>
    </tr>" ;

}
function display($result)
{
    $order = mysqli_fetch_row($result);
    echo "
        <tr><td>$order[0]</td>
            <td>$order[1]</td>
            <td>$order[2]</td>
            <td>$order[3]</td>
            <td>$order[4]</td>
            <td>$order[5]</td>
            <td>$order[6]</td>
            <td><button data-toggle='collapse' data-target='#$order[0]'>View</button>
                    </td>
        </tr>";
        view_details($order[0]);
}
function view_all()
{
    $access = new Access();
    $orders = "SELECT id,user_id,items,amount,order_date,order_status,address FROM orders,users
                WHERE orders.user_id = users.id_number";
    $result = $access->query($orders);
    $count = $access->rows($result);
    if($count > 0)
    {
        for ($i=0; $i < $count; $i++) { 
            display($result);
        }
        
    }
}
function view_pending()
{
    $access = new Access();
    $orders = "SELECT id,user_id,items,amount,order_date,order_status,address FROM orders,users
                WHERE orders.user_id = users.id_number and order_status like '%Pending%'";
    $result = $access->query($orders);
    $count = $access->rows($result);
    if($count > 0)
    {  
        for ($i=0; $i < $count; $i++) { 
            $order = mysqli_fetch_row($result);
            echo "
                <tr><td>$order[0]</td>
                    <td>$order[1]</td>
                    <td>$order[2]</td>
                    <td>$order[3]</td>
                    <td>$order[4]</td>
                    <td>$order[5]</td>
                    <td>$order[6]</td>
                    <td><button data-toggle='collapse' data-target='#$order[0]'>View</button>
                    </td>
                    <td><a class='btn btn-success btn-sm' href='orders.php?confirm=$order[0]'>Confirm</a></td>
                    <td><a class='btn btn-danger btn-sm' href='orders.php?reject=$order[0]'>Reject</a></td>
                </tr>";
                 view_details($order[0]);
                
        }
        
    }
    else
    {
        view_all();
    }
}
function view_shipping()
{
    $access = new Access();
    $orders = "SELECT id,user_id,items,amount,order_date,order_status,address FROM orders,users
                WHERE orders.user_id = users.id_number and order_status like '%shipping%'";
    $result = $access->query($orders);
    $count = $access->rows($result);
    if($count > 0)
    {  
        for ($i=0; $i < $count; $i++) { 
            display($result);
        }
        
    }
    else
    {
        view_all();
    }
}
function view_rejected()
{
    $access = new Access();
    $orders = "SELECT id,user_id,items,amount,order_date,order_status,address FROM orders,users
                WHERE orders.user_id = users.id_number and order_status like '%rejected%'";
    $result = $access->query($orders);
    $count = $access->rows($result);
    if($count > 0)
    {  
        for ($i=0; $i < $count; $i++) { 
            display($result);
        }
        
    }
    else
    {
        view_all();
    }
}

//function to confirm order
function confirm_order($order_id)
{
    $access = new Access();
    $id = $order_id;
    
    $query = "UPDATE orders SET order_status = 'Processed, under shipping' WHERE id = $id";
    $result = $access->query($query);
    if($result)
    {
        $message = "Order $id: Your order has been processed and is under shipping. Please visit our office after 3 days for collection. ";
        $user = mysqli_fetch_row($access->query("SELECT user_id FROM orders WHERE id = $id "))[0];
        $amount = mysqli_fetch_row($access->query("SELECT amount FROM orders WHERE id =$id"))[0];
        $access->query("INSERT INTO order_messages(order_id,user_id,title,message) VALUES($id,$user,'Success (Order no:$id)','$message')");
        update_credit($user,$amount,"Order $id processed.");
    }
    else
    {
        //display error message 
    }
    
}

//function to update credit
function update_credit($user_id,$amount,$service)
{
    $access = new Access();
    $id = $user_id;
    $query = "SELECT * FROM debts WHERE user_id = $id";
    $result = $access->query($query);
    $rows = $access->rows($result);
    
    if($rows == 0) // user has never made any order
    {
        $insert = "INSERT INTO debts(user_id,amount,service) VALUES ($id,$amount,'$service')";
        $access->query($insert);
    }
    else //user exists
    {
        $update = "UPDATE debts SET amount = debts.amount + $amount WHERE user_id = $id";
        $access->query($update);
    }
}

//function to sent message
function send_message($order_id,$user,$message)
{
    $query = "INSERT INTO order_messages(order_id,user_id,message) VALUES($order_id,$user,$message)";
    
}
?>
<div class="panel-header">
    <a href="orders.php" class="float-left clearfix btn btn-primary btn-sm">Orders::
        <span class="badge text-light"><?php echo $all ?>(all)</span>
    </a>
    <a href="orders.php?orders=pending" class="float-right clearfix btn btn-warning btn-sm ml-3">Pending::
        <span class="badge text-light"><?php echo $pending ?>(all)</span>
    </a>
    <a href="orders.php?orders=shipping" class="float-right clearfix btn btn-success btn-sm">Under Shipping::
        <span class="badge text-light"><?php echo $shipping ?>(all)</span>
    </a>
</div>
<div class="panel-body">
    <table class="table table-hover small">
        <tr><th>Order ID</th>
            <th>User ID</th>
            <th>Total Items</th>
            <th>Amount</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Shipping address</th>
        </tr>
        <?php
            if(isset($_GET['orders']))
            {
                $state = $_GET['orders'];

                if($state == 'pending')
                {
                    view_pending();
                }
                elseif($state == 'shipping')
                {
                    view_shipping();
                }
                elseif($state == 'completed')
                {
                    view_completed();
                }
                elseif($state == 'rejected')
                {
                    view_rejected();
                }
                else
                {
                    view_all();
                }
            }
            else{
                view_all();
            }
        ?>
    </table>
</div>