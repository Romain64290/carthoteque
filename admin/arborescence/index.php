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

				<div class="header icon-48-menu">
Gestion des thématiques</div>

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
  <table class="adminlist">
    <thead>
    
		<tr>
			<th width="38">
				#			</th>
			<th width="38">&nbsp;</th>
			<th width="500" class="title">
			  <a href="javascript:tableOrdering('m.name','desc','');" title="Cliquer pour trier cette colonne">Élément de menu</a>			</th>
			<th width="80" nowrap="nowrap">
			  <a href="javascript:tableOrdering('m.ordering','desc','');" title="Cliquer pour trier cette colonne">Ordre<img src="../include/images/sort_asc.png" alt=""  /></a></th>
					</tr>
	</thead>
	
	<tbody>
			
 <?php
 
 $sql_num = "SELECT * FROM thematique ORDER BY id_theme ASC"; 
 $req_num = mysql_query($sql_num) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
 $num_req=mysql_num_rows($req_num);
  
 
for ($i=1; $i<=$num_req;) { 
 
 $sql1 = "SELECT * FROM thematique ORDER BY id_theme ASC";
 $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 

     
while($a_requete=mysql_fetch_array($req1))
{
$id_theme=$a_requete["id_theme"];
$nom_theme=$a_requete["nom_theme"];

$nom_theme=stripslashes($nom_theme);			
?>			
					                 
          <!-- Ligne pour l'affichage de la rubrique parente -->
            
            <tr class="row<?php echo ($i % 2); ?>">
			<td>
			<?php echo $i; $i++;?>		</td>

			<td><input type="radio" name="id_theme" id="id_theme" value="<?php echo "t_$id_theme";?>">
			  <label for="yy"></label></td>
						<td nowrap="nowrap">
								<span class="editlinktip hasTip" title="">
				<a href="edit.php?id_theme=<?php echo "t_$id_theme";?>"><?php echo $nom_theme;?></a></span>
							</td>
			<td class="order" nowrap="nowrap"> </td>
	
		</tr>
        
       
        
      <?php
	  
 $sql2 = "SELECT * FROM sous_thematique  WHERE thematique_id_theme='".$id_theme."'  ORDER BY ordre_soustheme ASC";
 $req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
 $num_req2=mysql_num_rows($req2);
     
  
  while($a_requete=mysql_fetch_array($req2))
{
$id_soustheme=$a_requete["id_soustheme"];
$nom_soustheme=$a_requete["nom_soustheme"];
$ordre_soustheme=$a_requete["ordre_soustheme"];

$nom_soustheme=stripslashes($nom_soustheme);
 ?>
 
   <!-- Ligne pour l'affichage de la rubrique enfant  -->
        
					<tr class="row<?php echo ($i % 2); ?>">
			<td>
				<?php echo $i;  $i++;?>		</td>
			<td><input type="radio" name="id_theme" id="id_theme" value="<?php echo "sst_$id_soustheme";?>"></td>
	
			<td nowrap="nowrap">
								<span class="editlinktip hasTip" title="Cliquez pour éditer cet élément de menu::.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>|_</sup>&nbsp;<?php echo $nom_soustheme;?>">
				<a href="edit.php?id_theme=<?php echo "sst_$id_soustheme";?>">.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>|_</sup>&nbsp;<?php echo $nom_soustheme;?></a></span>
							</td>
			<td class="order" nowrap="nowrap">
              <span>&nbsp;</span>
          
			 	 <span><?php if($ordre_soustheme!=0 AND $ordre_soustheme!=$num_req2 )	{echo"<a href='move.php?id_soustheme=$id_soustheme&move=down' onClick='' title='Déplacer vers le bas'>  <img src='../includes/images/downarrow.png' width='16' height='16' border='0' alt='Déplacer vers le bas' /></a>";} else{ echo"<div style='width:16px; height:16px;'></div>";}?> </span>
           	  <span><?php if($ordre_soustheme>1)	{echo"<a href='move.php?id_soustheme=$id_soustheme&move=up' onClick='' title='Déplacer vers le haut'>  <img src='../includes/images/uparrow.png' width='16' height='16' border='0' alt='Déplacer vers le haut' /></a>";} else{ echo"<div style='width:16px; height:16px;'></div>";}?> </span>
			    <?php echo $ordre_soustheme;?>
			  
			  </td>
			
		</tr>
 
 
 
 
 <?php

}
 
	  
}
 }
  ?>
      
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
    
       <div id="content-pane" class="pane-sliders"><div class="panel"></div>
       
       
       
<script language="JavaScript">
 
function submitformulaire(type){
	
	
for(i=0;i<document.adminForm.id_theme.length;i++)
{
if(document.adminForm.id_theme[i].checked == true)
{var cochee = 1; break;}
else {var cochee = 0;}
}
if(cochee == 0)
{alert("Veuillez séléctionner une rubrique !");
return false;} 
else{	

switch (type) {
	
case 'edit':
document.adminForm.method = "post";
document.adminForm.action = "edit.php" ;
document.adminForm.submit();
break;
  
 case 'trash':
if (window.confirm('Etes vous sûr de vouloir supprimer cette rubrique ?'))
{ document.adminForm.method = "post";
document.adminForm.action = "trash.php" ;
document.adminForm.submit();
return true;} 
else {return false;}
break;
}

}}



</SCRIPT>
    
</body>
</html>
<?php
include("../includes/php_close.php");
?>