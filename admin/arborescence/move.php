<?php
include("../verif.php");
include("../includes/php_open.php");


$id_soustheme=$_GET['id_soustheme'];
$move=$_GET['move'];


$sql1 = "SELECT * FROM sous_thematique  WHERE id_soustheme='$id_soustheme'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$a_requete=mysql_fetch_array($req1);
$id_parent=$a_requete["thematique_id_theme"];
$position_menurub=$a_requete["ordre_soustheme"];

$sql2 = "SELECT * FROM sous_thematique WHERE thematique_id_theme='$id_parent'";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
$num_req2=mysql_num_rows($req2);

$num_plus=$num_req2+1;
$position_menurub_plus=$position_menurub+1;
$position_menurub_moins=$position_menurub-1;

$sql3 = "UPDATE sous_thematique SET ordre_soustheme='$num_plus' WHERE id_soustheme ='$id_soustheme'"; 
$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error()); 



if($move == "up")
	{
		
$sql6 = "UPDATE sous_thematique SET ordre_soustheme='$position_menurub' WHERE ordre_soustheme ='$position_menurub_moins' AND thematique_id_theme='$id_parent'"; 
$req6 = mysql_query($sql6) or die('Erreur SQL !<br />'.$sql6.'<br />'.mysql_error()); 

$sql7 = "UPDATE sous_thematique SET ordre_soustheme='$position_menurub_moins' WHERE id_soustheme ='$id_soustheme'"; 
$req7 = mysql_query($sql7) or die('Erreur SQL !<br />'.$sql7.'<br />'.mysql_error()); 
	
	} 
		else{	
	/*	echo $position_menurub_plus;*/

$sql4 = "UPDATE sous_thematique SET ordre_soustheme='$position_menurub' WHERE ordre_soustheme ='$position_menurub_plus' AND thematique_id_theme='$id_parent'"; 
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 

$sql5 = "UPDATE sous_thematique SET ordre_soustheme='$position_menurub_plus' WHERE id_soustheme ='$id_soustheme'"; 
$req5 = mysql_query($sql5) or die('Erreur SQL !<br />'.$sql5.'<br />'.mysql_error()); 
			}




Header("Location:index.php");
include("../includes/php_close.php");
?>
