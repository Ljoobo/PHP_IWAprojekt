<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
	
    $parkingId=$_GET['parking_spot_id'];

    $sql="SELECT slika, video
          FROM parkiraliste
          WHERE parkiraliste_id=".$parkingId;

    $result=executeQuery($bp, $sql);

    list($picture,$video)=mysqli_fetch_array($result);
    echo "<table>
        <thead><tr>
		<th>Slika</th>
		<th>Video</th>
        </tr></thread>
        <tbody>
        <tr>
            <td><img src='".$picture."' width=300 height=200></td>
            <td>
            <a class='link' href=".$video." width=300 height=200'>LINK NA VIDEO</a>
            </td>
        </tr>
        </tbody>
        </table>";

    $sql="SELECT t.naziv, t.opis 
        FROM tvrtka t 
        WHERE t.parkiraliste_id=".$parkingId;

    $result=executeQuery($bp, $sql);
    echo "<table>";
	echo "<caption>TVRTKE KOJE KORISTE PARKIRNO MJESTO</caption>";
	echo "<thead><tr>
		<th>Naziv</th>
		<th>Opis</th>";
	echo "</tr></thead>";
	
	echo "<tbody>";
	while(list($company_name,$description)=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$company_name."</td>
            <td>".$description."</td>";  
        echo "</tr>";
    
    }
    echo "</tbody>";
	echo "</table>";
?>	
<?php
	closeConnection($bp);
	include("footer.php");
?>
