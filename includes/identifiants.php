<?php 
try
{
//les idetifiant puor la bbd mysql pour eviter la Répétition
$db=new PDO('mysql:host=localhost;dbname=fienders_ar','fienders_admin','algerian.m1');
}
catch(Exeption $e)
{
die('Erreur:'.$e->getMessage());
}

?>
