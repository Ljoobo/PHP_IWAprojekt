<?php
	include("header.php");
	$bp=connectToDatabase();
?>

<?php
	
	$sql="SELECT COUNT(*) FROM korisnik";
	$rs=executeQuery($bp,$sql);
	$row=mysqli_fetch_array($rs);
	$rows_number=$row[0];
	$page_number=ceil($rows_number/$page_size);

	
	$sql="SELECT * FROM korisnik ORDER BY korisnik_id LIMIT ".$page_size;
	if(isset($_GET['stranica'])){
		$sql=$sql." OFFSET ".(($_GET['stranica']-1)*$page_size);
		$active=$_GET['stranica'];
	}
	else $active = 1;

	$rs=executeQuery($bp,$sql);
	echo "<table>";
	echo "<caption>Popis korisnika sustava</caption>";
	echo "<thead><tr>
		<th>Korisničko ime</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>E-mail</th>
		<th>Lozinka</th>
		<th>Slika</th>
		<th></th>";
	echo "</tr></thead>";
	
	echo "<tbody>";
	while(list($id,$type,$user_name,$password,$name,$surname,$email,$picture)=mysqli_fetch_array($rs)){
		echo "<tr>
			<td>$user_name</td>
			<td>$name</td>";
		echo "<td>".(empty($surname)?"&nbsp;":"$surname")."</td>
			<td>".(empty($email)?"&nbsp;":"$email")."</td>
			<td>$password</td>
			<td><figure><img src='$picture' width='70' height='100' alt='Slika korisnika $name $surname'/></figure></td>";
        
            $active=$_SESSION['aktivni_korisnik_id'];
        
			if($active_user_type==0)echo "<td><a class='link' href='users.php?korisnik=$id'>UREDI</a></td>";
			else if(isset($_SESSION["aktivni_korisnik_id"])&&$_SESSION["aktivni_korisnik_id"]==$id) echo '<td><a class="link" href="users.php?korisnik='.$_SESSION["aktivni_korisnik_id"].'">UREDI</a></td>';
            if($active_user_type == 0 || $active_user_type == 1) {
                echo "<td><a class='link' href='add_partner.php?user_id=$id&aktivni=$active'>DODAJ PARTNERA</a></td>";
            }
			else echo "<td></td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

	
	echo '<div id="paginacija">';
	
	if($active!=1){
		$previous=$active-1;
		echo "<a class='link' href=\"users_list.php?stranica=".$previous."\">&lt;</a>";
	}
	for($i=1;$i<=$page_number;$i++){
		echo "<a class='link";
		if($active==$i)echo " aktivna"; 
		echo "' href=\"users_list.php?stranica=".$i."\">$i</a>";
	}
	
	if($active<$page_number){
		$next=$active+1;
		echo "<a class='link' href=\"users_list.php?stranica=".$next."\">&gt;</a>";
	}
	echo "<br/>";
	if($active_user_type==0||$active_user_type==1)echo '<a class="link" href="users.php">DODAJ KORISNIKA</a>';
	if(isset($_SESSION["aktivni_korisnik_id"]))echo '<a class="link" href="users.php?korisnik='.$_SESSION["aktivni_korisnik_id"].'">UREDI MOJE PODATKE</a>';
	echo '</div>';
?>

<?php
	closeConnection($bp);
	include("footer.php");
?>
