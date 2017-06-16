<?php
include("../verif.php");
include("../includes/php_open.php");

if(!isset($_REQUEST['recherche'])){$recherche="";}else{$recherche=$_REQUEST['recherche'];}
if(!isset($_REQUEST['rubrique'])){$rubrique=0;}else{$rubrique=$_REQUEST['rubrique'];}
if(!isset($_REQUEST['page_affichee'])){$page_affichee=1;}else{$page_affichee=$_REQUEST['page_affichee'];}
if(!isset($_REQUEST['orderby'])){$orderby="ip_ip_autorisee ASC";}else{$orderby=$_REQUEST['orderby'];}
if(!isset($_REQUEST['limite_affichage'])){$limite_affichage=20;}else{$limite_affichage=$_REQUEST['limite_affichage'];}

$limite_basse=($page_affichee-1)*$limite_affichage;
$limite="$limite_basse,$limite_affichage"; 

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" id="minwidth" >

<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
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
  
 <script> $(function() { var cache = {};$( "#recherche" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "../cartes/search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
    

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
<li><a href="../gestion_ip/index.php"onmouseover="this.style.background='#fcfcfc';this.style.color='#599031';" onMouseOut="this.style.background='#f0f0f0';this.style.color='#333333';">Gestion des ip</a></li>
</ul>
</div>

<div class="clr"></div>

        
<?php   


if($recherche=="")
	{
$sql = "SELECT * FROM ip_autorisee ORDER BY ".$orderby." LIMIT ".$limite."";
$sql_num = "SELECT id_ip_autorisee FROM ip_autorisee ORDER BY ".$orderby."";
			
    } else
			{
		
			$sql = "SELECT * FROM ip_autorisee 
				WHERE description_ip_autorisee LIKE '%".$recherche."%' OR ip_ip_autorisee LIKE '%".$recherche."%'
				ORDER BY ".$orderby." LIMIT ".$limite."";
			$sql_num = "SELECT id_ip_autorisee FROM ip_autorisee 
				    WHERE description_ip_autorisee LIKE '%".$recherche."%' OR ip_ip_autorisee LIKE '%".$recherche."%'
				    ORDER BY ".$orderby."";
			
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

<div class="header icon-48-article"> Gestion des adresses ip autorisées</div>
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
						<input type="text" name="recherche" id="recherche" value="<?php echo $recherche;?>" class="text_area" onChange="javascript:submitformulaire('index');" title="Filtrez par titre ou saisissez un ID d'article"/>
						<button onClick="javascript:submitformulaire('index');">Appliquer</button>

					<td nowrap="nowrap">                 
                    
             
                    </td>
			  </tr>
			</table>
		

			<table class="adminlist" cellspacing="1">
			<thead>
				<tr>
					<th width="38">	<a href="#">#</a></th>
					<th width="28">&nbsp;</th>
					<th width="100" class="title">	<a href="#">Adresse IP</a></th>
					<th width="500" class="title">	<a href="#">Description</a></th>
								
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
$id_ip_autorisee=$a_requete["id_ip_autorisee"];
$ip_ip_autorisee=stripslashes($a_requete["ip_ip_autorisee"]);
$description_ip_autorisee=stripslashes($a_requete["description_ip_autorisee"]);


			
?>			
					<tr class="row<?php echo ($i % 2); ?>">
					<td><?php echo $i; ?></td>
					<td><input type="radio" name="id_ip_autorisee" id="id_ip_autorisee" value="<?php echo $id_ip_autorisee;?>"><label for="yy"></label></td>
					<td><a href="edit.php?id_ip_autorisee=<?php echo $id_ip_autorisee;?>"><?php echo $ip_ip_autorisee;?></a></td>
					<td><?php echo $description_ip_autorisee;?></td>
									
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
for(i=0;i<document.adminForm.id_ip_autorisee.length;i++)
{
if(document.adminForm.id_ip_autorisee[i].checked == true)
{var cochee = 1; break;}
else {var cochee = 0;}
}
if(cochee == 0)
{alert("Veuillez séléctionner un mot-clé !");
return false;} 
else{	

switch (type) {
	
case 'edit':
document.adminForm.method = "post";
document.adminForm.action = "edit.php" ;
document.adminForm.submit();
break;
  
 case 'trash':
if (window.confirm('Etes vous sûr de vouloir supprimer ce mot-clé ?'))
{ document.adminForm.method = "post";
document.adminForm.action = "trash.php" ;
document.adminForm.submit();
return true;} 
else {return false;}
break;
}
		}
}}



</SCRIPT>
      
</body>
</html>
<?php
include("../includes/php_close.php");
?>