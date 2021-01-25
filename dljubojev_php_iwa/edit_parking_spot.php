<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
    
    if(isset($_SESSION['aktivni_korisnik'])){
        $active_user_id=$_SESSION["aktivni_korisnik_id"];
        $active_user_type=$_SESSION['aktivni_korisnik_tip'];
	}
    
       if(isset($_POST['name']) && isset($_POST['adress']) && isset($_POST['picture'])){
		{
            foreach ($_POST as $key => $value)
			$parkingName=$_POST['name'];
			$parkingAdress=$_POST['adress'];
			$parkingPicture=$_POST['picture'];
			$parkingVideo=$_POST['video'];
            $parkingId=$_POST['parking_spot_id'];
			
			 $sql="UPDATE parkiraliste SET
					naziv='$parkingName',
					adresa='$parkingAdress',
					slika='$parkingPicture',
					video='$parkingVideo'
                    WHERE parkiraliste_id=".$parkingId;
			}
			executeQuery($bp,$sql);
			header("Location:parking_spot_list.php");
		}
    
    
?>

<html>
<body>

<form action="edit_parking_spot.php" method="post">
    <input type="hidden" name="parking_spot_id" value="<?php echo $_GET['parking_spot_id']; ?>">
    Naziv parkirališta: <input type="text" name="name" value="<?php echo $_GET['parking_name']; ?>"><br>
    Adresa parkirališta: <input type="text" name="adress" value="<?php echo $_GET['parking_adress']; ?>"><br>
    Slika: <input type="text" name="picture" value="<?php echo $_GET['parking_picture']; ?>"><br>
    Video: <input type="text" name="video" value="<?php echo $_GET['parking_video']; ?>"><br>
    <input type="submit">
</form>

</body>
</html>


<?php
	closeConnection($bp);
	include("footer.php");
?>
