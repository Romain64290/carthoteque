<?php

include("includes/php_open.php"); 

// on teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) { 
 
       
      // on teste si une entrée de la base contient ce couple login / pass
     $sql = 'SELECT count(*) FROM carto_session WHERE login_session="'.$_POST['login'].'" AND motdepasse_session="'.($_POST['pwd']).'"'; 
	 $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
	  $data = mysql_fetch_array($req); 
      
       
      // si on obtient une réponse, alors l'utilisateur est un membre
      if ($data[0] == 1) { 
         session_start(); 
         $_SESSION['login'] = $_POST['login']; 
		  $_SESSION['pwd'] = $_POST['pwd']; 
          header ('location: cartes/index.php'); 
         exit(); 
      } 
       else { 
        echo '<body onLoad="alert(\'Veuillez utilisez un identifiant et un mot de passe valide pour accéder à l administration.\')">'; 
             // puis on le redirige vers la page d'accueil
             echo '<meta http-equiv="refresh" content="0;URL=index.php">'; 
      } }
      // sinon, alors la, il y a un gros problème :)
      else { 
         echo 'Les variables du formulaire ne sont pas déclarées.';  
      } 
 
 
include("includes/php_close.php");
?>