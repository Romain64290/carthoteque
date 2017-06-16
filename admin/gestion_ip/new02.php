<?php
include("../verif.php");
include("../includes/php_open.php");

$description=addslashes(mysql_real_escape_string(trim($_POST['description_ip_adresse'])));
$ip_adresse=addslashes(mysql_real_escape_string(trim($_POST['ip_adresse'])));

$sql2="INSERT INTO ip_autorisee VALUES('','$ip_adresse','$description')";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());	
		
include("../includes/php_close.php");
Header("Location:index.php");
?>