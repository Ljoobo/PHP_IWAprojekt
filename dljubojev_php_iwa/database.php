<?php
	define("POSLUZITELJ","localhost");
	define("BAZA","iwa_2018_sk_projekt");
	define("BAZA_KORISNIK","iwa_2018");
	define("BAZA_LOZINKA","foi2018");

	function connectToDatabase(){
		$connection=mysqli_connect(POSLUZITELJ,BAZA_KORISNIK,BAZA_LOZINKA);
		if(!$connection)echo "GREŠKA: Problem sa spajanjem u datoteci database.php funkcija connectToDatabase: ".mysqli_connect_error();
		mysqli_select_db($connection,BAZA);
		if(mysqli_error($connection)!=="")echo "GREŠKA: Problem sa odabirom baze u database.php funkcija connectToDatabase: ".mysqli_error($connection);
		mysqli_set_charset($connection,"utf8");
		if(mysqli_error($connection)!=="")echo "GREŠKA: Problem sa odabirom baze u database.php funkcija connectToDatabase: ".mysqli_error($connection);
		return $connection;
	}

	function executeQuery($connection,$query){
		$resultQ=mysqli_query($connection,$query);
		if(mysqli_error($connection)!=="")echo "GREŠKA: Problem sa upitom: ".$query." : u datoteci database.php funkcija executeQuery: ".mysqli_error($connection);
		return $resultQ;
	}

	function closeConnection($connection){
		mysqli_close($connection);
	}
?>
