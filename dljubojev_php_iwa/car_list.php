<?php
	include("header.php");
	$bp=connectToDatabase();
?>



<html>
<body>

<form action="car_list.php" method="post">
    <caption>Filtriraj prema vremenu odlaska:</caption><br>
    <p></p>
    <caption>DATUM OD:</caption><br>
    <input type="text" name="day_from" maxlength="2" size=3><th> /</th>
    <input type="text" name="month_from" maxlength="2" size=3><th> /</th>
    <input type="text" name="year_from" maxlength="4" size=5><th>(datum/mjesec/godina)</th><br>
    <caption>VRIJEME OD:</caption><br>
    <input type="text" name="hour_from" maxlength="2" size=3><th> :</th>
    <input type="text" name="minute_from" maxlength="2" size=3><th> :</th>
    <input type="text" name="second_from" maxlength="2" size=5><th>(hh:mm:ss)</th>
    <p></p>
    <caption>DATUM DO:</caption><br>
    <input type="text" name="day_to" maxlength="2" size=3><th> /</th>
    <input type="text" name="month_to" maxlength="2" size=3><th> /</th>
    <input type="text" name="year_to" maxlength="4" size=5><th>(datum/mjesec/godina)</th><br>
    <caption>VRIJEME DO:</caption><br>
    <input type="text" name="hour_to" maxlength="2" size=3><th> :</th>
    <input type="text" name="minute_to" maxlength="2" size=3><th> :</th>
    <input type="text" name="second_to" maxlength="2" size=5><th>(hh:mm:ss)</th>
    <p></p>
    <input type="submit">
</form>

</body>
</html>

<?php
    if($_SESSION['aktivni_korisnik_tip'] != 0 && $_SESSION['aktivni_korisnik_tip'] != 1){
        header("Location:index.php");
    } 
    
    $sql="SELECT registracija, datum_vrijeme_dolaska, datum_vrijeme_odlaska FROM automobil";

    if($_SESSION['aktivni_korisnik_tip'] == 1){
        $sqli="SELECT p.partner_id
               FROM tvrtka t
               INNER JOIN partner p ON p.tvrtka_id=t.tvrtka_id
               WHERE t.moderator_id=".$_SESSION['aktivni_korisnik_id'];
        $partner_result = executeQuery($bp, $sqli);
        $partners = "";
        $i = 0;
        $size = mysqli_num_rows($partner_result);
        while($partner = mysqli_fetch_array($partner_result)) {
            $partners = $partners.$partner[0];
            if ($i != $size - 1) {
                $partners = $partners.",";
            }
            $i++;
        }
        $sql = $sql." WHERE partner_id IN (".$partners.")";
    }
    
    if(isset($_POST['day_from']) && isset($_POST['month_from']) && isset($_POST['year_from']) && isset($_POST['day_to']) && isset($_POST['month_to']) && isset($_POST['year_to'])){
        
            $day_from=$_POST['day_from'];
            $month_from=$_POST['month_from'];
            $year_from=$_POST['year_from'];
            $day_to=$_POST['day_to'];
            $month_to=$_POST['month_to'];
            $year_to=$_POST['year_to'];
            $hour_from=$_POST['hour_from'];
            $minute_from=$_POST['minute_from'];
            $second_from=$_POST['second_from'];
            $hour_to=$_POST['hour_to'];
            $minute_to=$_POST['minute_to'];
            $second_to=$_POST['second_to'];
        
            
            if(checkdate($month_from, $day_from, $year_from) && checkdate($month_to, $day_to, $year_to) && $hour_from >= 0 && $hour_from < 24 
            && $minute_from >= 0 && $minute_from < 60 && $second_from >= 0 && $second_from < 60 && $hour_to >= 0 && $hour_to < 24 
            && $minute_to >= 0 && $minute_to < 60 && $second_to >= 0 && $second_to < 60)
                {
                $date_time_from = $year_from."-".$month_from."-".$day_from." ".$hour_from.":".$minute_from.":".$second_from; 
                $date_time_to = $year_to."-".$month_to."-".$day_to." ".$hour_to.":".$minute_to.":".$second_to;

                if ($_SESSION['aktivni_korisnik_tip'] == 1){
                    $sql = $sql." AND datum_vrijeme_odlaska BETWEEN '$date_time_from' AND '$date_time_to'";    
                } else if ($_SESSION['aktivni_korisnik_tip'] == 0){
                    $sql = $sql." WHERE datum_vrijeme_odlaska BETWEEN '$date_time_from' AND '$date_time_to'";    
                }    
            }
                                               
    } 

    $result = executeQuery($bp, $sql);
    echo "<table>";
	echo "<caption>DOLASCI/ODLASCI</caption>";
	echo "<thead><tr>
		<th>Registracija</th>
		<th>Vrijeme dolaska</th>
        <th>Vrijeme odlaska</th>";
    	echo "</tr></thead>";
    
    
	echo "<tbody>";
	while(list($registration,$arrival,$departure)=mysqli_fetch_array($result)){
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
            
    }
        
    
    echo "</tbody>";
    echo "</table>";
    
    
?>

<?php
	include("footer.php");
?>