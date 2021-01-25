
<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
    if(isset($_SESSION['aktivni_korisnik'])){
        $active_user_id=$_SESSION["aktivni_korisnik_id"];
        $active_user_type=$_SESSION['aktivni_korisnik_tip'];
	}

    if($active_user_type==0){
        $korisnikId=$_SESSION['aktivni_korisnik_id'];
        $sqli="SELECT t.naziv, t.opis, p.naziv, p.adresa, k.ime, k.prezime, t.tvrtka_id, t.moderator_id, t.parkiraliste_id
                FROM tvrtka t
                INNER JOIN korisnik k ON t.moderator_id=k.korisnik_id
                INNER JOIN parkiraliste p ON t.parkiraliste_id=p.parkiraliste_id
                GROUP BY t.tvrtka_id";

        $result=executeQuery($bp, $sqli);
    }
    echo "<table>";
	echo "<caption>Popis partnera</caption>";
	echo "<thead><tr>
		<th>Naziv</th>
		<th>Opis</th>
        <th>Naziv parkiralista</th>
        <th>Adresa</th>
        <th>Moderator</th>";
    	echo "</tr></thead>";
    
    
	echo "<tbody>";
	while(list($company_name,$description,$parking_spot_name,$parking_spot_adress,$modName, $modSurname, $company_id, $mod_id, $parking_spot_id)=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$company_name."</td>
            <td>".$description."</td>
            <td>".$parking_spot_name."</td>
            <td>".$parking_spot_adress."</td>
            <td>".$modName. " " .$modSurname."</td>";
        if ($_SESSION['aktivni_korisnik_id']==$mod_id || $_SESSION['aktivni_korisnik_tip'] == 0) {
                echo "<td><a class='link' href='edit_company.php?company_id=$company_id&mod_id=$mod_id'>UREDI</a></td>";
            }
        
    }
    echo "</tbody>";
    echo "</table>";
    if ($active_user_type==0) {
        echo '<div><a class="link" href="add_company.php">DODAJ TVRTKU</a></div>';    
    }
?>
<?php
	closeConnection($bp);
	include("footer.php");
?>
