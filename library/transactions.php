<?php
include_once('db_control.php');
include_once('header.php');
include_once('navigation.php');
$access = new Access();
$services = "SELECT * FROM transactions";
$result = $access->query($services);
$rows = $access->rows($result);
?>
<div class="panel-heading">
    <div class="float-left clearfix">
        <h6>Balance::
            <span>Ksh 80000.00</span>
        </h6>
    </div>
    <button class="float-right btn btn-success btn-sm" data-toggle='modal' data-target='#widthraw'>Widthraw</button>
</div>
<div class="panel-body" >
    <table class="table small">
        <tr class="bg-dark text-light">
            <th>ID</th>
            <th>User ID</th>
            <th>M-pesa Code</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Service</th>
        </tr>
<?php
if($rows >= 1)
{
    for ($i=0; $i < $rows; $i++) 
    { 
        $row = mysqli_fetch_row($result);
        echo "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
        </tr>";
    }
}
?>
    </table>
</div>