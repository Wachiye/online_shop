<?php 
session_start();
include_once('db_control.php');
$access = new Access();
include_once('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty($_POST['idno'])  && empty($_POST['fname']) &&
        empty($_POST['lname']) && empty($_POST['uname']) && empty($_POST['pass'])
        && empty($_POST['pswd']) && empty($_POST['phone']) && empty($_POST['email'])
        && empty($_POST['adrs']) && empty($_POST['ans']))
        empty_fields();
    elseif($_POST['pass'] != $_POST['pswd'])
        password_error();
    else
    {
        $id = $access->clean($_POST['idno']);
        $fname = $access->clean($_POST['fname']);
        $lname = $access->clean($_POST['lname']);
        $uname= $access->clean($_POST['uname']);
        $pass= $access->clean($_POST['pass']);
        $phone = $access->clean($_POST['phone']);
        $email= $access->clean($_POST['email']);
        $address= $access->clean($_POST['adrs']);
        $quiz= $access->clean($_POST['quiz']);
        $ans= $access->clean($_POST['ans']);

        $query = "SELECT * FROM users WHERE id_number = $id OR username = '$uname' OR email ='$email'";
        $result = $access->query($query);
        $count = $access->rows($result);
        if($count == 0)
        {
            $query = "INSERT INTO users(id_number,first_name,last_name,username,password,email,address,question,answer,phone) 
                        VALUES($id,'$fname','$lname','$uname',md5('$pass'),'$email','$address','$quiz','$ans','$phone')";
            if($access->query($query))
            {
                printf("Account created succesfully. Redirecting you to the login page... please wait.") ;
                sleep(3);
                header("location: login.html");
            }
            else
            {
                //echo mysqli_error($db_server);
                echo "Server error.Unable to create account.";
            }
                
        }
        else
        {
            
            exists();
        }
    }
}
function empty_fields()
{
    echo '
    <div class="container alert alert-warning alert-dismissible" style="height:auto;">
        <button class="close" type="button" data-dismiss="alert" aria-label="close">&times;</button>
        <em>Sorry,all fields are required.</em>
    </div>
    ';
}
function password_error()
{
    echo "
    <div class='container alert alert-warning alert-dismissible' style='height:auto;'>
        <button class='close' type='button' data-dismiss='alert' aria-label='close'>&times;</button>
        <em>Sorry, passwords don't match. Try again.</em>
    </div>
    ";
}
function exists()
{
    echo '
    <div class="container alert alert-danger alert-dismissible" style="height:auto;">
        <button class="close" type="button" data-dismiss="alert" aria-label="close">&times;</button>
        <em>Sorry,ID/email/Username already exits.Try again.</em>
    </div>
';
}
?>
<div class="container">
    <form action = 'register.php' method='POST'  role='form'>
        <div class="personal-details p-reg float-left clearfix p-2">
            <div class = "form-group">
                <label for="idno">Id Number</label>
                <input class="form-control form-control-sm" type="text" name="idno">
            </div>
             <div class = "form-group">
                <label for="fname">First Name</label>
                <input class="form-control form-control-sm" type="text" name="fname">
            </div>
             <div class = "form-group">
                <label for="lname">Last Name</label>
                <input class="form-control form-control-sm" type="text" name="lname">
            </div>
             <div class = "form-group">
                <label for="email">Email</label>
                <input class="form-control form-control-sm" type="email" name="email">
            </div>
             <div class = "form-group">
                <label for="adrs">Address</label>
                <input class="form-control form-control-sm" type="text" name="adrs">
            </div>
             <div class = "form-group">
                <label for="phone">Phone</label>
                <input class="form-control form-control-sm" type="phone" name="phone">
            </div>
        </div>
        <div class="security-details s-reg float-left clearfix p-2">
           <div class = "form-group">
                <label for="uname">Username</label>
                <input class="form-control form-control-sm" type="text" name="uname">
            </div>
            <div class = "form-group">
                <label for="pass">Password</label>
                <input class="form-control form-control-sm" type="password" name="pass">
            </div>
            <div class = "form-group">
                <label for="pswd">Re-enter Password</label>
                <input class="form-control form-control-sm" type="password" name="pswd">
            </div>
            <div class = "form-group">
                <label for="quiz">Select your security question</label>
                <select class='form-control form-control-sm' name='quiz'>
                    <option value='birthplace'>What is your place of birth?</option>
                    <option value="hobby">What is your hobby?</option>
                    <option value="nickname"> What was your highschool nickname?</option>
                </select>
            </div>
            <div class = "form-group">
                <label for="ans">Answer</label>
                <input class="form-control form-control-sm" type="text" name="ans">
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="container">
            <p>By clicking submit, you agree on our <a href="terms.html"target='_blank' > Terms and Condition</a></p>
            <button class="btn btn-primary btn-sm btn-block" type='submit'>Submit</button>
        </div>
    </form>
</div>
</body>
</html>
