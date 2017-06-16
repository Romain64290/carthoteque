<?php
include("../verif.php");
include("../includes/php_open.php");

$q = $_GET["term"];


$return = array();
    $query = mysql_query("select * from tags where nom_tag like '$q%'");
    while ($row = mysql_fetch_array($query)) {
    array_push($return,array('label'=>$row['nom_tag'],'value'=>$row['nom_tag']));
}
echo(json_encode($return));

include("../includes/php_close.php");
?>
