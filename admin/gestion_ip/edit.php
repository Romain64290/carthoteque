<?php
include("../verif.php");
include("../includes/php_open.php");

$id_ip_autorisee=$_REQUEST['id_ip_autorisee'];


$sql = "SELECT * FROM ip_autorisee  WHERE id_ip_autorisee='$id_ip_autorisee'";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
$a_requete=mysql_fetch_array($req);

$ip_ip_autorisee=stripslashes($a_requete['ip_ip_autorisee']);	
$description_ip_autorisee=stripslashes($a_requete['description_ip_autorisee']);	
	


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
<table class="toolbar"><tr>
<td class="button" id="toolbar-save">
<a href="#" onClick="javascript:submitformulaire('sauver')" class="toolbar">
<span class="icon-32-save" title="Sauver">
</span>
Sauver
</a>
</td>




<td class="button" id="toolbar-cancel">
<a href="index.php" onClick="" class="toolbar">
<span class="icon-32-cancel" title="Fermer">
</span>
Annuler
</a>
</td>

</tr></table>
</div>
				<div class="header icon-48-config">
Editer une adresse IP</div>

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
	<legend>Adresse ip
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
			
		
				<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Adresse IP</span></td>
				<td width="573"><input name="ip_ip_autorisee" type="text" class="text_area" value="<?php echo $ip_ip_autorisee; ?>" size="50" /></td>
				</tr>
<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Description</span></td>
				<td width="573"><input name="description_ip_autorisee" type="text" class="text_area" value="<?php echo $description_ip_autorisee; ?>" size="50" /></td>
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
        
        <input name="id_ip_autorisee" type="hidden" value="<?php echo $id_ip_autorisee; ?>">

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
	document.adminForm.method = "post";
	document.adminForm.action = "edit02.php";
	document.adminForm.submit();
	}

}
</SCRIPT>


    
</body>
</html>
<?php
include("../includes/php_close.php");
?>