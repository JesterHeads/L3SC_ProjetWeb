<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
  <charset="UTF-8" />
  <link rel="stylesheet" href="css/login.css"/>
</head>
<body>
  <div id="global">
    <div class="panel">
      <?php
		
		//On ouvre la bdd
		require('base.php');
		
		//prend en paramètre le pseudo & le mdp pour se connecter
		if (isset($_POST['identifier1']) && isset($_POST['password1'])) {
			$boolUserName = checkUserName($bdd, $_POST['identifier1']);
			if (!$boolUserName) {
				$boolPassword = checkPassword($bdd, $_POST['identifier1'], $_POST['password1']);
				if ($boolPassword) {
					session_start();
					$_SESSION['user'] = $_POST['identifier1'];
					echo "<p> Bonjour ".$_SESSION['user']." ! </p>";
					header("refresh:5;URL=series_tv.php");
		  			exit();
				} else {
					echo "<p class=\"error\">Il y a une erreur dans votre mot de passe.</p>";
					echo "<p><a href='series_tv.php'>Retour vers la page d\'accueil..</a></p>";
					echo "<p><a href='connexion.html'>Réessayer..</a></p>";
				}
			} else {
				echo "<p class=\"error\">Ce login n'est pas connu.</p>";
				echo "<p><a href='series_tv.php'>Retour vers la page d\'accueil..</a></p>";
				echo "<p><a href='connexion.html'>Réessayer..</a></p>";
			}
		} else {
			echo "<p class=\"error\">Veuillez remplir tous les champs.</p>";
			echo "<p><a href='series_tv.php'>Retour vers la page d\'accueil..</a></p>";
			echo "<p><a href='connexion.html'>Réessayer..</a></p>";
		}
      ?>
    </div>
  </div>
</body>
</html>

<!-- PHP functions -->
<?php
  
  /**
   * Check the availability of a user name.
   */
  function checkUserName($bdd, $username){
    $query = "SELECT COUNT(*) AS count FROM users WHERE name=:username";
    $statement = $bdd->prepare($query);
    $statement->bindValue(":username", $username, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row["count"] == "0";
  }
  
  //on regarde si le password est identique à celui de la base de donnée
  function checkPassword($bdd, $username, $password){
	global $bdd;
	//on récupére le mot de passe de la bdd
	$chaine = "SELECT password FROM users WHERE name = '$username'";
	$req = $bdd->query($chaine);
	$data = $req->fetch();
	//on compare avec le mdp de la bdd
	if ($password == $data['password']) {
		return true;
	} else {
		return false;
	}
  }

?>