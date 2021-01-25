<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
    if($_SESSION['aktivni_korisnik_tip'] != 0 && $_SESSION['aktivni_korisnik_tip'] != 1){
        header("Location:index.php");
    } 

    if(isset($_POST['user']) && isset($_POST['company'])){
        $userId = $_POST['user'];
        $companyId = $_POST['company'];
        
        $sql = "SELECT * FROM partner";
        $partnerId = mysqli_num_rows(executeQuery($bp, $sql));
        $partnerId++;
        
        $sql = "INSERT INTO partner 
                (partner_id, korisnik_id, tvrtka_id)
                VALUES 
                ('$partnerId', '$userId', '$companyId')";
        
        executeQuery($bp, $sql);
        header("Location:users_list.php");
    }
?>

<html>
<body>

<form action="add_partner.php" method="post">
    <input type="hidden" name="user" value="<?php echo $_GET['user_id']?>">
    <input type="hidden" name="active" value="<?php echo $_GET['aktivni']?>">
    Tvrtka: <select name="company"><br>
        <?php 
            $sqlu="SELECT moderator_id, tvrtka_id, parkiraliste_id, naziv, opis 
                    FROM tvrtka";
                if($_SESSION['aktivni_korisnik_tip'] == 1) {
                    $sqlu=$sqlu." WHERE moderator_id=".$_GET['aktivni'];
                }
    
            $result = executeQuery($bp, $sqlu);
            while(list($modId, $company_id, $parkingId, $name, $description)=mysqli_fetch_array($result)){
                //$isPartnerAlready = "SELECT * FROM partner WHERE tvrtka_id = ".$company_id." AND korisnik_id = ".$_GET['user_id'];
        
                //if(mysqli_num_rows(executeQuery($bp, $isPartnerAlready)) == 0){
                    echo "<option value=".$company_id.">".$name." ".$description."</option>";
                }
            //}
        ?>
    </select>
    <br>
    <input type="submit">
</form>

</body>
</html>
<?php
	include("footer.php");
?>