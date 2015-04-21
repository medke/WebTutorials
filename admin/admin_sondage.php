<?php
session_start();
include("../includes/identifiants.php");
include("../includes/debut.php");
if (!verif_auth(ADMIN))  erreur("<h1>vous etes pas mon admisnitrateur</h1>");
$titre='';
$choix1='';
$choix2='';
$choix3='';
$choix4='';
 
?>

<form action="traite_admin_sonadge.php" method="post">
<p>Titre : <input type="text" id="txt" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
 <p>
  <br />
       <textarea name="choix1"   cols="50" rows="1"> </textarea><br />
      <textarea name="choix2"  cols="50" rows="1"> </textarea><br />
        <textarea name="choix3"  cols="50" rows="1"> </textarea><br />
      <textarea name="choix4"  cols="50" rows="1"> </textarea>
      <input type="submit" id="submit" name="rediger" value="Envoyer" /><br /><br />
	  

  </p>

</form>
<form action="traite_admin_sonadge.php" method="post">
<textarea name="supp_choix"  id="supp_choix" cols="10" rows="1"> </textarea><br />
 <input type="submit" id="submit" value="suprimer" /><br />
<form>

</body>
</html>