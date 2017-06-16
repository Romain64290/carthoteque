<?php
include("../verif.php");
include("../includes/php_open.php");

$id_carte=$_GET['id_carte'];

$sql1= "SELECT etat_carte FROM carte WHERE id_carte=$id_carte";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$a_req1=mysql_fetch_array($req1);
$etat_carte=$a_req1["etat_carte"];

function verif_presence($id_carte,$type_format,$extension_format)
{
	
$sql= "SELECT * FROM carte_has_format WHERE id_carte=$id_carte AND type_format=$type_format AND extension_format LIKE '$extension_format'";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
$num_req=mysql_num_rows($req);

if($num_req>0)echo"<b> &nbsp;&nbsp;&nbsp;{Fichier présent}</b>";
}



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

<link rel="stylesheet" href="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.css">

 <script src="../includes/js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
 <script src="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
 


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
Enregistrer
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
Nouvelle carte  : étape 2/2</div>

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
	<legend>Info carte
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
		
<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Publication</span></td>
				<td width="573">
					
<select name="publication" id="publication" class="inputbox" size="1">
<option value="1"<?php if($etat_carte==1){echo"selected";}?> >oui</option>
<option value="0"<?php if($etat_carte==0){echo"selected";}?> >non</option>
</select></td>
</tr>			
		</tbody>
	</table>
</fieldset>
						  
						 
						</td>
					</tr>
				</table>
			</div>
			
			
			
	<div id="page-site">
	  <table class="noshow">
					<tr>
						<td width="55%">
							<fieldset class="adminform">
								
	<legend> PDF - Upload </legend>
	<table width="744" cellspacing="1" class="admintable">
	<tbody>
	<tr>
		
	<label for="pdfa0">A0 :</label> <input type="file" name="pdfa0" id="pdfa0" /><?php verif_presence($id_carte,0, PDF); ?><br /><br />
	<label for="pdfa1">A1 :</label> <input type="file" name="pdfa1" id="pdfa1" /><?php verif_presence($id_carte,1, PDF); ?><br /><br />
	<label for="pdfa2">A2 :</label> <input type="file" name="pdfa2" id="pdfa2" /><?php verif_presence($id_carte,2, PDF); ?><br /><br />
	<label for="pdfa3">A3 :</label> <input type="file" name="pdfa3" id="pdfa3" /><?php verif_presence($id_carte,3, PDF); ?><br /><br />
	<label for="pdfa4">A4 :</label> <input type="file" name="pdfa4" id="pdfa4" /><?php verif_presence($id_carte,4, PDF); ?><br />
    
     </td>
    
			
   </tr>
   	
    </tbody>
	</table>
	
                          </fieldset>
                       
					</tr>
				</table>
	</div>	
	
	
	<div id="page-site">
	  <table class="noshow">
					<tr>
						<td width="55%">
							<fieldset class="adminform">
								
	<legend> JPG - Upload </legend>
	<table width="744" cellspacing="1" class="admintable">
	<tbody>
	<tr>
			<td width="300">

	<label for="jpga0">A0 :</label> <input type="file" name="jpga0" id="jpga0" /><?php verif_presence($id_carte,0, JPG); ?><br /><br />
	<label for="jpga1">A1 :</label> <input type="file" name="jpga1" id="jpga1" /><?php verif_presence($id_carte,1, JPG); ?><br /><br />
	<label for="jpga2">A2 :</label> <input type="file" name="jpga2" id="jpga2" /><?php verif_presence($id_carte,2, JPG); ?><br /><br />
	<label for="jpga3">A3 :</label> <input type="file" name="jpga3" id="jpga3" /><?php verif_presence($id_carte,3, JPG); ?><br /><br />
	<label for="jpga4">A4 :</label> <input type="file" name="jpga4" id="jpga4" /><?php verif_presence($id_carte,4, JPG); ?><br />


</td>
			
   </tr>
   	
    </tbody>
	</table>
	
                          </fieldset>
                       
					</tr>
				</table>
	</div>	
	
	<div id="page-site">
	  <table class="noshow">
					<tr>
						<td width="55%">
							<fieldset class="adminform">
								
	<legend> Vignette - Upload (Format 630px * 420px en JPG)</legend>
	<table width="744" cellspacing="1" class="admintable">
	<tbody>
	<tr>
			<td width="300">

	<label for="vignette"></label> <input type="file" name="vignette" id="vignette" /><?php echo"<b> &nbsp;&nbsp;&nbsp;{Fichier présent}</b>"; ?><br />


</td>
			
   </tr>
   	
    </tbody>
	</table>
	
                          </fieldset>
                       
					</tr>
				</table>
	</div>	
	
			
			<div id="page-server">
				
			</div>
		</div>

		<div class="clr"></div>
       	<input type="hidden" name="id" value="<?php echo $id_carte;?>" />
			<input type="hidden" name="MAX_FILE_SIZE" value="100480576" />
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
	
if(type == 'sauver') {
	
	document.adminForm.method = "post";
	document.adminForm.action = "edit04.php";
	document.adminForm.enctype = "multipart/form-data";
	document.adminForm.submit();
	
	}

}
</SCRIPT>


    
</body>
</html>
<?php
include("../includes/php_close.php");
?>