<?php
include("../verif.php");
include("../includes/php_open.php");

$nom_tags=addslashes(mysql_real_escape_string(trim($_POST['titre'])));

$sql2="INSERT INTO tags VALUES ('','$nom_tags','')";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());	
		

include("../includes/php_close.php");
Header("Location:index.php");

?>