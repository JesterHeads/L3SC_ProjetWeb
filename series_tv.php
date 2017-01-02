<!DOCTYPE html>
<html>
    <head>
        <title>Cinéfix</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
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

			//Démarrage ou restauration de la session
			session_start();

        function detailSeries($query){ //fonction d'affichage du detail des series
            global $bdd;
            $affiche="https://image.tmdb.org/t/p/w780";
            $req = $bdd->query($query);
            $int = $req->rowCount();
            if ($int > 0) {

                $res = $req->fetchAll();
                $compareserie = $res[0][0];
                $afficheSerie=$affiche.$res[0][8];
                $comparesaison = $res[0][3];
                $saison = 1;
                echo "<li><div class='topserie'>" . $compareserie."<br><img class='afficheSerie' src='$afficheSerie' alt='affiche de la série'>";
                echo "<p hidden>Nombre de saisons :".$res[0][5]." Nombre d'épisodes :".$res[0][4]."<br>Résumé : ".$res[0][6]."<br>Popularité : ".$res[0][7]."</p>";
                $comparesaison = -1;
                $saison = 0;
                echo "<div hidden class='numsaison'>";
                foreach($res as $value) {
                    if ($compareserie != $value[0]) {
                        echo "</div></div></li>";
                        $compareserie = $value[0];
                        $saison=1;
                        $comparesaison = $value[3];
                        $afficheSerie=$affiche.$value[8];
                        echo "<li><div class='topserie'>" . $compareserie."<br><img  src='$afficheSerie' alt='affiche de la série'>";
                        echo "<p hidden>Nombre de saisons :".$value[5]." Nombre d'épisodes :".$value[4]."<br>Résumé : ".$value[6]."<br>Popularité : ".$value[7]."</p>";
                        echo "<div hidden class='numsaison'> Saison n°".$saison;
                        echo "<p hidden class='nomepisode'>Episode n°".$value[2]." : ".$value[1]."</p>";
                        if (isset($_SESSION['user']) || !empty($_SESSION['user'])){
                            //texte brut car problème avec la fonction
                            //$id_user = idUsers();
                            $user = $_SESSION['user'];
                            $chaineUser = "SELECT * FROM users WHERE name = '$user'";
                            $reqUser = $bdd->query($chaineUser);
                            $resUser = $reqUser->fetch();
                            $id_user = $resUser[0];
                            $id_episode = $value[9];
                            //addButton($id_user, $id_episode);
                            $chaineButton = "SELECT * FROM usersepisodes WHERE user_id = '$id_user' AND episode_id = '$id_episode'";
                            $reqButton = $bdd->query($chaineButton);
                            $intButton = $reqButton->rowCount();
                            if ($intButton > 0) {
                                echo "<input type='button' hidden onclick='ajout_ep($value[9])' id='$value[9]' class='episodevu' value='Episode vu !' disabled='disabled'>";
                            } else {
                                echo "<input type='button' hidden onclick='ajout_ep($value[9])' id='$value[9]' class='episodevu' value='Episode déjà vu ?'>";
                            }
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
                            $user = $_SESSION['user'];
                            $chaineUser = "SELECT * FROM users WHERE name = '$user'";
                            $reqUser = $bdd->query($chaineUser);
                            $resUser = $reqUser->fetch();
                            $id_user = $resUser[0];
                            $id_episode = $value[9];
                            //addButton($id_user, $id_episode);
                            $chaineButton = "SELECT * FROM usersepisodes WHERE user_id = '$id_user' AND episode_id = '$id_episode'";
                            $reqButton = $bdd->query($chaineButton);
                            $intButton = $reqButton->rowCount();
                            if ($intButton > 0) {
                                echo "<input type='button' hidden onclick='ajout_ep($value[9])' id='$value[9]' class='episodevu' value='Episode vu !' disabled='disabled'>";
                            } else {
                                echo "<input type='button' hidden onclick='ajout_ep($value[9])' id='$value[9]' class='episodevu' value='Episode déjà vu ?'>";
                            }
                        }
                    }
                }
                echo "</div></div></li>";
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
        <div id="description">
        	<h3>BONJOUR A TOUS !</h3>
            <p>blablablablablablablablablablablablablablablablablablablablablablablabla</p>
        </div>
        <div id="topseries">
        	<h3>TOP SERIES</h3>
        	<ul class="top">
            <!-- On séléctionne arbitrairement trois films qui feront office de notre top
				Ils ne changent pas -->
            	<?php
                    $chaine="SELECT name FROM series ORDER BY popularity";
                    $req = $bdd->query($chaine);
                    $res = $req->fetchAll();
                    for($i=0;$i<4;$i++){
                        $nomSerie=$res[$i][0];
                        $chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name='$nomSerie'";
                        detailSeries($chaine);
                    }


				?>
            </ul>
        </div>
        <div id="randseries">
        <h3>SERIES ALEATOIRES</h3>
        	<ul class="rand">
         		<!-- On choisit aléatoirement 3 films à chaque fois que l'on charge la page -->
            	<?php
                for ($i=0; $i<3; $i++){
                    $chaine="SELECT name FROM series ORDER BY rand()";
                    $req = $bdd->query($chaine);
                    $res = $req->fetchAll();
                    $nomSerie=$res[0][0];
                    $chaine = "SELECT series.name, episodes.name, episodes.number, seriesseasons.season_id ,series.number_of_episodes,series.number_of_seasons,series.overview,series.popularity,series.poster_path, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name='$nomSerie'";
                    detailSeries($chaine);
                }
				?>
            </ul> 
        </div>
        <footer>
            </div>
            <?php
            	if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
			?>
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php" class="current">Accueil</a></li>
                    <li><a href="">Connexion</a></li>
                    <li><a href="">Inscription</a></li>
				</ul>
			</div>
            <?php 
				} else {
			?>
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php" class="current">Accueil</a></li>
                    <li><a href="">Mon compte</a></li>
                    <li><a href="userseries.php">Mes séries</a></li>
                    <li><a href="">Mes recommandations</a></li>
				</ul>
			</div>
            <?php
				}
			?>
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
