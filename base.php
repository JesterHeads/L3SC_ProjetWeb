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
	ini_set('memory_limit', '1024M');
    ini_set('post_max_size', '1024M');
    ini_set('upload_max_filesize', '1024M');
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>