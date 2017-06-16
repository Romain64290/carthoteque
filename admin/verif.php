<?php
session_start();

/*
si la variable de session login n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres*/

if(!isset($_SESSION['login'])) {
  echo 'Vous n\'êtes pas autorisé à acceder à cette zone';
  exit;
}

?> 