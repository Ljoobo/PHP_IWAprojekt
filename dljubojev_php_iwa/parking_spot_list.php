<?php
	include("header.php");
	$bp=connectToDatabase();
?>

<?php
	
	$sql="SELECT * FROM parkiraliste";
	$rs=executeQuery($bp,$sql);

	echo "<table>";
	echo "<caption>Popis parkiralista</caption>";
	echo "<thead><tr>
		<th>Naziv</th>
		<th>Adresa</th>
		<th></th>
        <th></th>";
	echo "</tr></thead>";
	
	echo "<tbody>";
	while(list($parking_id,$parking_spot_name,$parking_spot_adress, $picture, $video)=mysqli_fetch_array($rs)){
		echo "<tr>
			<td><a class='link' href='parking_spot.php?parking_spot_id=$parking_id'>$parking_spot_name</a></td>
			<td><a class='link' href='parking_spot.php?parking_spot_id=$parking_id'>$parking_spot_adress</a></td>";
		        
			if($active_user_type==0){
            echo "<td><a class='link' 
            href=
            'edit_parking_spot.php?parking_spot_id=$parking_id&parking_name=".rtrim($parking_spot_name)."&parking_adress=".rtrim($parking_spot_adress)."&parking_picture=".rtrim($picture)."&parking_video=".rtrim($video)."'>UREDI</a></td>";
                
                    
            }
    }
	echo "</tbody>";
	echo "</table>";

	
	echo "<br/>";
	if($active_user_type==0)echo '<a class="link" href="add_parking.php">DODAJ PARKING</a>';
	
?>

<?php
	closeConnection($bp);
	include("footer.php");
?>
