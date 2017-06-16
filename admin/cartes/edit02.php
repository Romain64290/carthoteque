<?php
include("../verif.php");
include("../includes/php_open.php");

$id_carte=$_POST['id_carte'];

$rubrique=$_POST['rubrique'];
$rubrique = explode("-", $rubrique );


$date_creation=$_POST['date'];
/*$date = explode("/", $date );
$date ="$date[2]-$date[1]-$date[0]";
$heure_live="00:00:00";
$date_creation="$date $heure_live";*/

//$date_jour=date('Y-m-d H:i:s');


$titre=addslashes(mysql_real_escape_string($_POST['titre']));
//$version=addslashes(mysql_real_escape_string($_POST['version']));
$prestation=addslashes(mysql_real_escape_string($_POST['prestation']));

$description = htmlspecialchars($_POST['description']); 
$description = addslashes($description);
$description = nl2br($description);

$commentaire = htmlspecialchars($_POST['commentaire']); 
$commentaire = addslashes($commentaire);
$commentaire = nl2br($commentaire);

$sql1="UPDATE carte SET nom_carte='$titre',description_carte='$description',creation_carte='$date_creation',commentaires_carte='$commentaire',prestation_carte='$prestation' WHERE id_carte=$id_carte";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());

$sql2="UPDATE carte_has_thematique SET id_thematique=$rubrique[0],id_sousthematique=$rubrique[1] WHERE id_carte=$id_carte";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

//supprimer les tags puis les remettre
$sql3="DELETE FROM carte_has_tags WHERE id_carte=$id_carte";
$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());

$tag1=addslashes(mysql_real_escape_string(trim($_POST['tag1'])));add_tag($tag1,$id_carte);
$tag2=addslashes(mysql_real_escape_string(trim($_POST['tag2'])));add_tag($tag2,$id_carte);
$tag3=addslashes(mysql_real_escape_string(trim($_POST['tag3'])));add_tag($tag3,$id_carte);
$tag4=addslashes(mysql_real_escape_string(trim($_POST['tag4'])));add_tag($tag4,$id_carte);
$tag5=addslashes(mysql_real_escape_string(trim($_POST['tag5'])));add_tag($tag5,$id_carte);
$tag6=addslashes(mysql_real_escape_string(trim($_POST['tag6'])));add_tag($tag6,$id_carte);
$tag7=addslashes(mysql_real_escape_string(trim($_POST['tag7'])));add_tag($tag7,$id_carte);
$tag8=addslashes(mysql_real_escape_string(trim($_POST['tag8'])));add_tag($tag8,$id_carte);
$tag9=addslashes(mysql_real_escape_string(trim($_POST['tag9'])));add_tag($tag9,$id_carte);
$tag10=addslashes(mysql_real_escape_string(trim($_POST['tag10'])));add_tag($tag10,$id_carte);



function add_tag($arg_1,$id)
{
    if ($arg_1<>"") 
    	{
 $sql = "SELECT * FROM tags WHERE nom_tag LIKE '$arg_1'";
 $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
 $num_req=mysql_num_rows($req);		
 		if ($num_req==0) {
 			$sql3="INSERT INTO tags VALUES ('','$arg_1','')";
			$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());
			$id3=mysql_insert_id();
 		}
 		else{
 		$a_requete=mysql_fetch_array($req);
		$id3=$a_requete["id_tags"];


 		}
 		$sql3="INSERT INTO carte_has_tags VALUES ('$id','$id3')";
		$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());	
	    }
}

include("../includes/php_close.php");
Header("Location:edit03.php?id_carte=$id_carte");

?>