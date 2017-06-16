<?php
include("../verif.php");
include("../includes/php_open.php");

$id_tags=$_REQUEST['id_tags'];

 $sql5 = "DELETE FROM carte_has_tags WHERE id_tags ='$id_tags'"; 
 $req5 = mysql_query($sql5) or die('Erreur SQL !<br />'.$sql5.'<br />'.mysql_error());

 $sql4 = "DELETE FROM tags WHERE id_tags ='$id_tags'"; 
 $req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
 
 
  
include("../include/php_close.php");
Header("Location:index.php");

?>
