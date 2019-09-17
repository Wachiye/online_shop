<?php
include_once('header.php');
include_once('../db_control.php');
require_once('details.php');
include_once('nav.php');
$access = new Access();

$id = $_SESSION['myid'];
$query = "SELECT * FROM order_messages WHERE user_id = $id ORDER BY order_id DESC";
$result = $access->query($query);
$rows = $access->rows($result);
?>
<div class="panel-body">
<button class='float-right clearfix btn btn-success btn-sm' data-toggle='modal' data-target='#contact'>Contact Us</button></div>
    <div id='contact' class='modal fade' role='dialog'>
        <div class="modal-dialog bg-light p-2">
            <div class="modal-head">
                <em class="modal-title">Contact Us</em>
                <button class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class="modal-body">
                <form action="contact.php" role='form'>
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="email" class="form-control form-control-sm" name='from' value='<?php echo $email ?>' placeholder='Your email'>
                    </div>
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="email" class="form-control form-control-sm" name='to' placeholder='Reciever email'>
                    </div>
                    <div class="form-group">
                        <label for="from">Message</label>
                        <textarea class="form-control form-control-sm" name='message' placeholder='Your email'></textarea>
                    </div>
                    <button class="btn btn-success btn-block" type='submit'>Sent</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
<div style='clear:both;'></div>
    <?php 
        if($rows > 0)
        {
            for ($i=0; $i < $rows; $i++) 
            { 
                $row = mysqli_fetch_row($result);
                echo "
                <div class='container-fluid'>
                <span><strong>$row[3]</strong></span>
                <button  data-toggle='collapse' data-target='#$row[0]'>View</button>
                    <p class='collapse' id ='$row[0]'> $row[4]
                    <br>
                    <em class='float-right'>$row[5]</em></p>
                </div>
                <div style='clear:both;'> <hr></div>
                ";
            }
        }
    ?>
</div>
</div>
</div>