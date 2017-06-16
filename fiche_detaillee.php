
<?php
include("admin/includes/php_open.php");
include("admin/verif_ip.php");

$id_carte=$_REQUEST['id_carte'];

$sql = "SELECT * FROM carte WHERE id_carte=$id_carte ORDER BY carte.id_carte DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
$a_req=mysql_fetch_array ($req);

$nom_carte=stripslashes($a_req["nom_carte"]);
//$version_carte=stripslashes($a_req["version_carte"]);
$description_carte=stripslashes($a_req["description_carte"]);

$creation_carte=$a_req["creation_carte"];
//$creation_carte=date("d/m/Y", strtotime($creation_carte));

$miseenligne_carte=$a_req["miseenligne_carte"];
$miseenligne_carte=date("d/m/Y", strtotime($miseenligne_carte));


$sql_thematique = "SELECT * FROM carte_has_thematique,thematique,sous_thematique WHERE carte_has_thematique.id_carte ='".$id_carte."' AND carte_has_thematique.id_thematique = thematique.id_theme AND carte_has_thematique.id_sousthematique = sous_thematique.id_soustheme"; 
$req_thematique = mysql_query($sql_thematique) or die('Erreur SQL !<br />'.$sql_thematique.'<br />'.mysql_error()); 
$thema_requete=mysql_fetch_array($req_thematique);
$nom_theme=stripslashes($thema_requete["nom_theme"]);
$nom_soustheme=stripslashes($thema_requete["nom_soustheme"]);
$id_thematique=stripslashes($thema_requete["id_thematique"]);


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
 
 <title>Cartothèque SIGOT - Fiche détaillée carte</title>
 </head>

    <body>
<!-- Header -->
<div class="container">
	<div class="row">
		<div class="col s12 m9 l8"><p>
<h5><i class="material-icons left"><a href="index.php">home</a>
<!-- Categorie et nom de la carte -->
</i><?php echo "$nom_theme >>> $nom_soustheme "; ?></h5>
</div>
<!-- Recherche -->
 <div class="input-field col m3 l4">
         <form action="recherche.php" method="post" name="form" >
          <input id="recherche" name="recherche" type="text" class="validate">
          <label for="recherche">Recherche</label><a href="#" onclick="document.form.submit();"><i class="material-icons prefix">search</i></a>
         </form>
        </div>
</div>
      <div class="row">
        <div class="col s12 m6 l6">
            <div class="card">
            <div class="card-image">
<!-- Lien vers image de la carte -->
              <?php echo"<img src=\"cartes/$id_carte/$id_carte"."_vignette_g.jpg\">";?>
<!-- Nom de la carte -->
              <span class="card-title black-text"><?php echo $nom_carte; ?></span>
            </div>
            
<!-- Description carte --> 
<?php if($description_carte!=""){echo "<div class=\"card-content\"><p>$description_carte</p></div>";}  ?>
            
            <div class="card-action">
			<div class="center-align">
<!-- tags -->
<?php
$sql_tag = "SELECT * FROM tags,carte_has_tags WHERE carte_has_tags.id_carte='".$id_carte."' AND carte_has_tags.id_tags = tags.id_tags ORDER BY nom_tag"; 
$req_tag = mysql_query($sql_tag) or die('Erreur SQL !<br />'.$sql_tag.'<br />'.mysql_error()); 
					  			
	  					while($tag_requete=mysql_fetch_array($req_tag))
						{
						$id_tags=$tag_requete["id_tags"];	
	  					$nom_tag=stripslashes($tag_requete["nom_tag"]);
						echo " <a href=\"recherche.php?tag=$id_tags\">$nom_tag </a> ";
						}

?>
		</div>

            </div>
          </div>
        </div>
          <div class="col s12 m5 l5">
	<i class="material-icons medium  indigo-darken-4-text">

<?php
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
 }

?>
</i>
<!-- Infos et stats -->
			<br><br>
			Date de création : <?php echo $creation_carte; ?><br>
			Date de mise en ligne : <?php echo $miseenligne_carte; ?><br><br>
			<b>Téléchargez la carte en haute définition </b>:
  <div class="collection">

<?php
$sql_format = "SELECT * FROM carte_has_format WHERE id_carte=$id_carte ORDER BY extension_format DESC, type_format ASC"; 
$req_format = mysql_query($sql_format) or die('Erreur SQL !<br />'.$sql_format.'<br />'.mysql_error()); 
					  			
	  					while($format_requete=mysql_fetch_array($req_format))
						{
						$id_format=$format_requete["id_format"];
						$id_carte=$format_requete["id_carte"];	
	  					$type_format=$format_requete["type_format"];	
	  					$extension_format=$format_requete["extension_format"];	
						$poids_carte=$format_requete["poids_carte"]/1024;
						$poids_carte_mo=round($poids_carte/1024, 2);
	  					  			
						echo " <a href=\"download.php?id_carte=$id_carte&type=$type_format&extention=$extension_format\" target=\"_blank\"class=\"collection-item\">Version Format A$type_format ($poids_carte_mo Mo)";
						if($extension_format=="PDF"){echo"<span class=\"badge pink-text text-accent-2\">PDF</span></a> ";}else{echo"<span class=\"badge orange-text text-darken-2\">JPG</span></a>";}
						}
?>
    

    
    
    
    
  </div>
		</div>
</div>
         </footer>
         
         
         <div  align="center"><br><FONT size="2pt">Réalisé par le service Développement et innovation des outils et pratiques numériques - 2015</FONT></div>
             </body>
   </html>
 
 
<?php
include("admin/includes/php_close.php");
?>
