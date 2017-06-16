<?php
include("../verif.php");
include("../includes/php_open.php");

$id_theme=$_REQUEST['id_theme'];
$id_theme2 = explode("_", $id_theme);

if($id_theme2[0]=="sst"){

//tu prends la position de ton sosu theme et le parent
$sql1 = "SELECT * FROM sous_thematique WHERE id_soustheme='$id_theme2[1]'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$a_requete=mysql_fetch_array($req1);
$thematique_id_theme=$a_requete["thematique_id_theme"];
$position_menurub=$a_requete["ordre_soustheme"];

// tu selectionne tous ceux qui sont au dessus
$sql2 = "SELECT * FROM sous_thematique WHERE ordre_soustheme>'$position_menurub' ORDER BY ordre_soustheme ASC";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
$num_req2=mysql_num_rows($req2);


for ($i=0; $i<= $num_req2; $i++) { 
		
$a_requete2=mysql_fetch_array ($req2);

$id_soustheme=$a_requete2["id_soustheme"];
$ordre_soustheme=$a_requete2["ordre_soustheme"];

$position_menurub_moins=$ordre_soustheme-1;
				 
$sql3 = "UPDATE sous_thematique SET ordre_soustheme='$position_menurub_moins' WHERE id_soustheme ='$id_soustheme' AND thematique_id_theme ='$thematique_id_theme'"; 
$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());

}
	

 $sql4 = "DELETE FROM sous_thematique WHERE id_soustheme ='$id_theme2[1]'"; 
 $req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
 
 // Supprime la table de liaisons
 $sql5 = "DELETE FROM carte_has_thematique WHERE id_sousthematique ='$id_theme2[1]'"; 
 $req5 = mysql_query($sql5) or die('Erreur SQL !<br />'.$sql5.'<br />'.mysql_error());
 
 
 }
 
include("../include/php_close.php");
Header("Location:index.php");

?>
