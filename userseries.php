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
            <h2>Vos série sur demande</h2>
        </header>
        <?php 
			//On ouvre la bdd
			require('base.php');
		
			//Démarrage ou restauration de la session
			session_start();
		?>
        <div id="onglets">
            <ul>
            	<li>BONJOUR
                <?php
					echo $_SESSION['user'];
				?>
                </li>
                <li><a href="series_tv.php" title="Accueil"> Accueil </a></li>
                <li><a href="compteuser.php" title="Mon compte"> Mon Compte </a></li>
                <li><a href="userseries.php" class="current" title="Mes series"> Mes séries </a></li>
                <li><a href="" title="Mes recommandations"> Mes recommandations</a></li>
                <li><a href="deconnexion.php" title="Se deconnecter"> Se deconnecter </a></li>
                <!-- Uniquement lorsque l'utilisateur est connecté à son compte -->
            </ul>
        </div>

        <div id="recapserie">
        	<h3>Vos séries regardées</h3>
            <?php
				$id_user = idUsers();
				$chaine = "SELECT series.name, series.poster_path FROM usersepisodes, series, seasonsepisodes, seriesseasons WHERE usersepisodes.user_id = '$id_user' AND usersepisodes.episode_id = seasonsepisodes.episode_id AND seasonsepisodes.season_id = seriesseasons.season_id AND seriesseasons.series_id = series.id ORDER BY series.name";
				$req = $bdd->query($chaine);
				$serie = "";
				while ($res = $req->fetch()) {
					if ($serie != $res[0]) {
						echo "<div class='step'>";
						echo "<h4>".$res[0]."</h4>";
						$serie = $res[0];
						$chaine2 = "SELECT episodes.name, episodes.number, seriesseasons.season_id, episodes.id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name = '$res[0]'";
						$req2 = $bdd->query($chaine2);
						$res2 = $req2->fetchAll();
						$comparesaison = -1;
						$saison = 0;	
						echo "<div>";													
						foreach ($res2 as $value) {
							if ($value[2] != $comparesaison) {
								echo "</div>";
								$comparesaison = $value[2];
								$saison++;
								echo "<div class='serie'> Saison n°".$saison;
							}
							$chaine3 = "SELECT * FROM usersepisodes WHERE usersepisodes.episode_id = '$value[3]'";
							$req3 = $bdd->query($chaine3);
							$int = $req3->rowCount();
							if ($int > 0) {
								echo "<p hidden class='nomepisodevu'>Episode n°".$value[1]." : ".$value[0]."</p>";
							} else {
								echo "<p hidden class='nomepisodepasvu'>Episode n°".$value[1]." : ".$value[0]."</p>";
							}
						}
						echo "</div></div>";
					}
				}
			?>
        </div>
        
        <footer>
        
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="compteuser.php">Mon compte</a></li>
                    <li><a href="userseries.php" class="current">Mes séries</a></li>
                    <li><a href="">Mes recommandations</a></li>
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
        <?php
			function idUsers() {
				global $bdd;
				$user = $_SESSION['user'];
				$chaineUser = "SELECT * FROM users WHERE name = '$user'";
				$reqUser = $bdd->query($chaineUser);
				$resUser = $reqUser->fetch();
				return $resUser[0];
			}
		?>
    </body>
        <script type="text/javascript" src="javascript/jquery.js"></script>
        <script type="text/javascript"  src="javascript/series.js"></script>
</html>
