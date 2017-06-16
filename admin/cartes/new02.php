<?php
include("../verif.php");
include("../includes/php_open.php");

$rubrique=$_POST['rubrique'];
$rubrique = explode("-", $rubrique );


$date_creation=$_POST['date'];
/*$date = explode("/", $date );
$date ="$date[2]-$date[1]-$date[0]";
$heure_live="00:00:00";
$date_creation="$date $heure_live";*/
$date_jour=date('Y-m-d H:i:s');


$titre=addslashes(mysql_real_escape_string($_POST['titre']));
$version="1";
$prestation=addslashes(mysql_real_escape_string($_POST['prestation']));

$description = htmlspecialchars($_POST['description']); 
$description = addslashes($description);
$description = nl2br($description);

$commentaire = htmlspecialchars($_POST['commentaire']); 
$commentaire = addslashes($commentaire);
$commentaire = nl2br($commentaire);

$etat_carte=2;


$sql1="INSERT INTO carte VALUES ('','$titre','$description','$version','$date_creation','$date_jour','$etat_carte','$commentaire','','$prestation')";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
$id=mysql_insert_id();

$sql2="INSERT INTO carte_has_thematique VALUES ('$id','$rubrique[0]','$rubrique[1]')";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

$tag1=addslashes(mysql_real_escape_string(trim($_POST['tag1'])));add_tag($tag1,$id);
$tag2=addslashes(mysql_real_escape_string(trim($_POST['tag2'])));add_tag($tag2,$id);
$tag3=addslashes(mysql_real_escape_string(trim($_POST['tag3'])));add_tag($tag3,$id);
$tag4=addslashes(mysql_real_escape_string(trim($_POST['tag4'])));add_tag($tag4,$id);
$tag5=addslashes(mysql_real_escape_string(trim($_POST['tag5'])));add_tag($tag5,$id);
$tag6=addslashes(mysql_real_escape_string(trim($_POST['tag6'])));add_tag($tag6,$id);
$tag7=addslashes(mysql_real_escape_string(trim($_POST['tag7'])));add_tag($tag7,$id);
$tag8=addslashes(mysql_real_escape_string(trim($_POST['tag8'])));add_tag($tag8,$id);
$tag9=addslashes(mysql_real_escape_string(trim($_POST['tag9'])));add_tag($tag9,$id);
$tag10=addslashes(mysql_real_escape_string(trim($_POST['tag10'])));add_tag($tag10,$id);


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
Header("Location:new03.php?id=$id");

?>