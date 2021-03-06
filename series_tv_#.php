<!DOCTYPE html>
<html>
    <head>
        <title>Cinéfix</title>
        <meta charset="UTF-8" />
        <link rel="Stylesheet" href="css/style.css" type="Text/css"/>
        <link rel="stylesheet" href="css/footer.css" type="text/css"/>
    </head>
    <body>	
        <header>
            <h1>CiNéFiX</h1>
            <h2>Vos séries sur demande</h2>
        </header>
        <?php 
			//On ouvre la bdd
			require('base.php');


		function detailSeries($query,$typeRecherche){// fonction d'affichage du détail des séries
			global $bdd;
			$urlImg="https://image.tmdb.org/t/p/w300"; //debut de l'url pour afficher le poster correspondant a une série
			$req = $bdd->query($query);
			$int = $req->rowCount();
			if ($int > 0) {
				echo "<div class='step'>";
				echo "<h4>".$typeRecherche."</h4>";
				$res = $req->fetchAll();
				$compareserie = $res[0][0];
				$premierAffiche=$urlImg.$res[0][8];

				echo "<div class='serie'>" . $compareserie."<br><img hidden src='$premierAffiche' alt='affiche de la série'>";
				echo "<p hidden>Nombre de saisons :".$res[0][5]." Nombre d'épisodes :".$res[0][4]."<br>Résumé : ".$res[0][6]."<br>Popularité : ".$res[0][7]."</p>";
				$comparesaison = -1;
				$saison = 0;
				echo "<div hidden>";
				foreach($res as $value) {
					if ($compareserie != $value[0]) {
						echo "</div></div>";
						$compareserie = $value[0];
						$saison=1;
						$comparesaison = $value[3];
						$afficheSerie=$urlImg.$value[8];
						echo "<div class='serie'>" . $compareserie."<br><img hidden src='$afficheSerie' alt='affiche de la série'>";
						echo "<p hidden>Nombre de saisons :".$value[5]." Nombre d'épisodes :".$value[4]."<br>Résumé : ".$value[6]."<br>Popularité : ".$value[7]."</p>";
						echo "<div hidden class='numsaison'> Saison n°".$saison;
						echo "<p hidden class='nomepisode'>Episode n°".$value[2]." : ".$value[1]."</p>";
						if (isset($_SESSION['user']) || !empty($_SESSION['user'])){
							//texte brut car problème avec la fonction
							//$id_user = idUsers();
							$id_episode = $value[9];
							addButton($id_episode);
						}
					} else {
						if ($value[3] != $comparesaison) {
							echo "</div>";
							$comparesaison = $value[3];
							$saison++;
							echo "<div hidden class='numsaison'> Saison n°".$saison;
						}
						echo "<p hidden class='nomepisode'>Episode n°".$value[2]." : ".$value[1]."</p>";
						if (isset($_SESSION['user']) || !empty($_SESSION['user'])){
							//texte brut car problème avec la fonction
							//$id_user = idUsers();
							$id_episode = $value[9];
							addButton($id_episode);
						}
					}
				}
				echo "</div></div></div>";
			}
		}

			//Démarrage ou restauration de la session
			session_start();
			
			//renvoie l'id de l'utilisateur connecté 
			function idUsers() {
				global $bdd;
				$user = $_SESSION['user'];
				$chaineUser = "SELECT * FROM users WHERE name = '$user'";
				$reqUser = $bdd->query($chaineUser);
				$resUser = $reqUser->fetch();
				return $resUser[0];
			}
			
			function addButton($id_episode) {
				global $bdd;
				$id_user = idUsers();
				$chaineButton = "SELECT * FROM usersepisodes WHERE user_id = '$id_user' AND episode_id = '$id_episode'";
				$reqButton = $bdd->query($chaineButton);
				$intButton = $reqButton->rowCount();
				if ($intButton > 0) {
					echo "<input type='button' hidden onclick='ajout_ep($id_episode)' id='$id_episode' class='episodevu' value='Episode vu !' disabled='disabled'>";
				} else {
					echo "<input type='button' hidden onclick='ajout_ep($id_episode)' id='$id_episode' class='episodevu' value='Episode déjà vu ?'>";
				}
			}
						
			if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
		?>
                <div id="onglets">
            <ul>
            	<li><a href="series_tv.php" title="Accueil"> Accueil </a></li>
                <li><a href="connexion.html" title="Se connecter"> Se connecter </a></li>
                <li><a href="inscription.html" title="S'inscrire"> S'inscrire </a></li>
                <!-- Uniquement lorsque l'utilisateur n'est pas connecté à son compte -->
            </ul>
        </div>
        <?php
			}else { 
		?>
        <div id="onglets">
            <ul>
            	<li>BONJOUR
                <?php
					echo $_SESSION['user'];
				?>
                </li>
                <li><a href="series_tv.php" class="current" title="Accueil"> Accueil </a></li>
                <li><a href="" title="Mon compte"> Mon Compte </a></li>
                <li><a href="userseries.php" title="Mes series"> Mes séries </a></li>
                <li><a href="" title="Mes recommandations"> Mes recommandations</a></li>
                <li><a href="deconnexion.php" title="Se deconnecter"> Se deconnecter </a></li>
                <!-- Uniquement lorsque l'utilisateur est connecté à son compte -->
            </ul>
        </div>
        <?php 
			};
		?>
        <div id="recherche">
            <div id="Ralphabet">
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
               </div>
               <div id ="Rgenres">
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
        </div>
		<div id="result">
        	<?php
				$urlImg="https://image.tmdb.org/t/p/w300"; //debut de l'url pour afficher le poster correspondant a une série
				//La variable qui correspond à la lettre choisi dans la liste de recherche par alphabet
				echo "<h3>Votre recherche</h3>";
				if ($_GET['recherche'] == "alll") {
					$alphabet = ["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
					for ($i = 0; $i < 36; $i++) {
						$lettre = $alphabet[$i];

						$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name LIKE '$lettre%' ORDER BY series.name";
						detailSeries($chaine,$lettre);
					}
				} else if ($_GET['recherche'] == "allg") {
					$genres = ["Action","Adventure","Action & Adventure","Animation","Comedy","Crime","Documentary","Drama","Family","Fantasy","History","Horror","Kids","Music","Mystery","Reality","Romance","News","Science Fiction","Sci-Fi & Fantasy","Soap","Talk","Thriller","TV Movie","War","War & Politics","Western"];
					for ($i = 0; $i < 27; $i++) {
						$genre =  $genres[$i];

						$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM seriesgenres, series, genres, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND genres.name = '$genre' AND genres.id = seriesgenres.genre_id AND seriesgenres.series_id = series.id ORDER BY series.name";
						detailSeries($chaine,$genre);
					}
				} else if ($_GET['recherche'] == "0") {
					for ($i = 0; $i < 10; $i++) {
						$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name LIKE '$i%' ORDER BY series.name";
						detailSeries($chaine,$i);
					}
				} else if (($_GET['recherche'] == "A") || ($_GET['recherche'] == "B") || ($_GET['recherche'] == "C") || ($_GET['recherche'] == "D") || ($_GET['recherche'] == "E") || ($_GET['recherche'] == "F") || ($_GET['recherche'] == "G") || ($_GET['recherche'] == "H") || ($_GET['recherche'] == "I") || ($_GET['recherche'] == "J") || ($_GET['recherche'] == "K") || ($_GET['recherche'] == "L") || ($_GET['recherche'] == "M") || ($_GET['recherche'] == "N") || ($_GET['recherche'] == "O") || ($_GET['recherche'] == "P") || ($_GET['recherche'] == "Q") || ($_GET['recherche'] == "R") || ($_GET['recherche'] == "S") || ($_GET['recherche'] == "T") || ($_GET['recherche'] == "U") || ($_GET['recherche'] == "V") || ($_GET['recherche'] == "W") || ($_GET['recherche'] == "X") || ($_GET['recherche'] == "Y")|| ($_GET['recherche'] == "Z")){
					$lettre = $_GET['recherche'];
					$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name LIKE '$lettre%' ORDER BY series.name";

					detailSeries($chaine,$lettre);

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
					$chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM seriesgenres, series, genres, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND genres.name = '$genre' AND genres.id = seriesgenres.genre_id AND seriesgenres.series_id = series.id ORDER BY series.name";
					detailSeries($chaine,$genre);

				}
			?>
        </div>
        <footer>
        	<div class="content">
            <?php
            	if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
			?>
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="connexion.html" title="Se connecter"> Se connecter </a></li>
               		<li><a href="inscription.html" title="S'inscrire"> S'inscrire </a></li>
				</ul>
            <?php 
				} else {
			?>
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="compteuser.php">Mon compte</a></li>
                    <li><a href="userseries.php">Mes séries</a></li>
                    <li><a href="">Mes recommandations</a></li>
				</ul>
			<?php
				}
			?>
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
