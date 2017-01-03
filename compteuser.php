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
                <li><a href="compteuser.php" class="current" title="Mon compte"> Mon Compte </a></li>
                <li><a href="userseries.php" title="Mes series"> Mes séries </a></li>
                <li><a href="" title="Mes recommandations"> Mes recommandations</a></li>
                <li><a href="deconnexion.php" title="Se deconnecter"> Se deconnecter </a></li>
                <!-- Uniquement lorsque l'utilisateur est connecté à son compte -->
            </ul>
        </div>

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
        
        <footer>
        
            <div class="content">
				<ul class="links">
					<li><a href="series_tv.php">Accueil</a></li>
                    <li><a href="compteuser.php" class="current">Mon compte</a></li>
                    <li><a href="userseries.php">Mes séries</a></li>
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
