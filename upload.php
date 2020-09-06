<?php
$image_dir = "Products/images/";
$target_file = $image_dir.basename($_FILES['image']['name']);
$upload_ok = 1;
$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST['submit']))
{
    $check = getimagesize($_FILES['image']['tmp_name']);
    
    if($check !== false)
    {
        echo "File is an image -" .$check['mime']. '.' ;
        $upload_ok = 1;
    }
    else
    {
        echo "File is not an image.";
        $upload_ok = 0;
    }
}
if(file_exists($target_file))
{
    echo "Sorry, file already exits.";
    $upload_ok = 0;
}
if($_FILES['image']['size'] > 500000)
{
    echo "Sorry, your file is too large. Select an image less or equal to 500KB";
    $upload_ok = 0;
}

if($image_file_type != 'jpeg' && $image_file_type != 'jpg' && $image_file_type != 'png' && $image_file_type != 'gif')
{
   echo "Sorry, only JPEG,JPG,GIF and PNG files are allowed.";
    $upload_ok = 0;
}

if($upload_ok == 0)
{
    echo "Sorry, your file wass not uploaded.";
}
else
{
    if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file))
    {
        echo "The file ". basename($_FILES['image']['name'])."has been uploaded.";
    }
    else
    {
        echo 'Sorry, there was an error uploading your file.';
    }
}
?>
<form action="upload.php" method ='post'>
<input type="file" name="image" id="image">
<button type="submit">SEnt</button>
</form>