<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  <charset="UTF-8" />
  <link rel="stylesheet" href="css/login.css"/>
</head>
<body>
  <div id="global">
    <div class="panel">
      <?php
		
		//On ouvre la bdd
		require('base.php');
		
		// A boolean for the validity of the user input
        $valid = true;

        // The message to display
        $message = "";
  
        // Check the user name
        if (!isset($_POST['identifier1']) || strlen($_POST['identifier1']) < 4){
          $valid = false;
          $message .= '<p class="error">Le nom d\'utilisateur est trop court.</p>';
        }
        else{
          $username = $_POST['identifier1'];  
        }
  
        // Check the password
        if (!isset($_POST['password1']) || strlen($_POST['password1']) < 8){
          $valid = false;
          $message .= '<p class="error">Le mot de passe est trop court.</p>';
        }
        else{
          $password = $_POST['password1'];
	
          // Check the password confirmation
          if (!isset($_POST['password2']) || $_POST['password2'] != $password){
            $valid = false;
            $message .= '<p class="error">Le mot de passe et sa confirmation ne sont pas identiques.</p>';
          }
        }
  
        // Check the email
        if (!isset($_POST['email']) || !contains('@', $_POST['email']) || !contains('.', $_POST['email'])){
          $valid = false;
          $message .= '<p class="error">L\'email entré est invalide.</p>';
        }
        else{
          $email = $_POST['email'];
        }

        // Check the availability of the user name
        if ($valid){
          $available = checkUserName($bdd, $username);
          if (!$available){
            $valid = false;
            $message .= '<p class="error">Le nom d\'utilisateur '.$username.' est déjà pris.</p>';
          }
        }

        // If everything is good, add the user
        if ($valid){
          echo "<p>Les champs ont été validés par le serveur.<p/>";
	
          // Add the user to the database
          $userOK = addUser($bdd, $username, $email, $password);
		  
    	  //Open and initialize the session
	  	  session_start();
		  $_SESSION['user']=$username;
		  header("refresh:5;URL=series_tv.php");
		  exit();
        }
  
        // If at least one criterion was not respected, display error messages
        else{
          echo "<p class=\"error\">L'inscription n'a pas pu être réalisée pour les raisons suivantes :</p>";
          echo $message;
          echo '<p><a href="series_tv.php">Retour vers la page d\'accueil..</a></p>';
		  echo "<p><a href='inscription.html'>Réessayer..</a></p>";
        }
      ?>
    </div>
  </div>
</body>
</html>

<!-- PHP functions -->
<?php
  /**
   * Test if a character $c is in a string $s.
   */
  function contains($c, $s){
    for ($i = 0; $i < strlen($s); $i++){
  	  if ($s[$i] == $c){
        return true;
	    }
    }
    return false;
  }
  
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

  /**
   * Put a user in the user table.
   */
  function addUser($bdd, $username, $email, $password){
    $query = "INSERT INTO users (name, email, password) VALUES (:username, :email, :password)";
    $statement = $bdd->prepare($query);
    $statement->bindValue(":username", $username, PDO::PARAM_STR);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->bindValue(":password", $password, PDO::PARAM_STR);
    $OK = $statement->execute();
    return $OK;
  }

?>