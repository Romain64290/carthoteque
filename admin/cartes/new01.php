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

<link rel="stylesheet" href="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.css">

 <script src="../includes/js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
 <script src="../includes/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <script src="../includes/js/jquery-ui-1.11.4.custom/date_francais.js"></script>
   
<script>
$(function() {
    $('#datepicker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
});
  </script>
  <style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
    
   
    <script> $(function() { var cache = {};$( "#tag1" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
    <script> $(function() { var cache = {};$( "#tag2" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag3" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag4" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag5" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag6" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag7" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag8" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag9" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>
	<script> $(function() { var cache = {};$( "#tag10" ).autocomplete({minLength: 2,source: function( request, response ) {var term = request.term;if ( term in cache ) {response( cache[ term ] ); return;} $.getJSON( "search.php", request, function( data, status, xhr ) { cache[ term ] = data; response( data ); }); } }); }); </script>


<style type="text/css">
<!--
.line {
	float: left;
}
-->
</style>


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
Etape suivante
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
Nouvelle carte  : étape 1/2</div>

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
	<legend>Infos carte
	</legend><table width="873" cellspacing="1" class="admintable">

		<tbody>
<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Titre</span></td>
				<td width="573"><input name="titre" type="text" class="text_area" value="" size="50" /></td>
</tr>		

<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Thématique associée</span></td>
				<td width="573">


<select name="rubrique"  class="inputbox" size="1">
<option value="0" >- Les thématiques -</option>                 
 <?php                    
 $sql_rubrique = "SELECT * FROM thematique ORDER BY ordre_theme ASC"; 
 $req_rubrique = mysql_query( $sql_rubrique) or die('Erreur SQL !<br />'. $sql_rubrique.'<br />'.mysql_error()); 
     	
	while($a_req_rubrique=mysql_fetch_array ($req_rubrique))
			{	
	$id_theme=$a_req_rubrique["id_theme"];
	$nom_theme=stripslashes($a_req_rubrique["nom_theme"]);
	
		echo"<optgroup label='$nom_theme'>";
$sql_ssrubrique = "SELECT * FROM sous_thematique WHERE thematique_id_theme='$id_theme' ORDER BY ordre_soustheme ASC"; 
$req_ssrubrique = mysql_query( $sql_ssrubrique) or die('Erreur SQL !<br />'. $sql_ssrubrique.'<br />'.mysql_error()); 
     	
	while($a_req_ssrubrique=mysql_fetch_array ($req_ssrubrique))
			{	
$id_soustheme=$a_req_ssrubrique["id_soustheme"];
$nom_soustheme=stripslashes($a_req_ssrubrique["nom_soustheme"]);
	
	echo"<option value='$id_theme-$id_soustheme'>$nom_soustheme</option>";
	
	
			}
	echo"</optgroup>";
			}
?>     
</select>
</td></tr>
	<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Date de création</span></td>
				<td width="573"><input type="text" id="datepicker" name="date"></td>
</tr>
<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Description</span></td>
				<td width="573"><textarea name="description" rows="8" cols="80"></textarea></td>
</tr>	
	<tr>
				<td width="218" valign="top" class="key"><span class="editlinktip hasTip">Prestation correspondante</span></td>
				<td width="573"><input name="prestation" type="text" class="text_area" value="" size="50" /></td>
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
								
	<legend> Mots-clés </legend>
	<table width="844" cellspacing="1" class="admintable">
	<tbody>
	<tr>
			<td width="500">
			<div class="line"> <input id="tag1" name="tag1"> - &nbsp;</div>
			<div class="line"> <input id="tag2" name="tag2"> - &nbsp;</div>
			<div class="line"> <input id="tag3" name="tag3"> - &nbsp;</div>
			<div class="line"> <input id="tag4" name="tag4"> - &nbsp;</div>
			<div class="line"> <input id="tag5" name="tag5">&nbsp;&nbsp;&nbsp;</div>
			<div class="line"> <input id="tag6" name="tag6"> - &nbsp;</div>
			<div class="line"> <input id="tag7" name="tag7"> - &nbsp;</div>
			<div class="line"> <input id="tag8" name="tag8"> - &nbsp;</div>
			<div class="line"> <input id="tag9" name="tag9"> - &nbsp;</div>
			<div class="line"> <input id="tag10" name="tag10">&nbsp;&nbsp;&nbsp;</div>

		
			
			</td>
			
   </tr>
   	
    </tbody>
	</table>
	
                          </fieldset>
                       
					</tr>
				</table>
	</div><div id="page-site">
	  <table class="noshow">
					<tr>
						<td width="55%">
							<fieldset class="adminform">
								
	<legend> Commentaire - usage interne, non communiqué en front office</legend>
	<table width="744" cellspacing="1" class="admintable">
	<tbody>
	<tr>
			<td width="300"><textarea name="commentaire" rows="8" cols="80"></textarea></td>
			
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
	
if(document.adminForm.titre.value == "")
{alert("Veuillez saisir un titre !");
document.adminForm.titre.focus();
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