<?php
	include("header.php");
	$bp=connectToDatabase();
?>
<?php
	$error="";
	if(isset($_POST['submit'])){
		foreach ($_POST as $key => $value)if(strlen($value)==0)$error="Sva polja za unos su obavezna";
		if(empty($error)){
			$id=$_POST['novi'];
			$type=$_POST['tip'];
			$user_name=$_POST['kor_ime'];
			$password=$_POST['lozinka'];
			$name=$_POST['ime'];
			$surname=$_POST['prezime'];
			$email=$_POST['email'];
			$picture=$_POST['slika'];

			if($id==0){
				$sql="INSERT INTO korisnik
				(tip_id,korisnicko_ime,lozinka,ime,prezime,email,slika)
				VALUES
				($type,'$user_name','$password','$name','$surname','$email','$picture');
				";
			}
			else{
				$sql="UPDATE korisnik SET
					tip_id='$type',
					ime='$name',
					prezime='$surname',
					lozinka='$password',
					email='$email',
					slika='$picture'
					WHERE korisnik_id='$id'
				";
			}
			executeQuery($bp,$sql);
			header("Location:users_list.php");
		}
	}
	if(isset($_GET['korisnik'])){
		$id=$_GET['korisnik'];
		if($active_user_type==2)$id=$_SESSION["aktivni_korisnik_id"]; 
		$sql="SELECT * FROM korisnik WHERE korisnik_id='$id'";
		$rs=executeQuery($bp,$sql);
		list($id,$type,$user_name,$password,$name,$surname,$email,$picture)=mysqli_fetch_array($rs);
	}
	else{
		$type=2;
		$user_name="";
		$password="";
		$name="";
		$surname="";
		$email="";
		$picture="";
	}
	if(isset($_POST['reset']))header("Location:users.php");
?>
<form method="POST" action="<?php if(isset($_GET['korisnik']))echo "users.php?korisnik=$id";else echo "users.php";?>">
	<table>
		
		<tbody>
			<tr>
				<td colspan="2">
					<input type="hidden" name="novi" value="<?php if(!empty($id))echo $id;else echo 0;?>"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<label class="greska"><?php if($error!="")echo $error; ?></label>
				</td>
			</tr>
			<tr>
				<td class="lijevi">
					<label for="kor_ime"><strong>Korisničko ime:</strong></label>
				</td>
				<td>
					<input type="text" name="kor_ime" id="kor_ime"
						<?php
							if(isset($id))echo "readonly='readonly'";
						?>
						value="<?php if(!isset($_POST['kor_ime']))echo $user_name; else echo $_POST['kor_ime'];?>" size="120" minlength="10" maxlength="50"
						placeholder="Korisničko ime ne smije sadržavati praznine, treba uključiti minimalno 10 znakova i započeti malim početnim slovom"
						required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="ime"><strong>Ime:</strong></label>
				</td>
				<td>
					<input type="text" name="ime" id="ime" value="<?php if(!isset($_POST['ime']))echo $name; else echo $_POST['ime'];?>"
						size="120" minlength="1" maxlength="50" placeholder="Ime treba započeti velikim početnim slovom" required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="prezime"><strong>Prezime:</strong></label>
				</td>
				<td>
					<input type="text" name="prezime" id="prezime" value="<?php if(!isset($_POST['prezime']))echo $surname; else echo $_POST['prezime'];?>"
						size="120" minlength="1" maxlength="50" placeholder="Prezime treba započeti velikim početnim slovom" required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="lozinka"><strong>Lozinka:</strong></label>
				</td>
				<td>
					<input <?php if(!empty($password))echo "type='text'"; else echo "type='password'";?>
						name="lozinka" id="lozinka" value="<?php if(!isset($_POST['lozinka']))echo $password; else echo $_POST['lozinka'];?>"
						size="120" minlength="8" maxlength="50"
						placeholder="Lozinka treba sadržati minimalno 8 znakova uključujući jedno veliko i jedno malo slovo, jedan broj i jedan posebni znak"
						required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="email"><strong>E-mail:</strong></label>
				</td>
				<td>
					<input type="email" name="email" id="email" value="<?php if(!isset($_POST['email']))echo $email; else echo $_POST['email'];?>"
						size="120" minlength="5" maxlength="50" placeholder="Ispravan oblik elektroničke pošte je nesto@nesto.nesto" required="required"/>
				</td>
			</tr>
			<?php
				if($_SESSION['aktivni_korisnik_tip']==0){
			?>
			<tr>
				<td><label for="tip"><strong>Tip korisnika:</strong></label></td>
				<td>
					<select id="tip" name="tip">
						<?php
							if(isset($_POST['tip'])){
								echo '<option value="0"';if($_POST['tip']==0)echo " selected='selected'";echo'>Administrator</option>';
								echo '<option value="1"';if($_POST['tip']==1)echo " selected='selected'";echo'>Moderator</option>';
								echo '<option value="2"';if($_POST['tip']==2)echo " selected='selected'";echo'>Korisnik</option>';
							}
							else{
								echo '<option value="0"';if($type==0)echo " selected='selected'";echo'>Administrator</option>';
								echo '<option value="1"';if($type==1)echo " selected='selected'";echo'>Moderator</option>';
								echo '<option value="2"';if($type==2)echo " selected='selected'";echo'>Korisnik</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php
				}
			?>
			<tr>
				<td>
					<label for="slika"><strong>Slika:</strong></label>
				</td>
				<td>
				<?php
					$dir=scandir("korisnici");
					echo '<select id="slika" name="slika">';
					foreach($dir as $key => $value){
						if($key<2)continue;
						else if(strcmp((isset($_POST['slika'])?$_POST['slika']:$picture),"korisnici/".$value)==0){
							echo '<option value="'."korisnici/".$value.'"';
							echo ' selected="selected">'."korisnici/".$value;
							echo '</option>';
						}
						else{
							echo '<option value="'."korisnici/".$value.'">';
							echo "korisnici/".$value;
							echo '</option>';
						}
					}
					echo '</select>';
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<?php
						if(isset($id)&&$active_user_id==$id||!empty($id))echo '<input type="submit" name="submit" value="Pošalji"/>';
						else echo '<input type="submit" name="reset" value="Izbriši"/><input type="submit" name="submit" value="Pošalji"/>';
					?>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
	closeConnection($bp);
	include("footer.php");
?>
