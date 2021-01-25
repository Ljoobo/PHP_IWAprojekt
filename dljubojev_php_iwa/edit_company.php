<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
    if($_SESSION['aktivni_korisnik_tip'] != 0 && $_SESSION["aktivni_korisnik_id"] != $_GET['mod_id']) {
        header("Location:index.php");
    }

    if (!isset($_POST['submit'])){
        $company_id = $_GET['company_id'];
        $sql = "SELECT * FROM tvrtka WHERE tvrtka_id=".$company_id;
        $result = executeQuery($bp, $sql);
        list ($company_id, $mod_id, $parking_id, $company_name, $company_description) = mysqli_fetch_array($result);     
    }
    
    if(isset($_POST['name']) && isset($_POST['company_id'])){
        $companyId=$_POST['company_id'];
        $companyName=$_POST['name'];
        $companyDescription=$_POST['description'];
        $parkingId=$_POST['parking'];
        $moderatorId=$_POST['mod'];
        
        $sql="UPDATE tvrtka SET
              naziv='$companyName',
              opis='$companyDescription',
              moderator_id='$moderatorId',
              parkiraliste_id='$parkingId'
              WHERE tvrtka_id=".$companyId;
        executeQuery($bp,$sql);
        header("Location:company_list.php");
    }
    
    
?>

<html>
<body>

<form action="edit_company.php" method="post">
    <input type="hidden" name="company_id" value="<?php echo $_GET['company_id']; ?>">
    Naziv tvrtke: <input type="text" name="name" value="<?php echo $company_name; ?>"><br>
    Opis tvrtke: <input type="text" name="description" value="<?php echo $company_description; ?>"><br>
    Parkiraliste: <select name="parking"><br>
        <?php 
            $sqlu="SELECT parkiraliste_id, naziv, adresa
                    FROM parkiraliste";
    
            $result = executeQuery($bp, $sqlu);
            while(list($parking, $parking_name, $adress)=mysqli_fetch_array($result)){
                $option = "<option value=".$parking;
                if ($parking_id == $parking) {
                    $option = $option." selected='selected'";
                }
                echo $option.">".$parking_name." ".$adress."</option>";
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
               $option = "<option value=".$user_id;
                if ($user_id == $mod_id) {
                    $option = $option." selected='selected'";
                }
                echo $option.">".$name." ".$surname."</option>";
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
