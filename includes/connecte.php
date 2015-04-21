<?php

mysql_connect("localhost", "fienders_admin", "algerian.m1");
mysql_select_db("fienders_ar");


$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
$donnees = mysql_fetch_array($retour);

if ($donnees['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
{
    mysql_query('INSERT INTO connectes VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
}
else // L'ip se trouve déjà dans la table, on met juste à jour le timestamp
{
    mysql_query('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
}


$timestamp_5min = time() - (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes
mysql_query('DELETE FROM connectes WHERE timestamp < ' . $timestamp_5min);


$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes');
$donnees = mysql_fetch_array($retour);



echo '<div id="n_connecte">هناك ' . $donnees['nbre_entrees'] . ' زائر حاليا في هدا الموقع          <a href="./contact.html" class="bug">التبليغ عن وجود خطأ</a></div>';


?>
