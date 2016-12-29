<!DOCTYPE html>
<html>
    <head>
        <title>Cinéfix</title>
        <meta charset="UTF-8" />
        <link rel="Stylesheet" href="css/series_tv.css" type="Text/css"/>
        <link rel="stylesheet" href="css/footer.css" type="text/css"/>
    </head>
    <body>
        <header>
            <h1>CiNéFiX</h1>
            <h2>Vos série sur demande</h2>
        </header>
        <?php 
			//On ouvre la bdd
			require('base.php');
		
			//Démarrage ou restauration de la session
			session_start();
			if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
		?>
        <div class="onglets">
            <ul>
                <li><a href="connexion.html" title="Se connecter"> Se connecter </a></li>
                <li><a href="inscription.html" title="S'inscrire"> S'inscrire </a></li>
                <!-- Uniquement lorsque l'utilisateur n'est pas connecté à son compte -->
            </ul>
        </div>
        <?php
			}else { 
		?>
        <div class="onglets">
            <ul>
            	<li>Bonjour 
                <?php
					echo $_SESSION['user'];
				?>
                </li>
                <li><a href="deconnexion.php" title="Se deconnecter"> Se deconnecter </a></li>
                <li><a href="compte.html" title="Mon compte"> Mon Compte </a></li>
                <li><a href="series.html" title="Mes series"> Mes séries </a></li>
                <li><a href="recommandations.html" title="Mes recommandations"> Mes recommandations</a></li>
                <!-- Uniquement lorsque l'utilisateur est connecté à son compte -->
            </ul>
        </div>
        <?php 
			};
		?>
        <div id="recherche">
        	<ul class="alphabet">
            	<li><a href="series_tv_%23.php?recherche=alll">#</a></li>
                <li><a href="series_tv_%23.php?recherche=0">0-9</a></li>
                <li><a href="series_tv_%23.php?recherche=A">A</a></li>
                <li><a href="series_tv_%23.php?recherche=B">B</a></li>
                <li><a href="series_tv_%23.php?recherche=C">C</a></li>
            	<li><a href="series_tv_%23.php?recherche=D">D</a></li>
                <li><a href="series_tv_%23.php?recherche=E">E</a></li>
                <li><a href="series_tv_%23.php?recherche=F">F</a></li>
                <li><a href="series_tv_%23.php?recherche=G">G</a></li>
            	<li><a href="series_tv_%23.php?recherche=H">H</a></li>
                <li><a href="series_tv_%23.php?recherche=I">I</a></li>
                <li><a href="series_tv_%23.php?recherche=J">J</a></li>
                <li><a href="series_tv_%23.php?recherche=K">K</a></li>
            	<li><a href="series_tv_%23.php?recherche=L">L</a></li>
                <li><a href="series_tv_%23.php?recherche=M">M</a></li>
                <li><a href="series_tv_%23.php?recherche=N">N</a></li>
                <li><a href="series_tv_%23.php?recherche=O">O</a></li>
            	<li><a href="series_tv_%23.php?recherche=P">P</a></li>
                <li><a href="series_tv_%23.php?recherche=Q">Q</a></li>
                <li><a href="series_tv_%23.php?recherche=R">R</a></li>
                <li><a href="series_tv_%23.php?recherche=S">S</a></li>
            	<li><a href="series_tv_%23.php?recherche=T">T</a></li>
                <li><a href="series_tv_%23.php?recherche=U">U</a></li>
                <li><a href="series_tv_%23.php?recherche=V">V</a></li>
                <li><a href="series_tv_%23.php?recherche=W">W</a></li>
            	<li><a href="series_tv_%23.php?recherche=X">X</a></li>
                <li><a href="series_tv_%23.php?recherche=Y">Y</a></li>
                <li><a href="series_tv_%23.php?recherche=Z">Z</a></li>
            </ul>
            <ul class="genres">
            	<li><a href="series_tv_%23.php?recherche=allg">#</a></li>
                <li><a href="series_tv_%23.php?recherche=Action">Action</a></li>
                <li><a href="series_tv_%23.php?recherche=Adventure">Adventure</a></li>
                <li><a href="series_tv_%23.php?recherche=ActionAventure">Action & Adventure</a></li>
                <li><a href="series_tv_%23.php?recherche=Animation">Animation</a></li>
                <li><a href="series_tv_%23.php?recherche=Comedy">Comedy</a></li>
                <li><a href="series_tv_%23.php?recherche=Crime">Crime</a></li>
                <li><a href="series_tv_%23.php?recherche=Documentary">Documentary</a></li>
                <li><a href="series_tv_%23.php?recherche=Drama">Drama</a></li>
                <li><a href="series_tv_%23.php?recherche=Family">Family</a></li>
                <li><a href="series_tv_%23.php?recherche=Fantasy">Fantasy</a></li>
                <li><a href="series_tv_%23.php?recherche=History">History</a></li>
                <li><a href="series_tv_%23.php?recherche=Horror">Horror</a></li>
                <li><a href="series_tv_%23.php?recherche=Kids">Kids</a></li>
                <li><a href="series_tv_%23.php?recherche=Music">Music</a></li> 
                <li><a href="series_tv_%23.php?recherche=Mystery">Mystery</a></li>
                <li><a href="series_tv_%23.php?recherche=Reality">Reality</a></li>
                <li><a href="series_tv_%23.php?recherche=Romance">Romance</a></li>
                <li><a href="series_tv_%23.php?recherche=News">News</a></li>
                <li><a href="series_tv_%23.php?recherche=Science Fiction">Science Fiction</a></li>
                <li><a href="series_tv_%23.php?recherche=Sci-FiFantasy">Sci-Fi & Fantasy</a></li>
                <li><a href="series_tv_%23.php?recherche=Soap">Soap</a></li> 
                <li><a href="series_tv_%23.php?recherche=Talk">Talk</a></li>
                <li><a href="series_tv_%23.php?recherche=Thriller">Thriller</a></li>
                <li><a href="series_tv_%23.php?recherche=TV Movie">TV Movie</a></li>
                <li><a href="series_tv_%23.php?recherche=War">War</a></li>
                <li><a href="series_tv_%23.php?recherche=WarPolitics">War & Politics</a></li>
                <li><a href="series_tv_%23.php?recherche=Western">Western</a></li>
            </ul>
        </div>
		<div id="#alphabet">
        	<?php

			$urlImg="https://image.tmdb.org/t/p/w300"; //debut de l'url pour afficher le poster correspondant a une série
				//La variable qui correspond à la lettre choisi dans la liste de recherche par alphabet
				echo "<h3>Votre recherche</h3>";
				if ($_GET['recherche'] == "alll") {
					$alphabet = ["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
					for ($i = 0; $i < 36; $i++) {
						$lettre = $alphabet[$i];
						$chaine = "SELECT name FROM series WHERE name LIKE '$lettre%' ORDER BY name";
						$req = $bdd->query($chaine);
						$int = $req->rowCount();
						if ($int > 0) {
							echo "<h3>".$lettre."</h3>";
							while ($res = $req->fetch()) {
								echo "<p>".$res[0]."</p>";
							}
						}
					}
				} else if ($_GET['recherche'] == "allg") {
					$genres = ["Action","Adventure","Action & Adventure","Animation","Comedy","Crime","Documentary","Drama","Family","Fantasy","History","Horror","Kids","Music","Mystery","Reality","Romance","News","Science Fiction","Sci-Fi & Fantasy","Soap","Talk","Thriller","TV Movie","War","War & Politics","Western"];
					for ($i = 0; $i < 27; $i++) {
						$genre =  $genres[$i];
						$chaine = "SELECT series.name FROM seriesgenres, series, genres WHERE genres.name = '$genre' AND genres.id = seriesgenres.genre_id AND seriesgenres.series_id = series.id ORDER BY series.name";
						$req = $bdd->query($chaine);
						$int = $req->rowCount();
						if ($int > 0) {
							echo "<h3>".$genre."</h3>";
							while ($res = $req->fetch()) {
								echo "<p>".$res[0]."</p>";
							}
						}
					  }
				} else if ($_GET['recherche'] == "0") {
					for ($i = 0; $i < 10; $i++) {
						$chaine = "SELECT name FROM series WHERE name LIKE '$i%' ORDER BY name";
						$req = $bdd->query($chaine);
						$int = $req->rowCount();
						if ($int > 0) {
							echo "<h3>".$i."</h3>";
							while ($res = $req->fetch()) {
								echo "<p>".$res[0]."</p>";
							}
						}
					}
				} else if (($_GET['recherche'] == "A") || ($_GET['recherche'] == "B") || ($_GET['recherche'] == "C") || ($_GET['recherche'] == "D") || ($_GET['recherche'] == "E") || ($_GET['recherche'] == "F") || ($_GET['recherche'] == "G") || ($_GET['recherche'] == "H") || ($_GET['recherche'] == "I") || ($_GET['recherche'] == "J") || ($_GET['recherche'] == "K") || ($_GET['recherche'] == "L") || ($_GET['recherche'] == "M") || ($_GET['recherche'] == "N") || ($_GET['recherche'] == "O") || ($_GET['recherche'] == "P") || ($_GET['recherche'] == "Q") || ($_GET['recherche'] == "R") || ($_GET['recherche'] == "S") || ($_GET['recherche'] == "T") || ($_GET['recherche'] == "U") || ($_GET['recherche'] == "V") || ($_GET['recherche'] == "W") || ($_GET['recherche'] == "X") || ($_GET['recherche'] == "Y")|| ($_GET['recherche'] == "Z")){
					//TEST POUR FAIRE LA LISTE DES SAISONS ET EPISODES POUR POUVOIR RECUPERER LES SERIES DANS LA PAGE MES SERIES
					//LORSQUE L'UTILISATEUR DIT QU'IL A VU CERTAIN EPISODE
					$lettre = $_GET['recherche'];
					$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name LIKE '$lettre%' ORDER BY series.name";
					$req = $bdd->query($chaine);
					$int = $req->rowCount();
					if ($int > 0) {


						echo "<h3>".$lettre."</h3>";
						$res = $req->fetchAll();
						$compareserie = $res[0][0];
						$premierAffiche=$urlImg.$res[0][8];
						echo "<div class='serie'>" . $compareserie."<br><img hidden src='$premierAffiche' alt='affiche de la série'>";
						echo "<p hidden>Nombre de saisons :".$res[0][5]." Nombre d'épisodes :".$res[0][4]."<br>Résumé : ".$res[0][6]."<br>Popularité : ".$res[0][7]."</p>";
						$comparesaison = -1;
						$saison = 1;

						foreach($res as $value) {
							if ($compareserie != $value[0]) {
								echo "</div>";
								$compareserie = $value[0];
								$saison=1;
								$comparesaison = $value[3];
								$afficheSerie=$urlImg.$value[8];
								echo "<div class='serie'>" . $compareserie."<br><img hidden src='$afficheSerie' alt='affiche de la série'>";
								echo "<p hidden>Nombre de saisons :".$value[5]." Nombre d'épisodes :".$value[4]."<br>Résumé : ".$value[6]."<br>Popularité : ".$value[7]."</p>";
								echo "<h4 hidden class='numsaison'> Saison n°".$saison."</h4>";
								echo "<p hidden class='nomepisode'>Episode n°".$value[2]." : ".$value[1]."</p>";
							} else {
								if ($value[3] != $comparesaison) {

									$comparesaison = $value[3];
									$saison++;
									echo "<h4 hidden class='numsaison'> Saison n°".$saison."</h4>";

								}
								echo "<p hidden class='nomepisode'>Episode n°".$value[2]." : ".$value[1]."</p>";

							}

						}

						}

				} else {
					if ($_GET['recherche'] == "ActionAventure") {
						$genre = "Action & Adventure";
					} else if ($_GET['recherche'] == "Sci-FiFantasy") {
						$genre = "Sci-Fi & Fantasy";
					} else if ($_GET['recherche'] == "WarPolitics") {
						$genre = "War & Politics";	
					} else {
						$genre = $_GET['recherche'];	
					}
					$chaine = "SELECT series.name FROM seriesgenres, series, genres WHERE genres.name = '$genre' AND genres.id = seriesgenres.genre_id AND seriesgenres.series_id = series.id ORDER BY series.name";
					$req = $bdd->query($chaine);
					$int = $req->rowCount();
					if ($int > 0) {
						echo "<h3>".$genre."</h3>";
						while ($res = $req->fetch()) {
							echo "<p>".$res[0]."</p>";
						}
					}
				}
				
			?>
        </div>
        <footer>>
            </div>-->
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
				</ul>
			</div>
			<div class="social">
				<span>Rejoignez-nous sur les réseaux sociaux<br></span>
				<a href="https://www.facebook.com/" title="facebook">
					<img src="images/facebook.png">
				</a>
				<a href="http://www.twitter.fr" title="twitter">
					<img src="images/twitter.jpg">
				</a>
				<a href="http://www.instagram.com" title="instagram">
					<img src="images/instagram.png">
				</a>
			</div>
			<div class="copyright">&copy;  2016 Tous droits réservés.<br>Site réalisé par Sophie, Jeanne, Benjamin et Thomas.</div>
        </footer>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript"  src="javascript/series.js"></script>

    </body>
</html>
