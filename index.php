<?php
include("admin/includes/php_open.php");

/* tracage IP et verification autorisation */

$date_jour=date('Y-m-d H:i:s');

include("admin/verif_ip.php");

$sql1="INSERT INTO visiteur VALUES ('','$ip','$date_jour')";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());

/* Fin - tracage IP et verification autorisation */


/* Les stats */

$sql_nbr = "SELECT id_carte FROM carte";
$req_nbr = mysql_query($sql_nbr) or die('Erreur SQL !<br />'.$sql_nbr.'<br />'.mysql_error()); 
$num_req_nbr=mysql_num_rows($req_nbr);

$sql_hit = "SELECT id_carte,nom_carte FROM carte ORDER BY hit_carte DESC LIMIT 1";
$req_hit = mysql_query($sql_hit) or die('Erreur SQL !<br />'.$sql_hit.'<br />'.mysql_error()); 
$num_req_hit=mysql_fetch_array($req_hit);
$num_req_hit_id=$num_req_hit['id_carte'];
$num_req_hit=stripslashes($num_req_hit['nom_carte']);

$sql_new = "SELECT id_carte,nom_carte FROM carte ORDER BY miseenligne_carte DESC LIMIT 1";
$req_new = mysql_query($sql_new) or die('Erreur SQL !<br />'.$sql_new.'<br />'.mysql_error()); 
$num_req_new=mysql_fetch_array($req_new);
$num_req_new_id=$num_req_new['id_carte'];
$num_req_new=stripslashes($num_req_new['nom_carte']);

/* Fin des stats */

/* Menu d'arborescence niveau 1 */

$sql_menu = "SELECT * FROM thematique	";
$req_menu = mysql_query($sql_menu) or die('Erreur SQL !<br />'.$sql_menu.'<br />'.mysql_error()); 

for ($i=1; $i<=7;$i++) {
$menu_requete=mysql_fetch_array($req_menu);
$menu[$i]=stripslashes($menu_requete["nom_theme"]);

}

/* Fin du menu d'arborescence niveau 1 */

/* Les tags */

$sql_tag = "SELECT * FROM tags ORDER BY hits_tag DESC LIMIT 12";
$req_tag = mysql_query($sql_tag) or die('Erreur SQL !<br />'.$sql_tag.'<br />'.mysql_error()); 

for ($i=1; $i<=12;$i++) {
$tag_requete=mysql_fetch_array($req_tag);
$nom_tag[$i]=stripslashes($tag_requete["nom_tag"]);
$id_tag[$i]=stripslashes($tag_requete["id_tags"]);
}

/* Fin des tags*/



?>

<!DOCTYPE html>
  <html>
     <head>

<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
<!-- <meta http-equiv="X-UA-Compatible" content="IE=9"> -->
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
	  
  html {font-family: GillSans, Calibri, Trebuchet, sans-serif;  }
 </style>
 
  
 <title>Cartothèque SIGOT</title>
 </head>

    <body>

	<!-- Header Titre + Recherche -->
<div class="container">
	<div class="row">
		<div class="col s12 m9 l8"><p>
<h2>Cartothèque</h2>
</div>
 <div class="input-field col m3 l4">
 	<form action="recherche.php" method="post" name="form" >
          <input id="recherche" name="recherche" type="text" class="validate">
          <label for="recherche">Recherche</label><a href="#" onclick="document.form.submit();"><i class="material-icons prefix">search</i></a>
         </form>
        </div>
</div>
<!-- Ligne 1 -->
	<div class="row">
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">business</i><br>
            			<!-- Dropdown Trigger  Ligne 1/Colonne 1 -->
			<a class='dropdown-button btn blue' href='#' data-activates='dropdown1'><?php echo $menu[1]; ?></a>
			 <!-- Dropdown Structure -->
				<ul id='dropdown1' class='dropdown-content'>
					
<?php

$sql_ssmenu1 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=1 ORDER BY ordre_soustheme ASC";
$req_ssmenu1 = mysql_query($sql_ssmenu1) or die('Erreur SQL !<br />'.$sql_ssmenu1.'<br />'.mysql_error()); 
while($ssmenu1_requete=mysql_fetch_array($req_ssmenu1))
{
	
$id_ssmenu1=$ssmenu1_requete["id_soustheme"];		
$nom_ssmenu1=stripslashes($ssmenu1_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu1\">$nom_ssmenu1</a></li>
<li class=\"divider\"></li>";
	
}
?>

				  </ul>
			</p></div>
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">directions_walk</i><br>
					<!-- Dropdown Trigger Ligne 1/Colonne 2-->
					<a class='dropdown-button btn blue lighten-1' href='#' data-activates='dropdown2'><?php echo $menu[2]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown2' class='dropdown-content'>
<?php

$sql_ssmenu2 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=2 ORDER BY ordre_soustheme ASC";
$req_ssmenu2 = mysql_query($sql_ssmenu2) or die('Erreur SQL !<br />'.$sql_ssmenu2.'<br />'.mysql_error()); 
while($ssmenu2_requete=mysql_fetch_array($req_ssmenu2))
{
	
$id_ssmenu2=$ssmenu2_requete["id_soustheme"];		
$nom_ssmenu2=stripslashes($ssmenu2_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu2\">$nom_ssmenu2</a></li>
<li class=\"divider\"></li>";
	
}
?>
	
				  </ul>
			</p></div>
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">nature_people</i><br>
					<!-- Dropdown Trigger Ligne 1/Colonne 3-->
					<a class='dropdown-button btn blue lighten-2' href='#' data-activates='dropdown3'><?php echo $menu[3]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown3' class='dropdown-content'>
					
<?php

$sql_ssmenu3 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=3 ORDER BY ordre_soustheme ASC";
$req_ssmenu3 = mysql_query($sql_ssmenu3) or die('Erreur SQL !<br />'.$sql_ssmenu3.'<br />'.mysql_error()); 
while($ssmenu3_requete=mysql_fetch_array($req_ssmenu3))
{
	
$id_ssmenu3=$ssmenu3_requete["id_soustheme"];		
$nom_ssmenu3=stripslashes($ssmenu3_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu3\">$nom_ssmenu3</a></li>
<li class=\"divider\"></li>";
	
}
?>				
				  </ul>
			</p></div>
	</div>
<!-- Ligne 2 -->			
				<div class="row">
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">store</i><br>
			<!-- Dropdown Trigger Ligne 2/Colonne 1-->
			<a class='dropdown-button btn blue green' href='#' data-activates='dropdown1b'><?php echo $menu[4]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown1b' class='dropdown-content'>
<?php

$sql_ssmenu4 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=4 ORDER BY ordre_soustheme ASC";
$req_ssmenu4 = mysql_query($sql_ssmenu4) or die('Erreur SQL !<br />'.$sql_ssmenu4.'<br />'.mysql_error()); 
while($ssmenu4_requete=mysql_fetch_array($req_ssmenu4))
{
	
$id_ssmenu4=$ssmenu4_requete["id_soustheme"];		
$nom_ssmenu4=stripslashes($ssmenu4_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu4\">$nom_ssmenu4</a></li>
<li class=\"divider\"></li>";
	
}
?>
					
				  </ul>
			</p></div>
					<div class="col s12 m6 l4"><p>
			     <i class="medium material-icons">share</i><br>
					<!-- Dropdown Trigger Ligne 1/Colonne 2-->
					<a class='dropdown-button btn green lighten-1' href='#' data-activates='dropdown2b'><?php echo $menu[5]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown2b' class='dropdown-content'>
					
<?php

$sql_ssmenu5 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=5 ORDER BY ordre_soustheme ASC";
$req_ssmenu5 = mysql_query($sql_ssmenu5) or die('Erreur SQL !<br />'.$sql_ssmenu5.'<br />'.mysql_error()); 
while($ssmenu5_requete=mysql_fetch_array($req_ssmenu5))
{
	
$id_ssmenu5=$ssmenu5_requete["id_soustheme"];		
$nom_ssmenu5=stripslashes($ssmenu5_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu5\">$nom_ssmenu5</a></li>
<li class=\"divider\"></li>";
	
}
?>
				
				  </ul>
			</p>
			</div>
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">people</i><br>
					<!-- Dropdown Trigger Ligne 1/Colonne 3-->
					<a class='dropdown-button btn green lighten-2' href='#' data-activates='dropdown3b'><?php echo $menu[6]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown3b' class='dropdown-content'>
<?php

$sql_ssmenu6 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=6 ORDER BY ordre_soustheme ASC";
$req_ssmenu6 = mysql_query($sql_ssmenu6) or die('Erreur SQL !<br />'.$sql_ssmenu6.'<br />'.mysql_error()); 
while($ssmenu6_requete=mysql_fetch_array($req_ssmenu6))
{
	
$id_ssmenu6=$ssmenu6_requete["id_soustheme"];		
$nom_ssmenu6=stripslashes($ssmenu6_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu6\">$nom_ssmenu6</a></li>
<li class=\"divider\"></li>";
	
}
?>
					
				  </ul>
			</p>
		</div>
	</div>
<!-- Ligne 3 -->
			<div class="row">
		<div class="col s12 m6 l4"><p>
			      <i class="medium material-icons">map</i><br>
            			<!-- Dropdown Trigger Ligne 3/Colonne 1-->
			<a class='dropdown-button btn lime' href='#' data-activates='dropdown1c'><?php echo $menu[7]; ?></a>

			 <!-- Dropdown Structure -->
				<ul id='dropdown1c' class='dropdown-content'>
<?php

$sql_ssmenu7 = "SELECT * FROM sous_thematique WHERE thematique_id_theme=7 ORDER BY ordre_soustheme ASC";
$req_ssmenu7 = mysql_query($sql_ssmenu7) or die('Erreur SQL !<br />'.$sql_ssmenu7.'<br />'.mysql_error()); 
while($ssmenu7_requete=mysql_fetch_array($req_ssmenu7))
{
	
$id_ssmenu7=$ssmenu7_requete["id_soustheme"];		
$nom_ssmenu7=stripslashes($ssmenu7_requete["nom_soustheme"]);		

echo"
<li><a href=\"recherche.php?id_ssmenu=$id_ssmenu7\">$nom_ssmenu7</a></li>
<li class=\"divider\"></li>";
	
}
?>
					
				  </ul>
			</p></div>
			</div>
</div>
			 <!-- Pied de page avec contact et tags -->
		<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col s12 m6 l4">
                <h5>Nous contacter</h5>
			<a href="mailto:sig@agglo-pau.fr" class="waves-effect waves-light btn blue-grey"><i class="small material-icons left">mail</i> sig@agglo-pau.fr</a><br>
			<a class="waves-effect waves-light btn blue-grey"><i class="small material-icons left">perm_phone_msg</i> 05 40 03 83 10</a>
<!-- Statistiques --> 
				<h5>Stats</h5>
                <ul>
					<li><b>Nombre de cartes :</b> <?php echo $num_req_nbr; ?></li>
					<li><b>Carte la plus populaire :</b> <a href="fiche_detaillee.php?id_carte=<?php echo $num_req_hit_id; ?>"><?php echo $num_req_hit; ?></a></li>
					<li><b>Carte la plus récente :</b> <a href="fiche_detaillee.php?id_carte=<?php echo $num_req_new_id; ?>"><?php echo $num_req_new; ?></a></li>
                </ul>   
				</div>
<!-- Tags -->
              <div class="col s12 m6 l8">
		<div class="center-align">
<!-- Tags 1ère ligne -->
				<a href="recherche.php?tag=<?php echo $id_tag[1]; ?>"class="waves-effect waves-light indigo lighten-1 btn-large"><?php echo $nom_tag[1]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[2]; ?>" class="waves-effect waves-light indigo lighten-1 btn-large"><?php echo $nom_tag[2]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[3]; ?>" class="waves-effect waves-light indigo lighten-1 btn-large"><?php echo $nom_tag[3]; ?></a><br>
<!-- Tags 2ème ligne -->
				<a href="recherche.php?tag=<?php echo $id_tag[4]; ?>" class="waves-effect waves-light indigo lighten-2 btn"><?php echo $nom_tag[4]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[5]; ?>" class="waves-effect waves-light indigo lighten-2 btn"><?php echo $nom_tag[5]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[6]; ?>" class="waves-effect waves-light indigo lighten-2 btn"><?php echo $nom_tag[6]; ?></a><br>
<!-- Tags 3ème ligne -->				
				<a href="recherche.php?tag=<?php echo $id_tag[7]; ?>" class="waves-effect waves-light indigo lighten-3 btn"><?php echo $nom_tag[7]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[8]; ?>" class="waves-effect waves-light indigo lighten-3 btn"><?php echo $nom_tag[8]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[9]; ?>" class="waves-effect waves-light indigo lighten-3 btn"><?php echo $nom_tag[9]; ?></a><br>
<!-- Tags 4ème ligne -->
				<a href="recherche.php?tag=<?php echo $id_tag[10]; ?>" class="waves-effect waves-light indigo lighten-4 btn"><?php echo $nom_tag[10]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[11]; ?>" class="waves-effect waves-light indigo lighten-4 btn"><?php echo $nom_tag[11]; ?></a>
				<a href="recherche.php?tag=<?php echo $id_tag[12]; ?>" class="waves-effect waves-light indigo lighten-4 btn"><?php echo $nom_tag[12]; ?></a>
		</div>
              </div>
            </div>
          </div>
          
              
        </footer>
        <div  align="center"><br><FONT size="2pt">Réalisé par le service Développement et innovation des outils et pratiques numériques - 2015</FONT></div>
         </body>
 </html>
   
  <script type="text/javascript"> 
     $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false // Displays dropdown below the button
    }
  );
  </script>
  

<?php
include("admin/includes/php_close.php");
?>
