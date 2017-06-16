<?php
include("../verif.php");
include("../includes/php_open.php");

$id_carte=$_REQUEST['id_carte'];

$sql1 = "DELETE FROM carte_has_tags WHERE id_carte ='$id_carte'"; 
 $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
 
 $sql2 = "DELETE FROM carte_has_thematique WHERE id_carte ='$id_carte'"; 
 $req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
 
 $sql3 = "DELETE FROM carte_has_format WHERE id_carte ='$id_carte'"; 
 $req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());

 $sql4 = "DELETE FROM carte WHERE id_carte ='$id_carte'"; 
 $req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 

$destination="/var/www/cartes/cartes/$id_carte/";
 
rrmdir($destination); 
  
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
}   
  
  
  
include("../include/php_close.php");
Header("Location:index.php");

?>
