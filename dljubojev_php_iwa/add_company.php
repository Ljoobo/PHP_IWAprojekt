<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php

    if($_SESSION['aktivni_korisnik_tip'] != 0) {
        header("Location:index.php");
    }

	
	if(isset($_POST['company_name']) && isset($_POST['parking']) && isset($_POST['mod'])){
			$companyName=$_POST['company_name'];
			$companyDescription=$_POST['description'];
			$parkingId=$_POST['parking'];
			$moderator=$_POST['mod'];
			$sql="INSERT INTO tvrtka
				(naziv, opis, parkiraliste_id, moderator_id)
				VALUES
				('$companyName','$companyDescription','$parkingId','$moderator')";
                
			executeQuery($bp, $sql);
			header("Location:company_list.php");
    } 
	
?> 


<html>
<body>

<form action="add_company.php" method="post">
    Naziv tvrtke: <input type="text" name="company_name"><br>
    Opis tvrtke: <input type="text" name="description"><br>
    Parkiraliste: <select name="parking"><br>
        <?php 
            $sqlu="SELECT parkiraliste_id, naziv, adresa
                    FROM parkiraliste";
    
            $result = executeQuery($bp, $sqlu);
            while(list($parking_id, $parking_name, $adress)=mysqli_fetch_array($result)){
                echo "<option value=".$parking_id.">".$parking_name." ".$adress."</option>";
            }
        ?>
    </select>
    <br>
    Moderator: <select name="mod"><br>
        <?php 
            $query="SELECT korisnik_id, ime, prezime
                    FROM korisnik
                    WHERE tip_id=1";
    
            $result = executeQuery($bp, $query);

            while(list($user_id, $name, $surname)=mysqli_fetch_array($result)){
               echo "<option value=".$user_id.">".$name." ".$surname."</option>";
            }
        ?>
    </select>
    <br>
    <input type="submit">
</form>

</body>
</html>


<?php
	closeConnection($bp);
	include("footer.php");
?>
