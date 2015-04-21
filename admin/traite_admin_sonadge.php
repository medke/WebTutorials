<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Rédiger sondage</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style type="text/css">
        h3, form
        {
            text-align:center;
        }
        </style>
    </head>
    
    <body><?php
	include("../includes/identifiants.php");

if (isset($_POST['titre']) AND isset($_POST['choix1']) AND isset($_POST['choix2']) AND isset($_POST['choix3']) AND isset($_POST['choix4']) )
{
$titre = htmlspecialchars($_POST['titre']);
$choix1=htmlspecialchars($_POST['choix1']);
$choix2=htmlspecialchars($_POST['choix2']);
$choix3=htmlspecialchars($_POST['choix3']);
$choix4=htmlspecialchars($_POST['choix4']);

$req = $db->prepare('INSERT INTO sondage(titre,choix1, choix2, choix3, choix4) VALUES(:titre, :choix1, :choix2, :choix3, :choix4)');
	$req->bindValue(':titre' , $titre, PDO::PARAM_STR);
	$req->bindValue(':choix1', $choix1, PDO::PARAM_STR);
	$req->bindValue(':choix2', $choix2, PDO::PARAM_STR);
	$req->bindValue(':choix3', $choix3, PDO::PARAM_STR);
	$req->bindValue(':choix4', $choix4, PDO::PARAM_STR);
	$req->execute();

echo 'Le vote est bien ajoutè';


}
elseif(isset($_POST['supp_choix'])){
$supp_choix = htmlspecialchars($_POST['supp_choix']);
if($supp_choix!=0){
//sucerite
$query=$db->query('DELETE FROM sondage  WHERE id=\'' . $supp_choix . '\'');
$query=$db->query('DELETE FROM dvote  WHERE id=\'' . $supp_choix . '\'');
$query=$db->query('DELETE FROM vote  WHERE id=\'' . $supp_choix . '\'');

echo'le sondage nemero   '.$supp_choix.'   est bien suprimer ';
}
else{
$query=$db->query('DELETE  FROM sondage ');
$query=$db->query('DELETE  FROM vote ');
$query=$db->query('DELETE  FROM dvote ');
echo'tous le sondage sont supprimer ';
}}
else
{
echo"tu a oublies de remplir un champ";
}
?>
</body>
</html>