<?php
	include("header.php");
	$bp=connectToDatabase();
    
?>
<?php
    if(isset($_SESSION['aktivni_korisnik'])){
        $active_user_id=$_SESSION["aktivni_korisnik_id"];
        $active_user_type=$_SESSION['aktivni_korisnik_tip'];
	} else {
        header("Location:index.php");
    }

    $korisnikId=$_SESSION['aktivni_korisnik_id'];

    $sqli = "SELECT t.tvrtka_id, t.naziv, t.opis, p.naziv, p.adresa
             FROM tvrtka t
             INNER JOIN parkiraliste p ON p.parkiraliste_id = t.parkiraliste_id";
    
    if ($active_user_type == 2){
            $sqli=$sqli." INNER JOIN partner pa ON pa.korisnik_id=$korisnikId
                            AND t.tvrtka_id=pa.tvrtka_id";
        } else if ($active_user_type == 1) {
            $sqli=$sqli." WHERE t.moderator_id=$korisnikId";
        }
       
    $result=executeQuery($bp, $sqli);
    echo "<table>";
	echo "<caption>Popis partnera</caption>";
	echo "<thead><tr>
		<th>Naziv</th>
		<th>Opis</th>
        <th>Naziv parkiralista</th>
        <th>Adresa</th>";
	echo "</tr></thead>";
    
	echo "<tbody>";
	while(list($company_id, $company_name,$description,$parking_spot_name,$parking_spot_adress)=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$company_name."</td>
            <td>".$description."</td>
            <td>$parking_spot_name</td>
            <td>".$parking_spot_adress."</td>
            <td><a class='link' href='parking_reservation.php?company_id=$company_id'>PRIJAVA/ODJAVA</a>";
            
        echo "</tr>";
        
        
    }
    echo "</tbody>";
	echo "</table>";

    if($active_user_type==0)echo '<a class="link" href="statistic.php">POGLEDAJ STATISTIKU</a>';




?>

<?php
	closeConnection($bp);
	include("footer.php");
?>
