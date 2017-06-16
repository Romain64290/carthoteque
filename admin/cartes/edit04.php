<?php

include("../verif.php");
include("../includes/php_open.php");

$id=$_POST['id'];
$maxsize=$_POST['MAX_FILE_SIZE'];

$publication=$_POST['publication'];

$sql = "UPDATE carte SET etat_carte=$publication WHERE id_carte=$id";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


$destination="/var/www/cartes/cartes/$id/";
$extension_jpg=array('jpg','JPG','jpeg','JPEG');
$extension_pdf=array('pdf','PDF');

$pdfa0_destination=$destination.$id."_a0.pdf";
$pdfa1_destination=$destination.$id."_a1.pdf";
$pdfa2_destination=$destination.$id."_a2.pdf";
$pdfa3_destination=$destination.$id."_a3.pdf";
$pdfa4_destination=$destination.$id."_a4.pdf";

$jpga0_destination=$destination.$id."_a0.jpg";
$jpga1_destination=$destination.$id."_a1.jpg";
$jpga2_destination=$destination.$id."_a2.jpg";
$jpga3_destination=$destination.$id."_a3.jpg";
$jpga4_destination=$destination.$id."_a4.jpg";

$vignette_destination=$destination.$id."_vignette.jpg";
$vignetteg_destination=$destination.$id."_vignette_g.jpg";
$vignettep_destination=$destination.$id."_vignette_p.jpg";


function upload($index,$destination,$maxsize,$extensions)
{			
		  if ( $_FILES[$index]['error'] > 0) return FALSE;

  				 //Test2: taille limite
     			if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;

   				//Test3: extension
     			$ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     			if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;					
					
			return move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
				
}

function carte_has_format($id,$type_format,$extension_format,$poids_carte)
{

$sql3= "SELECT * FROM carte_has_format WHERE id_carte=$id AND type_format=$type_format AND extension_format LIKE '$extension_format'";
$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error()); 
$num_req3=mysql_num_rows($req3);
if($num_req3==0){
$sql1="INSERT INTO carte_has_format VALUES ('','$id','$type_format','$extension_format','$poids_carte')";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());	}			
else{
$sql4="UPDATE carte_has_format SET poids_carte=$poids_carte WHERE id_carte=$id AND type_format=$type_format AND extension_format LIKE '$extension_format' ";
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error());	
}
}

function verif_presence($id_carte,$type_format,$extension_format)
{
	
$sql= "SELECT * FROM carte_has_format WHERE id_carte=$id_carte AND type_format=$type_format AND extension_format LIKE '$extension_format'";
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
return $num_req=mysql_num_rows($req);

}

function darkroom($img, $to, $width = 0, $height = 0){
 
	$dimensions = getimagesize($img);
	$ratio      = $dimensions[0] / $dimensions[1];
 
	// Calcul des dimensions si 0 passé en paramètre
	if($width == 0 && $height == 0){
		$width = $dimensions[0];
		$height = $dimensions[1];
	}elseif($height == 0){
		$height = round($width / $ratio);
	}elseif ($width == 0){
		$width = round($height * $ratio);
	}
 
	if($dimensions[0] > ($width / $height) * $dimensions[1]){
		$dimY = $height;
		$dimX = round($height * $dimensions[0] / $dimensions[1]);
		$decalX = ($dimX - $width) / 2;
		$decalY = 0;
	}
	if($dimensions[0] < ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = round($width * $dimensions[1] / $dimensions[0]);
		$decalY = ($dimY - $height) / 2;
		$decalX = 0;
	}
	if($dimensions[0] == ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = $height;
		$decalX = 0;
		$decalY = 0;
	}
 

		$pattern = imagecreatetruecolor($width, $height);
		$type = mime_content_type($img);
		switch (substr($type, 6)) {
			case 'jpeg':
				$image = imagecreatefromjpeg($img);
				break;
			case 'gif':
				$image = imagecreatefromgif($img);
				break;
			case 'png':
				$image = imagecreatefrompng($img);
				break;
		}
		imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
		imagedestroy($image);
		imagejpeg($pattern, $to, 100);
 
		return TRUE;
 
      
}

// Lance l'upload du fichier s'il est présent et attribut un etat au fichier
if($_FILES['pdfa0']['size'] > 0) {$pdfa0_up=upload('pdfa0',$pdfa0_destination,$maxsize,$extension_pdf);if ($pdfa0_up){ $pdfa0_etat="ok";carte_has_format($id,0,PDF,$_FILES['pdfa0']['size']);} else{$pdfa0_etat="no";}} else{$pdfa0_present=verif_presence($id,0,PDF);if($pdfa0_present){$pdfa0_etat="present";}else{$pdfa0_etat="manquant";}}
if($_FILES['pdfa1']['size'] > 0) {$pdfa1_up=upload('pdfa1',$pdfa1_destination,$maxsize,$extension_pdf);if ($pdfa1_up){ $pdfa1_etat="ok";carte_has_format($id,1,PDF,$_FILES['pdfa1']['size']);} else{$pdfa1_etat="no";}} else{$pdfa1_present=verif_presence($id,1,PDF);if($pdfa1_present){$pdfa1_etat="present";}else{$pdfa1_etat="manquant";}}
if($_FILES['pdfa2']['size'] > 0) {$pdfa2_up=upload('pdfa2',$pdfa2_destination,$maxsize,$extension_pdf);if ($pdfa2_up){ $pdfa2_etat="ok";carte_has_format($id,2,PDF,$_FILES['pdfa2']['size']);} else{$pdfa2_etat="no";}} else{$pdfa2_present=verif_presence($id,2,PDF);if($pdfa2_present){$pdfa2_etat="present";}else{$pdfa2_etat="manquant";}}
if($_FILES['pdfa3']['size'] > 0) {$pdfa3_up=upload('pdfa3',$pdfa3_destination,$maxsize,$extension_pdf);if ($pdfa3_up){ $pdfa3_etat="ok";carte_has_format($id,3,PDF,$_FILES['pdfa3']['size']);} else{$pdfa3_etat="no";}} else{$pdfa3_present=verif_presence($id,3,PDF);if($pdfa3_present){$pdfa3_etat="present";}else{$pdfa3_etat="manquant";}}
if($_FILES['pdfa4']['size'] > 0) {$pdfa4_up=upload('pdfa4',$pdfa4_destination,$maxsize,$extension_pdf);if ($pdfa4_up){ $pdfa4_etat="ok";carte_has_format($id,4,PDF,$_FILES['pdfa4']['size']);} else{$pdfa4_etat="no";}} else{$pdfa4_present=verif_presence($id,4,PDF);if($pdfa4_present){$pdfa4_etat="present";}else{$pdfa4_etat="manquant";}}

if($_FILES['jpga0']['size'] > 0) {$jpga0_up=upload('jpga0',$jpga0_destination,$maxsize,$extension_jpg);if ($jpga0_up){ $jpga0_etat="ok";carte_has_format($id,0,JPG,$_FILES['jpga0']['size']);} else{$jpga0_etat="no";}} else{$jpga0_present=verif_presence($id,0,JPG);if($jpga0_present){$jpga0_etat="present";}else{$jpga0_etat="manquant";}}
if($_FILES['jpga1']['size'] > 0) {$jpga1_up=upload('jpga1',$jpga1_destination,$maxsize,$extension_jpg);if ($jpga1_up){ $jpga1_etat="ok";carte_has_format($id,1,JPG,$_FILES['jpga1']['size']);} else{$jpga1_etat="no";}} else{$jpga1_present=verif_presence($id,1,JPG);if($jpga1_present){$jpga1_etat="present";}else{$jpga1_etat="manquant";}}
if($_FILES['jpga2']['size'] > 0) {$jpga2_up=upload('jpga2',$jpga2_destination,$maxsize,$extension_jpg);if ($jpga2_up){ $jpga2_etat="ok";carte_has_format($id,2,JPG,$_FILES['jpga2']['size']);} else{$jpga2_etat="no";}} else{$jpga2_present=verif_presence($id,2,JPG);if($jpga2_present){$jpga2_etat="present";}else{$jpga2_etat="manquant";}}
if($_FILES['jpga3']['size'] > 0) {$jpga3_up=upload('jpga3',$jpga3_destination,$maxsize,$extension_jpg);if ($jpga3_up){ $jpga3_etat="ok";carte_has_format($id,3,JPG,$_FILES['jpga3']['size']);} else{$jpga3_etat="no";}} else{$jpga3_present=verif_presence($id,3,JPG);if($jpga3_present){$jpga3_etat="present";}else{$jpga3_etat="manquant";}}
if($_FILES['jpga4']['size'] > 0) {$jpga4_up=upload('jpga4',$jpga4_destination,$maxsize,$extension_jpg);if ($jpga4_up){ $jpga4_etat="ok";carte_has_format($id,4,JPG,$_FILES['jpga4']['size']);} else{$jpga4_etat="no";}} else{$jpga4_present=verif_presence($id,4,JPG);if($jpga4_present){$jpga4_etat="present";}else{$jpga4_etat="manquant";}}

if($_FILES['vignette']['size'] > 0) {$vignette_up=upload('vignette',$vignette_destination,$maxsize,$extension_jpg);if ($vignette_up){ $vignette_etat="ok";darkroom($vignette_destination,$vignetteg_destination, $width = 630, $height = 420);darkroom($vignette_destination,$vignettep_destination, $width = 135, $height = 90);} else{$vignette_etat="no";}} else{}


include("../includes/php_close.php");


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

<td class="button" id="toolbar-back">
<a href="index.php" onClick="" class="toolbar">
<span class="icon-32-back" title="Fermer">
</span>
Retour
</a>
</td>

</tr></table>
</div>
				<div class="header icon-48-config">
Nouvelle carte  : Fin</div>

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

				<div id="config-document">
			
		
	
	<div id="page-site">
	  <table class="noshow">
					<tr>
						<td width="55%">
							<fieldset class="adminform">
								
	<legend> Recapitulatif upload </legend>
	<table width="744" cellspacing="1" class="admintable">
	<tbody>
	<tr>
			<td width="300">

<?php

switch ($pdfa0_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A0 en PDF present<br></div>";
        break;
    case "manquant":
        echo "<div style='color:#FFA500'>Fichier AO en Pdf Manquant <br></div>";
        break;
    case "ok":
        echo "<div style='color:#00FF00'>Transfert du fichier PDF en AO réussi <br></div>";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier PDF en AO <br></div>";
        break;
}

switch ($pdfa1_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A1 en PDF present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A1 en Pdf Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier PDF en A1 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier PDF en A1 <br></div>";
        break;
}

switch ($pdfa2_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A2 en PDF present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A2 en Pdf Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier PDF en A2 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier PDF en A2 <br></div>";
        break;
}

switch ($pdfa3_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A3 en PDF present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A3 en Pdf Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier PDF en A3 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier PDF en A3 <br></div>";
        break;
}

switch ($pdfa4_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A4 en PDF present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A4 en Pdf Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier PDF en A4 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier PDF en A4 <br></div>";
        break;
}

switch ($jpga0_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A0 en JPEG present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A0 en JPEG Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier JPEG en A0 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier JPEG  en A0 <br></div>";
        break;
}

switch ($jpga1_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A1 en JPEG present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A1 en JPEG Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier JPEG en A1 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier JPEG  en A1 <br></div>";
        break;
}

switch ($jpga2_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A2 en JPEG present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A2 en JPEG Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier JPEG en A2 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier JPEG  en A2 <br></div>";
        break;
}

switch ($jpga3_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A3 en JPEG present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A3 en JPEG Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier JPEG en A3 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier JPEG  en A3 <br></div>";
        break;
}

switch ($jpga4_etat) {
	case "present":
         echo "<div style='color:#00FF00'>Fichier A4 en JPEG present<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FFA500'>Fichier A4 en JPEG Manquant <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert du fichier JPEG en A4 réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert du fichier JPEG  en A4 <br></div>";
        break;
}

switch ($vignette_etat) {
	case "present":
         echo "<div style='color:#00FF00'>La Vignette est presente<br></div>";
        break;
    case "manquant":
         echo "<div style='color:#FF0000'>La Vignette d'illustration est manquante <br></div>";
        break;
    case "ok":
         echo "<div style='color:#00FF00'>Transfert de la vignette réussi <br></div> ";
        break;
    case "no":
        echo "<div style='color:#FF0000'>Echec du transfert de la vignette <br></div>";
        break;
}

?>	


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
    
    
</body>
</html>
