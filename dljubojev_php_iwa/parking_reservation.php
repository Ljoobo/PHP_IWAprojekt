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

    if(isset($_GET['car_id'])) {
        $sqlu = "UPDATE automobil SET
                datum_vrijeme_odlaska = now() 
                WHERE automobil_id=".$_GET['car_id'];
        executeQuery($bp, $sqlu);
        // header("Location:parking_reservation.php");
    }
    
    $company_id=$_GET['company_id'];

    $partner_sql = "SELECT partner_id 
                    FROM partner 
                    WHERE tvrtka_id = ".$company_id." AND korisnik_id = ".$_SESSION['aktivni_korisnik_id'];

    list($partnerId) = mysqli_fetch_array(executeQuery($bp, $partner_sql));

    $sql = "SELECT a.automobil_id, a.registracija, a.datum_vrijeme_dolaska, a.datum_vrijeme_odlaska
            FROM partner p 
            INNER JOIN automobil a ON a.partner_id = p.partner_id 
            WHERE p.tvrtka_id = ".$company_id;

    if($_SESSION['aktivni_korisnik_tip'] == 2) {
        $sql = $sql." AND a.partner_id = ".$partnerId;
    }
    
    $result = executeQuery($bp, $sql);

    echo "<table>";
	echo "<caption>PRIJAVA I ODJAVA AUTOMOBILA</caption>";
	echo "<thead><tr>
		<th>Registracija</th>
		<th>Datum i vrijeme dolaska</th>
        <th>Datum i vrijeme odlaska</th>
        <th></th>
        <td></td>";
    	echo "</tr></thead>";

    echo "<table>";
    while(list($car_id, $registration, $arrival, $departure) = mysqli_fetch_array($result)) {
        $formated_arrival = date("d.m.Y. h:i:s", strtotime($arrival));
        
        if ($departure != "0000-00-00 00:00:00"){
            $formated_departure = date("d.m.Y. h:i:s", strtotime($departure));    
        } else {
            $formated_departure = "00.00.0000. 00:00:00";
        }
        
        echo "<tr>";
            echo "<td>".$registration."</td>
                  <td>".$formated_arrival."</td>
                  <td>".$formated_departure."</td>";
            if($formated_departure == "00.00.0000. 00:00:00"){
                echo "<td><a class='link' href='parking_reservation.php?car_id=$car_id&company_id=$company_id'>ODJAVA</a>";
            }
        echo "</tr>";
    }
    echo "</table>"; 

    echo "<a class='link' href='arrival_record.php?company_id=$company_id'>DODAJ AUTOMOBIL NA PARKIRALIŠTE</a>";    

?>


<?php
	closeConnection($bp);
	include("footer.php");
?>