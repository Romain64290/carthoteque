<?php
include("../verif.php");
include("../includes/php_open.php");

if(!isset($_REQUEST['recherche'])){$recherche="";}else{$recherche=$_REQUEST['recherche'];}
if(!isset($_REQUEST['rubrique'])){$rubrique=0;}else{$rubrique=$_REQUEST['rubrique'];}
if(!isset($_REQUEST['page_affichee'])){$page_affichee=1;}else{$page_affichee=$_REQUEST['page_affichee'];}
if(!isset($_REQUEST['orderby'])){$orderby="carte.id_carte DESC";}else{$orderby=$_REQUEST['orderby'];}
if(!isset($_REQUEST['limite_affichage'])){$limite_affichage=20;}else{$limite_affichage=$_REQUEST['limite_affichage'];}

$limite_basse=($page_affichee-1)*$limite_affichage;
$limite="$limite_basse,$limite_affichage"; 

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" id="minwidth" >

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIGOT</title>

<link rel="stylesheet" href="../includes/css/modal.css" type="text/css" />
<link rel="stylesheet" href="../includes/css/menu.css" type="text/css" />
<link rel="stylesheet" href="../includes/css/system.css" type="text/css" />
<link rel="stylesheet" href="../includes/css/template.css"  type="text/css" />
<link rel="stylesheet" href="../includes/css/rounded.css"  type="text/css"/>
<link rel="stylesheet" href="../includes/css/icon.css"  type="text/css" />

 <script src="../includes/js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
 <script src="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
 
 <link rel="stylesheet" href="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.css">

 <script> $(function() { var cache = {};$( "#recherche" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>

</head>

<body id="minwidth-body">
	<div id="border-top" class="h_green">
		<div>
			<div>
				<span class="title">SIGOT</span>
			</div>
		</div>
	</div>
	<div id="header-box">

<div id="module-menu">
<ul id="menu" >
<li><a href="../cartes/index.php"onmouseover="this.style.background='#fcfcfc';this.style.color='#599031';" onMouseOut="this.style.background='#f0f0f0';this.style.color='#333333';"> Les cartes</a></li>
<li><a href="../tags/index.php"onmouseover="this.style.background='#fcfcfc';this.style.color='#599031';" onMouseOut="this.style.background='#f0f0f0';this.style.color='#333333';"> Gestion des mots-clés</a></li>
<li><a href="../arborescence/index.php"onmouseover="this.style.background='#fcfcfc';this.style.color='#599031';" onMouseOut="this.style.background='#f0f0f0';this.style.color='#333333';"> Gestion des thématiques</a></li>
<li><a href="../stats/index.php"onmouseover="this.style.background='#fcfcfc';this.style.color='#599031';" onMouseOut="this.style.background='#f0f0f0';this.style.color='#333333';">Les stats</a></li>
</ul>
</div>

<div class="clr"></div>

        
<?php   


if($recherche=="")
	{
	if($rubrique==0)
	// recherhe="" , rubrique ="" => ok 
		{ $sql = "SELECT * FROM carte WHERE etat_carte < 2 ORDER BY $orderby LIMIT $limite";
		  $sql_num = "SELECT id_carte FROM carte WHERE etat_carte < 2 ORDER BY $orderby";}
			else
			// recherche="", rubrique = x => ok
			    {$sql = "SELECT * FROM carte,carte_has_thematique WHERE carte_has_thematique.id_thematique=$rubrique AND carte_has_thematique.id_carte=carte.id_carte AND carte.etat_carte < 2  ORDER BY $orderby LIMIT $limite";
				$sql_num = "SELECT * FROM carte,carte_has_thematique WHERE carte_has_thematique.id_thematique=$rubrique AND carte_has_thematique.id_carte=carte.id_carte  AND carte.etat_carte < 2  ORDER BY $orderby";}
    } else
			{
			if($rubrique==0)
		{
				// recherche =x, rubrique ="" => ok
			$sql="(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte FROM carte_has_tags INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
					WHERE ((tags.nom_tag LIKE '%".$recherche."%') AND carte.etat_carte < 2))
					UNION
					(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte FROM carte 
					WHERE ((carte.nom_carte LIKE '%".$recherche."%' OR carte.description_carte LIKE '%".$recherche."%') AND carte.etat_carte < 2)) 
					ORDER BY id_carte DESC LIMIT $limite";
								
		 		$sql_num = "(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte FROM carte_has_tags INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
					WHERE ((tags.nom_tag LIKE '%".$recherche."%') AND carte.etat_carte < 2))
					UNION
					(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte FROM carte 
					WHERE ((carte.nom_carte LIKE '%".$recherche."%' OR carte.description_carte LIKE '%".$recherche."%') AND carte.etat_carte < 2)) 
					ORDER BY id_carte DESC";
					
		
		
		}
			else
			    {
			    	// recherche =x, rubrique =x => ok
			    	
			    	$sql="(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte,carte_has_thematique.id_thematique FROM carte_has_tags 
			    	INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
					INNER JOIN carte_has_thematique ON carte_has_thematique.id_carte=carte.id_carte
					WHERE ((tags.nom_tag LIKE '%".$recherche."%') AND carte.etat_carte < 2) AND carte_has_thematique.id_thematique=$rubrique )
					UNION
					(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte,carte_has_thematique.id_thematique FROM carte 
					INNER JOIN carte_has_thematique ON carte_has_thematique.id_carte=carte.id_carte
					WHERE ((carte.nom_carte LIKE '%".$recherche."%' OR carte.description_carte LIKE '%".$recherche."%') AND carte.etat_carte < 2) AND carte_has_thematique.id_thematique=$rubrique) 
					ORDER BY id_carte DESC LIMIT $limite";
								
		 		$sql_num = "(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte,carte_has_thematique.id_thematique FROM carte_has_tags
		 			INNER JOIN carte ON carte_has_tags.id_carte=carte.id_carte INNER JOIN tags ON carte_has_tags.id_tags=tags.id_tags
					INNER JOIN carte_has_thematique ON carte_has_thematique.id_carte=carte.id_carte
					WHERE ((tags.nom_tag LIKE '%".$recherche."%') AND carte.etat_carte < 2) AND carte_has_thematique.id_thematique=$rubrique )
					UNION
					(SELECT carte.id_carte,carte.nom_carte,carte.description_carte,carte.miseenligne_carte,carte.etat_carte,carte_has_thematique.id_thematique FROM carte 
					INNER JOIN carte_has_thematique ON carte_has_thematique.id_carte=carte.id_carte
					WHERE ((carte.nom_carte LIKE '%".$recherche."%' OR carte.description_carte LIKE '%".$recherche."%') AND carte.etat_carte < 2) AND carte_has_thematique.id_thematique=$rubrique) 
					ORDER BY id_carte DESC";
			    	
			
				}
	}
 $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
 $req_num = mysql_query($sql_num) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
  $num_req=mysql_num_rows($req_num);
  
 ?>         
        
</div>
	<div id="content-box">
	<div id="content-box">

		<div class="border">
			<div class="padding">
				<div id="toolbar-box">
   			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">

				<div class="toolbar" id="toolbar">
<table class="toolbar"><tr>

<td class="button" id="toolbar-new">

<a href="new01.php" onClick="" class="toolbar">
<span class="icon-32-new" title="Nouveau">
</span>
Nouveau
</a>
</td>

<td class="button" id="toolbar-edit">
<a href="#" onClick="javascript:submitformulaire('edit')" class="toolbar">
<span class="icon-32-edit" title="Éditer">
</span>
Éditer
</a>
</td>

<td class="button" id="toolbar-trash">
<a href="#"  onClick="javascript:submitformulaire('trash')" class="toolbar">
<span class="icon-32-trash" title="Corbeille">
</span>
Corbeille
</a>
</td>

</tr></table>
</div>

<div class="header icon-48-article"> Les cartes</div>
<div class="clr"></div>
</div>
<div class="b">
<div class="b">
<div class="b"></div></div>
</div></div>
<div class="clr"></div>
<div id="element-box">
<div class="t">
<div class="t">
<div class="t"></div>
</div></div>

			<div class="m">
						<form name="adminForm">

			<table>
				<tr>
					<td width="100%">
						Recherche:
						<input type="text" name="recherche" id="recherche" value="<?php echo $recherche;?>" class="text_area" onChange="javascript:submitformulaire('index');" title=""/>
						<button onClick="javascript:submitformulaire('index');">Appliquer</button>

					<td nowrap="nowrap">                 
                    
                    
<select name="rubrique" id="etat class="inputbox" size="1" onChange="javascript:submitformulaire('index');">
<option value="0"  <?php if($rubrique==0){echo"selected='selected'";}?>>- Tri par thématique -</option>                 
 <?php                    
 $sql_rubrique = "SELECT * FROM thematique ORDER BY ordre_theme ASC"; 
 $req_rubrique = mysql_query( $sql_rubrique) or die('Erreur SQL !<br />'. $sql_rubrique.'<br />'.mysql_error()); 
     	
	while($a_req_rubrique=mysql_fetch_array ($req_rubrique))
			{	
	$id_theme=$a_req_rubrique["id_theme"];
	$nom_theme=$a_req_rubrique["nom_theme"];
		
	echo"<option value='$id_theme'"; if($rubrique==$id_theme){echo"selected='selected'";} echo">$nom_theme</option>";
			}
?>     
</select>
                    </td>
			  </tr>
			</table>

			<table class="adminlist" cellspacing="1">
			<thead>
				<tr>
					<th width="38">	<a href="#">#</a></th>
					<th width="28">&nbsp;</th>
					<th width="435" class="title">	<a href="#">Les cartes</a></th>
					<th width="258" nowrap="nowrap"  class="title"> <a href="#">Thématiques</a></th>
					<th width="150" nowrap="nowrap"  class="title"><a href="#">Date de mise en ligne</a></th>
					<th width="57"><a href="#">Etat</a></th>
			
				</tr>
			</thead>

<tfoot>
			<tr>
				<td colspan="10">
					<del class="container"><div class="pagination">

<div class="limit">Affichage #

<select name="limite_affichage" id="limite_affichage" class="inputbox" size="1" onChange="javascript:submitformulaire('index');">
<option value="20"  <?php if($limite_affichage==20){echo"selected='selected'";}?>>20</option>
<option value="30" <?php if($limite_affichage==30){echo"selected='selected'";}?>>30</option>
<option value="50" <?php if($limite_affichage==50){echo"selected='selected'";}?>>50</option>
<option value="100" <?php if($limite_affichage==100){echo"selected='selected'";}?>>100</option>
<option value="200" <?php if($limite_affichage==200){echo"selected='selected'";}?>>200</option>
<option value="500" <?php if($limite_affichage==500){echo"selected='selected'";}?>>500</option>
</select></div>

<?php
if($num_req > $limite_affichage) {
  $nombre_page=ceil($num_req/$limite_affichage);
  
   if($page_affichee==1) {echo "<div class='button2-right off'><div class='start'><span>Début</span></div></div><div class='button2-right off'><div class='prev'><span>Préc</span></div></div>";}
else{  
  ?>
<div class="button2-right"><div class="start"><a href="index.php?page_affichee=1" title="Début">Début</a></div></div>
<div class="button2-right"><div class="prev"><a href="index.php?page_affichee=<?php echo $page_affichee-1; ?>" title="Préc">Préc</a></div></div>

<?php
}
?>

<div class="button2-left">
<div class="page">

<?php
for ($i=1; $i<= $nombre_page; $i++) { 
 if($page_affichee==$i) {echo "<span>$i</span>";} else{echo"<a href='index.php?page_affichee=$i' title='$i'>$i</a>";}
				}

?>
</div></div>

<?php
if($page_affichee==$nombre_page) {echo"<div class='button2-left off'><div class='next'><span>Suivant</span></div></div><div class='button2-left off'><div class='end'><span>Fin</span></div></div>";}
else{
?>
<div class="button2-left"><div class="next"><a href="index.php?page_affichee=<?php echo $page_affichee+1; ?>" title="Suivant">Suivant</a></div></div>
<div class="button2-left"><div class="end"><a href="index.php?page_affichee=<?php echo $nombre_page; ?>" title="Fin">Fin</a></div></div>
<?php
}
?>

<div class="limit">Page <?php echo $page_affichee;?> sur <?php echo $nombre_page;?></div>

<?php
}
?>

</div>
</del>		</td>
			</tr>
			</tfoot>
			<tbody>           
            
<?php
$i = (($page_affichee-1)*$limite_affichage)+1;

while($a_requete=mysql_fetch_array($req))
{
$id_carte=$a_requete["id_carte"];
$nom_carte=stripslashes($a_requete["nom_carte"]);
$etat_carte=$a_requete["etat_carte"];

$miseenligne_carte=$a_requete["miseenligne_carte"];
$miseenligne_carte=date("d/m/Y", strtotime($miseenligne_carte));
			
?>			
					<tr class="row<?php echo ($i % 2); ?>">
					<td><?php echo $i; ?></td>
					<td><input type="radio" name="id_carte" id="id_carte" value="<?php echo $id_carte;?>"><label for="yy"></label></td>
					<td><a href="edit01.php?id_carte=<?php echo $id_carte;?>"><?php echo "$nom_carte";?></a></td>
				


<td align="left">  
                    
                    
               
               
<?php    


$sql2 = "SELECT * FROM carte_has_thematique,thematique,sous_thematique WHERE carte_has_thematique.id_carte ='".$id_carte."' AND carte_has_thematique.id_thematique = thematique.id_theme AND carte_has_thematique.id_sousthematique = sous_thematique.id_soustheme"; 
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
 
$b_requete=mysql_fetch_array($req2);
				

	$nom_theme=$b_requete["nom_theme"];
	$nom_soustheme=$b_requete["nom_soustheme"];
		
	
		echo"<span style=\"font-size:0.8em\"><b>$nom_theme</b> >> $nom_soustheme</span>";
	
?>
                   
                       
                               </select></td>








					<td align="center"> <?php echo $miseenligne_carte; ?> </td>
					<td align="left" class="order">
                    
<?php

if($etat_carte=="0"){echo "<img src=\"../includes/images/publish_x.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"non publié\" />";}
if($etat_carte=="1"){echo  "<img src=\"../includes/images/publish_g.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Publié\" />";}			
				
					
			

?>
                    </td>
					
				</tr>
								
       <?php   $i++;  } ?>                     
             
             	</tbody>
			</table>
		<input type="hidden" name="page_affichee" value="<?php echo $page_affichee; ?>" />
	
        
        </form>
		
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>

				</div>
			</div>
   		</div>
		<noscript>
			Attention! Le support du JavaScript doit être activé dans votre navigateur pour une utilisation optimale de l'Administration de Joomla!.		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>


<div id="border-bottom"><div><div></div></div></div>
	<div id="footer">
		<p class="copyright">Réalisé par le service Développements et Innovations numériques - 2015</p>

	</div>
    
<script language="JavaScript">
 
function submitformulaire(type){
	
if(type == 'index') {
	document.adminForm.method = "post";
	document.adminForm.action = "index.php";
	document.adminForm.submit();
	}

else{		
for(i=0;i<document.adminForm.vod.length;i++)
{
if(document.adminForm.vod[i].checked == true)
{var cochee = 1; break;}
else {var cochee = 0;}
}
if(cochee == 0)
{alert("Veuillez séléctionner une vidéo !");
return false;} 
else{	}
		}
}



</SCRIPT>
      
</body>
</html>
<?php
include("../includes/php_close.php");
?>