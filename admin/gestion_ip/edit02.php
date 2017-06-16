<?php
include("../verif.php");
include("../includes/php_open.php");

$id_ip_autorisee=$_REQUEST['id_ip_autorisee'];
$ip_ip_autorisee=addslashes($_REQUEST['ip_ip_autorisee']);
$description_ip_autorisee=addslashes($_REQUEST['description_ip_autorisee']);


$sql1 = "UPDATE ip_autorisee SET ip_ip_autorisee='$ip_ip_autorisee',description_ip_autorisee='$description_ip_autorisee' WHERE id_ip_autorisee ='$id_ip_autorisee'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());

Header("Location:index.php");
include("../includes/php_close.php");
?>