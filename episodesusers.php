<?php	 
	//On ouvre la bdd
	require('base.php');
	
	//Démarrage ou restauration de la session
	session_start();
			
	$idepisode = $_GET['idepisode']; 	// On récupère l'id de l'épisode
	
	addEpisode($idepisode); // que l'on ajoute à la table usersepisodes
	
	function idUsers() {
		global $bdd;
		$id = $_SESSION['user'];
		$chaine = "SELECT * FROM users WHERE name = '$id'";
		$req = $bdd->query($chaine);
		$res = $req->fetch();
		return $res[0];
	}
	
	//Fonction qui fait l'ajout
	function addEpisode($idepisode){ 
		global $bdd;
		$chaine = "INSERT INTO usersepisodes (user_id, episode_id, rating) VALUES (:user_id, :episode_id, :rating)";
    	$statement = $bdd->prepare($chaine);
		$id = idUsers();
    	$statement->bindValue(':user_id', $id, PDO::PARAM_INT);
    	$statement->bindValue(':episode_id', $idepisode, PDO::PARAM_INT);
    	$statement->bindValue(':rating', NULL, PDO::PARAM_INT);
    	$statement->execute();
		echo "zzzz";
	}
?>