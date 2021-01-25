<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php

	
	if(isset($_POST['name']) && isset($_POST['adress']) && isset($_POST['picture'])){
			$parkingName=$_POST['name'];
			$parkingAdress=$_POST['adress'];
			$parkingPicture=$_POST['picture'];
			$parkingVideo=$_POST['video'];
			$sql="INSERT INTO parkiraliste
				(naziv,adresa,slika,video)
				VALUES
				('$parkingName','$parkingAdress','$parkingPicture','$parkingVideo')";
                
			executeQuery($bp, $sql);
			header("Location:parking_spot_list.php");
    } 
	
?> 


<html>
<body>

<form action="add_parking.php" method="post">
    Naziv parkirališta: <input type="text" name="name"><br>
    Adresa parkirališta: <input type="text" name="adress"><br>
    Slika: <input type="text" name="picture"><br>
    Video: <input type="text" name="video"><br>
    <input type="submit">
</form>

</body>
</html>


<?php
	closeConnection($bp);
	include("footer.php");
?>
