<?php
	include("header.php");
	$bp=connectToDatabase();
?>

<?php 

 if($_SESSION['aktivni_korisnik_tip'] != 0){
        header("Location:index.php");
    } 
        
        $sql="SELECT tvrtka.parkiraliste_id, parkiraliste.naziv, (TO_SECONDS(datum_vrijeme_odlaska)-TO_SECONDS(datum_vrijeme_dolaska))/60/COUNT(*) AS prosjek 
        FROM automobil, tvrtka, partner, parkiraliste 
        WHERE tvrtka.tvrtka_id = partner.tvrtka_id AND partner.partner_id = automobil.partner_id 
        AND tvrtka.parkiraliste_id = parkiraliste.parkiraliste_id 
        AND automobil.datum_vrijeme_odlaska <> '0000-00-00 00:00:00' 
        GROUP BY tvrtka.parkiraliste_id";

        $result=executeQuery($bp, $sql);

    echo "<table>";
	echo "<caption>Statistika prema parkiralištu</caption>";
	echo "<thead><tr>
		<th>Naziv parkirališta</th>
		<th>Prosječno vrijeme zadržavanja</th>";
    	echo "</tr></thead>";
    
    
	echo "<tbody>";
	while(list($parking_id,$parking_name,$average)=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$parking_name."</td>
            <td>".$average."</td>";
    }
echo "</tbody>";
echo "</table><p></p>";
        
        $sqli="SELECT tvrtka.tvrtka_id, tvrtka.naziv, (TO_SECONDS(datum_vrijeme_odlaska)-TO_SECONDS(datum_vrijeme_dolaska))/60/COUNT(*) AS prosjek FROM automobil, tvrtka, partner 
        WHERE tvrtka.tvrtka_id = partner.tvrtka_id 
        AND partner.partner_id = automobil.partner_id  
        AND automobil.datum_vrijeme_odlaska <> '0000-00-00 00:00:00' 
        GROUP BY naziv";


        $result=executeQuery($bp, $sqli);

    echo "<table>";
	echo "<caption>Statistika prema tvrtci</caption>";
	echo "<thead><tr>
		<th>Naziv tvrtke</th>
		<th>Prosječno vrijeme zadržavanja</th>";
    	echo "</tr></thead>";
    
    
	echo "<tbody>";
	while(list($company_id,$company_name,$average)=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$company_name."</td>
            <td>".$average."</td>";
    }
echo "</tbody>";
echo "</table>";
?>

<?php
	include("footer.php");
?>