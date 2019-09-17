<?php
session_start();

include_once('db_control.php');
$access = new Access();

include_once('header.php');

include_once('index-nav.php') 
?>
	
	<div class="container-fluid m-0">
			<p id ='cart_items'></p>
		</div>
	<div class="main-section-index bg-light p-2" >
		
<?php

	$query = "SELECT * FROM tblproduct";

	$result = $access->query($query);
	$count = $access->rows($result);

	if($count >=1)
	{
		
		for ($i=0; $i <$count; $i++) { 
			$row = mysqli_fetch_row($result);
			echo " 
			<div class ='item'>
				<form>
					<div class='image small'>";
					if($row[8] == 'True')
					{
						echo "<div class='offer bg-danger p-1 text-light'>On Offer</div>";
					}
			echo "	
					<img src='$row[3]' width='100%' height='auto'><span class='bg-info badge item-badge'>$row[7]</span></div>
					<div class='name  small'>$row[1]</div>
					<div class='price small'>Ksh $row[4]</div>
					<div class='small text-center info'><a class='btn btn-link btn-sm' href='#'>More</a></div>
					<div style='clear:both'></div>
					<div class='size small'><input class='form-control form-control-sm' type='text' name='size' id='size' value='1'></div>
					<div class='add-btn'><input class='form-control form-control-sm' type='submit' value='Add' onclick='add(\"$row[2]\")'/></div>
					
				</form>
			</div>";
		}
		echo "</div>"	;
	}


?>
	</div>
</body>
</html>