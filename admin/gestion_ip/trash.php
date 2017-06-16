<?php
include("../verif.php");
include("../includes/php_open.php");

$id_ip_autorisee=$_REQUEST['id_ip_autorisee'];


 $sql4 = "DELETE FROM ip_autorisee WHERE id_ip_autorisee ='$id_ip_autorisee'"; 
 $req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
 
 
  
include("../include/php_close.php");
Header("Location:index.php");

?>
