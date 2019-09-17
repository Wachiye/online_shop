<?php
$to = "siranjofuw@gmail.com";
?>
<html>
    <head>
        <title>EasyTech::Contact Us</title>
        <style>
        form
        {   
            width:500px;
            margin:auto;
            text-align:left;
        }
        label{
            text-align:right;
        }
        </style>
</head>
<body>
<form action = "wp-contact.php" method = "POST" width="500" margin="auto">
            <em>All fields are required</em><br>
        <label for = "first_name" >First Name:<br>
            <input type ="text" name = "first_name" placeholder = "First Name" /><br>
      <label for = "last_name" >Last Name:</label><br>
            <input type="text" name = "last_name" placeholder ="Last Name"><br>
        <label for = "from">From:</label><br>
            <input type = "email"  name = "from" placeholder = "Your Email address"><br>
        <label for = "to">To</label><br>
            <input type = "email" name = "to" id="to" value = "<?php echo $to ?>" disabled><br>
        <label for = "subject">Subject:</label><br>
            <input type="text" name = "subject" placeholder = "Subject"><br>
        <label for = "message">Message</label><br>
            <textarea name="message" id="message" cols="80%" rows="8" placeholder ="Write your message here.."></textarea><br><br>
            <input type="submit" value = "Sent" >
            <input type="button" value = "Close" onClick = "">
</form>
</body>
</html>
