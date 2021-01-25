<?php
	include("header.php");
?>

<article>
	<div id="opis">
        <h2><p align="center"><font size="+2">Sustav za kreiranje i upravljanje parkirnih mjesta tvrtke</font></p></h2>
		</div>
	<br/>
	<table>
		<caption>Korisnici sustava</caption>
		<thead>
			<tr>
				<th class="lijevi">Popis uloga</th>
				<th>Opis uloga</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Administrator</td>
				<td>Dodavanje i uređivanje korisnika, tvrtki i parkirališta, definiranje uloga novih korisnika.</td>
			</tr>
			<tr>
				<td>Moderator</td>
				<td>Dodavanje korisnika kao partnera, pregledavanje partnera svojih tvrtki, filtriranje vremena prema odlasku automobila.</td>
			</tr>
			<tr>
				<td>Obični korisnik</td>
				<td>Vidi popis tvrtki kod kojih je partner, koje parkiralište koristi te popis automobila na parkiralištu. Može evidentirati dolaske i odlaske automobila.</td>
			</tr>
			<tr>
				<td>Anonimni korisnik</td>
				<td>Pregled dostupnih parkirališta i detalji o istom.</td>
			</tr>
		</tbody>
	</table>
	<br/>
	<table>
		<caption>Datoteke sustava</caption>
		<thead>
			<tr>
				<th class="lijevi">Popis datoteka</th>
				<th>Opis datoteka</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>database.php</td>
				<td>Skripta za rad s bazom podataka.</td>
			</tr>
			<tr>
				<td>index.php</td>
				<td>Kratak opis aplikacije.</td>
			</tr>
			<tr>
				<td>zaglavlje.php</td>
				<td>Zaglavlje, sve ostale datoteke je uključuju, te sadrži meni.</td>
			</tr>
			<tr>
				<td>podnozje.php</td>
				<td>Podnožje stranice, poveznice na korisne linkove.</td>
			</tr>
			<tr>
				<td>author.html</td>
				<td>Podatci o autoru.</td>
			</tr>
			<tr>
				<td>add_company.php</td>
				<td>Dodavanje tvrtki.</td>
			</tr>
			<tr>
				<td>users.php i users_list.php</td>
				<td>Skripte koje izlistavaju korisnike, ako je tip korisnika administrator ili moderator postoji mogućnost dodavanja novog korisnika, korisnici mogu uređivati svoje podatke, dodavanje partnera tvrtkama od strane administratora i moderatora.</td>
			</tr>
			<tr>
				<td>add_parking.php</td>
				<td>Dodavanje novog parkirališta.</td>
			</tr>
			<tr>
				<td>add_partner.php</td>
				<td>Dodavanje novih tvrtki na parkiralište, postavljanje moderatora za tvrtku.</td>
			</tr>
			<tr>
				<td>arrival_record.php</td>
				<td>Dodavanje novog automobila na parkiralište.</td>
			</tr>
			<tr>
				<td>car_list.php</td>
				<td>Evidencija dolazaka i odlazaka automobila, mogućnost filtriranja podataka.</td>
			</tr>
			<tr>
				<td>edit_company.php, edit_parking_spot</td>
				<td>Skripte služe za uređivanja podataka tvrtke i parkirališta.</td>
			</tr>
			<tr>
				<td>parking_spot.php, parking_spot_list.php</td>
				<td>Evidencija svih parkirališta, detaljni podatci o parkiralištu (slika, video).</td>
			</tr>
			<tr>
				<td>login.php</td>
				<td>Obrazac za prijavu u sustav.</td>
			</tr>
            <tr>
				<td>parking_reservation.php</td>
				<td>Prijava i odjava automobila sa parkirališta.</td>
			</tr>
		
        </tbody>
	</table>
</article>

<?php
	include("footer.php");
?>
