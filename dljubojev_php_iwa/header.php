<?php
	include("database.php");
	if(session_id()=="")session_start();

	$current=basename($_SERVER["PHP_SELF"]);
	$path=$_SERVER['REQUEST_URI'];
	$active_user=0;
	$active_user_type=-1;
	$page_size=5; 
	$page_size_video=20; 	

	if(isset($_SESSION['aktivni_korisnik'])){
		$active_user=$_SESSION['aktivni_korisnik'];
		$active_user_name=$_SESSION['aktivni_korisnik_ime'];
		$active_user_type=$_SESSION['aktivni_korisnik_tip'];
		$active_user_id=$_SESSION["aktivni_korisnik_id"];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ogledna aplikacija</title>
		<meta name="autor" content="IWA Webmaster"/>
		<meta name="datum" content="10.10.2016."/>
		<meta charset="utf-8"/>
		<link href="styles.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="video.js"></script>
	</head>
	<body onload="forma();">
		<header>
			<span>
				<strong>Izgradnja Web aplikacija</strong>
				<br/>
                
                
                <?php
                    
                    echo "<a class='link' href='author.html'>O AUTORU</a><br>";
				                            
					echo "<strong>Trenutna lokacija: </strong>".$current."<br/>";
					if($active_user===0){
						echo "<span><strong>Status: </strong>Neprijavljeni korisnik</span><br/>";
						echo "<a class='link' href='login.php'>PRIJAVA</a>";
					}
					else{
						echo "<span><strong>Status: </strong>Dobrodošli, $active_user_name</span><br/>";
						echo "<a class='link' href='login.php?logout=1'>ODJAVA</a>";
					}
				?>
			</span>
		</header>
		<nav id="navigacija" class="menu">
			<?php
				switch(true){
					case $current:
						switch($active_user_type>=0) {
							case 'true':
								echo '<a href="index.php"';
								if($current=="index.php")echo ' class="aktivna"';
								echo ">POČETNA</a>";
                                
								echo '<a href="users_list.php"';
								if($current=="users_list.php")echo ' class="aktivna"';
								echo ">KORISNICI</a>";
                                
								echo '<a href="parking_spot_list.php"';
								if($current=="parking_spot_list.php")echo ' class="aktivna"';
								echo ">POPIS PARKIRALISTA</a>";
                                
								echo '<a href="partners_list.php"';
								if($current=="partners_list.php")echo ' class="aktivna"';
								echo ">PRIJAVA/ODJAVA AUTOMOBILA</a>";
                                
                                                          		
                                break;

							default:
								echo '<a href="index.php"';
								if($current=="index.php")echo ' class="aktivna"';
								echo ">POČETNA</a>";
                                
							    echo '<a href="parking_spot_list.php"';
								if($current=="parking_spot_list.php")echo ' class="aktivna"';
								echo ">POPIS PARKIRALISTA</a>";
                                
                                                                
                                
								break;
						}

					default:
						break;
				} 
            if($active_user_type==0 || $active_user_type==1){
                           
								 echo '<a href="car_list.php"';
								if($current=="car_list.php")echo ' class="aktivna"';
								echo ">DOLASCI/ODLASCI</a>";
            }
            if($active_user_type==0){
                           
								echo '<a href="company_list.php"';
								if($current=="company_list.php")echo ' class="aktivna"';
								echo ">POPIS TVRTKI</a>"; 
            }
			?>
		</nav>
		<section id="sadrzaj">
