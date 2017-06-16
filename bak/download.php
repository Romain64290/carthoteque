<?php
include("admin/includes/php_open.php");
include("admin/verif_ip.php");

$id_carte=$_REQUEST['id_carte'];
$type=$_REQUEST['type'];
$extension=$_REQUEST['extention'];
$extension=strtolower($extension);

$sql = "UPDATE carte SET hit_carte=hit_carte+1 WHERE id_carte ='$id_carte'"; 
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$name=$id_carte."_a".$type.".".$extension;
$dossier="cartes/$id_carte/";

$file = $dossier.$name;

    header('Content-Type: application/force-download');
    header("Content-Transfer-Encoding: binary");
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    readfile($file);
    exit();
?>