<?php
include("../verif.php");
include("../includes/php_open.php");

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
        
      
        
	</div>
    
    
    
    
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

</div>
				<div class="header icon-48-config">
Les stats</div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>

				</div>
			</div>
  		</div>
   		<div class="clr"></div>
						
		
				
		<div id="element-box">
			<div class="t">
		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>

			<div class="m">
						<form name="adminForm">
				<div id="config-document">
			<div id="page-site"></div>

			<div id="page-system">
				<table class="noshow">
					<tr>
						<td width="60%">
							
							
	<fieldset class="adminform">
	<legend>Visites
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
			

<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Nbr. visites</span></td>
				<td width="573">
<?php
$sql = "SELECT * FROM visiteur";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
$nbr_visite=mysql_num_rows($req);

echo $nbr_visite;
?>
</td>
				</tr>
				
		</tbody>
	</table>
</fieldset>						
							
							
							
							
							
							
							
						  <fieldset class="adminform">
	<legend>Les cartes
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
			

<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Top 10</span></td>
				<td width="573">


<?php	
$sql_tag = "SELECT * FROM carte ORDER BY hit_carte DESC LIMIT 10";
$req_tag = mysql_query($sql_tag) or die('Erreur SQL !<br />'.$sql_tag.'<br />'.mysql_error()); 

for ($i=1; $i<=10;$i++) {
$carte_requete=mysql_fetch_array($req_tag);
$nom_carte=stripslashes($carte_requete["nom_carte"]);
$hit_carte=$carte_requete["hit_carte"];

echo"$i - $nom_carte - ($hit_carte vues)<br>";

}
?>

<br> 
</td>
				</tr>
				
		</tbody>
	</table>
</fieldset>
					
					<fieldset class="adminform">
	<legend>Les mots-clés
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
			

<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Top 10</span></td>
				<td width="573">
<?php	
$sql_tag = "SELECT * FROM tags ORDER BY hits_tag DESC LIMIT 10";
$req_tag = mysql_query($sql_tag) or die('Erreur SQL !<br />'.$sql_tag.'<br />'.mysql_error()); 

for ($i=1; $i<=10;$i++) {
$tag_requete=mysql_fetch_array($req_tag);
$nom_tag=stripslashes($tag_requete["nom_tag"]);
$hits_tag=$tag_requete["hits_tag"];

echo"$i - $nom_tag - ($hits_tag vues)<br>";

}
?>
<br> 
</td>
				</tr>
				
		</tbody>
	</table>
</fieldset>	  
						 
						</td>
					</tr>
				</table>
			</div>
			<div id="page-server">
				
			</div>
		</div>

		<div class="clr"></div>
       

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
    
        
    <div id="content-pane" class="pane-sliders"><div class="panel"></div>
    
    
    
<script language="JavaScript">
 
function submitformulaire(type){
	
if(type == 'sauver') {
	
if(document.adminForm.rubrique.value == 0)
{alert("Veuillez séléctionner une rubrique !");
document.adminForm.rubrique.focus();
return false;} 
else{		
	
	document.adminForm.method = "post";
	document.adminForm.action = "new02.php";
	document.adminForm.submit();
	
}
	
	}

}
</SCRIPT>


    
</body>
</html>
<?php
include("../includes/php_close.php");
?>