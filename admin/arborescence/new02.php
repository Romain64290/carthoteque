<?php
include("../verif.php");
include("../includes/php_open.php");

$nom_soustheme=addslashes(trim($_POST['titre']));
$thematique_id_theme=$_POST['rubrique'];


$sql1 = "SELECT * FROM sous_thematique WHERE thematique_id_theme='$thematique_id_theme'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$num_req1=mysql_num_rows($req1);

$position_menurub=$num_req1+1;

$sql2="INSERT INTO sous_thematique VALUES ('','$nom_soustheme','$thematique_id_theme','$position_menurub')";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());	
		

include("../includes/php_close.php");
Header("Location:index.php");

?>