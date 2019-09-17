<?php
include_once('db_control.php');
include_once('header.php');
include_once('navigation.php');
$access = new Access();
$member_query = "SELECT id_number,first_name,last_name,username,email,phone,address FROM users";
$member_result = $access->query($member_query);
$members = $access->rows($member_result);
$admin_query = "SELECT username,email,phone FROM admins";
$admin_result = $access->query($admin_query);
$admins = $access->rows($admin_result);
?>
<div class="panel-header">
    <h6 class="float-left clearfix mr-3">Total Members ::
        <span class="badge"><?php echo $members ?></span>
    </h6>
    <div class="float-right clearfix">
        <a href="members.php?admins" class="btn btn-info btn-sm">Admins:: <?php echo $admins ?></a>
        <a href="register.php" class="btn btn-info btn-sm" target='_BLANK'>New</a>
        <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#contact'>Contact</button>
        <div id='contact' class="modal fade" role='dialog'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Contact Form</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="contact.php" method="post">
                            <div class='form-group'>
                                <label for="from">From</label>
                                <input class='form-control form-control-sm' type="text" name='from' disabled>
                            </div>
                            <div class='form-group'>
                                <label for="to">To</label>
                                <input class='form-control form-control-sm' type="text" name='to'>
                            </div>
                            <div class='form-group'>
                                <label for="Subject">Subject</label>
                                <input class='form-control form-control-sm' type="text" name='subject'>
                            </div>
                            <div class='form-group'>
                                <label for="message">Message</label>
                                <textarea class='form-control' name="message" id="message" rows="5" placeholder='Enter your message here'></textarea>
                            </div>
                            <button class="btn btn-success btn-sm btn-block" type='submit'>Sent</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                       <span><em>EasyTech &copy; 2019</em></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-body">
    <table class="table small">
        <tr class='bg-dark text-light small'>
<?php 
if(isset($_GET['admins']))
{
?>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Delete</th>
<?php
if($admins >= 1)
{
    for ($i=0; $i < $admins; $i++) 
    { 
        $admin = mysqli_fetch_row($admin_result);
        echo "
            <tr class='small'><td>$admin[0]</td>
                <td>$admin[1]</td>
                <td>$admin[2]</td>
                <td><a class='btn btn-sm btn-danger' href='members.php?admin&delete=$admin[0]'>Delete</a></td>
            </tr>
        ";
    }
    echo "</table>
    </div>";
}
}
else
{
?>
            <th>ID No</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Suspend</th>
            <th>Delete</th>
        </tr>
<?php
if($members >= 1)
{
    for ($i=0; $i < $members; $i++) 
    { 
        $member = mysqli_fetch_row($member_result);
        echo "
            <tr class='small'><td>$member[0]</td>
                <td>$member[1] $member[2]</td>
                <td>$member[3]</td>
                <td>$member[4]</td>
                <td>$member[5]</td>
                <td>$member[6]</td>
                <td><a class='btn btn-sm btn-warning' href='members.php?suspend=$member[0]'>Suspend</a></td>
                <td><a class='btn btn-sm btn-danger' href='members.php?delete=$member[0]'>Delete</a></td>
            </tr>
        ";
    }
    echo "</table>
    </div>";
}
}
?>