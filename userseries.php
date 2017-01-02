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
                <li><a href="series_tv.php" title="Accueil"> Accueil </a></li>
                <li><a href="" title="Mon compte"> Mon Compte </a></li>
                <li><a href="userseries.php" class="current" title="Mes series"> Mes séries </a></li>
                <li><a href="" title="Mes recommandations"> Mes recommandations</a></li>
                <li><a href="deconnexion.php" title="Se deconnecter"> Se deconnecter </a></li>
                <!-- Uniquement lorsque l'utilisateur est connecté à son compte -->
            </ul>
        </div>
        <?php 
			};
		?>
		<div id="recap">
        	<h3>Récapitulatif</h3>
            <?php
				$id_user = idUsers();
				$chaine = "SELECT * FROM usersepisodes WHERE user_id = '$id_user'";
				$req = $bdd->query($chaine);
				$series = $req->rowCount();
				$tps = $series*2727;
				$temps = $tps % 3600;
				$h = ( $tps - $temps ) / 3600 ;
				$s = $temps % 60 ;
				$m = ( $temps - $s ) / 60;
				echo "<h4>Tu as passé ".$h." heures, ".$m." minutes et ".$s." secondes devant ton ordinateur. <br> Félicitations !";
			?>
            <img src="images/podium.png">
        </div>
        <div id="recapserie">
        	<h3>Vos séries regardées</h3>
            <?php
				$chaine = "SELECT series.name, series.poster_path FROM usersepisodes, series, seasonsepisodes, seriesseasons WHERE usersepisodes.user_id = '$id_user' AND usersepisodes.episode_id = seasonsepisodes.episode_id AND seasonsepisodes.season_id = seriesseasons.season_id AND seriesseasons.series_id = series.id ORDER BY series.name";
				$req = $bdd->query($chaine);
				$serie = "";
				while ($res = $req->fetch()) {
					if ($serie != $res[0]) {
						echo "<div class='step'>";
						echo "<h4>".$res[0]."</h4>";
						$serie = $res[0];
						$chaine2 = "SELECT episodes.name, episodes.number, seriesseasons.season_id FROM series, seriesseasons, seasonsepisodes, episodes WHERE series.id = seriesseasons.series_id AND seriesseasons.season_id = seasonsepisodes.season_id AND seasonsepisodes.episode_id = episodes.id AND series.name = '$res[0]'";
						$req2 = $bdd->query($chaine2);
						$comparesaison = -1;
						$saison = 0;														
						while ($res2 = $req2->fetch()) {
							if ($res2[2] != $comparesaison) {
								$comparesaison = $res2[2];
								$saison++;
								echo "<div class='numsaison'> Saison n°".$saison;
							}
							echo "<p class='nomepisode'>Episode n°".$res2[1]." : ".$res2[0]."</p>";
						}
						echo "</div>";
					}
				}
			?>
        </div>
        <footer>
            </div>
            <?php
            	if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
			?>
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="">Connexion</a></li>
                    <li><a href="">Inscription</a></li>
				</ul>
			</div>
            <?php 
				} else {
			?>
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="">Mon compte</a></li>
                    <li><a href="" class="current">Mes séries</a></li>
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
</html>
