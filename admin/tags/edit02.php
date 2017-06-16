<?php
include("../verif.php");
include("../includes/php_open.php");

$id_tags=$_REQUEST['id_tags'];

$nom_tag=addslashes($_REQUEST['titre']);


$sql1 = "UPDATE tags SET nom_tag='$nom_tag' WHERE id_tags ='$id_tags'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());

Header("Location:index.php");
include("../includes/php_close.php");
?>