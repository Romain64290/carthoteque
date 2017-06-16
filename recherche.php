
<?php
include("admin/includes/php_open.php");
include("admin/verif_ip.php");

if(isset($_REQUEST['tag'])){	
$tag=$_REQUEST['tag'];

// mise a jour des stats de tag
$sql_update = "UPDATE tags SET hits_tag=hits_tag+1 WHERE id_tags =$tag"; 
$req_update = mysql_query($sql_update) or die('Erreur SQL !<br />'.$sql_update.'<br />'.mysql_error());


$sql = "SELECT * FROM carte INNER JOIN carte_has_tags ON carte_has_tags.id_tags=$tag AND carte_has_tags.id_carte=carte.id_carte
WHERE carte.etat_carte < 2  ORDER BY carte.id_carte DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
$num_req=mysql_num_rows($req);

// Recherche du nom_tag pour affichage du resultat recherche
$sql2 = "SELECT * FROM tags WHERE id_tags =$tag";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
$a_req2=mysql_fetch_array ($req2);
$resultat=stripslashes($a_req2["nom_tag"]);
}

if(isset($_REQUEST['id_ssmenu'])){	
$id_ssmenu=$_REQUEST['id_ssmenu'];
$sql ="SELECT * FROM carte INNER JOIN carte_has_thematique ON carte_has_thematique.id_sousthematique=$id_ssmenu AND carte_has_thematique.id_carte=carte.id_carte 
	   WHERE carte.etat_carte < 2  ORDER BY carte.id_carte DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
$num_req=mysql_num_rows($req);

// Recherche du nom_ssmenu pour affichage du resultat recherche
$sql2 = "SELECT * FROM sous_thematique WHERE id_soustheme =$id_ssmenu";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
$a_req2=mysql_fetch_array ($req2);
$resultat=stripslashes($a_req2["nom_soustheme"]);

}

if(isset($_REQUEST['recherche'])){
$search=$_REQUEST['recherche'];

// Update du tag si besoin.
$sql_update = "UPDATE tags SET hits_tag=hits_tag+1 WHERE nom_tag LIKE '$search'"; 
$req_update = mysql_query($sql_update) or die('Erreur SQL !<br />'.$sql_update.'<br />'.mysql_error());

/*
$sql="SELECT * FROM carte_has_tags INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
WHERE ((tags.nom_tag LIKE '%".$search."%') AND carte.etat_carte < 2) OR ((carte.nom_carte LIKE '%".$search."%' OR carte.description_carte LIKE '%".$search."%') AND carte.etat_carte < 2) 
GROUP BY carte.id_carte
ORDER BY carte.id_carte DESC";*/

$sql="(SELECT carte.id_carte,carte.nom_carte FROM carte_has_tags INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
WHERE ((tags.nom_tag LIKE '%".$search."%') AND carte.etat_carte < 2))
UNION
(SELECT carte.id_carte,carte.nom_carte FROM carte 
WHERE ((carte.nom_carte LIKE '%".$search."%') AND carte.etat_carte < 2)) 
ORDER BY id_carte DESC";


$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
$num_req=mysql_num_rows($req);

$resultat=$search;
}



?>

<!DOCTYPE html>
  <html>
     <head>
     	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
<script src="admin/includes/js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
<script src="admin/includes/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
<link rel="stylesheet" href="admin/includes/js/jquery-ui-1.11.4.custom/jquery-ui.css">
<script type="text/javascript" src="js/materialize.min.js"></script>
	
<script> $(function() { var cache = {};$( "#recherche" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
 
      
<style type="text/css">
  html {font-family: GillSans, Calibri, Trebuchet, sans-serif; }
 </style>
 
 <title>Cartothèque SIGOT - Résultats recherche</title>

    
 
 </head>
    <body>
     
<div class="container">
		<div class="row">
			<div class="col s12 m9 l8"><p>
				<h2><i class="material-icons left"><a href="index.php">home</a></i>Cartothèque</h2>
			</div>
			<div class="input-field col m3 l4">
				
				<form action="recherche.php" method="post" name="form" >
          <input id="recherche" name="recherche" type="text" >
          <label for="recherche">Recherche</label><a href="#" onclick="document.form.submit();"><i class="material-icons prefix">search</i></a>
         </form>
				
				
			</div>
		</div>
		
	Résultat(s) pour la recherche : <b><?php echo $resultat; ?></b> 
<!-- Résultat recherche à metre en boucle-->		
<ul class="collection">
	
	
	<?php
	if($num_req==0){echo "Désolé, il n'y a pas de résultats à votre recherche.";}
		else{
				
				
			while($a_req=mysql_fetch_array ($req))
				{	
				$id_carte=$a_req["id_carte"];
				$nom_carte=stripslashes($a_req["nom_carte"]);
				
				$sql_thematique = "SELECT * FROM carte_has_thematique,thematique,sous_thematique WHERE carte_has_thematique.id_carte ='".$id_carte."' AND carte_has_thematique.id_thematique = thematique.id_theme AND carte_has_thematique.id_sousthematique = sous_thematique.id_soustheme"; 
				$req_thematique = mysql_query($sql_thematique) or die('Erreur SQL !<br />'.$sql_thematique.'<br />'.mysql_error()); 
 				$thema_requete=mysql_fetch_array($req_thematique);
				$nom_theme=stripslashes($thema_requete["nom_theme"]);
				$nom_soustheme=stripslashes($thema_requete["nom_soustheme"]);
				$id_thematique=stripslashes($thema_requete["id_thematique"]);
				
				echo"
    			<li class=\"collection-item avatar\">
      			<a href=\"fiche_detaillee.php?id_carte=$id_carte\" class=\"collection-item\"><i class=\"material-icons circle red\">";
      			
    switch ($id_thematique) {
    case 1:
        echo "business";
        break;
    case 2:
        echo "directions_walk";
        break;
    case 3:
        echo "nature_people";
        break;
	case 4:
        echo "store";
        break;
	case 5:
        echo "share";
        break;	
	case 6:
        echo "people";
        break;
	case 7:
        echo "map";
        break;
};
      			
      			
      			echo"</i><div class=\"right\">
	  			<!-- Image en petit 135x90 pixels -->
	  			<img src=\"cartes/$id_carte/$id_carte"."_vignette_p.jpg\"></div>
      			<span class=\"title black-text\"><b> $nom_carte</b></span><br>
      			<span class=\"grey-text text-darken-2\">Thématique : $nom_theme<br>
      			Sous-Thématique : $nom_soustheme</span><br>
	  			<span class=\"grey-text text-darken-1\">Mots clés :";
		
						$sql_tag = "SELECT * FROM tags,carte_has_tags WHERE carte_has_tags.id_carte='".$id_carte."' AND carte_has_tags.id_tags = tags.id_tags ORDER BY nom_tag"; 
						$req_tag = mysql_query($sql_tag) or die('Erreur SQL !<br />'.$sql_tag.'<br />'.mysql_error()); 
					  			
	  					while($tag_requete=mysql_fetch_array($req_tag))
						{	
	  					$nom_tag=stripslashes($tag_requete["nom_tag"]);
						echo " $nom_tag - ";
						}
				
	  			
	  			 echo"
	  			 </span>
	  			</a>
				</li>";
				}
			
}
?>



		  </ul>
		</div>
</div>

<div  align="center"><br><FONT size="2pt">Réalisé par le service Développement et innovation des outils et pratiques numériques - 2015</FONT></div>
    </body>
</html>



<?php
include("admin/includes/php_close.php");
?>