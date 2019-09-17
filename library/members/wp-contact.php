<?php
$to = "siranjofuw@gmail.com";
if(empty($_POST['first_name']) || empty($_POST['last_name']) ||
    empty($_POST['from']) || empty($_POST['subject']) || empty($_POST['message']) )
        exit();
else
{
    $name = $_POST['first_name'];
    $name .= $_POST['last_name'];
    $from = $_POST['from'];
    $subject =$_POST['subject'];
    $body = $_POST['message'];

    $headers = "From:$from\r\n";
    $headers .= "Reply-To:$from\r\n";
    $headers .= "Content-Type: text/plain;\r\n charset=iso-8859-1\r\n";

    $result = mail("$to", "$subject", "$name \r\n $body", $headers);
   
   if($result == True)
   {
       echo "Email sent successfully";
       sleep(2);
       header("loaction:index.html")
   }
   else
   {
       echo "Could not sent email";
   }
}
?>