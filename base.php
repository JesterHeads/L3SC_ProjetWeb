<?php
  // URL of the host
  $dbhost = "localhost"; 
  
  // Name of the database
  $dbname = "project";
  
  // User name
  $dbuser = "root";
  
  // Password (not used here)
  $dbpass = "";
 
  try {
    $bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>