<?php
	define("IMAGE","Products/");
	
		$id = $_GET['id'];
		$file_name = $_FILES['image'];
		move_file();
	
	//process the file
	function move_file()
	{
		$new_file = IMAGE. $_FILES['image']['name'];
		if(move_uploaded_file($_FILES['image']['tmp_name'],$new_file))
		{
			echo "File uploaded";
		}
		else
		{
			echo "error";
		}
	}
	

?>