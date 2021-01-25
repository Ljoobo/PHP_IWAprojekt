<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
	if(isset($_GET['logout'])){
		unset($_SESSION["aktivni_korisnik"]);
		unset($_SESSION['aktivni_korisnik_ime']);
		unset($_SESSION["aktivni_korisnik_tip"]);
		unset($_SESSION["aktivni_korisnik_id"]);
		session_destroy();
		header("Location:index.php");
	}

	$error= "";
	if(isset($_POST['submit'])){
		$user_name=mysqli_real_escape_string($bp,$_POST['korisnicko_ime']);
		$password=mysqli_real_escape_string($bp,$_POST['lozinka']);

		if(!empty($user_name)&&!empty($password)){
			$sql="SELECT korisnik_id, tip_id, ime, prezime FROM korisnik WHERE korisnicko_ime='$user_name' AND lozinka='$password'";
			$rs=executeQuery($bp,$sql);
			if(mysqli_num_rows($rs)==0) {
                $error="Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
            } else {
				list($id,$type,$name,$surname)=mysqli_fetch_array($rs);
				$_SESSION['aktivni_korisnik']=$user_name;
				$_SESSION['aktivni_korisnik_ime']=$name." ".$surname;
				$_SESSION["aktivni_korisnik_id"]=$id;
				$_SESSION['aktivni_korisnik_tip']=$type;
				header("Location:index.php");
			}
		}
		else $error = "Molim unesite korisničko ime i lozinku";
	}
?>
<form id="prijava" name="prijava" method="POST" action="login.php" onsubmit="return validacija();">
	<table>
		<caption>Prijava u sustav</caption>
		<tbody>
			<tr>
					<td colspan="2" style="text-align:center;">
						<label class="greska"><?php if($error!="")echo $error; ?></label>
					</td>
			</tr>
			<tr>
				<td class="lijevi">
					<label for="korisnicko_ime"><strong>Korisničko ime:</strong></label>
				</td>
				<td>
					<input name="korisnicko_ime" id="korisnicko_ime" type="text" size="120"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="lozinka"><strong>Lozinka:</strong></label>
				</td>
				<td>
					<input name="lozinka"	id="lozinka" type="password" size="120"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input name="submit" type="submit" value="Prijavi se"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
	closeConnection($bp);
	include("footer.php");
?>
