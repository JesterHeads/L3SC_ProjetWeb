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
		<div id="content">
        	<?php
			//usersepisodes -> id
			//episodes -> number, name
			//seasonsepisodes -> episode_id; season_id
			//seriesseasons -> season_id; series_id
			//series -> id, name
				$chaine = "SELECT * FROM series ORDER BY rand()";
				$req = $bdd->query($chaine);
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
    </body>
</html>
