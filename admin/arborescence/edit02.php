<?php
include("../verif.php");
include("../includes/php_open.php");

$id_theme=$_REQUEST['id_theme'];
$id_theme2 = explode("_", $id_theme);

$nom_theme=addslashes(mysql_real_escape_string($_REQUEST['titre']));


if($id_theme2[0]=="t"){$sql1 = "UPDATE thematique SET nom_theme='$nom_theme' WHERE id_theme ='$id_theme2[1]'";}
else{$sql1 = "UPDATE sous_thematique SET nom_soustheme='$nom_theme' WHERE id_soustheme ='$id_theme2[1]'";}

$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());

Header("Location:index.php");
include("../includes/php_close.php");
?>