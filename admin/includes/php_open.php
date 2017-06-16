<?php 

$db =mysql_connect("localhost","root","eruption")or die(mysql_error()."<br><b>Site momentanément indisponible</b>");
mysql_select_db('cartes',$db);
mysql_query("SET NAMES UTF8");
?>
